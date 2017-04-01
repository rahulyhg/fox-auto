<?php
namespace Fox\ORM;

class Metadata
{
    protected $data = array();

    public function setData(array & $data)
    {
        $this->data = & $data;
    }

    public function get($entityName)
    {
        return $this->data[$entityName];
    }

}
