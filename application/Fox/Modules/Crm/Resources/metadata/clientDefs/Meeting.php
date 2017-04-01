<?php
return array (
  'controller' => 'controllers/record',
  'views' => 
  array (
    'detail' => 'crm:views/meeting/detail',
  ),
  'recordViews' => 
  array (
    'list' => 'crm:views/meeting/record/list',
    'detail' => 'crm:views/meeting/record/detail',
  ),
  'sidePanels' => 
  array (
    'detail' => 
    array (
      0 => 
      array (
        'name' => 'attendees',
        'label' => 'Attendees',
        'view' => 'crm:views/meeting/record/panels/attendees',
        'options' => 
        array (
          'fieldList' => 
          array (
            0 => 'users',
            1 => 'contacts',
            2 => 'leads',
          ),
        ),
        'sticked' => true,
      ),
    ),
    'detailSmall' => 
    array (
      0 => 
      array (
        'name' => 'attendees',
        'label' => 'Attendees',
        'view' => 'crm:views/meeting/record/panels/attendees',
        'sticked' => true,
      ),
    ),
    'edit' => 
    array (
      0 => 
      array (
        'name' => 'attendees',
        'label' => 'Attendees',
        'view' => 'crm:views/meeting/record/panels/attendees',
        'sticked' => true,
      ),
    ),
    'editSmall' => 
    array (
      0 => 
      array (
        'name' => 'attendees',
        'label' => 'Attendees',
        'view' => 'crm:views/meeting/record/panels/attendees',
        'sticked' => true,
      ),
    ),
  ),
  'filterList' => 
  array (
    0 => 
    array (
      'name' => 'planned',
    ),
    1 => 
    array (
      'name' => 'held',
      'style' => 'success',
    ),
    2 => 
    array (
      'name' => 'todays',
    ),
  ),
  'boolFilterList' => 
  array (
    0 => 'onlyMy',
  ),
);
?>