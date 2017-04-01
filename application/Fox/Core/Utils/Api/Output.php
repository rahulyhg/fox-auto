<?php
namespace Fox\Core\Utils\Api;

class Output
{
    protected $slim;

    protected $errorDesc = array(
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Page Not Found',
        409 => 'Conflict',
        500 => 'Internal Server Error',
    );


    public function __construct(\Fox\Core\Utils\Api\Slim $slim)
    {
        $this->slim = $slim;
    }

    protected function getSlim()
    {
        return $this->slim;
    }

    /**
    * Output the result
    *
    * @param mixed $data - JSON
    */
    public function render($data = null)
    {
        if (is_array($data)) {
            $dataArr = array_values($data);
            $data = empty($dataArr[0]) ? false : $dataArr[0];
        }

        ob_clean();
        echo $data;
    }

    public function processError($message = 'Error', $code = 500, $isPrint = false)
    {
        $currentRoute = $this->slim->router()->getCurrentRoute();

        if (isset($currentRoute)) {
            $inputData = $this->slim->request()->getBody();
            $inputData = $this->clearPasswords($inputData);
            logger()->error('API ['.$this->slim->request()->getMethod().']:'.$currentRoute->getPattern().', Params:'.print_r($currentRoute->getParams(), true).', InputData: '.$inputData.' - '.$message);
        }

        $this->displayError($message, $code, $isPrint);
    }

    /**
    * Output the error and stop app execution
    *
    * @param string $text
    * @param int $statusCode
    *
    * @return void
    */
    public function displayError($text, $statusCode = 500, $isPrint = false)
    {
        logger()->error('Display Error: '.$text.', Code: '.$statusCode.' URL: '.$_SERVER['REQUEST_URI']);

        ob_clean();

        if (!empty( $this->slim)) {
            $this->slim->response()->status($statusCode);
            $this->slim->response()->header('X-Status-Reason', $text);

            if ($isPrint) {
                $status = $this->getCodeDesc($statusCode);
                $status = isset($status) ? $statusCode.' '.$status : 'HTTP '.$statusCode;
                $this->slim->printError($text, $status);
            }

            $this->slim->stop();
        } else {
            logger()->info('Could not get Slim instance. It looks like a direct call (bypass API). URL: '.$_SERVER['REQUEST_URI']);
            die($text);
        }
    }

    /**
     * Get status code desription
     *
     * @param  int $statusCode
     * @return string | null
     */
    protected function getCodeDesc($statusCode)
    {
        if (isset($this->errorDesc[$statusCode])) {
            return $this->errorDesc[$statusCode];
        }

        return null;
    }

    /**
     * Clear passwords for inputData
     *
     * @param  string $inputData
     *
     * @return string
     */
    protected function clearPasswords($inputData)
    {
        return preg_replace('/"(.*?password.*?)":".*?"/i', '"$1":"*****"', $inputData);
    }
}
