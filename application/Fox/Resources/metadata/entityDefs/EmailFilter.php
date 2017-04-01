<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'maxLength' => 100,
      'tooltip' => true,
      'trim' => true,
    ),
    'from' => 
    array (
      'type' => 'varchar',
      'maxLength' => 255,
      'tooltip' => true,
      'trim' => true,
    ),
    'to' => 
    array (
      'type' => 'varchar',
      'maxLength' => 255,
      'tooltip' => true,
      'trim' => true,
    ),
    'subject' => 
    array (
      'type' => 'varchar',
      'maxLength' => 255,
      'tooltip' => true,
    ),
    'bodyContains' => 
    array (
      'type' => 'array',
      'tooltip' => true,
    ),
    'parent' => 
    array (
      'type' => 'linkParent',
      'tooltip' => true,
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
    'parent' => 
    array (
      'type' => 'belongsToParent',
      'entityList' => 
      array (
        0 => 'EmailAccount',
        1 => 'InboundEmail',
      ),
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
    'asc' => false,
  ),
);
?>