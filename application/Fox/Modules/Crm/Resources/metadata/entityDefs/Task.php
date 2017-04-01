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
        0 => 'Not Started',
        1 => 'Started',
        2 => 'Completed',
        3 => 'Canceled',
        4 => 'Deferred',
      ),
      'view' => 'views/fields/enum-styled',
      'style' => 
      array (
        'Completed' => 'success',
      ),
      'default' => 'Not Started',
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
    'dateStart' => 
    array (
      'type' => 'datetimeOptional',
      'before' => 'dateEnd',
    ),
    'dateEnd' => 
    array (
      'type' => 'datetimeOptional',
      'after' => 'dateStart',
      'view' => 'crm:views/task/fields/date-end',
      'audited' => true,
    ),
    'dateStartDate' => 
    array (
      'type' => 'date',
      'disabled' => true,
    ),
    'dateEndDate' => 
    array (
      'type' => 'date',
      'disabled' => true,
    ),
    'dateCompleted' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'isOverdue' => 
    array (
      'type' => 'bool',
      'readOnly' => true,
      'notStorable' => true,
      'view' => 'crm:views/task/fields/is-overdue',
      'disabled' => true,
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
        1 => 'Contact',
        2 => 'Lead',
        3 => 'Opportunity',
        4 => 'Case',
      ),
    ),
    'account' => 
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
      'required' => true,
      'view' => 'views/fields/user',
    ),
    'teams' => 
    array (
      'type' => 'linkMultiple',
    ),
    'attachments' => 
    array (
      'type' => 'attachmentMultiple',
      'sourceList' => 
      array (
        0 => 'Document',
      ),
      'layoutListDisabled' => true,
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
    'parent' => 
    array (
      'type' => 'belongsToParent',
      'foreign' => 'tasks',
    ),
    'account' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Account',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
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
    'dateEndStatus' => 
    array (
      'columns' => 
      array (
        0 => 'dateEnd',
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
    'dateEnd' => 
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