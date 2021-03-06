<?php


namespace Fox\Modules\Crm\Business\Reminder;

use \Fox\ORM\Entity;

class EmailReminder
{
    protected $entityManager;

    protected $mailSender;

    protected $config;

    protected $dateTime;

    protected $language;


    public function __construct($entityManager, $mailSender, $config, $dateTime, $language)
    {
        $this->entityManager = $entityManager;
        $this->mailSender = $mailSender;
        $this->config = $config;
        $this->dateTime = $dateTime;
        $this->language = $language;
    }

    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    protected function parseInvitationTemplate($contents, $entity, $user = null)
    {

        $contents = str_replace('{eventType}', strtolower($this->language->translate($entity->getEntityName(), 'scopeNames')), $contents);

        $preferences = $this->getEntityManager()->getEntity('Preferences', $user->id);
        $timezone = $preferences->get('timeZone');

        foreach ($entity->getFields() as $field => $d) {
            if (empty($d['type'])) continue;
            $key = '{'.$field.'}';
            switch ($d['type']) {
                case 'datetime':
                    $contents = str_replace($key, $this->dateTime->convertSystemDateTime($entity->get($field), $timezone), $contents);
                    break;
                case 'date':
                    $contents = str_replace($key, $this->dateTime->convertSystemDate($entity->get($field)), $contents);
                    break;
                default:
                    $contents = str_replace($key, $entity->get($field), $contents);
            }
        }

        if ($user) {
            $contents = str_replace('{userName}', $user->get('name'), $contents);
        }

        $siteUrl = rtrim($this->config->get('siteUrl'), '/');

        $url = $siteUrl . '/#' . $entity->getEntityName() . '/view/' . $entity->id;
        $contents = str_replace('{url}', $url, $contents);

        return $contents;
    }

    protected function getTemplate($name)
    {
        $systemLanguage = $this->config->get('language');

        $fileName = 'custom/Fox/Custom/Resources/templates/'.$name.'.'.$systemLanguage.'.tpl';
        if (!file_exists($fileName)) {
            $fileName = 'application/Fox/Modules/Crm/Resources/templates/'.$name.'.'.$systemLanguage.'.tpl';
        }
        if (!file_exists($fileName)) {
            $fileName = 'custom/Fox/Custom/Resources/templates/'.$name.'.en_US.tpl';
        }
        if (!file_exists($fileName)) {
            $fileName = 'application/Fox/Modules/Crm/Resources/templates/'.$name.'.en_US.tpl';
        }

        return file_get_contents($fileName);
    }

    public function send(Entity $reminder)
    {
        $user = $this->getEntityManager()->getEntity('User', $reminder->get('userId'));
        $entity = $this->getEntityManager()->getEntity($reminder->get('entityType'), $reminder->get('entityId'));

        $emailAddress = $user->get('emailAddress');

        if (empty($user) || empty($emailAddress) || empty($entity)) {
            return;
        }

        $email = $this->getEntityManager()->getEntity('Email');
        $email->set('to', $emailAddress);

        $subjectTpl = $this->getTemplate('ReminderSubject');
        $bodyTpl = $this->getTemplate('ReminderBody');

        $subject = $this->parseInvitationTemplate($subjectTpl, $entity, $user);
        $subject = str_replace(array("\n", "\r"), '', $subject);

        $body = $this->parseInvitationTemplate($bodyTpl, $entity, $user);

        $email->set('subject', $subject);
        $email->set('body', $body);
        $email->set('isHtml', true);
        $this->getEntityManager()->saveEntity($email);

        $emailSender = $this->mailSender;

        $emailSender->send($email);

        $this->getEntityManager()->removeEntity($email);
    }
}

