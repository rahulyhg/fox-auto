<?php
return array (
  'fields' => 
  array (
    'type' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Tactics',
        1 => 'SetMeal',
        2 => 'OrdersLimit',
        3 => 'Orders',
      ),
      'default' => 'Orders',
      'required' => true,
    ),
    'status' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 1,
        1 => 2,
      ),
      'default' => 1,
    ),
    'name' => 
    array (
      'type' => 'varchar',
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
  'indexes' => 
  array (
    'name' => 
    array (
      'columns' => 
      array (
        0 => 'name',
        1 => 'deleted',
      ),
    ),
  ),
);
?>