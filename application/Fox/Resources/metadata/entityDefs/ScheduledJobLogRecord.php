<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'readOnly' => true,
    ),
    'status' => 
    array (
      'type' => 'varchar',
      'readOnly' => true,
    ),
    'executionTime' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'scheduledJob' => 
    array (
      'type' => 'link',
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
    'sortBy' => 'executionTime',
    'asc' => false,
  ),
);
?>