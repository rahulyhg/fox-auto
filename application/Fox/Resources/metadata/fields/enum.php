<?php
return array (
  'params' => 
  array (
    0 => 
    array (
      'name' => 'required',
      'type' => 'bool',
      'default' => false,
    ),
    1 => 
    array (
      'name' => 'options',
      'type' => 'array',
      'view' => 'views/admin/field-manager/fields/options',
    ),
    2 => 
    array (
      'name' => 'default',
      'type' => 'varchar',
    ),
    3 => 
    array (
      'name' => 'isSorted',
      'type' => 'bool',
    ),
    4 => 
    array (
      'name' => 'translation',
      'type' => 'varchar',
      'hidden' => true,
    ),
    5 => 
    array (
      'name' => 'audited',
      'type' => 'bool',
    ),
  ),
  'filter' => true,
  'fieldDefs' => 
  array (
    'type' => 'varchar',
  ),
);
?>