<?php
return array (
  'controller' => 'controllers/record-tree',
  'collection' => 'collections/tree',
  'menu' => 
  array (
    'listTree' => 
    array (
      'buttons' => 
      array (
        0 => 
        array (
          'label' => 'List View',
          'link' => '#KnowledgeBaseCategory/list',
          'acl' => 'read',
          'style' => 'default',
        ),
      ),
    ),
    'list' => 
    array (
      'buttons' => 
      array (
        0 => 
        array (
          'label' => 'Tree View',
          'link' => '#KnowledgeBaseCategory',
          'acl' => 'read',
          'style' => 'default',
        ),
      ),
    ),
  ),
);
?>