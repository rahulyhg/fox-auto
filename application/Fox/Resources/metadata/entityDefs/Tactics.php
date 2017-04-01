<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 1,
        1 => 2,
        2 => 3,
        3 => 4,
      ),
      'default' => 1,
      'required' => true,
    ),
    'reason' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
    'status' => 
    array (
      'type' => 'enum-check',
      'options' => 
      array (
        0 => 0,
        1 => 1,
        2 => 2,
        3 => 5,
      ),
      'default' => 0,
      'readOnly' => true,
    ),
    'v1' => 
    array (
      'type' => 'varchar',
      'required' => true,
    ),
    'v2' => 
    array (
      'type' => 'varchar',
    ),
    'v3' => 
    array (
      'type' => 'varchar',
    ),
    'v4' => 
    array (
      'type' => 'varchar',
    ),
    'desc' => 
    array (
      'type' => 'varchar',
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'auditAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'createdBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
    'auditBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
  ),
  'links' => 
  array (
    'reason' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'reason',
    ),
    'createdBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'auditBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'name',
    'asc' => true,
  ),
  'indexes' => 
  array (
    'name' => 
    array (
      'columns' => 
      array (
        0 => 'name',
        1 => 'deleted',
      ),
    ),
  ),
);
?>