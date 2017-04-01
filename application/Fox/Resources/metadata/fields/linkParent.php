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
      'name' => 'entityList',
      'type' => 'multiEnum',
      'view' => 'Admin.FieldManager.Fields.EntityList',
    ),
    2 => 
    array (
      'name' => 'audited',
      'type' => 'bool',
    ),
  ),
  'actualFields' => 
  array (
    0 => 'id',
    1 => 'type',
  ),
  'notActualFields' => 
  array (
    0 => 'name',
  ),
  'filter' => true,
  'notCreatable' => true,
  'fieldDefs' => 
  array (
    'notStorable' => true,
  ),
);
?>