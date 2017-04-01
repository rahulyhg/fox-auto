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
      'foreign' => 'portalRoles',
    ),
    'portals' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Portal',
      'foreign' => 'portalRoles',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'name',
    'asc' => true,
  ),
);
?>