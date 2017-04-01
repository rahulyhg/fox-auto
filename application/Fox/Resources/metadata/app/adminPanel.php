<?php
return array (
  'system' => 
  array (
    'label' => 'System',
    'items' => 
    array (
      0 => 
      array (
        'url' => '#Admin/settings',
        'label' => 'Settings',
        'description' => 'settings',
      ),
      1 => 
      array (
        'url' => '#Admin/userInterface',
        'label' => 'User Interface',
        'description' => 'userInterface',
      ),
      2 => 
      array (
        'url' => '#Admin/clearCache',
        'label' => 'Clear Cache',
        'description' => 'clearCache',
      ),
    ),
  ),
  'users' => 
  array (
    'label' => 'Users',
    'items' => 
    array (
      0 => 
      array (
        'url' => '#User',
        'label' => 'Users',
        'description' => 'users',
      ),
      1 => 
      array (
        'url' => '#Team',
        'label' => 'Teams',
        'description' => 'teams',
      ),
      2 => 
      array (
        'url' => '#Role',
        'label' => 'Roles',
        'description' => 'roles',
      ),
      3 => 
      array (
        'url' => '#Admin/authTokens',
        'label' => 'Auth Tokens',
        'description' => 'authTokens',
      ),
    ),
  ),
  'customization' => 
  array (
    'label' => 'Customization',
    'items' => 
    array (
      0 => 
      array (
        'url' => '#Admin/layouts',
        'label' => 'Layout Manager',
        'description' => 'layoutManager',
      ),
      1 => 
      array (
        'url' => '#Admin/entityManager',
        'label' => 'Entity Manager',
        'description' => 'entityManager',
      ),
    ),
  ),
  'email' => 
  array (
    'label' => 'Email',
    'items' => 
    array (
      0 => 
      array (
        'url' => '#Admin/outboundEmails',
        'label' => 'Outbound Emails',
        'description' => 'outboundEmails',
      ),
      1 => 
      array (
        'url' => '#Admin/inboundEmails',
        'label' => 'Inbound Emails',
        'description' => 'inboundEmails',
      ),
    ),
  ),
  'data' => 
  array (
    'label' => 'Data',
    'items' => 
    array (
      0 => 
      array (
        'url' => '#Import',
        'label' => 'Import',
        'description' => 'import',
      ),
    ),
  ),
);
?>