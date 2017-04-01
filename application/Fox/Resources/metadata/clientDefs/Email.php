<?php
return array (
  'controller' => 'controllers/record',
  'acl' => 'acl/email',
  'model' => 'models/email',
  'views' => 
  array (
    'list' => 'views/email/list',
    'detail' => 'views/email/detail',
  ),
  'recordViews' => 
  array (
    'list' => 'views/email/record/list',
    'detail' => 'views/email/record/detail',
    'edit' => 'views/email/record/edit',
    'editQuick' => 'views/email/record/edit-quick',
    'detailQuick' => 'views/email/record/detail-quick',
  ),
  'modalViews' => 
  array (
    'detail' => 'views/email/modals/detail',
    'compose' => 'views/modals/compose-email',
  ),
  'menu' => 
  array (
    'list' => 
    array (
      'buttons' => 
      array (
        0 => 
        array (
          'label' => 'Compose',
          'action' => 'composeEmail',
          'style' => 'danger',
          'acl' => 'create',
        ),
      ),
      'dropdown' => 
      array (
        0 => 
        array (
          'label' => 'Archive Email',
          'link' => '#Email/create',
          'acl' => 'create',
        ),
        1 => 
        array (
          'label' => 'Email Templates',
          'link' => '#EmailTemplate',
          'acl' => 'read',
          'aclScope' => 'EmailTemplate',
        ),
        2 => 
        array (
          'label' => 'Email Accounts',
          'link' => '#EmailAccount',
          'aclScope' => 'EmailAccountScope',
        ),
      ),
    ),
    'detail' => 
    array (
      'dropdown' => 
      array (
        0 => 
        array (
          'label' => 'Reply',
          'action' => 'reply',
          'acl' => 'read',
        ),
        1 => 
        array (
          'label' => 'Reply to All',
          'action' => 'replyToAll',
          'acl' => 'read',
        ),
        2 => 
        array (
          'label' => 'Forward',
          'action' => 'forward',
          'acl' => 'read',
        ),
      ),
    ),
  ),
  'filterList' => 
  array (
    0 => 'inbox',
    1 => 'sent',
    2 => 'drafts',
    3 => 'trash',
  ),
  'defaultFilterData' => 
  array (
    'presetName' => 'inbox',
    'primary' => 'inbox',
  ),
  'boolFilterList' => 
  array (
  ),
);
?>