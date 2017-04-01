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
      'name' => 'previewSize',
      'type' => 'enum',
      'default' => 'small',
      'options' => 
      array (
        0 => 'x-small',
        1 => 'small',
        2 => 'medium',
        3 => 'large',
      ),
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