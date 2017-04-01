<?php
return array (
  'options' => 
  array (
    'fields' => 
    array (
      'title' => 
      array (
        'type' => 'varchar',
        'required' => true,
      ),
      'autorefreshInterval' => 
      array (
        'type' => 'enumFloat',
        'options' => 
        array (
          0 => 0,
          1 => 0.5,
          2 => 1,
          3 => 2,
          4 => 5,
          5 => 10,
        ),
      ),
      'displayRecords' => 
      array (
        'type' => 'enumInt',
        'options' => 
        array (
          0 => 3,
          1 => 4,
          2 => 5,
          3 => 10,
          4 => 15,
          5 => 20,
          6 => 30,
        ),
      ),
    ),
    'defaults' => 
    array (
      'displayRecords' => 10,
      'autorefreshInterval' => 0.5,
    ),
    'layout' => 
    array (
      0 => 
      array (
        'rows' => 
        array (
          0 => 
          array (
            0 => 
            array (
              'name' => 'title',
            ),
          ),
          1 => 
          array (
            0 => 
            array (
              'name' => 'displayRecords',
            ),
            1 => 
            array (
              'name' => 'autorefreshInterval',
            ),
          ),
        ),
      ),
    ),
  ),
);
?>