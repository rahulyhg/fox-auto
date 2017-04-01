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
      'name' => 'sourceList',
      'type' => 'multiEnum',
      'view' => 'views/admin/field-manager/fields/source-list',
    ),
  ),
  'actualFields' => 
  array (
    0 => 'ids',
  ),
  'notActualFields' => 
  array (
    0 => 'names',
  ),
  'linkDefs' => 
  array (
    'type' => 'hasChildren',
    'entity' => 'Attachment',
    'foreign' => 'parent',
    'layoutRelationshipsDisabled' => true,
    'relationName' => 'attachments',
  ),
  'filter' => false,
  'fieldDefs' => 
  array (
    'layoutListDisabled' => true,
  ),
);
?>