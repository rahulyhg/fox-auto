<?php
return array (
  'controller' => 'controllers/record',
  'views' => 
  array (
    'list' => 'crm:views/knowledge-base-article/list',
  ),
  'recordViews' => 
  array (
    'editQuick' => 'crm:views/knowledge-base-article/record/edit-quick',
    'detailQuick' => 'crm:views/knowledge-base-article/record/detail-quick',
  ),
  'modalViews' => 
  array (
    'select' => 'crm:views/knowledge-base-article/modals/select-records',
  ),
  'filterList' => 
  array (
    0 => 'published',
  ),
  'boolFilterList' => 
  array (
    0 => 'onlyMy',
  ),
  'relationshipPanels' => 
  array (
    'cases' => 
    array (
      'create' => false,
      'rowActionsView' => 'views/record/row-actions/relationship-view-and-unlink',
    ),
  ),
);
?>