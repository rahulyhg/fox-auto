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
    'title' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
    ),
    'status' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'New',
        1 => 'Assigned',
        2 => 'In Process',
        3 => 'Converted',
        4 => 'Recycled',
        5 => 'Dead',
      ),
      'default' => 'New',
      'view' => 'views/fields/enum-styled',
      'style' => 
      array (
        'Converted' => 'success',
        'Recycled' => 'danger',
        'Dead' => 'danger',
      ),
      'audited' => true,
    ),
    'source' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => '',
        1 => 'Call',
        2 => 'Email',
        3 => 'Existing Customer',
        4 => 'Partner',
        5 => 'Public Relations',
        6 => 'Web Site',
        7 => 'Campaign',
        8 => 'Other',
      ),
      'default' => '',
    ),
    'opportunityAmount' => 
    array (
      'type' => 'currency',
      'audited' => true,
    ),
    'opportunityAmountConverted' => 
    array (
      'type' => 'currencyConverted',
      'readOnly' => true,
    ),
    'website' => 
    array (
      'type' => 'url',
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
    'accountName' => 
    array (
      'type' => 'varchar',
    ),
    'assignedUser' => 
    array (
      'type' => 'link',
      'view' => 'views/fields/user',
    ),
    'acceptanceStatus' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'disabled' => true,
    ),
    'teams' => 
    array (
      'type' => 'linkMultiple',
    ),
    'campaign' => 
    array (
      'type' => 'link',
      'layoutListDisabled' => true,
    ),
    'createdAccount' => 
    array (
      'type' => 'link',
      'layoutDetailDisabled' => true,
      'layoutMassUpdateDisabled' => true,
    ),
    'createdContact' => 
    array (
      'type' => 'link',
      'layoutDetailDisabled' => true,
      'layoutMassUpdateDisabled' => true,
    ),
    'createdOpportunity' => 
    array (
      'type' => 'link',
      'layoutDetailDisabled' => true,
      'layoutMassUpdateDisabled' => true,
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
    'opportunities' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Opportunity',
      'foreign' => 'leads',
    ),
    'meetings' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Meeting',
      'foreign' => 'leads',
      'layoutRelationshipsDisabled' => true,
    ),
    'calls' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Call',
      'foreign' => 'leads',
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
    'createdAccount' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Account',
      'noJoin' => true,
    ),
    'createdContact' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Contact',
      'noJoin' => true,
    ),
    'createdOpportunity' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Opportunity',
      'noJoin' => true,
    ),
    'campaign' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Campaign',
      'foreign' => 'leads',
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
      'foreign' => 'leads',
    ),
  ),
  'convertEntityList' => 
  array (
    0 => 'Account',
    1 => 'Contact',
    2 => 'Opportunity',
  ),
  'convertFields' => 
  array (
    'Contact' => 
    array (
    ),
    'Account' => 
    array (
      'name' => 'accountName',
      'billingAddressStreet' => 'addressStreet',
      'billingAddressCity' => 'addressCity',
      'billingAddressState' => 'addressState',
      'billingAddressPostalCode' => 'addressPostalCode',
      'billingAddressCountry' => 'addressCountry',
    ),
    'Opportunity' => 
    array (
      'amount' => 'opportunityAmount',
      'leadSource' => 'source',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
    'asc' => false,
    'textFilterFields' => 
    array (
      0 => 'name',
      1 => 'accountName',
      2 => 'emailAddress',
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
    'status' => 
    array (
      'columns' => 
      array (
        0 => 'status',
        1 => 'deleted',
      ),
    ),
    'createdAt' => 
    array (
      'columns' => 
      array (
        0 => 'createdAt',
        1 => 'deleted',
      ),
    ),
    'createdAtStatus' => 
    array (
      'columns' => 
      array (
        0 => 'createdAt',
        1 => 'status',
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