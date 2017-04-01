<?php
return array (
  'relationshipPanels' => 
  array (
    'users' => 
    array (
      'create' => false,
      'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
      'layout' => 'listForTeam',
      'selectPrimaryFilterName' => 'active',
    ),
  ),
  'recordViews' => 
  array (
    'detail' => 'views/team/record/detail',
    'edit' => 'views/team/record/edit',
    'list' => 'views/team/record/list',
  ),
  'boolFilterList' => 
  array (
    0 => 'onlyMy',
  ),
);
?>