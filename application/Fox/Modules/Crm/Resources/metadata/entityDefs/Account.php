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
    'phoneNumber' => 
    array (
      'type' => 'phone',
      'typeList' => 
      array (
        0 => 'Office',
        1 => 'Fax',
        2 => 'Other',
      ),
      'defaultType' => 'Office',
    ),
    'type' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => '',
        1 => 'Customer',
        2 => 'Investor',
        3 => 'Partner',
        4 => 'Reseller',
      ),
      'default' => '',
    ),
    'industry' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => '',
        1 => 'Advertising',
        2 => 'Agriculture',
        3 => 'Apparel & Accessories',
        4 => 'Automotive',
        5 => 'Banking',
        6 => 'Biotechnology',
        7 => 'Building Materials & Equipment',
        8 => 'Chemical',
        9 => 'Computer',
        10 => 'Education',
        11 => 'Electronics',
        12 => 'Energy',
        13 => 'Entertainment & Leisure',
        14 => 'Finance',
        15 => 'Food & Beverage',
        16 => 'Grocery',
        17 => 'Healthcare',
        18 => 'Insurance',
        19 => 'Legal',
        20 => 'Manufacturing',
        21 => 'Publishing',
        22 => 'Real Estate',
        23 => 'Service',
        24 => 'Sports',
        25 => 'Software',
        26 => 'Technology',
        27 => 'Telecommunications',
        28 => 'Television',
        29 => 'Transportation',
        30 => 'Venture Capital',
      ),
      'default' => '',
      'isSorted' => true,
    ),
    'sicCode' => 
    array (
      'type' => 'varchar',
      'maxLength' => 40,
      'trim' => true,
    ),
    'balances' => 
    array (
      'type' => 'varchar',
      'maxLength' => 40,
      'trim' => true,
      'readOnly' => true,
    ),
    'blockedBalances' => 
    array (
      'type' => 'varchar',
      'maxLength' => 40,
      'trim' => true,
      'readOnly' => true,
    ),
    'openId' => 
    array (
      'type' => 'varchar',
      'trim' => true,
      'readOnly' => true,
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
    'parent' => 
    array (
      'type' => 'link',
      'readOnly' => true,
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
    'parent' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Account',
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
    'opportunities' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Opportunity',
      'foreign' => 'account',
    ),
    'cases' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Case',
      'foreign' => 'account',
    ),
    'documents' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Document',
      'foreign' => 'accounts',
    ),
    'meetingsPrimary' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Meeting',
      'foreign' => 'account',
      'layoutRelationshipsDisabled' => true,
    ),
    'emailsPrimary' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Email',
      'foreign' => 'account',
      'layoutRelationshipsDisabled' => true,
    ),
    'callsPrimary' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Call',
      'foreign' => 'account',
      'layoutRelationshipsDisabled' => true,
    ),
    'tasksPrimary' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Task',
      'foreign' => 'account',
      'layoutRelationshipsDisabled' => true,
    ),
    'meetings' => 
    array (
      'type' => 'hasChildren',
      'entity' => 'Meeting',
      'foreign' => 'parent',
      'layoutRelationshipsDisabled' => true,
    ),
    'calls' => 
    array (
      'type' => 'hasChildren',
      'entity' => 'Call',
      'foreign' => 'parent',
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
    'targetLists' => 
    array (
      'type' => 'hasMany',
      'entity' => 'TargetList',
      'foreign' => 'accounts',
    ),
    'portalUsers' => 
    array (
      'type' => 'hasMany',
      'entity' => 'User',
      'foreign' => 'accounts',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'name',
    'asc' => true,
  ),
  'indexes' => 
  array (
    'name' => 
    array (
      'columns' => 
      array (
        0 => 'name',
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
  ),
);
?>