<?php
return array (
  'mandatory' => 
  array (
    'scopeLevel' => 
    array (
      'User' => 
      array (
        'read' => 'all',
        'edit' => 'no',
        'delete' => 'no',
        'stream' => 'no',
        'create' => 'no',
      ),
      'Team' => 
      array (
        'read' => 'all',
        'edit' => 'no',
        'delete' => 'no',
        'create' => 'no',
      ),
      'Note' => 
      array (
        'read' => 'own',
        'edit' => 'own',
        'delete' => 'own',
        'create' => 'yes',
      ),
      'Portal' => 
      array (
        'read' => 'all',
        'edit' => 'no',
        'delete' => 'no',
        'create' => 'no',
      ),
      'Attachment' => 
      array (
        'read' => 'own',
        'edit' => 'own',
        'delete' => 'own',
        'create' => 'yes',
      ),
      'EmailAccount' => 
      array (
        'read' => 'own',
        'edit' => 'own',
        'delete' => 'own',
        'create' => 'yes',
      ),
      'EmailFilter' => 
      array (
        'read' => 'own',
        'edit' => 'own',
        'delete' => 'own',
        'create' => 'yes',
      ),
      'Preferences' => 
      array (
        'read' => 'own',
        'edit' => 'own',
        'delete' => 'no',
        'create' => 'no',
      ),
      'Notification' => 
      array (
        'read' => 'own',
        'edit' => 'no',
        'delete' => 'own',
        'create' => 'no',
      ),
      'Role' => false,
      'PortalRole' => false,
    ),
    'fieldLevel' => 
    array (
    ),
    'scopeFieldLevel' => 
    array (
      'Attachment' => 
      array (
        'parent' => false,
      ),
    ),
  ),
  'default' => 
  array (
    'scopeLevel' => 
    array (
    ),
    'fieldLevel' => 
    array (
    ),
    'assignmentPermission' => 'all',
    'userPermission' => 'no',
    'portalPermission' => 'no',
  ),
  'scopeLevelTypesDefaults' => 
  array (
    'boolean' => true,
    'record' => 
    array (
      'read' => 'all',
      'stream' => 'all',
      'edit' => 'all',
      'delete' => 'no',
      'create' => 'yes',
    ),
  ),
);
?>