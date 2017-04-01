<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'trim' => true,
    ),
    'type' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
    ),
    'size' => 
    array (
      'type' => 'int',
      'min' => 0,
    ),
    'parent' => 
    array (
      'type' => 'linkParent',
    ),
    'related' => 
    array (
      'type' => 'linkParent',
      'noLoad' => true,
    ),
    'sourceId' => 
    array (
      'type' => 'varchar',
      'maxLength' => 36,
      'readOnly' => true,
      'disabled' => true,
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'createdBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
    'contents' => 
    array (
      'type' => 'text',
      'notStorable' => true,
    ),
    'role' => 
    array (
      'type' => 'varchar',
      'maxLength' => 36,
    ),
    'global' => 
    array (
      'type' => 'bool',
      'default' => false,
    ),
  ),
  'links' => 
  array (
    'createdBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'parent' => 
    array (
      'type' => 'belongsToParent',
      'foreign' => 'attachments',
    ),
    'related' => 
    array (
      'type' => 'belongsToParent',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
    'asc' => false,
  ),
  'indexes' => 
  array (
    'parent' => 
    array (
      'columns' => 
      array (
        0 => 'parentType',
        1 => 'parentId',
      ),
    ),
  ),
  'sources' => 
  array (
    'Document' => 
    array (
      'insertModalView' => '',
    ),
  ),
);
?>