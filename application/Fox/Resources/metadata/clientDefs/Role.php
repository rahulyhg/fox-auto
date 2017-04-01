<?php
return array (
  'recordViews' => 
  array (
    'detail' => 'views/role/record/detail',
    'edit' => 'views/role/record/edit',
    'editQuick' => 'views/role/record/edit',
    'list' => 'views/role/record/list',
  ),
  'relationshipPanels' => 
  array (
    'users' => 
    array (
      'create' => false,
      'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
    ),
    'teams' => 
    array (
      'create' => false,
      'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
    ),
  ),
  'views' => 
  array (
    'list' => 'views/role/list',
  ),
);
?>