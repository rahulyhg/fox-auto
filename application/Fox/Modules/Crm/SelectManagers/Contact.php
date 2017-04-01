<?php


namespace Fox\Modules\Crm\SelectManagers;

class Contact extends \Fox\Core\SelectManagers\Base
{
    protected function filterPortalUsers(&$result)
    {
        $result['customJoin'] .= " JOIN user AS portalUser ON portalUser.contact_id = contact.id AND portalUser.deleted = 0 ";
    }

    protected function filterNotPortalUsers(&$result)
    {
        $result['customJoin'] .= " LEFT JOIN user AS portalUser ON portalUser.contact_id = contact.id AND portalUser.deleted = 0 ";
        $this->addAndWhere(array(
            'portalUser.id' => null
        ), $result);
    }

 }

