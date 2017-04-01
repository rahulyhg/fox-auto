<?php
return array (
  'recordViews' => 
  array (
    'detail' => 'views/inbound-email/record/detail',
    'edit' => 'views/inbound-email/record/edit',
    'list' => 'views/inbound-email/record/list',
  ),
  'formDependency' => 
  array (
    'createCase' => 
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
              0 => 'caseDistribution',
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
            0 => 'caseDistribution',
          ),
        ),
      ),
    ),
    'caseDistribution' => 
    array (
      'map' => 
      array (
        'Round-Robin' => 
        array (
          0 => 
          array (
            'action' => 'show',
            'fields' => 
            array (
              0 => 'targetUserPosition',
            ),
          ),
        ),
        'Least-Busy' => 
        array (
          0 => 
          array (
            'action' => 'show',
            'fields' => 
            array (
              0 => 'targetUserPosition',
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
            0 => 'targetUserPosition',
          ),
        ),
      ),
    ),
    'reply' => 
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
              0 => 'replyEmailTemplate',
              1 => 'replyFromAddress',
              2 => 'replyFromName',
            ),
          ),
          1 => 
          array (
            'action' => 'setRequired',
            'fields' => 
            array (
              0 => 'replyEmailTemplate',
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
            0 => 'replyEmailTemplate',
            1 => 'replyFromAddress',
            2 => 'replyFromName',
          ),
        ),
        1 => 
        array (
          'action' => 'setNotRequired',
          'fields' => 
          array (
            0 => 'replyEmailTemplate',
          ),
        ),
      ),
    ),
  ),
  'searchPanelDisabled' => true,
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