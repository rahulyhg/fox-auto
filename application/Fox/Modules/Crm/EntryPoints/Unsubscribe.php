<?php
/************************************************************************
 * This file is part of CRM.
 *
 * CRM - Open Source CRM application.
 * Copyright (C) 2014-2015 Yuri Kuznetsov, Taras Machyshyn, Oleksiy Avramenko
 * Website: http://www.CRM.com
 *
 * CRM is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * CRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with CRM. If not, see http://www.gnu.org/licenses/.phpppph
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "CRM" word.
 ************************************************************************/

namespace Fox\Modules\Crm\EntryPoints;

use \Fox\Core\Utils\Util;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;
use \Fox\Core\Exceptions\Error;

class Unsubscribe extends \Fox\Core\EntryPoints\Base
{
    public static $authRequired = false;

    public function handle()
    {
        if (empty($_GET['id'])) {
            throw new BadRequest();
        }
        $queueItemId = $_GET['id'];

        $queueItem = $this->getEntityManager()->getEntity('EmailQueueItem', $queueItemId);

        if (!$queueItem) {
            throw new NotFound();
        }

        $campaign = null;
        $target = null;

        $massEmailId = $queueItem->get('massEmailId');
        if ($massEmailId) {
            $massEmail = $this->getEntityManager()->getEntity('MassEmail', $massEmailId);
            if ($massEmail) {
                $campaignId = $massEmail->get('campaignId');
                if ($campaignId) {
                    $campaign = $this->getEntityManager()->getEntity('Campaign', $campaignId);
                }

                $targetType = $queueItem->get('targetType');
                $targetId = $queueItem->get('targetId');

                if ($targetType && $targetId) {
                    $target = $this->getEntityManager()->getEntity($targetType, $targetId);

                    if ($massEmail->get('optOutEntirely')) {
                        $emailAddress = $target->get('emailAddress');
                        if ($emailAddress) {
                            $ea = $this->getEntityManager()->getRepository('EmailAddress')->getByAddress($emailAddress);
                            if ($ea) {
                                $ea->set('optOut', true);
                                $this->getEntityManager()->saveEntity($ea);
                            }
                        }
                    }

                    $link = null;
                    $m = array(
                        'Account' => 'accounts',
                        'Contact' => 'contacts',
                        'Lead' => 'leads',
                        'User' => 'users'
                    );
                    if (!empty($m[$target->getEntityType()])) {
                        $link = $m[$target->getEntityType()];
                    }
                    if ($link) {
                        $targetListList = $massEmail->get('targetLists');

                        foreach ($targetListList as $targetList) {
                            $this->getEntityManager()->getRepository('TargetList')->updateRelation($targetList, $link, $target->id, array(
                                'optedOut' => true
                            ));
                        }
                        echo $this->getLanguage()->translate('unsubscribed', 'messages', 'Campaign');
                    }
                }
            }
        }

        if ($campaign && $target) {
            $campaignService = $this->getServiceFactory()->create('Campaign');
            $campaignService->logOptedOut($campaignId, $queueItemId, $target, $queueItem->get('emailAddress'), null, $queueItem->get('isTest'));
        }

    }
}
