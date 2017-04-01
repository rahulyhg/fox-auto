<?php
return array (
  'controller' => 'controllers/record',
  'recordViews' => 
  array (
    'detail' => 'crm:views/case/record/detail',
  ),
  'bottomPanels' => 
  array (
    'detail' => 
    array (
    ),
  ),
  'sidePanels' => 
  array (
    'detail' => 
    array (
      0 => 
      array (
        'name' => 'activities',
        'label' => 'Activities',
        'view' => 'crm:views/record/panels/activities',
        'aclScope' => 'Activities',
      ),
      1 => 
      array (
        'name' => 'history',
        'label' => 'History',
        'view' => 'crm:views/record/panels/history',
        'aclScope' => 'Activities',
      ),
      2 => 
      array (
        'name' => 'tasks',
        'label' => 'Tasks',
        'view' => 'crm:views/record/panels/tasks',
        'aclScope' => 'Task',
      ),
    ),
  ),
  'filterList' => 
  array (
    0 => 
    array (
      'name' => 'open',
    ),
    1 => 
    array (
      'name' => 'closed',
      'style' => 'success',
    ),
  ),
  'relationshipPanels' => 
  array (
    'articles' => 
    array (
      'create' => false,
      'rowActionsView' => 'views/record/row-actions/relationship-view-and-unlink',
    ),
  ),
  'boolFilterList' => 
  array (
    0 => 'onlyMy',
  ),
  'selectDefaultFilters' => 
  array (
    'filter' => 'open',
  ),
);
?>