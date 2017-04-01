<?php
return array (
  'fields' => 
  array (
    'isAdmin' => 
    array (
      'type' => 'bool',
      'tooltip' => true,
    ),
    'userName' => 
    array (
      'type' => 'varchar',
      'maxLength' => 50,
      'required' => true,
      'view' => 'views/user/fields/user-name',
      'tooltip' => true,
    ),
    'name' => 
    array (
      'type' => 'personName',
      'view' => 'views/user/fields/name',
    ),
    'password' => 
    array (
      'type' => 'password',
      'maxLength' => 150,
      'internal' => true,
      'disabled' => true,
    ),
    'passwordConfirm' => 
    array (
      'type' => 'password',
      'maxLength' => 150,
      'internal' => true,
      'disabled' => true,
      'notStorable' => true,
    ),
    'salutationName' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => '',
        1 => 'Mr.',
        2 => 'Mrs.',
        3 => 'Ms.',
        4 => 'Dr.',
      ),
    ),
    'firstName' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
      'default' => '',
    ),
    'lastName' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
      'required' => true,
      'default' => '',
    ),
    'isActive' => 
    array (
      'type' => 'bool',
      'tooltip' => true,
      'default' => true,
    ),
    'isPortalUser' => 
    array (
      'type' => 'bool',
    ),
    'isSuperAdmin' => 
    array (
      'type' => 'bool',
      'default' => false,
      'disabled' => true,
    ),
    'title' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
      'trim' => true,
    ),
    'emailAddress' => 
    array (
      'type' => 'email',
      'required' => false,
    ),
    'phoneNumber' => 
    array (
      'type' => 'phone',
      'typeList' => 
      array (
        0 => 'Mobile',
        1 => 'Office',
        2 => 'Home',
        3 => 'Fax',
        4 => 'Other',
      ),
      'defaultType' => 'Mobile',
    ),
    'token' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'disabled' => true,
    ),
    'defaultTeam' => 
    array (
      'type' => 'link',
      'tooltip' => true,
    ),
    'acceptanceStatus' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'disabled' => true,
    ),
    'teamRole' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'disabled' => true,
    ),
    'teams' => 
    array (
      'type' => 'linkMultiple',
      'tooltip' => true,
      'columns' => 
      array (
        'role' => 'userRole',
      ),
      'view' => 'views/user/fields/teams',
      'default' => 'javascript: return {teamsIds: []}',
    ),
    'roles' => 
    array (
      'type' => 'linkMultiple',
      'tooltip' => true,
    ),
    'portals' => 
    array (
      'type' => 'linkMultiple',
      'tooltip' => true,
    ),
    'portalRoles' => 
    array (
      'type' => 'linkMultiple',
      'tooltip' => true,
    ),
    'contact' => 
    array (
      'type' => 'link',
      'view' => 'views/user/fields/contact',
    ),
    'accounts' => 
    array (
      'type' => 'linkMultiple',
    ),
    'account' => 
    array (
      'type' => 'link',
      'notStorable' => true,
      'readOnly' => true,
    ),
    'portal' => 
    array (
      'type' => 'link',
      'notStorable' => true,
      'readOnly' => true,
    ),
    'avatar' => 
    array (
      'type' => 'image',
      'view' => 'views/user/fields/avatar',
      'previewSize' => 'small',
    ),
    'sendAccessInfo' => 
    array (
      'type' => 'bool',
      'notStorable' => true,
      'disabled' => true,
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
  ),
  'links' => 
  array (
    'defaultTeam' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Team',
    ),
    'teams' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Team',
      'foreign' => 'users',
      'additionalColumns' => 
      array (
        'role' => 
        array (
          'type' => 'varchar',
          'len' => 100,
        ),
      ),
      'layoutRelationshipsDisabled' => true,
    ),
    'roles' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Role',
      'foreign' => 'users',
      'layoutRelationshipsDisabled' => true,
    ),
    'portals' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Portal',
      'foreign' => 'users',
      'layoutRelationshipsDisabled' => true,
    ),
    'portalRoles' => 
    array (
      'type' => 'hasMany',
      'entity' => 'PortalRole',
      'foreign' => 'users',
      'layoutRelationshipsDisabled' => true,
    ),
    'preferences' => 
    array (
      'type' => 'hasOne',
      'entity' => 'Preferences',
    ),
    'meetings' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Meeting',
      'foreign' => 'users',
    ),
    'calls' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Call',
      'foreign' => 'users',
    ),
    'emails' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Email',
      'foreign' => 'users',
    ),
    'notes' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Note',
      'foreign' => 'users',
    ),
    'contact' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Contact',
      'foreign' => 'portalUser',
    ),
    'accounts' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Account',
      'foreign' => 'portalUsers',
      'relationName' => 'AccountPortalUser',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'userName',
    'asc' => true,
    'textFilterFields' => 
    array (
      0 => 'name',
      1 => 'userName',
    ),
  ),
);
?>