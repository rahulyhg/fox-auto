<?php
return array (
  'controller' => 'controllers/record',
  'recordViews' => 
  array (
    'list' => 'crm:views/task/record/list',
    'detail' => 'crm:views/task/record/detail',
  ),
  'views' => 
  array (
    'list' => 'crm:views/task/list',
    'detail' => 'crm:views/task/detail',
  ),
  'formDependency' => 
  array (
    'status' => 
    array (
      'map' => 
      array (
        'Completed' => 
        array (
          0 => 
          array (
            'action' => 'show',
            'fields' => 
            array (
              0 => 'dateCompleted',
            ),
          ),
        ),
      ),
      'default' => 
      array (
        0 => 
        array (
          'action' => 'hide',
          'fields' => 
          array (
            0 => 'dateCompleted',
          ),
        ),
      ),
    ),
  ),
  'filterList' => 
  array (
    0 => 'actual',
    1 => 
    array (
      'name' => 'completed',
      'style' => 'success',
    ),
    2 => 
    array (
      'name' => 'todays',
    ),
    3 => 
    array (
      'name' => 'overdue',
      'style' => 'danger',
    ),
  ),
  'boolFilterList' => 
  array (
    0 => 'onlyMy',
  ),
);
?>