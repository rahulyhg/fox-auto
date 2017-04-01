<?php
return array (
  'controller' => 'controllers/record',
  'boolFilterList' => 
  array (
    0 => 'onlyMy',
  ),
  'sidePanels' => 
  array (
    'detail' => 
    array (
      0 => 
      array (
        'name' => 'optedOut',
        'label' => 'Opted Out',
        'view' => 'crm:views/target-list/record/panels/opted-out',
      ),
    ),
  ),
  'relationshipPanels' => 
  array (
    'contacts' => 
    array (
      'actionList' => 
      array (
        0 => 
        array (
          'label' => 'Unlink All',
          'action' => 'unlinkAllRelated',
          'acl' => 'edit',
          'data' => 
          array (
            'link' => 'contacts',
          ),
        ),
      ),
      'rowActionsView' => 'crm:views/target-list/record/row-actions/default',
      'view' => 'crm:views/target-list/record/panels/relationship',
    ),
    'leads' => 
    array (
      'actionList' => 
      array (
        0 => 
        array (
          'label' => 'Unlink All',
          'action' => 'unlinkAllRelated',
          'acl' => 'edit',
          'data' => 
          array (
            'link' => 'leads',
          ),
        ),
      ),
      'rowActionsView' => 'crm:views/target-list/record/row-actions/default',
      'view' => 'crm:views/target-list/record/panels/relationship',
    ),
    'accounts' => 
    array (
      'actionList' => 
      array (
        0 => 
        array (
          'label' => 'Unlink All',
          'action' => 'unlinkAllRelated',
          'acl' => 'edit',
          'data' => 
          array (
            'link' => 'accounts',
          ),
        ),
      ),
      'rowActionsView' => 'crm:views/target-list/record/row-actions/default',
      'view' => 'crm:views/target-list/record/panels/relationship',
    ),
    'users' => 
    array (
      'create' => false,
      'actionList' => 
      array (
        0 => 
        array (
          'label' => 'Unlink All',
          'action' => 'unlinkAllRelated',
          'acl' => 'edit',
          'data' => 
          array (
            'link' => 'users',
          ),
        ),
      ),
      'rowActionsView' => 'crm:views/target-list/record/row-actions/default',
      'view' => 'crm:views/target-list/record/panels/relationship',
    ),
  ),
);
?>