<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
      'trim' => true,
    ),
    'logo' => 
    array (
      'type' => 'image',
    ),
    'url' => 
    array (
      'type' => 'url',
      'notStorable' => true,
      'readOnly' => true,
    ),
    'isActive' => 
    array (
      'type' => 'bool',
      'default' => true,
    ),
    'isDefault' => 
    array (
      'type' => 'bool',
      'default' => false,
      'notStorable' => true,
    ),
    'portalRoles' => 
    array (
      'type' => 'linkMultiple',
    ),
    'tabList' => 
    array (
      'type' => 'array',
      'translation' => 'Global.scopeNamesPlural',
      'view' => 'views/portal/fields/tab-list',
    ),
    'quickCreateList' => 
    array (
      'type' => 'array',
      'translation' => 'Global.scopeNames',
      'view' => 'views/portal/fields/quick-create-list',
    ),
    'companyLogo' => 
    array (
      'type' => 'image',
    ),
    'theme' => 
    array (
      'type' => 'enum',
      'view' => 'views/preferences/fields/theme',
      'translation' => 'Global.themes',
      'default' => '',
    ),
    'language' => 
    array (
      'type' => 'enum',
      'view' => 'views/preferences/fields/language',
      'default' => '',
    ),
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
    'dashboardLayout' => 
    array (
      'type' => 'jsonArray',
      'view' => 'views/settings/fields/dashboard-layout',
    ),
    'dashletsOptions' => 
    array (
      'type' => 'jsonObject',
      'disabled' => true,
    ),
    'modifiedAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'modifiedBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
      'view' => 'views/fields/user',
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'createdBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
      'view' => 'views/fields/user',
    ),
  ),
  'links' => 
  array (
    'createdBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'modifiedBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'users' => 
    array (
      'type' => 'hasMany',
      'entity' => 'User',
      'foreign' => 'portals',
    ),
    'portalRoles' => 
    array (
      'type' => 'hasMany',
      'entity' => 'PortalRole',
      'foreign' => 'portals',
    ),
    'notes' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Note',
      'foreign' => 'portals',
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'name',
    'asc' => true,
  ),
);
?>