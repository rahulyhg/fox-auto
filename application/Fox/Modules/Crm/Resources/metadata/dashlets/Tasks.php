<?php
return array (
  'view' => 'crm:views/dashlets/tasks',
  'aclScope' => 'Task',
  'entityType' => 'Task',
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
        ),
      ),
    ),
    'defaults' => 
    array (
      'sortBy' => 'dateEnd',
      'asc' => true,
      'displayRecords' => 5,
      'expandedLayout' => 
      array (
        'rows' => 
        array (
          0 => 
          array (
            0 => 
            array (
              'name' => 'name',
              'link' => true,
            ),
          ),
          1 => 
          array (
            0 => 
            array (
              'name' => 'status',
            ),
            1 => 
            array (
              'name' => 'dateEnd',
            ),
          ),
        ),
      ),
      'searchData' => 
      array (
        'bool' => 
        array (
          'onlyMy' => true,
        ),
        'primary' => 'actualNotDeferred',
      ),
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