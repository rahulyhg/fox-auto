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
    'subject' => 
    array (
      'type' => 'varchar',
    ),
    'body' => 
    array (
      'type' => 'text',
      'view' => 'views/fields/wysiwyg',
    ),
    'isHtml' => 
    array (
      'type' => 'bool',
      'default' => true,
    ),
    'oneOff' => 
    array (
      'type' => 'bool',
      'default' => false,
      'tooltip' => true,
    ),
    'attachments' => 
    array (
      'type' => 'linkMultiple',
      'view' => 'views/fields/attachment-multiple',
    ),
    'assignedUser' => 
    array (
      'type' => 'link',
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
      'view' => 'views/fields/user',
    ),
    'modifiedBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
      'view' => 'views/fields/user',
    ),
  ),
  'links' => 
  array (
    'attachments' => 
    array (
      'type' => 'hasChildren',
      'entity' => 'Attachment',
      'foreign' => 'parent',
    ),
    'teams' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Team',
      'relationName' => 'entityTeam',
    ),
    'assignedUser' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
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
    'sortBy' => 'createdAt',
    'asc' => false,
  ),
);
?>