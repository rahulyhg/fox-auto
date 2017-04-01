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
      'name' => 'min',
      'type' => 'float',
    ),
    2 => 
    array (
      'name' => 'max',
      'type' => 'float',
    ),
    3 => 
    array (
      'name' => 'audited',
      'type' => 'bool',
    ),
  ),
  'actualFields' => 
  array (
    0 => 'currency',
    1 => '',
  ),
  'fields' => 
  array (
    'currency' => 
    array (
      'type' => 'varchar',
      'disabled' => true,
    ),
    'converted' => 
    array (
      'type' => 'currencyConverted',
      'readOnly' => true,
    ),
  ),
  'filter' => true,
);
?>