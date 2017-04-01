<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'view' => 'crm:views/document/fields/name',
      'trim' => true,
    ),
    'file' => 
    array (
      'type' => 'file',
      'required' => true,
      'view' => 'crm:views/document/fields/file',
    ),
    'status' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Active',
        1 => 'Draft',
        2 => 'Expired',
        3 => 'Canceled',
      ),
      'view' => 'views/fields/enum-styled',
      'style' => 
      array (
        'Canceled' => 'danger',
        'Expired' => 'danger',
      ),
    ),
    'source' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Fox',
      ),
      'default' => 'Fox',
    ),
    'type' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => '',
        1 => 'Contract',
        2 => 'NDA',
        3 => 'EULA',
        4 => 'License Agreement',
      ),
    ),
    'publishDate' => 
    array (
      'type' => 'date',
      'required' => true,
      'default' => 'javascript: return this.dateTime.getToday();',
    ),
    'expirationDate' => 
    array (
      'type' => 'date',
      'after' => 'publishDate',
    ),
    'description' => 
    array (
      'type' => 'text',
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
    'assignedUser' => 
    array (
      'type' => 'link',
      'view' => 'views/fields/user',
    ),
    'teams' => 
    array (
      'type' => 'linkMultiple',
    ),
    'accounts' => 
    array (
      'type' => 'linkMultiple',
      'layoutDetailDisabled' => true,
      'layoutListDisabled' => true,
      'layoutMassUpdateDisabled' => true,
      'importDisabled' => true,
      'noLoad' => true,
    ),
    'folder' => 
    array (
      'type' => 'link',
      'view' => 'views/fields/link-category-tree',
    ),
  ),
  'links' => 
  array (
    'accounts' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Account',
      'foreign' => 'documents',
    ),
    'opportunities' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Opportunity',
      'foreign' => 'documents',
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
    'assignedUser' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'teams' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Team',
      'relationName' => 'entityTeam',
      'layoutRelationshipsDisabled' => true,
    ),
    'folder' => 
    array (
      'type' => 'belongsTo',
      'foreign' => 'documents',
      'entity' => 'DocumentFolder',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
    'asc' => false,
  ),
);
?>