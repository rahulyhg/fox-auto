<?php
return array (
  'mandatory' => 
  array (
    'scopeLevel' => 
    array (
      'User' => 
      array (
        'read' => 'own',
        'edit' => 'no',
        'delete' => 'no',
        'stream' => 'no',
        'create' => 'no',
      ),
      'Team' => false,
      'Note' => 
      array (
        'read' => 'own',
        'edit' => 'own',
        'delete' => 'own',
        'create' => 'yes',
      ),
      'Notification' => 
      array (
        'read' => 'own',
        'edit' => 'no',
        'delete' => 'own',
        'create' => 'no',
      ),
      'Portal' => false,
      'Attachment' => 
      array (
        'read' => 'own',
        'edit' => 'own',
        'delete' => 'own',
        'create' => 'yes',
      ),
      'EmailAccount' => false,
      'ExternalAccount' => false,
      'Role' => false,
      'PortalRole' => false,
      'EmailFilter' => false,
      'EmailTemplate' => false,
      'Preferences' => 
      array (
        'read' => 'own',
        'edit' => 'own',
        'delete' => 'no',
        'create' => 'no',
      ),
    ),
    'fieldLevel' => 
    array (
    ),
    'scopeFieldLevel' => 
    array (
      'Preferences' => 
      array (
        'smtpServer' => false,
        'smtpPort' => false,
        'smtpSecurity' => false,
        'smtpUsername' => false,
        'smtpPassword' => false,
        'smtpAuth' => false,
        'receiveAssignmentEmailNotifications' => false,
        'defaultReminders' => false,
      ),
      'Call' => 
      array (
        'reminders' => false,
      ),
      'Meeting' => 
      array (
        'reminders' => false,
      ),
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
      'assignedUser' => 
      array (
        'read' => 'yes',
        'edit' => 'no',
      ),
      'assignedUsers' => 
      array (
        'read' => 'yes',
        'edit' => 'no',
      ),
      'teams' => 
      array (
        'read' => 'yes',
        'edit' => 'no',
      ),
    ),
    'scopeFieldLevel' => 
    array (
      'Call' => 
      array (
        'users' => 
        array (
          'read' => 'yes',
          'edit' => 'no',
        ),
        'leads' => false,
      ),
      'Meeting' => 
      array (
        'users' => 
        array (
          'read' => 'yes',
          'edit' => 'no',
        ),
        'leads' => false,
      ),
    ),
  ),
  'scopeLevelTypesDefaults' => 
  array (
    'boolean' => false,
    'record' => false,
  ),
);
?>