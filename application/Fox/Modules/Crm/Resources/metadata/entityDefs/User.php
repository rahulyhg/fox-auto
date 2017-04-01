<?php
return array (
  'links' => 
  array (
    'targetLists' => 
    array (
      'type' => 'hasMany',
      'entity' => 'TargetList',
      'foreign' => 'users',
    ),
  ),
);
?>