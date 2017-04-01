<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'maxLength' => 36,
      'index' => true,
    ),
    'type' => 
    array (
      'type' => 'enum',
    ),
  ),
  'links' => 
  array (
  ),
  'collection' => 
  array (
    'sortBy' => 'name',
    'asc' => true,
  ),
);
?>