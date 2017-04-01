<?php
return array (
  'fields' => 
  array (
    'massEmail' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
    'status' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Pending',
        1 => 'Sent',
        2 => 'Failed',
      ),
      'readOnly' => true,
    ),
    'attemptCount' => 
    array (
      'type' => 'int',
      'readOnly' => true,
      'default' => 0,
    ),
    'target' => 
    array (
      'type' => 'linkParent',
      'readOnly' => true,
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'sentAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'emailAddress' => 
    array (
      'type' => 'varchar',
      'readOnly' => true,
    ),
    'isTest' => 
    array (
      'type' => 'bool',
    ),
  ),
  'links' => 
  array (
    'massEmail' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'MassEmail',
      'foreign' => 'queueItems',
    ),
    'target' => 
    array (
      'type' => 'belongsToParent',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
    'asc' => false,
  ),
);
?>