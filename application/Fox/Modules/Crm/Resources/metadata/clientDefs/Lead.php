<?php
return array (
  'controller' => 'crm:controllers/lead',
  'views' => 
  array (
    'detail' => 'Crm:Lead.Detail',
  ),
  'recordViews' => 
  array (
    'detail' => 'Crm:Lead.Record.Detail',
  ),
  'formDependency' => 
  array (
    'status' => 
    array (
      'map' => 
      array (
        'Converted' => 
        array (
          0 => 
          array (
            'action' => 'show',
            'panels' => 
            array (
              0 => 'convertedTo',
            ),
          ),
        ),
      ),
      'default' => 
      array (
        0 => 
        array (
          'action' => 'hide',
          'panels' => 
          array (
            0 => 'convertedTo',
          ),
        ),
      ),
    ),
  ),
  'sidePanels' => 
  array (
    'detail' => 
    array (
      0 => 
      array (
        'name' => 'convertedTo',
        'label' => 'Converted To',
        'view' => 'crm:views/lead/record/panels/converted-to',
        'notRefreshable' => true,
        'hidden' => true,
      ),
      1 => 
      array (
        'name' => 'activities',
        'label' => 'Activities',
        'view' => 'crm:views/record/panels/activities',
        'aclScope' => 'Activities',
      ),
      2 => 
      array (
        'name' => 'history',
        'label' => 'History',
        'view' => 'crm:views/record/panels/history',
        'aclScope' => 'Activities',
      ),
      3 => 
      array (
        'name' => 'tasks',
        'label' => 'Tasks',
        'view' => 'crm:views/record/panels/tasks',
        'aclScope' => 'Task',
      ),
    ),
    'edit' => 
    array (
      0 => 
      array (
        'name' => 'convertedTo',
        'label' => 'Converted To',
        'view' => 'crm:views/lead/record/panels/converted-to',
        'notRefreshable' => true,
        'hidden' => true,
      ),
    ),
    'detailSmall' => 
    array (
      0 => 
      array (
        'name' => 'convertedTo',
        'label' => 'Converted To',
        'view' => 'crm:views/lead/record/panels/converted-to',
        'notRefreshable' => true,
        'hidden' => true,
      ),
    ),
    'editSmall' => 
    array (
      0 => 
      array (
        'name' => 'convertedTo',
        'label' => 'Converted To',
        'view' => 'crm:views/lead/record/panels/converted-to',
        'notRefreshable' => true,
        'hidden' => true,
      ),
    ),
  ),
  'relationshipPanels' => 
  array (
    'campaignLogRecords' => 
    array (
      'rowActionsView' => 'Record.RowActions.Empty',
      'select' => false,
      'create' => false,
    ),
    'targetLists' => 
    array (
      'create' => false,
      'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
    ),
  ),
  'filterList' => 
  array (
    0 => 
    array (
      'name' => 'actual',
    ),
    1 => 
    array (
      'name' => 'converted',
      'style' => 'success',
    ),
  ),
  'boolFilterList' => 
  array (
    0 => 'onlyMy',
  ),
);
?>