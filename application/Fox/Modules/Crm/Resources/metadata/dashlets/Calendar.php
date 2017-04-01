<?php
return array (
  'view' => 'crm:views/dashlets/calendar',
  'aclScope' => 'Calendar',
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
      'enabledScopeList' => 
      array (
        'type' => 'multiEnum',
        'options' => 
        array (
          0 => 'Meeting',
          1 => 'Call',
          2 => 'Task',
        ),
        'translation' => 'Global.scopeNamesPlural',
        'required' => true,
      ),
      'mode' => 
      array (
        'type' => 'enum',
        'options' => 
        array (
          0 => 'basicWeek',
          1 => 'agendaWeek',
          2 => 'month',
        ),
      ),
    ),
    'defaults' => 
    array (
      'autorefreshInterval' => 0.5,
      'mode' => 'basicWeek',
      'enabledScopeList' => 
      array (
        0 => 'Meeting',
        1 => 'Call',
        2 => 'Task',
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
            1 => 
            array (
              'name' => 'autorefreshInterval',
            ),
          ),
          1 => 
          array (
            0 => 
            array (
              'name' => 'mode',
            ),
            1 => 
            array (
              'name' => 'enabledScopeList',
            ),
          ),
        ),
      ),
    ),
  ),
);
?>