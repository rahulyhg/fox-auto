<?php
return array (
  'controller' => 'controllers/email-account',
  'recordViews' => 
  array (
    'list' => 'EmailAccount.Record.List',
    'detail' => 'EmailAccount.Record.Detail',
    'edit' => 'EmailAccount.Record.Edit',
  ),
  'views' => 
  array (
    'list' => 'EmailAccount.List',
  ),
  'searchPanelDisabled' => true,
  'formDependency' => 
  array (
    'storeSentEmails' => 
    array (
      'map' => 
      array (
        'true' => 
        array (
          0 => 
          array (
            'action' => 'show',
            'fields' => 
            array (
              0 => 'sentFolder',
            ),
          ),
          1 => 
          array (
            'action' => 'setRequired',
            'fields' => 
            array (
              0 => 'sentFolder',
            ),
          ),
        ),
      ),
      'default' => 
      array (
        0 => 
        array (
          'action' => 'hide',
          'fields' => 
          array (
            0 => 'sentFolder',
          ),
        ),
        1 => 
        array (
          'action' => 'setNotRequired',
          'fields' => 
          array (
            0 => 'sentFolder',
          ),
        ),
      ),
    ),
  ),
  'relationshipPanels' => 
  array (
    'filters' => 
    array (
      'select' => false,
      'rowActionsView' => 'views/record/row-actions/relationship-edit-and-remove',
    ),
  ),
);
?>