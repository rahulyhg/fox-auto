<?php
return array (
  'controller' => 'controllers/record',
  'menu' => 
  array (
    'list' => 
    array (
      'buttons' => 
      array (
        0 => 
        array (
          'label' => 'Target Lists',
          'link' => '#TargetList',
          'acl' => 'read',
          'style' => 'default',
          'aclScope' => 'TargetList',
        ),
      ),
      'dropdown' => 
      array (
        0 => 
        array (
          'label' => 'Mass Emails',
          'link' => '#MassEmail',
          'acl' => 'read',
          'aclScope' => 'MassEmail',
        ),
        1 => 
        array (
          'label' => 'Email Templates',
          'link' => '#EmailTemplate',
          'acl' => 'read',
          'aclScope' => 'EmailTemplate',
        ),
      ),
    ),
  ),
  'recordViews' => 
  array (
    'detail' => 'crm:views/campaign/record/detail',
  ),
  'views' => 
  array (
    'detail' => 'crm:views/campaign/detail',
  ),
  'sidePanels' => 
  array (
    'detail' => 
    array (
      0 => 
      array (
        'name' => 'statistics',
        'label' => 'Statistics',
        'view' => 'crm:views/campaign/record/panels/statistics',
        'hidden' => false,
      ),
    ),
  ),
  'relationshipPanels' => 
  array (
    'campaignLogRecords' => 
    array (
      'view' => 'crm:views/campaign/record/panels/campaign-log-records',
      'layout' => 'listForCampaign',
      'rowActionsView' => 'views/record/row-actions/remove-only',
      'select' => false,
      'create' => false,
    ),
  ),
  'filterList' => 
  array (
    0 => 'active',
  ),
  'formDependency' => 
  array (
    'type' => 
    array (
      'map' => 
      array (
        'Email' => 
        array (
          0 => 
          array (
            'action' => 'show',
            'fields' => 
            array (
              0 => 'targetLists',
              1 => 'excludingTargetLists',
            ),
          ),
        ),
        'Newsletter' => 
        array (
          0 => 
          array (
            'action' => 'show',
            'fields' => 
            array (
              0 => 'targetLists',
              1 => 'excludingTargetLists',
            ),
          ),
        ),
        'Mail' => 
        array (
          0 => 
          array (
            'action' => 'show',
            'fields' => 
            array (
              0 => 'targetLists',
              1 => 'excludingTargetLists',
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
            0 => 'targetLists',
            1 => 'excludingTargetLists',
          ),
        ),
      ),
    ),
  ),
  'boolFilterList' => 
  array (
    0 => 'onlyMy',
  ),
);
?>