<?php


namespace Fox\Controllers;

use \Fox\Core\Exceptions\Forbidden;

class EmailAddress extends \Fox\Core\Controllers\Record
{
    public function actionSearchInAddressBook($params, $data, $request)
    {
        if (!$this->getAcl()->checkScope('Email')) {
            throw new Forbidden();
        }
        if (!$this->getAcl()->checkScope('Email', 'create')) {
            throw new Forbidden();
        }
        $q = $request->get('q');
        $limit = intval($request->get('limit'));
        if (empty($limit) || $limit > 30) {
            $limit = 5;
        }
        return $this->getRecordService()->searchInAddressBook($q, $limit);
    }
}

