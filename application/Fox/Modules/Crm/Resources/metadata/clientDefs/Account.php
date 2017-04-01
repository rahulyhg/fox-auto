<?php
return array (
  'controller' => 'controllers/record',
  'aclPortal' => 'crm:acl-portal/account',
  'views' => 
  array (
    'detail' => 'crm:views/account/detail',
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
    'contacts' => 
    array (
      'layout' => 'listForAccount',
    ),
    'opportunities' => 
    array (
      'layout' => 'listForAccount',
    ),
    'campaignLogRecords' => 
    array (
      'rowActionsView' => 'views/record/row-actions/empty',
      'select' => false,
      'create' => false,
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
  ),
);
?>