<?php
return array (
  'fields' => 
  array (
    'post' => 
    array (
      'type' => 'text',
    ),
    'data' => 
    array (
      'type' => 'jsonObject',
      'readOnly' => true,
    ),
    'type' => 
    array (
      'type' => 'varchar',
      'readOnly' => true,
    ),
    'targetType' => 
    array (
      'type' => 'varchar',
    ),
    'parent' => 
    array (
      'type' => 'linkParent',
      'readOnly' => true,
    ),
    'related' => 
    array (
      'type' => 'linkParent',
      'readOnly' => true,
    ),
    'attachments' => 
    array (
      'type' => 'linkMultiple',
      'view' => 'views/stream/fields/attachment-multiple',
    ),
    'number' => 
    array (
      'type' => 'autoincrement',
      'index' => true,
      'readOnly' => true,
    ),
    'teams' => 
    array (
      'type' => 'linkMultiple',
      'noLoad' => true,
    ),
    'portals' => 
    array (
      'type' => 'linkMultiple',
      'noLoad' => true,
    ),
    'users' => 
    array (
      'type' => 'linkMultiple',
      'noLoad' => true,
    ),
    'isGlobal' => 
    array (
      'type' => 'bool',
    ),
    'notifiedUserIdList' => 
    array (
      'type' => 'jsonArray',
      'notStorable' => true,
    ),
    'isToSelf' => 
    array (
      'type' => 'bool',
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
    'attachments' => 
    array (
      'type' => 'hasChildren',
      'entity' => 'Attachment',
      'relationName' => 'attachments',
      'foreign' => 'parent',
    ),
    'parent' => 
    array (
      'type' => 'belongsToParent',
      'foreign' => 'notes',
    ),
    'superParent' => 
    array (
      'type' => 'belongsToParent',
    ),
    'related' => 
    array (
      'type' => 'belongsToParent',
    ),
    'teams' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Team',
      'foreign' => 'notes',
    ),
    'portals' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Portal',
      'foreign' => 'notes',
    ),
    'users' => 
    array (
      'type' => 'hasMany',
      'entity' => 'User',
      'foreign' => 'notes',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'number',
    'asc' => false,
  ),
  'streamRelated' => 
  array (
    'Account' => 
    array (
      0 => 'meetings',
      1 => 'calls',
      2 => 'tasks',
    ),
    'Contact' => 
    array (
      0 => 'meetings',
      1 => 'calls',
      2 => 'tasks',
    ),
    'Lead' => 
    array (
      0 => 'meetings',
      1 => 'calls',
      2 => 'tasks',
    ),
    'Opportunity' => 
    array (
      0 => 'meetings',
      1 => 'calls',
      2 => 'tasks',
    ),
    'Case' => 
    array (
      0 => 'meetings',
      1 => 'calls',
      2 => 'tasks',
    ),
  ),
  'statusStyles' => 
  array (
    'Lead' => 
    array (
      'New' => 'primary',
      'Assigned' => 'primary',
      'In Process' => 'primary',
      'Converted' => 'success',
      'Recycled' => 'danger',
      'Dead' => 'danger',
    ),
    'Case' => 
    array (
      'New' => 'primary',
      'Assigned' => 'primary',
      'Pending' => 'default',
      'Closed' => 'success',
      'Rejected' => 'danger',
      'Duplicate' => 'danger',
    ),
    'Opportunity' => 
    array (
      'Prospecting' => 'primary',
      'Qualification' => 'primary',
      'Needs Analysis' => 'primary',
      'Value Proposition' => 'primary',
      'Id. Decision Makers' => 'primary',
      'Perception Analysis' => 'primary',
      'Proposal/Price Quote' => 'primary',
      'Negotiation/Review' => 'primary',
      'Closed Won' => 'success',
      'Closed Lost' => 'danger',
    ),
    'Task' => 
    array (
      'Completed' => 'success',
      'Started' => 'primary',
      'Canceled' => 'danger',
    ),
    'Meeting' => 
    array (
      'Held' => 'success',
    ),
    'Call' => 
    array (
      'Held' => 'success',
    ),
  ),
  'statusFields' => 
  array (
    'Lead' => 'status',
    'Case' => 'status',
    'Opportunity' => 'stage',
    'Task' => 'status',
    'Meeting' => 'status',
    'Call' => 'status',
    'Campaign' => 'status',
  ),
  'indexes' => 
  array (
    'createdAt' => 
    array (
      'type' => 'index',
      'columns' => 
      array (
        0 => 'createdAt',
      ),
    ),
    'parent' => 
    array (
      'type' => 'index',
      'columns' => 
      array (
        0 => 'parentId',
        1 => 'parentType',
      ),
    ),
    'parentAndSuperParent' => 
    array (
      'type' => 'index',
      'columns' => 
      array (
        0 => 'parentId',
        1 => 'parentType',
        2 => 'superParentId',
        3 => 'superParentType',
      ),
    ),
  ),
);
?>