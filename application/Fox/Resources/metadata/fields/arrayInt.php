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
      'type' => 'arrayInt',
    ),
    2 => 
    array (
      'name' => 'translation',
      'type' => 'varchar',
      'hidden' => true,
    ),
    3 => 
    array (
      'name' => 'noEmptyString',
      'type' => 'bool',
      'default' => false,
    ),
  ),
  'filter' => true,
  'notCreatable' => true,
  'fieldDefs' => 
  array (
    'type' => 'jsonArray',
  ),
);
?>