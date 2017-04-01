<?php
return array (
  'fields' => 
  array (
    'token' => 
    array (
      'type' => 'varchar',
      'maxLength' => '36',
      'index' => true,
    ),
    'hash' => 
    array (
      'type' => 'varchar',
      'maxLength' => 150,
      'index' => true,
    ),
    'userId' => 
    array (
      'type' => 'varchar',
      'maxLength' => '36',
    ),
    'user' => 
    array (
      'type' => 'link',
    ),
    'portal' => 
    array (
      'type' => 'link',
    ),
    'ipAddress' => 
    array (
      'type' => 'varchar',
      'maxLength' => '36',
    ),
    'lastAccess' => 
    array (
      'type' => 'datetime',
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
    'user' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'portal' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Portal',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'lastAccess',
    'asc' => false,
  ),
  'indexes' => 
  array (
    'token' => 
    array (
      'columns' => 
      array (
        0 => 'token',
        1 => 'deleted',
      ),
    ),
  ),
);
?>