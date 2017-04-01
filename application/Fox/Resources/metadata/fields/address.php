<?php
return array (
  'actualFields' => 
  array (
    0 => 'street',
    1 => 'city',
    2 => 'state',
    3 => 'country',
    4 => 'postalCode',
  ),
  'fields' => 
  array (
    'street' => 
    array (
      'type' => 'text',
      'maxLength' => 255,
      'dbType' => 'varchar',
    ),
    'city' => 
    array (
      'type' => 'varchar',
    ),
    'state' => 
    array (
      'type' => 'varchar',
    ),
    'country' => 
    array (
      'type' => 'varchar',
    ),
    'postalCode' => 
    array (
      'type' => 'varchar',
    ),
    'map' => 
    array (
      'type' => 'map',
      'notStorable' => true,
      'readOnly' => true,
      'layoutListDisabled' => true,
      'provider' => 'Google',
      'height' => 300,
    ),
  ),
  'mergable' => false,
  'notCreatable' => false,
  'filter' => true,
  'fieldDefs' => 
  array (
    'skipOrmDefs' => true,
  ),
);
?>