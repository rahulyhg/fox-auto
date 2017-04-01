<?php
return array (
  'fields' => 
  array (
    'timeZone' => 
    array (
      'type' => 'enum',
      'detault' => '',
      'view' => 'views/preferences/fields/time-zone',
    ),
    'dateFormat' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'MM/DD/YYYY',
        1 => 'YYYY-MM-DD',
        2 => 'DD.MM.YYYY',
        3 => 'DD/MM/YYYY',
      ),
      'default' => '',
      'view' => 'views/preferences/fields/date-format',
    ),
    'timeFormat' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'HH:mm',
        1 => 'hh:mma',
        2 => 'hh:mmA',
        3 => 'hh:mm A',
        4 => 'hh:mm a',
      ),
      'default' => '',
      'view' => 'views/preferences/fields/time-format',
    ),
    'weekStart' => 
    array (
      'type' => 'enumInt',
      'options' => 
      array (
        0 => 0,
        1 => 1,
      ),
      'default' => -1,
      'view' => 'views/preferences/fields/week-start',
    ),
    'defaultCurrency' => 
    array (
      'type' => 'enum',
      'default' => '',
      'view' => 'views/preferences/fields/default-currency',
    ),
    'thousandSeparator' => 
    array (
      'type' => 'varchar',
      'default' => ',',
      'maxLength' => 1,
      'view' => 'views/settings/fields/thousand-separator',
    ),
    'decimalMark' => 
    array (
      'type' => 'varchar',
      'default' => '.',
      'required' => true,
      'maxLength' => 1,
    ),
    'dashboardLayout' => 
    array (
      'type' => 'jsonArray',
    ),
    'dashletsOptions' => 
    array (
      'type' => 'jsonObject',
    ),
    'presetFilters' => 
    array (
      'type' => 'jsonObject',
    ),
    'smtpEmailAddress' => 
    array (
      'type' => 'varchar',
      'readOnly' => true,
      'notStorable' => true,
      'view' => 'views/preferences/fields/smtp-email-address',
    ),
    'smtpServer' => 
    array (
      'type' => 'varchar',
    ),
    'smtpPort' => 
    array (
      'type' => 'int',
      'min' => 0,
      'max' => 9999,
      'default' => 25,
    ),
    'smtpAuth' => 
    array (
      'type' => 'bool',
      'default' => false,
    ),
    'smtpSecurity' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => '',
        1 => 'SSL',
        2 => 'TLS',
      ),
    ),
    'smtpUsername' => 
    array (
      'type' => 'varchar',
      'required' => true,
    ),
    'smtpPassword' => 
    array (
      'type' => 'password',
    ),
    'language' => 
    array (
      'type' => 'enum',
      'default' => '',
      'view' => 'views/preferences/fields/language',
    ),
    'exportDelimiter' => 
    array (
      'type' => 'varchar',
      'default' => ',',
      'required' => true,
      'maxLength' => 1,
    ),
    'receiveAssignmentEmailNotifications' => 
    array (
      'type' => 'bool',
      'default' => true,
    ),
    'autoFollowEntityTypeList' => 
    array (
      'type' => 'multiEnum',
      'view' => 'views/preferences/fields/auto-follow-entity-type-list',
      'translation' => 'Global.scopeNamesPlural',
      'notStorable' => true,
      'tooltip' => true,
    ),
    'signature' => 
    array (
      'type' => 'text',
      'view' => 'Fields.Wysiwyg',
    ),
    'defaultReminders' => 
    array (
      'type' => 'jsonArray',
      'view' => 'crm:views/meeting/fields/reminders',
    ),
    'theme' => 
    array (
      'type' => 'enum',
      'view' => 'views/preferences/fields/theme',
      'translation' => 'Global.themes',
    ),
    'useCustomTabList' => 
    array (
      'type' => 'bool',
      'default' => false,
    ),
    'tabList' => 
    array (
      'type' => 'array',
      'translation' => 'Global.scopeNamesPlural',
      'view' => 'views/preferences/fields/tab-list',
    ),
    'emailReplyToAllByDefault' => 
    array (
      'type' => 'bool',
      'default' => true,
    ),
  ),
);
?>