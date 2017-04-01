<?php
return array (
  'controller' => 'controllers/record',
  'relationshipPanels' => 
  array (
    'users' => 
    array (
      'create' => false,
      'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
      'layout' => 'listSmall',
      'selectPrimaryFilterName' => 'activePortal',
    ),
  ),
  'searchPanelDisabled' => true,
);
?>