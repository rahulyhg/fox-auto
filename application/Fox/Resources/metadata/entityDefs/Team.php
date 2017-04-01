<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
      'trim' => true,
    ),
    'roles' => 
    array (
      'type' => 'linkMultiple',
      'tooltip' => true,
    ),
    'positionList' => 
    array (
      'type' => 'array',
      'tooltip' => true,
    ),
    'userRole' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'disabled' => true,
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
  ),
  'links' => 
  array (
    'users' => 
    array (
      'type' => 'hasMany',
      'entity' => 'User',
      'foreign' => 'teams',
    ),
    'roles' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Role',
      'foreign' => 'teams',
    ),
    'notes' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Note',
      'foreign' => 'teams',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'name',
    'asc' => true,
  ),
);
?>