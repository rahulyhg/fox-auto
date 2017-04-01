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
    'body' => 
    array (
      'type' => 'text',
      'view' => 'Fields.Wysiwyg',
    ),
    'header' => 
    array (
      'type' => 'text',
      'view' => 'Fields.Wysiwyg',
    ),
    'footer' => 
    array (
      'type' => 'text',
      'view' => 'Fields.Wysiwyg',
      'tooltip' => true,
    ),
    'entityType' => 
    array (
      'type' => 'enum',
      'required' => true,
      'translation' => 'Global.scopeNames',
      'view' => 'Fields.EntityType',
    ),
    'leftMargin' => 
    array (
      'type' => 'float',
      'default' => 10,
    ),
    'rightMargin' => 
    array (
      'type' => 'float',
      'default' => 10,
    ),
    'topMargin' => 
    array (
      'type' => 'float',
      'default' => 10,
    ),
    'bottomMargin' => 
    array (
      'type' => 'float',
      'default' => 25,
    ),
    'printFooter' => 
    array (
      'type' => 'bool',
    ),
    'footerPosition' => 
    array (
      'type' => 'float',
      'default' => 15,
    ),
    'teams' => 
    array (
      'type' => 'linkMultiple',
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'modifiedAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'createdBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
    'modifiedBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
  ),
  'links' => 
  array (
    'teams' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Team',
      'relationName' => 'entityTeam',
    ),
    'createdBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'modifiedBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'name',
    'asc' => true,
  ),
);
?>