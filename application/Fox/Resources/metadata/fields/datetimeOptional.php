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
      'name' => 'default',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'name' => 'after',
      'type' => 'varchar',
    ),
    3 => 
    array (
      'name' => 'before',
      'type' => 'varchar',
    ),
    4 => 
    array (
      'name' => 'audited',
      'type' => 'bool',
    ),
  ),
  'actualFields' => 
  array (
    0 => '',
    1 => 'date',
  ),
  'fields' => 
  array (
    'date' => 
    array (
      'type' => 'date',
      'disabled' => true,
    ),
  ),
  'filter' => true,
  'notCreatable' => true,
  'fieldDefs' => 
  array (
    'type' => 'datetime',
    'notNull' => false,
  ),
  'view' => 'Fields.DatetimeOptional',
);
?>