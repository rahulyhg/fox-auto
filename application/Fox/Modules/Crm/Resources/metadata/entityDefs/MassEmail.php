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
        0 => 'Draft',
        1 => 'Pending',
      ),
      'default' => 'Pending',
    ),
    'storeSentEmails' => 
    array (
      'type' => 'bool',
      'default' => false,
    ),
    'optOutEntirely' => 
    array (
      'type' => 'bool',
      'default' => false,
      'tooltip' => true,
    ),
    'fromAddress' => 
    array (
      'type' => 'varchar',
      'trim' => true,
      'view' => 'crm:views/mass-email/fields/from-address',
    ),
    'fromName' => 
    array (
      'type' => 'varchar',
    ),
    'replyToAddress' => 
    array (
      'type' => 'varchar',
      'trim' => true,
    ),
    'replyToName' => 
    array (
      'type' => 'varchar',
    ),
    'startAt' => 
    array (
      'type' => 'datetime',
      'required' => true,
    ),
    'emailTemplate' => 
    array (
      'type' => 'link',
      'required' => true,
      'view' => 'crm:views/mass-email/fields/email-template',
    ),
    'campaign' => 
    array (
      'type' => 'link',
    ),
    'targetLists' => 
    array (
      'type' => 'linkMultiple',
      'required' => true,
      'tooltip' => true,
    ),
    'excludingTargetLists' => 
    array (
      'type' => 'linkMultiple',
      'tooltip' => true,
    ),
    'inboundEmail' => 
    array (
      'type' => 'link',
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
    'emailTemplate' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'EmailTemplate',
    ),
    'campaign' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Campaign',
      'foreign' => 'massEmails',
    ),
    'targetLists' => 
    array (
      'type' => 'hasMany',
      'entity' => 'TargetList',
      'foreign' => 'massEmails',
    ),
    'excludingTargetLists' => 
    array (
      'type' => 'hasMany',
      'entity' => 'TargetList',
      'foreign' => 'massEmailsExcluding',
      'relationName' => 'massEmailTargetListExcluding',
    ),
    'inboundEmail' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'InboundEmail',
    ),
    'queueItems' => 
    array (
      'type' => 'hasMany',
      'entity' => 'EmailQueueItem',
      'foreign' => 'massEmail',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
    'asc' => false,
  ),
);
?>