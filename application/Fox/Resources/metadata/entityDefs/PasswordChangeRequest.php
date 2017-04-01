<?php
return array (
  'fields' => 
  array (
    'requestId' => 
    array (
      'type' => 'varchar',
      'maxLength' => 24,
      'index' => true,
    ),
    'user' => 
    array (
      'type' => 'link',
      'readOnly' => true,
      'index' => true,
    ),
    'url' => 
    array (
      'type' => 'url',
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
  ),
  'links' => 
  array (
    'user' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
  ),
);
?>