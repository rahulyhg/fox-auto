<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'view' => 'views/admin/job/fields/name',
    ),
    'status' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Pending',
        1 => 'Running',
        2 => 'Success',
        3 => 'Failed',
      ),
      'default' => 'Pending',
    ),
    'executeTime' => 
    array (
      'type' => 'datetime',
      'required' => true,
    ),
    'serviceName' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'maxLength' => 100,
    ),
    'method' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'maxLength' => 100,
    ),
    'data' => 
    array (
      'type' => 'jsonObject',
    ),
    'scheduledJob' => 
    array (
      'type' => 'link',
    ),
    'attempts' => 
    array (
      'type' => 'int',
    ),
    'failedAttempts' => 
    array (
      'type' => 'int',
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'modifiedAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
  ),
  'links' => 
  array (
    'scheduledJob' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'ScheduledJob',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
    'asc' => false,
  ),
  'indexes' => 
  array (
    'executeTime' => 
    array (
      'columns' => 
      array (
        0 => 'status',
        1 => 'executeTime',
      ),
    ),
    'status' => 
    array (
      'columns' => 
      array (
        0 => 'status',
        1 => 'deleted',
      ),
    ),
  ),
);
?>