<?php
return array (
  'controller' => 'controllers/record',
  'views' => 
  array (
    'detail' => 'Crm:Opportunity.Detail',
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
      'name' => 'won',
      'style' => 'success',
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
);
?>