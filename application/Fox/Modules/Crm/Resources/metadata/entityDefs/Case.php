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
    'number' => 
    array (
      'type' => 'autoincrement',
      'index' => true,
    ),
    'status' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'New',
        1 => 'Assigned',
        2 => 'Pending',
        3 => 'Closed',
        4 => 'Rejected',
        5 => 'Duplicate',
      ),
      'default' => 'New',
      'view' => 'views/fields/enum-styled',
      'style' => 
      array (
        'Closed' => 'success',
        'Duplicate' => 'danger',
        'Rejected' => 'danger',
      ),
      'audited' => true,
    ),
    'priority' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Low',
        1 => 'Normal',
        2 => 'High',
        3 => 'Urgent',
      ),
      'default' => 'Normal',
      'audited' => true,
    ),
    'type' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => '',
        1 => 'Question',
        2 => 'Incident',
        3 => 'Problem',
      ),
      'audited' => true,
    ),
    'description' => 
    array (
      'type' => 'text',
    ),
    'account' => 
    array (
      'type' => 'link',
    ),
    'contact' => 
    array (
      'type' => 'link',
      'view' => 'crm:views/case/fields/contact',
    ),
    'contacts' => 
    array (
      'type' => 'linkMultiple',
      'view' => 'crm:views/case/fields/contacts',
    ),
    'inboundEmail' => 
    array (
      'type' => 'link',
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
    'inboundEmail' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'InboundEmail',
    ),
    'account' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Account',
      'foreign' => 'cases',
    ),
    'contact' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Contact',
      'foreign' => 'casesPrimary',
    ),
    'contacts' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Contact',
      'foreign' => 'cases',
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
    'articles' => 
    array (
      'type' => 'hasMany',
      'entity' => 'KnowledgeBaseArticle',
      'foreign' => 'cases',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'number',
    'asc' => false,
  ),
  'indexes' => 
  array (
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