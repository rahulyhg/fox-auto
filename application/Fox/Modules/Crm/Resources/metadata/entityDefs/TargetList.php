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
    'entryCount' => 
    array (
      'type' => 'int',
      'readOnly' => true,
      'notStorable' => true,
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
    'campaigns' => 
    array (
      'type' => 'link',
    ),
  ),
  'links' => 
  array (
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
    'campaigns' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Campaign',
      'foreign' => 'targetLists',
    ),
    'massEmails' => 
    array (
      'type' => 'hasMany',
      'entity' => 'MassEmail',
      'foreign' => 'targetLists',
    ),
    'campaignsExcluding' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Campaign',
      'foreign' => 'excludingTargetLists',
    ),
    'massEmailsExcluding' => 
    array (
      'type' => 'hasMany',
      'entity' => 'MassEmail',
      'foreign' => 'excludingTargetLists',
    ),
    'accounts' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Account',
      'foreign' => 'targetLists',
      'additionalColumns' => 
      array (
        'optedOut' => 
        array (
          'type' => 'bool',
        ),
      ),
    ),
    'contacts' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Contact',
      'foreign' => 'targetLists',
      'additionalColumns' => 
      array (
        'optedOut' => 
        array (
          'type' => 'bool',
        ),
      ),
    ),
    'leads' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Lead',
      'foreign' => 'targetLists',
      'additionalColumns' => 
      array (
        'optedOut' => 
        array (
          'type' => 'bool',
        ),
      ),
    ),
    'users' => 
    array (
      'type' => 'hasMany',
      'entity' => 'User',
      'foreign' => 'targetLists',
      'additionalColumns' => 
      array (
        'optedOut' => 
        array (
          'type' => 'bool',
        ),
      ),
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
    'asc' => false,
  ),
  'indexes' => 
  array (
    'createdAt' => 
    array (
      'columns' => 
      array (
        0 => 'createdAt',
        1 => 'deleted',
      ),
    ),
  ),
);
?>