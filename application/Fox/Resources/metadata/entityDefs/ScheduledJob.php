<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'varchar',
      'required' => true,
    ),
    'job' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'view' => 'views/scheduled-job/fields/job',
    ),
    'status' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Active',
        1 => 'Inactive',
      ),
    ),
    'scheduling' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'view' => 'views/scheduled-job/fields/scheduling',
      'tooltip' => true,
    ),
    'lastRun' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
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
    'createdBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
    'modifiedBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
  ),
  'links' => 
  array (
    'createdBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'modifiedBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'log' => 
    array (
      'type' => 'hasMany',
      'entity' => 'ScheduledJobLogRecord',
      'foreign' => 'scheduledJob',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'name',
    'asc' => true,
  ),
  'jobSchedulingMap' => 
  array (
    'CheckInboundEmails' => '*/4 * * * *',
    'CheckEmailAccounts' => '*/5 * * * *',
    'SendEmailReminders' => '/2 * * * *',
    'Cleanup' => '1 1 * * 0',
    'AuthTokenControl' => '*/6 * * * *',
  ),
);
?>