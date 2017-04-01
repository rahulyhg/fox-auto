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
      'trim' => true,
      'view' => 'EmailAccount.Fields.EmailAddress',
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
      'view' => 'EmailAccount.Fields.Folders',
      'tooltip' => true,
    ),
    'sentFolder' => 
    array (
      'type' => 'varchar',
      'view' => 'EmailAccount.Fields.Folder',
    ),
    'storeSentEmails' => 
    array (
      'type' => 'bool',
      'tooltip' => true,
    ),
    'keepFetchedEmailsUnread' => 
    array (
      'type' => 'bool',
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
    'assignedUser' => 
    array (
      'type' => 'link',
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
    'assignedUser' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
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