<?php
return array (
  'controller' => 'controllers/record',
  'views' => 
  array (
    'list' => 'crm:views/document/list',
  ),
  'modalViews' => 
  array (
    'select' => 'crm:views/document/modals/select-records',
  ),
  'filterList' => 
  array (
    0 => 'active',
    1 => 'draft',
  ),
  'boolFilterList' => 
  array (
    0 => 'onlyMy',
  ),
  'selectDefaultFilters' => 
  array (
    'filter' => 'active',
  ),
);
?>