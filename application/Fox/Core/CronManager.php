<?php
namespace Fox\Core;

use \PDO;
use Fox\Core\Utils\Json;
use Fox\Core\Exceptions\NotFound;
use GuzzleHttp\json_decode;

class CronManager
{
    private $container;
    private $config;
    private $fileManager;
    private $entityManager;

    private $scheduledJobUtil;

    const PENDING = 'Pending';
    const RUNNING = 'Running';
    const SUCCESS = 'Success';
    const FAILED = 'Failed';

    protected $lastRunTime = 'data/cache/application/cronLastRunTime.php';

    public function __construct(\Fox\Core\Container $container)
    {
        $this->container = $container;

        $this->config = $this->container->make('config');
        $this->fileManager = $this->container->make('fileManager');
        $this->entityManager = $this->container->make('entityManager');
        $this->serviceFactory = $this->container->make('serviceFactory');

        $this->scheduledJobUtil = $this->container->make('scheduledJob');
        $this->cronJob = new \Fox\Core\Utils\Cron\Job($this->config, $this->entityManager);
        $this->cronScheduledJob = new \Fox\Core\Utils\Cron\ScheduledJob($this->config, $this->entityManager);
    }

    protected function getLastRunTime()
    {
        $lastRunData = $this->fileManager->getPhpContents($this->lastRunTime);

        $lastRunTime = time() - intval($this->config->get('cron.minExecutionTime')) - 1;
        if (is_array($lastRunData) && !empty($lastRunData['time'])) {
            $lastRunTime = $lastRunData['time'];
        }

        return $lastRunTime;
    }

    protected function setLastRunTime($time)
    {
        $data = array(
            'time' => $time,
        );
        return $this->fileManager->putPhpContents($this->lastRunTime, $data);
    }

    protected function checkLastRunTime()
    {
        $currentTime = time();
        $lastRunTime = $this->getLastRunTime();
        $minTime = $this->config->get('cron.minExecutionTime');

        if ($currentTime > ($lastRunTime + $minTime) ) {
            return true;
        }

        return false;
    }

    /**
     * Run Cron
     *
     * @return void
     */
    public function run()
    {
        if (!$this->checkLastRunTime()) {
            logger()->info('CronManager: Stop cron running, too frequent execution.');
            return;
        }

        $this->setLastRunTime(time());

        $entityManager = $this->entityManager;

        $cronJob = $this->cronJob;
        $cronScheduledJob = $this->cronScheduledJob;

        //Check scheduled jobs and create related jobs
        $this->createJobsFromScheduledJobs();

        $pendingJobs = $cronJob->getPendingJobs();

        foreach ($pendingJobs as $job) {

            $jobEntity = $entityManager->getEntity('Job', $job['id']);

            if (!isset($jobEntity)) {
                logger()->error('CronManager: empty Job entity ['.$job['id'].'].');
                continue;
            }

            $jobEntity->set('status', self::RUNNING);
            $entityManager->saveEntity($jobEntity);

            $isSuccess = true;

            try {
                if (!empty($job['scheduled_job_id'])) {
                    $this->runScheduledJob($job);
                } else {
                    $this->runService($job);
                }
            } catch (\Exception $e) {
                $isSuccess = false;
                logger()->error('CronManager: Failed job running, job ['.$job['id'].']. Error Details: '.$e->getMessage());
            }

            $status = $isSuccess ? self::SUCCESS : self::FAILED;

            $jobEntity->set('status', $status);
            $entityManager->saveEntity($jobEntity);

            //set status in the schedulerJobLog
            if (!empty($job['scheduled_job_id'])) {
                $cronScheduledJob->addLogRecord($job['scheduled_job_id'], $status);
            }
        }
    }

    /**
     * Run Scheduled Job
     *
     * @param  array  $job
     *
     * @return void
     */
    protected function runScheduledJob(array $job)
    {
        $jobName = $job['method'];

        $className = $this->scheduledJobUtil->get($jobName);
        if ($className === false) {
            throw new NotFound();
        }

        $jobClass = new $className($this->container);
        $method = $this->scheduledJobUtil->getMethodName();
        if (!method_exists($jobClass, $method)) {
            throw new NotFound();
        }

        $jobClass->$method();
    }

    /**
     * Run Service
     *
     * @param  array  $job
     *
     * @return void
     */
    protected function runService(array $job)
    {
        $serviceName = $job['service_name'];

        if (!$this->serviceFactory->checkExists($serviceName)) {
            throw new NotFound();
        }

        $service = $this->serviceFactory->create($serviceName);
        $serviceMethod = $job['method'];

        if (!method_exists($service, $serviceMethod)) {
            throw new NotFound();
        }

        $data = $job['data'];
        if (Json::isJSON($data)) {
            $data = json_decode($data, true);
        }

        $service->$serviceMethod($data);
    }

    /**
     * Check scheduled jobs and create related jobs
     *
     * @return array  List of created Jobs
     */
    protected function createJobsFromScheduledJobs()
    {
        $entityManager = $this->entityManager;

        $activeScheduledJobs = $this->cronScheduledJob->getActiveJobs();

        $cronJob = $this->cronJob;
        $runningScheduledJobs = $cronJob->getActiveJobs('scheduled_job_id', self::RUNNING, PDO::FETCH_COLUMN);

        $createdJobs = array();
        foreach ($activeScheduledJobs as $scheduledJob) {

            if (in_array($scheduledJob['id'], $runningScheduledJobs)) {
                continue;
            }

            $scheduling = $scheduledJob['scheduling'];

            $cronExpression = \Cron\CronExpression::factory($scheduling);

            try {
                $prevDate = $cronExpression->getPreviousRunDate()->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                logger()->error('CronManager: ScheduledJob ['.$scheduledJob['id'].']: CronExpression - Impossible CRON expression ['.$scheduling.']');
                continue;
            }

            if ($cronExpression->isDue()) {
                $prevDate = date('Y-m-d H:i:s');
            }

            $existsJob = $cronJob->getJobByScheduledJob($scheduledJob['id'], $prevDate);

            if (!isset($existsJob) || empty($existsJob)) {
                //create a new job
                $jobEntity = $entityManager->getEntity('Job');
                $jobEntity->set(array(
                    'name' => $scheduledJob['name'],
                    'status' => self::PENDING,
                    'scheduledJobId' => $scheduledJob['id'],
                    'executeTime' => $prevDate,
                    'method' => $scheduledJob['job'],
                ));
                $jobEntityId = $entityManager->saveEntity($jobEntity);
                if (!empty($jobEntityId)) {
                    $createdJobs[] = $jobEntityId;
                }
            }
        }

        return $createdJobs;
    }
}
