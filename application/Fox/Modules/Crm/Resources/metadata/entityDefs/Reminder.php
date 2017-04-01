<?php
return array (
  'fields' => 
  array (
    'remindAt' => 
    array (
      'type' => 'datetime',
      'index' => true,
    ),
    'startAt' => 
    array (
      'type' => 'datetime',
      'index' => true,
    ),
    'type' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Popup',
        1 => 'Email',
      ),
      'maxLength' => 36,
      'index' => true,
      'default' => 'Popup',
    ),
    'seconds' => 
    array (
      'type' => 'enumInt',
      'options' => 
      array (
        0 => 0,
        1 => 60,
        2 => 120,
        3 => 300,
        4 => 600,
        5 => 900,
        6 => 1800,
        7 => 3600,
        8 => 7200,
        9 => 10800,
        10 => 18000,
        11 => 86400,
      ),
      'default' => 0,
    ),
    'entityType' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
    ),
    'entityId' => 
    array (
      'type' => 'varchar',
      'maxLength' => 50,
    ),
    'userId' => 
    array (
      'type' => 'varchar',
      'maxLength' => 50,
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'remindAt',
    'asc' => false,
  ),
);
?>