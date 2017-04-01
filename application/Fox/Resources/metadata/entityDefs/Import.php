<?php
return array (
  'fields' => 
  array (
    'entityType' => 
    array (
      'type' => 'enum',
      'translation' => 'Global.scopeNames',
      'required' => true,
    ),
    'file' => 
    array (
      'type' => 'file',
      'required' => true,
    ),
    'importedCount' => 
    array (
      'type' => 'int',
      'readOnly' => true,
      'notStorable' => true,
    ),
    'duplicateCount' => 
    array (
      'type' => 'int',
      'readOnly' => true,
      'notStorable' => true,
    ),
    'updatedCount' => 
    array (
      'type' => 'int',
      'readOnly' => true,
      'notStorable' => true,
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
  ),
  'links' => 
  array (
    'createdBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
    'asc' => false,
  ),
);
?>