<?php
return array (
  'controller' => 'controllers/record',
  'views' => 
  array (
    'detail' => 'crm:views/call/detail',
  ),
  'recordViews' => 
  array (
    'list' => 'crm:views/call/record/list',
    'detail' => 'crm:views/call/record/detail',
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