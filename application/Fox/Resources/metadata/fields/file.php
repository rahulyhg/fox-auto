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
  ),
  'actualFields' => 
  array (
    0 => 'id',
  ),
  'notActualFields' => 
  array (
    0 => 'name',
  ),
  'filter' => false,
  'linkDefs' => 
  array (
    'type' => 'belongsTo',
    'entity' => 'Attachment',
  ),
  'fieldDefs' => 
  array (
    'skipOrmDefs' => true,
  ),
);
?>