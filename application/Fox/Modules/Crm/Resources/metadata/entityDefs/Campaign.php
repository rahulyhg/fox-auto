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
        0 => 'Planning',
        1 => 'Active',
        2 => 'Inactive',
        3 => 'Complete',
      ),
      'default' => 'Planning',
    ),
    'type' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Email',
        1 => 'Newsletter',
        2 => 'Web',
        3 => 'Television',
        4 => 'Radio',
        5 => 'Mail',
      ),
      'default' => 'Email',
    ),
    'startDate' => 
    array (
      'type' => 'date',
    ),
    'endDate' => 
    array (
      'type' => 'date',
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
    'targetLists' => 
    array (
      'type' => 'linkMultiple',
      'tooltip' => true,
    ),
    'excludingTargetLists' => 
    array (
      'type' => 'linkMultiple',
      'tooltip' => true,
    ),
    'sentCount' => 
    array (
      'type' => 'int',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'openedCount' => 
    array (
      'view' => 'crm:views/campaign/fields/int-with-percentage',
      'type' => 'int',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'clickedCount' => 
    array (
      'view' => 'crm:views/campaign/fields/int-with-percentage',
      'type' => 'int',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'optedOutCount' => 
    array (
      'view' => 'crm:views/campaign/fields/int-with-percentage',
      'type' => 'int',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'bouncedCount' => 
    array (
      'view' => 'crm:views/campaign/fields/int-with-percentage',
      'type' => 'int',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'hardBouncedCount' => 
    array (
      'type' => 'int',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'softBouncedCount' => 
    array (
      'type' => 'int',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'leadCreatedCount' => 
    array (
      'type' => 'int',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'openedPercentage' => 
    array (
      'type' => 'int',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'clickedPercentage' => 
    array (
      'type' => 'int',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'optedOutPercentage' => 
    array (
      'type' => 'int',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'bouncedPercentage' => 
    array (
      'type' => 'int',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'revenue' => 
    array (
      'type' => 'currency',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'budget' => 
    array (
      'type' => 'currency',
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
    'targetLists' => 
    array (
      'type' => 'hasMany',
      'entity' => 'TargetList',
      'foreign' => 'campaigns',
    ),
    'excludingTargetLists' => 
    array (
      'type' => 'hasMany',
      'entity' => 'TargetList',
      'foreign' => 'campaignsExcluding',
      'relationName' => 'campaignTargetListExcluding',
    ),
    'accounts' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Account',
      'foreign' => 'campaign',
    ),
    'contacts' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Contact',
      'foreign' => 'campaign',
    ),
    'leads' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Lead',
      'foreign' => 'campaign',
    ),
    'opportunities' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Opportunity',
      'foreign' => 'campaign',
    ),
    'campaignLogRecords' => 
    array (
      'type' => 'hasMany',
      'entity' => 'CampaignLogRecord',
      'foreign' => 'campaign',
    ),
    'trackingUrls' => 
    array (
      'type' => 'hasMany',
      'entity' => 'CampaignTrackingUrl',
      'foreign' => 'campaign',
    ),
    'massEmails' => 
    array (
      'type' => 'hasMany',
      'entity' => 'MassEmail',
      'foreign' => 'campaign',
      'layoutRelationshipsDisabled' => true,
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