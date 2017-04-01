<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'varchar',
      'required' => true,
    ),
    'version' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'maxLength' => 50,
    ),
    'fileList' => 
    array (
      'type' => 'jsonArray',
    ),
    'description' => 
    array (
      'type' => 'text',
    ),
    'isInstalled' => 
    array (
      'type' => 'bool',
      'default' => false,
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'createdBy' => 
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
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
    'asc' => false,
  ),
);
?>