<?php
return array (
  'params' => 
  array (
    0 => 
    array (
      'name' => 'provider',
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Google',
      ),
      'default' => 'Google',
    ),
    1 => 
    array (
      'name' => 'height',
      'type' => 'int',
      'default' => 300,
    ),
  ),
  'filter' => false,
  'notCreatable' => true,
  'fieldDefs' => 
  array (
    'notStorable' => true,
  ),
);
?>