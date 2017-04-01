<?php
return array (
  'fields' => 
  array (
    'number' => 
    array (
      'type' => 'autoincrement',
      'index' => true,
    ),
    'data' => 
    array (
      'type' => 'jsonObject',
    ),
    'noteData' => 
    array (
      'type' => 'jsonObject',
      'notStorable' => true,
    ),
    'type' => 
    array (
      'type' => 'varchar',
    ),
    'read' => 
    array (
      'type' => 'bool',
    ),
    'user' => 
    array (
      'type' => 'link',
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'message' => 
    array (
      'type' => 'text',
    ),
    'related' => 
    array (
      'type' => 'linkParent',
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
    'related' => 
    array (
      'type' => 'belongsToParent',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'number',
    'asc' => false,
  ),
  'indexes' => 
  array (
    'createdAt' => 
    array (
      'type' => 'index',
      'columns' => 
      array (
        0 => 'createdAt',
      ),
    ),
    'user' => 
    array (
      'type' => 'index',
      'columns' => 
      array (
        0 => 'userId',
        1 => 'createdAt',
      ),
    ),
  ),
);
?>