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
        1 => 'In Review',
        2 => 'Published',
        3 => 'Archived',
      ),
      'view' => 'crm:views/knowledge-base-article/fields/status',
      'default' => 'Draft',
    ),
    'language' => 
    array (
      'type' => 'enum',
      'view' => 'crm:views/knowledge-base-article/fields/language',
      'default' => '',
    ),
    'type' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Article',
      ),
    ),
    'portals' => 
    array (
      'type' => 'linkMultiple',
      'tooltip' => true,
    ),
    'publishDate' => 
    array (
      'type' => 'date',
    ),
    'expirationDate' => 
    array (
      'type' => 'date',
      'after' => 'publishDate',
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
    ),
    'modifiedBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
    'assignedUser' => 
    array (
      'type' => 'link',
    ),
    'teams' => 
    array (
      'type' => 'linkMultiple',
    ),
    'categories' => 
    array (
      'type' => 'linkMultiple',
      'view' => 'views/fields/link-multiple-category-tree',
    ),
    'attachments' => 
    array (
      'type' => 'attachmentMultiple',
    ),
    'body' => 
    array (
      'type' => 'wysiwyg',
    ),
  ),
  'links' => 
  array (
    'cases' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Case',
      'foreign' => 'articles',
    ),
    'portals' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Portal',
      'foreign' => 'articles',
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
    'categories' => 
    array (
      'type' => 'hasMany',
      'foreign' => 'articles',
      'entity' => 'KnowledgeBaseCategory',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'name',
    'asc' => true,
  ),
);
?>