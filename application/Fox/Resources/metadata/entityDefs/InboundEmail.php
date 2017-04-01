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
    'emailAddress' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'maxLength' => 100,
      'view' => 'views/email-account/fields/email-address',
      'trim' => true,
    ),
    'status' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Active',
        1 => 'Inactive',
      ),
    ),
    'host' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'trim' => true,
    ),
    'port' => 
    array (
      'type' => 'varchar',
      'default' => '143',
      'required' => true,
    ),
    'ssl' => 
    array (
      'type' => 'bool',
    ),
    'username' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'trim' => true,
    ),
    'password' => 
    array (
      'type' => 'password',
    ),
    'monitoredFolders' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'default' => 'INBOX',
      'view' => 'views/inbound-email/fields/folders',
    ),
    'fetchSince' => 
    array (
      'type' => 'date',
      'required' => true,
    ),
    'fetchData' => 
    array (
      'type' => 'jsonObject',
      'readOnly' => true,
    ),
    'assignToUser' => 
    array (
      'type' => 'link',
      'tooltip' => true,
    ),
    'team' => 
    array (
      'type' => 'link',
      'tooltip' => true,
    ),
    'addAllTeamUsers' => 
    array (
      'type' => 'bool',
      'tooltip' => true,
    ),
    'createCase' => 
    array (
      'type' => 'bool',
      'tooltip' => true,
    ),
    'caseDistribution' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => '',
        1 => 'Direct-Assignment',
        2 => 'Round-Robin',
        3 => 'Least-Busy',
      ),
      'default' => 'Direct-Assignment',
      'tooltip' => true,
    ),
    'targetUserPosition' => 
    array (
      'type' => 'enum',
      'view' => 'views/inbound-email/fields/target-user-position',
      'tooltip' => true,
    ),
    'reply' => 
    array (
      'type' => 'bool',
      'tooltip' => true,
    ),
    'replyEmailTemplate' => 
    array (
      'type' => 'link',
    ),
    'replyFromAddress' => 
    array (
      'type' => 'varchar',
    ),
    'replyToAddress' => 
    array (
      'type' => 'varchar',
      'tooltip' => true,
      'required' => true,
    ),
    'replyFromName' => 
    array (
      'type' => 'varchar',
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
    ),
    'modifiedBy' => 
    array (
      'type' => 'link',
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
    'assignToUser' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'team' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Team',
    ),
    'replyEmailTemplate' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'EmailTemplate',
    ),
    'filters' => 
    array (
      'type' => 'hasChildren',
      'foreign' => 'parent',
      'entity' => 'EmailFilter',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'name',
    'asc' => true,
  ),
);
?>