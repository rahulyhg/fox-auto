<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'varchar',
      'required' => true,
    ),
    'lower' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'index' => true,
    ),
    'invalid' => 
    array (
      'type' => 'bool',
    ),
    'optOut' => 
    array (
      'type' => 'bool',
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