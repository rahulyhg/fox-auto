<?php
return array (
  'links' => 
  array (
    'articles' => 
    array (
      'type' => 'hasMany',
      'entity' => 'KnowledgeBaseArticle',
      'foreign' => 'portals',
    ),
  ),
);
?>