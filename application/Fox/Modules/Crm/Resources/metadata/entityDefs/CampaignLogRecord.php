<?php
return array (
  'fields' => 
  array (
    'action' => 
    array (
      'type' => 'enum',
      'required' => true,
      'maxLength' => 50,
      'options' => 
      array (
        0 => 'Sent',
        1 => 'Opened',
        2 => 'Opted Out',
        3 => 'Bounced',
        4 => 'Clicked',
        5 => 'Lead Created',
      ),
    ),
    'actionDate' => 
    array (
      'type' => 'datetime',
      'required' => true,
    ),
    'data' => 
    array (
      'type' => 'jsonObject',
      'view' => 'crm:views/campaign-log-record/fields/data',
    ),
    'stringData' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
    ),
    'stringAdditionalData' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
    ),
    'application' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'maxLength' => 36,
      'default' => 'Fox',
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'createdBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
    'campaign' => 
    array (
      'type' => 'link',
    ),
    'parent' => 
    array (
      'type' => 'linkParent',
    ),
    'object' => 
    array (
      'type' => 'linkParent',
    ),
    'queueItem' => 
    array (
      'type' => 'link',
    ),
    'isTest' => 
    array (
      'type' => 'bool',
      'default' => false,
    ),
  ),
  'links' => 
  array (
    'createdBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'campaign' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Campaign',
      'foreign' => 'campaignLogRecords',
    ),
    'queueItem' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'EmailQueueItem',
      'noJoin' => true,
    ),
    'parent' => 
    array (
      'type' => 'belongsToParent',
      'entityList' => 
      array (
        0 => 'Account',
        1 => 'Contact',
        2 => 'Lead',
        3 => 'Opportunity',
        4 => 'User',
      ),
    ),
    'object' => 
    array (
      'type' => 'belongsToParent',
      'entityList' => 
      array (
        0 => 'Email',
      ),
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'actionDate',
    'asc' => false,
  ),
  'indexes' => 
  array (
    'actionDate' => 
    array (
      'columns' => 
      array (
        0 => 'actionDate',
        1 => 'deleted',
      ),
    ),
    'action' => 
    array (
      'columns' => 
      array (
        0 => 'action',
        1 => 'deleted',
      ),
    ),
  ),
);
?>