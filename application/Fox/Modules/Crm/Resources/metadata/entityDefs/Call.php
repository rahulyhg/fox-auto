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
    'status' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Planned',
        1 => 'Held',
        2 => 'Not Held',
      ),
      'default' => 'Planned',
      'view' => 'Fields.EnumStyled',
      'style' => 
      array (
        'Held' => 'success',
      ),
      'audited' => true,
    ),
    'dateStart' => 
    array (
      'type' => 'datetime',
      'required' => true,
      'default' => 'javascript: return this.dateTime.getNow(15);',
      'audited' => true,
    ),
    'dateEnd' => 
    array (
      'type' => 'datetime',
      'required' => true,
      'after' => 'dateStart',
    ),
    'duration' => 
    array (
      'type' => 'duration',
      'start' => 'dateStart',
      'end' => 'dateEnd',
      'options' => 
      array (
        0 => 300,
        1 => 600,
        2 => 900,
        3 => 1800,
        4 => 2700,
        5 => 3600,
        6 => 7200,
      ),
      'default' => 300,
      'notStorable' => true,
    ),
    'reminders' => 
    array (
      'type' => 'jsonArray',
      'notStorable' => true,
      'view' => 'crm:views/meeting/fields/reminders',
    ),
    'direction' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Outbound',
        1 => 'Inbound',
      ),
      'default' => 'Outbound',
    ),
    'description' => 
    array (
      'type' => 'text',
    ),
    'parent' => 
    array (
      'type' => 'linkParent',
      'entityList' => 
      array (
        0 => 'Account',
        1 => 'Lead',
        2 => 'Opportunity',
        3 => 'Case',
      ),
    ),
    'account' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
    'acceptanceStatus' => 
    array (
      'type' => 'enum',
      'notStorable' => true,
      'disabled' => true,
      'options' => 
      array (
        0 => 'None',
        1 => 'Accepted',
        2 => 'Tentative',
        3 => 'Declined',
      ),
    ),
    'users' => 
    array (
      'type' => 'linkMultiple',
      'layoutDetailDisabled' => true,
      'layoutListDisabled' => true,
      'view' => 'crm:views/meeting/fields/users',
      'columns' => 
      array (
        'status' => 'acceptanceStatus',
      ),
    ),
    'contacts' => 
    array (
      'type' => 'linkMultiple',
      'layoutDetailDisabled' => true,
      'layoutListDisabled' => true,
      'view' => 'crm:views/meeting/fields/contacts',
      'columns' => 
      array (
        'status' => 'acceptanceStatus',
      ),
    ),
    'leads' => 
    array (
      'type' => 'linkMultiple',
      'layoutDetailDisabled' => true,
      'layoutListDisabled' => true,
      'view' => 'crm:views/meeting/fields/attendees',
      'columns' => 
      array (
        'status' => 'acceptanceStatus',
      ),
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
      'required' => true,
      'view' => 'views/fields/user',
    ),
    'teams' => 
    array (
      'type' => 'linkMultiple',
    ),
  ),
  'links' => 
  array (
    'account' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Account',
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
    'users' => 
    array (
      'type' => 'hasMany',
      'entity' => 'User',
      'foreign' => 'calls',
      'additionalColumns' => 
      array (
        'status' => 
        array (
          'type' => 'varchar',
          'len' => '36',
          'default' => 'None',
        ),
      ),
    ),
    'contacts' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Contact',
      'foreign' => 'calls',
      'additionalColumns' => 
      array (
        'status' => 
        array (
          'type' => 'varchar',
          'len' => '36',
          'default' => 'None',
        ),
      ),
    ),
    'leads' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Lead',
      'foreign' => 'calls',
      'additionalColumns' => 
      array (
        'status' => 
        array (
          'type' => 'varchar',
          'len' => '36',
          'default' => 'None',
        ),
      ),
    ),
    'parent' => 
    array (
      'type' => 'belongsToParent',
      'foreign' => 'calls',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'dateStart',
    'asc' => false,
  ),
  'indexes' => 
  array (
    'dateStartStatus' => 
    array (
      'columns' => 
      array (
        0 => 'dateStart',
        1 => 'status',
      ),
    ),
    'dateStart' => 
    array (
      'columns' => 
      array (
        0 => 'dateStart',
        1 => 'deleted',
      ),
    ),
    'status' => 
    array (
      'columns' => 
      array (
        0 => 'status',
        1 => 'deleted',
      ),
    ),
    'assignedUser' => 
    array (
      'columns' => 
      array (
        0 => 'assignedUserId',
        1 => 'deleted',
      ),
    ),
    'assignedUserStatus' => 
    array (
      'columns' => 
      array (
        0 => 'assignedUserId',
        1 => 'status',
      ),
    ),
  ),
);
?>