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
    'order' => 
    array (
      'type' => 'int',
      'required' => true,
    ),
    'teams' => 
    array (
      'type' => 'linkMultiple',
    ),
    'parent' => 
    array (
      'type' => 'link',
    ),
    'childList' => 
    array (
      'type' => 'jsonArray',
      'notStorable' => true,
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
    'teams' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Team',
      'relationName' => 'entityTeam',
      'layoutRelationshipsDisabled' => true,
    ),
    'parent' => 
    array (
      'type' => 'belongsTo',
      'foreign' => 'children',
      'entity' => 'KnowledgeBaseCategory',
    ),
    'children' => 
    array (
      'type' => 'hasMany',
      'foreign' => 'parent',
      'entity' => 'KnowledgeBaseCategory',
    ),
    'articles' => 
    array (
      'type' => 'hasMany',
      'foreign' => 'categories',
      'entity' => 'KnowledgeBaseArticle',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'parent',
    'asc' => true,
  ),
  'additionalTables' => 
  array (
    'KnowledgeBaseCategoryPath' => 
    array (
      'fields' => 
      array (
        'id' => 
        array (
          'type' => 'id',
          'dbType' => 'int',
          'len' => '11',
          'autoincrement' => true,
          'unique' => true,
        ),
        'ascendorId' => 
        array (
          'type' => 'varchar',
          'len' => '100',
          'index' => true,
        ),
        'descendorId' => 
        array (
          'type' => 'varchar',
          'len' => '24',
          'index' => true,
        ),
      ),
    ),
  ),
);
?>