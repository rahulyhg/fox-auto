<?php
return array (
  'controller' => 'controllers/import',
  'recordViews' => 
  array (
    'list' => 'Import.Record.List',
    'detail' => 'Import.Record.Detail',
  ),
  'views' => 
  array (
    'list' => 'Import.List',
    'detail' => 'Import.Detail',
  ),
  'bottomPanels' => 
  array (
    'detail' => 
    array (
      0 => 
      array (
        'name' => 'imported',
        'label' => 'Imported',
        'view' => 'views/import/record/panels/imported',
      ),
      1 => 
      array (
        'name' => 'duplicates',
        'label' => 'Duplicates',
        'view' => 'views/import/record/panels/duplicates',
        'rowActionsView' => 'views/import/record/row-actions/duplicates',
      ),
      2 => 
      array (
        'name' => 'updated',
        'label' => 'Updated',
        'view' => 'views/import/record/panels/updated',
      ),
    ),
  ),
  'searchPanelDisabled' => true,
);
?>