<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'maxLength' => 150,
      'required' => true,
      'type' => 'varchar',
      'trim' => true,
    ),
    'assignmentPermission' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'not-set',
        1 => 'all',
        2 => 'team',
        3 => 'no',
      ),
      'default' => 'not-set',
      'tooltip' => true,
      'translation' => 'Role.options.levelList',
    ),
    'userPermission' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'not-set',
        1 => 'all',
        2 => 'team',
        3 => 'no',
      ),
      'default' => 'not-set',
      'tooltip' => true,
      'translation' => 'Role.options.levelList',
    ),
    'portalPermission' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'not-set',
        1 => 'yes',
        2 => 'no',
      ),
      'default' => 'not-set',
      'tooltip' => true,
      'translation' => 'Role.options.levelList',
    ),
    'data' => 
    array (
      'type' => 'jsonObject',
    ),
    'fieldData' => 
    array (
      'type' => 'jsonObject',
    ),
  ),
  'links' => 
  array (
    'users' => 
    array (
      'type' => 'hasMany',
      'entity' => 'User',
      'foreign' => 'roles',
    ),
    'teams' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Team',
      'foreign' => 'roles',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'name',
    'asc' => true,
  ),
);
?>