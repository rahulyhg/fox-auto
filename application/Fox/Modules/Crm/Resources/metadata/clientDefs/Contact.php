<?php
return array (
  'controller' => 'controllers/record',
  'aclPortal' => 'crm:acl-portal/contact',
  'views' => 
  array (
    'detail' => 'crm:views/contact/detail',
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
  'relationshipPanels' => 
  array (
    'campaignLogRecords' => 
    array (
      'rowActionsView' => 'views/record/row-actions/empty',
      'select' => false,
      'create' => false,
    ),
    'opportunities' => 
    array (
      'layout' => 'listForAccount',
    ),
    'targetLists' => 
    array (
      'create' => false,
      'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
    ),
  ),
  'boolFilterList' => 
  array (
    0 => 'onlyMy',
  ),
  'additionalLayouts' => 
  array (
    'detailConvert' => 
    array (
      'type' => 'detail',
    ),
    'listForAccount' => 
    array (
      'type' => 'listSmall',
    ),
  ),
  'filterList' => 
  array (
    0 => 'portalUsers',
  ),
);
?>