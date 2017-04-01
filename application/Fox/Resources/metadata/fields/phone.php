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
      'name' => 'typeList',
      'type' => 'array',
      'default' => 
      array (
        0 => 'Mobile',
        1 => 'Office',
        2 => 'Home',
        3 => 'Fax',
        4 => 'Other',
      ),
      'view' => 'views/admin/field-manager/fields/options',
    ),
    2 => 
    array (
      'name' => 'defaultType',
      'type' => 'varchar',
      'default' => 'Mobile',
    ),
  ),
  'notActualFields' => 
  array (
    0 => 'data',
  ),
  'notCreatable' => true,
  'filter' => true,
  'fieldDefs' => 
  array (
    'notStorable' => true,
  ),
);
?>