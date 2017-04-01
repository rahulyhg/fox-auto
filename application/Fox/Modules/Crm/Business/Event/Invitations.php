<?php


namespace Fox\Modules\Crm\Business\Event;

use \Fox\ORM\Entity;

class Invitations
{
    protected $entityManager;

    protected $smtpParams;

    protected $mailSender;

    protected $config;

    protected $dateTime;

    protected $language;

    protected $fileManager;

    protected $ics;

    public function __construct($entityManager, $smtpParams, $mailSender, $config, $dateTime, $language, $fileManager)
    {
        $this->entityManager = $entityManager;
        $this->smtpParams = $smtpParams;
        $this->mailSender = $mailSender;
        $this->config = $config;
        $this->dateTime = $dateTime;
        $this->language = $language;
        $this->fileManager = $fileManager;
    }

    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    protected function parseInvitationTemplate($contents, $entity, $invitee = null, $uid = null)
    {

        $contents = str_replace('{eventType}', strtolower($this->language->translate($entity->getEntityType(), 'scopeNames')), $contents);

        foreach ($entity->getAttributes() as $field => $d) {
            if (empty($d['type'])) continue;
            $key = '{'.$field.'}';
            switch ($d['type']) {
                case 'datetime':
                    $contents = str_replace($key, $this->dateTime->convertSystemDateTime($entity->get($field)), $contents);
                    break;
                case 'date':
                    $contents = str_replace($key, $this->dateTime->convertSystemDate($entity->get($field)), $contents);
                    break;
                case 'jsonArray':
                    break;
                case 'jsonObject':
                    break;
                default:
                    $contents = str_replace($key, $entity->get($field), $contents);
            }
        }

        if ($invitee) {
            $contents = str_replace('{inviteeName}', $invitee->get('name'), $contents);
        }

        $siteUrl = rtrim($this->config->get('siteUrl'), '/');

        $url = $siteUrl . '/#' . $entity->getEntityType() . '/view/' . $entity->id;
        $contents = str_replace('{url}', $url, $contents);

        if ($invitee && $invitee->getEntityType() != 'User') {
            $contents = preg_replace('/\{#userOnly\}(.*?)\{\/userOnly\}/s', '', $contents);
        }

        $contents = str_replace('{#userOnly}', '', $contents);
        $contents = str_replace('{/userOnly}', '', $contents);

        if ($uid) {
            $contents = str_replace('{acceptLink}', $siteUrl . '?entryPoint=eventConfirmation&action=accept&uid=' . $uid->get('name'), $contents);
            $contents = str_replace('{declineLink}', $siteUrl . '?entryPoint=eventConfirmation&action=decline&uid=' . $uid->get('name'), $contents);
            $contents = str_replace('{tentativeLink}', $siteUrl . '?entryPoint=eventConfirmation&action=tentativeLink&uid=' . $uid->get('name'), $contents);
        }
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

    public function sendInvitation(Entity $entity, Entity $invitee, $link)
    {
        $uid = $this->getEntityManager()->getEntity('UniqueId');
        $uid->set('data', array(
            'eventType' => $entity->getEntityType(),
            'eventId' => $entity->id,
            'inviteeId' => $invitee->id,
            'inviteeType' => $invitee->getEntityType(),
            'link' => $link
        ));
        $this->getEntityManager()->saveEntity($uid);

        $emailAddress = $invitee->get('emailAddress');
        if (empty($emailAddress)) {
            return;
        }

        $email = $this->getEntityManager()->getEntity('Email');
        $email->set('to', $emailAddress);

        $subjectTpl = $this->getTemplate('InvitationSubject');
        $bodyTpl = $this->getTemplate('InvitationBody');

        $subject = $this->parseInvitationTemplate($subjectTpl, $entity, $invitee, $uid);
        $subject = str_replace(array("\n", "\r"), '', $subject);

        $body = $this->parseInvitationTemplate($bodyTpl, $entity, $invitee, $uid);

        $email->set('subject', $subject);
        $email->set('body', $body);
        $email->set('isHtml', true);
        $this->getEntityManager()->saveEntity($email);

        $attachmentName = ucwords($this->language->translate($entity->getEntityType(), 'scopeNames')).'.ics';
        $attachment = $this->getEntityManager()->getEntity('Attachment');
        $attachment->set(array(
            'name' => $attachmentName,
            'type' => 'text/calendar',
            'contents' => $this->getIscContents($entity),
        ));

        $email->addAttachment($attachment);

        $emailSender = $this->mailSender;

        if ($this->smtpParams) {
            $emailSender->useSmtp($this->smtpParams);
        }
        $emailSender->send($email);

        $this->getEntityManager()->removeEntity($email);
    }

    protected function getIscContents(Entity $entity)
    {
        $user = $entity->get('assignedUser');

        $who = '';
        $email = '';
        if ($user) {
            $who = $user->get('name');
            $email = $user->get('emailAddress');
        }

        $ics = new Ics('//CRM//CRM Calendar//EN', array(
            'startDate' => strtotime($entity->get('dateStart')),
            'endDate' => strtotime($entity->get('dateEnd')),
            'uid' => $entity->id,
            'summary' => $entity->get('name'),
            'who' => $who,
            'email' => $email,
            'description' => $entity->get('description'),
        ));

        return $ics->get();
    }

}

