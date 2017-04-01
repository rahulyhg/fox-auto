<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'personName',
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
    'accountId' => 
    array (
      'where' => 
      array (
        '=' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND account_id = {value})',
        'IN' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND account_id IN {value})',
        'NOT IN' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND account_id NOT IN {value})',
      ),
      'disabled' => true,
    ),
    'title' => 
    array (
      'type' => 'varchar',
      'maxLength' => 50,
      'notStorable' => true,
      'select' => 'accountContact.role',
      'orderBy' => 'accountContact.role {direction}',
      'where' => 
      array (
        'LIKE' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND role LIKE {value})',
        '=' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND role = {value})',
      ),
      'trim' => true,
    ),
    'description' => 
    array (
      'type' => 'text',
    ),
    'emailAddress' => 
    array (
      'type' => 'email',
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
    'doNotCall' => 
    array (
      'type' => 'bool',
    ),
    'address' => 
    array (
      'type' => 'address',
    ),
    'addressStreet' => 
    array (
      'type' => 'text',
      'maxLength' => 255,
      'dbType' => 'varchar',
    ),
    'addressCity' => 
    array (
      'type' => 'varchar',
    ),
    'addressState' => 
    array (
      'type' => 'varchar',
    ),
    'addressCountry' => 
    array (
      'type' => 'varchar',
    ),
    'addressPostalCode' => 
    array (
      'type' => 'varchar',
    ),
    'account' => 
    array (
      'type' => 'link',
    ),
    'accounts' => 
    array (
      'type' => 'linkMultiple',
      'view' => 'crm:views/contact/fields/accounts',
      'columns' => 
      array (
        'role' => 'contactRole',
      ),
    ),
    'accountRole' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'disabled' => true,
    ),
    'accountType' => 
    array (
      'type' => 'foreign',
      'link' => 'account',
      'field' => 'type',
    ),
    'opportunityRole' => 
    array (
      'type' => 'enum',
      'notStorable' => true,
      'disabled' => true,
      'options' => 
      array (
        0 => '',
        1 => 'Decision Maker',
        2 => 'Evaluator',
        3 => 'Influencer',
      ),
    ),
    'acceptanceStatus' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'disabled' => true,
    ),
    'campaign' => 
    array (
      'type' => 'link',
      'layoutListDisabled' => true,
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
      'view' => 'views/fields/assigned-user',
    ),
    'teams' => 
    array (
      'type' => 'linkMultiple',
    ),
    'targetLists' => 
    array (
      'type' => 'linkMultiple',
      'layoutDetailDisabled' => true,
      'layoutListDisabled' => true,
      'layoutMassUpdateDisabled' => true,
      'importDisabled' => true,
      'noLoad' => true,
    ),
    'targetList' => 
    array (
      'type' => 'link',
      'notStorable' => true,
      'layoutDetailDisabled' => true,
      'layoutListDisabled' => true,
      'layoutMassUpdateDisabled' => true,
      'layoutFiltersDisabled' => true,
      'entity' => 'TargetList',
    ),
    'portalUser' => 
    array (
      'type' => 'link',
      'layoutMassUpdateDisabled' => true,
      'layoutListDisabled' => true,
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
    'account' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Account',
    ),
    'accounts' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Account',
      'foreign' => 'contacts',
      'additionalColumns' => 
      array (
        'role' => 
        array (
          'type' => 'varchar',
          'len' => 50,
        ),
      ),
      'layoutRelationshipsDisabled' => true,
    ),
    'opportunities' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Opportunity',
      'foreign' => 'contacts',
    ),
    'casesPrimary' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Case',
      'foreign' => 'contact',
      'layoutRelationshipsDisabled' => true,
    ),
    'cases' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Case',
      'foreign' => 'contacts',
    ),
    'meetings' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Meeting',
      'foreign' => 'contacts',
      'layoutRelationshipsDisabled' => true,
    ),
    'calls' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Call',
      'foreign' => 'contacts',
      'layoutRelationshipsDisabled' => true,
    ),
    'tasks' => 
    array (
      'type' => 'hasChildren',
      'entity' => 'Task',
      'foreign' => 'parent',
      'layoutRelationshipsDisabled' => true,
    ),
    'emails' => 
    array (
      'type' => 'hasChildren',
      'entity' => 'Email',
      'foreign' => 'parent',
      'layoutRelationshipsDisabled' => true,
    ),
    'campaign' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Campaign',
      'foreign' => 'contacts',
      'noJoin' => true,
    ),
    'campaignLogRecords' => 
    array (
      'type' => 'hasChildren',
      'entity' => 'CampaignLogRecord',
      'foreign' => 'parent',
    ),
    'targetLists' => 
    array (
      'type' => 'hasMany',
      'entity' => 'TargetList',
      'foreign' => 'contacts',
    ),
    'portalUser' => 
    array (
      'type' => 'hasOne',
      'entity' => 'User',
      'foreign' => 'contact',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'name',
    'asc' => true,
    'textFilterFields' => 
    array (
      0 => 'name',
      1 => 'emailAddress',
    ),
  ),
  'indexes' => 
  array (
    'firstName' => 
    array (
      'columns' => 
      array (
        0 => 'firstName',
        1 => 'deleted',
      ),
    ),
    'name' => 
    array (
      'columns' => 
      array (
        0 => 'firstName',
        1 => 'lastName',
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
  ),
);
?>