<?php
return array (
  'app' => 
  array (
    'acl' => 
    array (
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
          'MassEmail' => 'Campaign',
          'CampaignLogRecord' => 'Campaign',
          'CampaignTrackingUrl' => 'Campaign',
          'EmailQueueItem' => false,
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
    ),
    'aclPortal' => 
    array (
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
          'MassEmail' => 'Campaign',
          'CampaignLogRecord' => 'Campaign',
          'CampaignTrackingUrl' => 'Campaign',
          'EmailQueueItem' => false,
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
          'KnowledgeBaseArticle' => 
          array (
            'portals' => false,
          ),
        ),
      ),
      'scopeLevelTypesDefaults' => 
      array (
        'boolean' => false,
        'record' => false,
      ),
    ),
    'adminPanel' => 
    array (
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
    ),
    'defaultDashboardLayouts' => 
    array (
      'Standard' => 
      array (
        0 => 
        array (
          'name' => 'My Fox',
          'layout' => 
          array (
            0 => 
            array (
              'id' => 'defaultActivities',
              'name' => 'Activities',
              'x' => 2,
              'y' => 2,
              'width' => 2,
              'height' => 2,
            ),
            1 => 
            array (
              'id' => 'defaultStream',
              'name' => 'Stream',
              'x' => 0,
              'y' => 0,
              'width' => 2,
              'height' => 4,
            ),
            2 => 
            array (
              'id' => 'defaultTasks',
              'name' => 'Tasks',
              'x' => 2,
              'y' => 4,
              'width' => 2,
              'height' => 2,
            ),
          ),
        ),
      ),
    ),
    'defaultDashboardOptions' => 
    array (
      'Standard' => 
      array (
        'defaultStream' => 
        array (
          'displayRecords' => 10,
        ),
      ),
    ),
    'entityTemplateList' => 
    array (
      0 => 'Base',
      1 => 'Person',
    ),
    'jsLibs' => 
    array (
      'Flotr' => 
      array (
        'path' => 'client/lib/flotr2.js',
        'exportsTo' => 'window',
        'exportsAs' => 'Flotr',
      ),
      'wx' => 
      array (
        'path' => 'client/lib/wx/wx.min.js',
        'exportsTo' => 'window',
        'exportsAs' => 'wx',
      ),
      'Summernote' => 
      array (
        'path' => 'client/lib/summernote.min.js',
        'exportsTo' => '$',
        'exportsAs' => 'summernote',
      ),
      'Textcomplete' => 
      array (
        'path' => 'client/lib/jquery.textcomplete.js',
        'exportsTo' => '$',
        'exportsAs' => 'textcomplete',
      ),
      'Select2' => 
      array (
        'path' => 'client/lib/select2.min.js',
        'exportsTo' => '$',
        'exportsAs' => 'select2',
      ),
      'Selectize' => 
      array (
        'path' => 'client/lib/selectize.min.js',
        'exportsTo' => '$',
        'exportsAs' => 'selectize',
      ),
      'Cropper' => 
      array (
        'path' => 'client/lib/cropper.min.js',
        'exportsTo' => '$',
        'exportsAs' => 'cropper',
      ),
      'gridstack' => 
      array (
        'path' => 'client/lib/gridstack.min.js',
        'exportsTo' => '$',
        'exportsAs' => 'gridstack',
      ),
      'full-calendar' => 
      array (
        'path' => 'client/modules/crm/lib/fullcalendar.min.js',
        'exportsTo' => '$',
        'exportsAs' => 'fullCalendar',
      ),
    ),
    'popupNotifications' => 
    array (
      'event' => 
      array (
        'url' => 'Activities/action/popupNotifications',
        'interval' => 15,
        'view' => 'Crm:Meeting.PopupNotification',
      ),
    ),
  ),
  'clientDefs' => 
  array (
    'Area' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
      ),
      'recordViews' => 
      array (
        'list' => 'views/set-meal/record/list',
      ),
      'sidePanels' => 
      array (
      ),
      'relationshipPanels' => 
      array (
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'additionalLayouts' => 
      array (
        'detailConvert' => 
        array (
          'type' => 'detail',
        ),
      ),
    ),
    'AuthToken' => 
    array (
      'recordViews' => 
      array (
        'list' => 'Admin.AuthToken.Record.List',
      ),
    ),
    'Dashboard' => 
    array (
      'controller' => 'Controllers.Dashboard',
    ),
    'Email' => 
    array (
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
    ),
    'EmailAccount' => 
    array (
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
    ),
    'EmailFilter' => 
    array (
      'controller' => 'controllers/record',
      'modalViews' => 
      array (
        'edit' => 'views/email-filter/modals/edit',
      ),
      'searchPanelDisabled' => true,
    ),
    'EmailTemplate' => 
    array (
      'controller' => 'controllers/record',
      'recordViews' => 
      array (
        'edit' => 'views/email-template/record/edit',
        'detail' => 'views/email-template/record/detail',
        'editQuick' => 'views/email-template/record/edit-quick',
      ),
      'sidePanels' => 
      array (
        'detail' => 
        array (
          0 => 
          array (
            'name' => 'information',
            'label' => 'Info',
            'view' => 'views/email-template/record/panels/information',
          ),
        ),
        'edit' => 
        array (
          0 => 
          array (
            'name' => 'information',
            'label' => 'Info',
            'view' => 'views/email-template/record/panels/information',
          ),
        ),
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'filterList' => 
      array (
        0 => 'actual',
      ),
    ),
    'Encashment' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
      ),
      'recordViews' => 
      array (
        'list' => 'views/set-meal/record/list',
        'detail' => 'views/set-meal/record/detail',
      ),
      'sidePanels' => 
      array (
      ),
      'relationshipPanels' => 
      array (
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'additionalLayouts' => 
      array (
        'detailConvert' => 
        array (
          'type' => 'detail',
        ),
      ),
    ),
    'ExternalAccount' => 
    array (
      'controller' => 'controllers/external-account',
    ),
    'Import' => 
    array (
      'controller' => 'controllers/import',
      'recordViews' => 
      array (
        'list' => 'Import.Record.List',
        'detail' => 'Import.Record.Detail',
      ),
      'views' => 
      array (
        'list' => 'Import.List',
        'detail' => 'Import.Detail',
      ),
      'bottomPanels' => 
      array (
        'detail' => 
        array (
          0 => 
          array (
            'name' => 'imported',
            'label' => 'Imported',
            'view' => 'views/import/record/panels/imported',
          ),
          1 => 
          array (
            'name' => 'duplicates',
            'label' => 'Duplicates',
            'view' => 'views/import/record/panels/duplicates',
            'rowActionsView' => 'views/import/record/row-actions/duplicates',
          ),
          2 => 
          array (
            'name' => 'updated',
            'label' => 'Updated',
            'view' => 'views/import/record/panels/updated',
          ),
        ),
      ),
      'searchPanelDisabled' => true,
    ),
    'InboundEmail' => 
    array (
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
    ),
    'Job' => 
    array (
      'modalViews' => 
      array (
        'detail' => 'Admin.Job.Modals.Detail',
      ),
      'recordViews' => 
      array (
        'list' => 'Admin.Job.Record.List',
        'detailQuick' => 'Admin.Job.Record.DetailSmall',
      ),
    ),
    'Note' => 
    array (
      'collection' => 'collections/note',
      'recordViews' => 
      array (
        'edit' => 'views/note/record/edit',
        'editQuick' => 'views/note/record/edit',
      ),
      'modalViews' => 
      array (
        'edit' => 'views/note/modals/edit',
      ),
      'itemViews' => 
      array (
        'Post' => 'views/stream/notes/post',
      ),
    ),
    'Notification' => 
    array (
      'controller' => 'controllers/notification',
      'collection' => 'collections/note',
      'itemViews' => 
      array (
        'System' => 'views/notification/items/system',
      ),
    ),
    'Orders' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
        'detail' => 'Orders.Detail',
      ),
      'recordViews' => 
      array (
        'detail' => 'Orders.Record.Detail',
      ),
      'sidePanels' => 
      array (
      ),
      'relationshipPanels' => 
      array (
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'additionalLayouts' => 
      array (
        'detailConvert' => 
        array (
          'type' => 'detail',
        ),
      ),
    ),
    'OrdersLimit' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
      ),
      'recordViews' => 
      array (
        'list' => 'views/set-meal/record/list',
        'detail' => 'views/set-meal/record/detail',
      ),
      'sidePanels' => 
      array (
      ),
      'relationshipPanels' => 
      array (
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'additionalLayouts' => 
      array (
        'detailConvert' => 
        array (
          'type' => 'detail',
        ),
      ),
    ),
    'PasswordChangeRequest' => 
    array (
      'controller' => 'controllers/password-change-request',
    ),
    'Portal' => 
    array (
      'controller' => 'controllers/record',
      'relationshipPanels' => 
      array (
        'users' => 
        array (
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
          'layout' => 'listSmall',
          'selectPrimaryFilterName' => 'activePortal',
        ),
      ),
      'searchPanelDisabled' => true,
    ),
    'PortalRole' => 
    array (
      'recordViews' => 
      array (
        'detail' => 'views/portal-role/record/detail',
        'edit' => 'views/portal-role/record/edit',
        'editQuick' => 'views/portal-role/record/edit',
        'list' => 'views/portal-role/record/list',
      ),
      'relationshipPanels' => 
      array (
        'users' => 
        array (
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
        ),
      ),
      'views' => 
      array (
        'list' => 'views/portal-role/list',
      ),
    ),
    'Preferences' => 
    array (
      'recordViews' => 
      array (
        'edit' => 'views/preferences/record/edit',
      ),
      'views' => 
      array (
        'edit' => 'views/preferences/edit',
      ),
      'acl' => 'acl/preferences',
      'aclPortal' => 'acl-portal/preferences',
    ),
    'Reason' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
      ),
      'sidePanels' => 
      array (
      ),
      'relationshipPanels' => 
      array (
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'additionalLayouts' => 
      array (
        'detailConvert' => 
        array (
          'type' => 'detail',
        ),
      ),
    ),
    'Role' => 
    array (
      'recordViews' => 
      array (
        'detail' => 'views/role/record/detail',
        'edit' => 'views/role/record/edit',
        'editQuick' => 'views/role/record/edit',
        'list' => 'views/role/record/list',
      ),
      'relationshipPanels' => 
      array (
        'users' => 
        array (
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
        ),
        'teams' => 
        array (
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
        ),
      ),
      'views' => 
      array (
        'list' => 'views/role/list',
      ),
    ),
    'ScheduledJob' => 
    array (
      'controller' => 'controllers/record',
      'relationshipPanels' => 
      array (
        'log' => 
        array (
          'readOnly' => true,
        ),
      ),
      'recordViews' => 
      array (
        'list' => 'ScheduledJob.Record.List',
      ),
      'views' => 
      array (
        'list' => 'ScheduledJob.List',
      ),
    ),
    'ScheduledJobLogRecord' => 
    array (
      'controller' => 'controllers/record',
    ),
    'SetMeal' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
      ),
      'recordViews' => 
      array (
        'list' => 'views/set-meal/record/list',
        'detail' => 'views/set-meal/record/detail',
      ),
      'sidePanels' => 
      array (
      ),
      'relationshipPanels' => 
      array (
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'additionalLayouts' => 
      array (
        'detailConvert' => 
        array (
          'type' => 'detail',
        ),
      ),
    ),
    'Stream' => 
    array (
      'controller' => 'controllers/stream',
    ),
    'Tactics' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
      ),
      'recordViews' => 
      array (
        'list' => 'views/set-meal/record/list',
        'detail' => 'views/set-meal/record/detail',
      ),
      'sidePanels' => 
      array (
      ),
      'relationshipPanels' => 
      array (
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'additionalLayouts' => 
      array (
        'detailConvert' => 
        array (
          'type' => 'detail',
        ),
      ),
    ),
    'Team' => 
    array (
      'relationshipPanels' => 
      array (
        'users' => 
        array (
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
          'layout' => 'listForTeam',
          'selectPrimaryFilterName' => 'active',
        ),
      ),
      'recordViews' => 
      array (
        'detail' => 'views/team/record/detail',
        'edit' => 'views/team/record/edit',
        'list' => 'views/team/record/list',
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
    ),
    'Template' => 
    array (
      'controller' => 'controllers/record',
      'recordViews' => 
      array (
        'detail' => 'Template.Record.Detail',
      ),
      'formDependency' => 
      array (
        'printFooter' => 
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
                  0 => 'footer',
                  1 => 'footerPosition',
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
                0 => 'footer',
                1 => 'footerPosition',
              ),
            ),
          ),
        ),
      ),
    ),
    'User' => 
    array (
      'views' => 
      array (
        'detail' => 'views/user/detail',
        'list' => 'views/user/list',
      ),
      'recordViews' => 
      array (
        'detail' => 'views/user/record/detail',
        'detailQuick' => 'views/user/record/detail-quick',
        'edit' => 'views/user/record/edit',
        'editQuick' => 'views/user/record/edit',
        'list' => 'views/user/record/list',
      ),
      'filterList' => 
      array (
        0 => 'active',
        1 => 'activePortal',
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMyTeam',
      ),
    ),
    'Account' => 
    array (
      'controller' => 'controllers/record',
      'aclPortal' => 'crm:acl-portal/account',
      'views' => 
      array (
        'detail' => 'crm:views/account/detail',
      ),
      'sidePanels' => 
      array (
        'detail' => 
        array (
          0 => 
          array (
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities',
          ),
          1 => 
          array (
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities',
          ),
          2 => 
          array (
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task',
          ),
        ),
      ),
      'relationshipPanels' => 
      array (
        'contacts' => 
        array (
          'layout' => 'listForAccount',
        ),
        'opportunities' => 
        array (
          'layout' => 'listForAccount',
        ),
        'campaignLogRecords' => 
        array (
          'rowActionsView' => 'views/record/row-actions/empty',
          'select' => false,
          'create' => false,
        ),
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'additionalLayouts' => 
      array (
        'detailConvert' => 
        array (
          'type' => 'detail',
        ),
      ),
    ),
    'Calendar' => 
    array (
      'colors' => 
      array (
        'Meeting' => '#558BBD',
        'Call' => '#CF605D',
        'Task' => '#76BA4E',
      ),
      'scopeList' => 
      array (
        0 => 'Meeting',
        1 => 'Call',
        2 => 'Task',
      ),
      'allDayScopeList' => 
      array (
        0 => 'Task',
      ),
      'modeList' => 
      array (
        0 => 'month',
        1 => 'agendaWeek',
        2 => 'agendaDay',
      ),
      'completedStatusList' => 
      array (
        0 => 'Held',
        1 => 'Completed',
      ),
    ),
    'Call' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
        'detail' => 'crm:views/call/detail',
      ),
      'recordViews' => 
      array (
        'list' => 'crm:views/call/record/list',
        'detail' => 'crm:views/call/record/detail',
      ),
      'sidePanels' => 
      array (
        'detail' => 
        array (
          0 => 
          array (
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
          ),
        ),
        'detailSmall' => 
        array (
          0 => 
          array (
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
          ),
        ),
        'edit' => 
        array (
          0 => 
          array (
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
          ),
        ),
        'editSmall' => 
        array (
          0 => 
          array (
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
          ),
        ),
      ),
      'filterList' => 
      array (
        0 => 
        array (
          'name' => 'planned',
        ),
        1 => 
        array (
          'name' => 'held',
          'style' => 'success',
        ),
        2 => 
        array (
          'name' => 'todays',
        ),
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
    ),
    'Campaign' => 
    array (
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
    ),
    'CampaignLogRecord' => 
    array (
      'acl' => 'crm:acl/campaign-tracking-url',
    ),
    'CampaignTrackingUrl' => 
    array (
      'controller' => 'controllers/record',
      'acl' => 'crm:acl/campaign-tracking-url',
    ),
    'Case' => 
    array (
      'controller' => 'controllers/record',
      'recordViews' => 
      array (
        'detail' => 'crm:views/case/record/detail',
      ),
      'bottomPanels' => 
      array (
        'detail' => 
        array (
        ),
      ),
      'sidePanels' => 
      array (
        'detail' => 
        array (
          0 => 
          array (
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities',
          ),
          1 => 
          array (
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities',
          ),
          2 => 
          array (
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task',
          ),
        ),
      ),
      'filterList' => 
      array (
        0 => 
        array (
          'name' => 'open',
        ),
        1 => 
        array (
          'name' => 'closed',
          'style' => 'success',
        ),
      ),
      'relationshipPanels' => 
      array (
        'articles' => 
        array (
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-view-and-unlink',
        ),
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'selectDefaultFilters' => 
      array (
        'filter' => 'open',
      ),
    ),
    'Contact' => 
    array (
      'controller' => 'controllers/record',
      'aclPortal' => 'crm:acl-portal/contact',
      'views' => 
      array (
        'detail' => 'crm:views/contact/detail',
      ),
      'sidePanels' => 
      array (
        'detail' => 
        array (
          0 => 
          array (
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities',
          ),
          1 => 
          array (
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities',
          ),
          2 => 
          array (
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task',
          ),
        ),
      ),
      'relationshipPanels' => 
      array (
        'campaignLogRecords' => 
        array (
          'rowActionsView' => 'views/record/row-actions/empty',
          'select' => false,
          'create' => false,
        ),
        'opportunities' => 
        array (
          'layout' => 'listForAccount',
        ),
        'targetLists' => 
        array (
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
        ),
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'additionalLayouts' => 
      array (
        'detailConvert' => 
        array (
          'type' => 'detail',
        ),
        'listForAccount' => 
        array (
          'type' => 'listSmall',
        ),
      ),
      'filterList' => 
      array (
        0 => 'portalUsers',
      ),
    ),
    'Document' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
        'list' => 'crm:views/document/list',
      ),
      'modalViews' => 
      array (
        'select' => 'crm:views/document/modals/select-records',
      ),
      'filterList' => 
      array (
        0 => 'active',
        1 => 'draft',
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'selectDefaultFilters' => 
      array (
        'filter' => 'active',
      ),
    ),
    'DocumentFolder' => 
    array (
      'controller' => 'controllers/record-tree',
      'collection' => 'collections/tree',
      'menu' => 
      array (
        'listTree' => 
        array (
          'buttons' => 
          array (
            0 => 
            array (
              'label' => 'List View',
              'link' => '#DocumentFolder/list',
              'acl' => 'read',
              'style' => 'default',
            ),
          ),
        ),
        'list' => 
        array (
          'buttons' => 
          array (
            0 => 
            array (
              'label' => 'Tree View',
              'link' => '#DocumentFolder',
              'acl' => 'read',
              'style' => 'default',
            ),
          ),
        ),
      ),
    ),
    'EmailQueueItem' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
        'list' => 'crm:views/email-queue-item/list',
      ),
      'recordViews' => 
      array (
        'list' => 'crm:views/email-queue-item/record/list',
      ),
    ),
    'KnowledgeBaseArticle' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
        'list' => 'crm:views/knowledge-base-article/list',
      ),
      'recordViews' => 
      array (
        'editQuick' => 'crm:views/knowledge-base-article/record/edit-quick',
        'detailQuick' => 'crm:views/knowledge-base-article/record/detail-quick',
      ),
      'modalViews' => 
      array (
        'select' => 'crm:views/knowledge-base-article/modals/select-records',
      ),
      'filterList' => 
      array (
        0 => 'published',
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'relationshipPanels' => 
      array (
        'cases' => 
        array (
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-view-and-unlink',
        ),
      ),
    ),
    'KnowledgeBaseCategory' => 
    array (
      'controller' => 'controllers/record-tree',
      'collection' => 'collections/tree',
      'menu' => 
      array (
        'listTree' => 
        array (
          'buttons' => 
          array (
            0 => 
            array (
              'label' => 'List View',
              'link' => '#KnowledgeBaseCategory/list',
              'acl' => 'read',
              'style' => 'default',
            ),
          ),
        ),
        'list' => 
        array (
          'buttons' => 
          array (
            0 => 
            array (
              'label' => 'Tree View',
              'link' => '#KnowledgeBaseCategory',
              'acl' => 'read',
              'style' => 'default',
            ),
          ),
        ),
      ),
    ),
    'Lead' => 
    array (
      'controller' => 'crm:controllers/lead',
      'views' => 
      array (
        'detail' => 'Crm:Lead.Detail',
      ),
      'recordViews' => 
      array (
        'detail' => 'Crm:Lead.Record.Detail',
      ),
      'formDependency' => 
      array (
        'status' => 
        array (
          'map' => 
          array (
            'Converted' => 
            array (
              0 => 
              array (
                'action' => 'show',
                'panels' => 
                array (
                  0 => 'convertedTo',
                ),
              ),
            ),
          ),
          'default' => 
          array (
            0 => 
            array (
              'action' => 'hide',
              'panels' => 
              array (
                0 => 'convertedTo',
              ),
            ),
          ),
        ),
      ),
      'sidePanels' => 
      array (
        'detail' => 
        array (
          0 => 
          array (
            'name' => 'convertedTo',
            'label' => 'Converted To',
            'view' => 'crm:views/lead/record/panels/converted-to',
            'notRefreshable' => true,
            'hidden' => true,
          ),
          1 => 
          array (
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities',
          ),
          2 => 
          array (
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities',
          ),
          3 => 
          array (
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task',
          ),
        ),
        'edit' => 
        array (
          0 => 
          array (
            'name' => 'convertedTo',
            'label' => 'Converted To',
            'view' => 'crm:views/lead/record/panels/converted-to',
            'notRefreshable' => true,
            'hidden' => true,
          ),
        ),
        'detailSmall' => 
        array (
          0 => 
          array (
            'name' => 'convertedTo',
            'label' => 'Converted To',
            'view' => 'crm:views/lead/record/panels/converted-to',
            'notRefreshable' => true,
            'hidden' => true,
          ),
        ),
        'editSmall' => 
        array (
          0 => 
          array (
            'name' => 'convertedTo',
            'label' => 'Converted To',
            'view' => 'crm:views/lead/record/panels/converted-to',
            'notRefreshable' => true,
            'hidden' => true,
          ),
        ),
      ),
      'relationshipPanels' => 
      array (
        'campaignLogRecords' => 
        array (
          'rowActionsView' => 'Record.RowActions.Empty',
          'select' => false,
          'create' => false,
        ),
        'targetLists' => 
        array (
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
        ),
      ),
      'filterList' => 
      array (
        0 => 
        array (
          'name' => 'actual',
        ),
        1 => 
        array (
          'name' => 'converted',
          'style' => 'success',
        ),
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
    ),
    'MassEmail' => 
    array (
      'controller' => 'controllers/record',
      'acl' => 'crm:acl/mass-email',
      'recordViews' => 
      array (
        'detail' => 'crm:views/mass-email/record/detail',
      ),
      'views' => 
      array (
        'detail' => 'crm:views/mass-email/detail',
      ),
      'formDependency' => 
      array (
        'status' => 
        array (
          'map' => 
          array (
            'Complete' => 
            array (
              0 => 
              array (
                'action' => 'setReadOnly',
                'fields' => 
                array (
                  0 => 'status',
                ),
              ),
            ),
            'In Process' => 
            array (
              0 => 
              array (
                'action' => 'setReadOnly',
                'fields' => 
                array (
                  0 => 'status',
                ),
              ),
            ),
            'Failed' => 
            array (
              0 => 
              array (
                'action' => 'setReadOnly',
                'fields' => 
                array (
                  0 => 'status',
                ),
              ),
            ),
          ),
          'default' => 
          array (
            0 => 
            array (
              'action' => 'setNotReadOnly',
              'fields' => 
              array (
                0 => 'status',
              ),
            ),
          ),
        ),
      ),
    ),
    'Meeting' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
        'detail' => 'crm:views/meeting/detail',
      ),
      'recordViews' => 
      array (
        'list' => 'crm:views/meeting/record/list',
        'detail' => 'crm:views/meeting/record/detail',
      ),
      'sidePanels' => 
      array (
        'detail' => 
        array (
          0 => 
          array (
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'options' => 
            array (
              'fieldList' => 
              array (
                0 => 'users',
                1 => 'contacts',
                2 => 'leads',
              ),
            ),
            'sticked' => true,
          ),
        ),
        'detailSmall' => 
        array (
          0 => 
          array (
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
          ),
        ),
        'edit' => 
        array (
          0 => 
          array (
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
          ),
        ),
        'editSmall' => 
        array (
          0 => 
          array (
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
          ),
        ),
      ),
      'filterList' => 
      array (
        0 => 
        array (
          'name' => 'planned',
        ),
        1 => 
        array (
          'name' => 'held',
          'style' => 'success',
        ),
        2 => 
        array (
          'name' => 'todays',
        ),
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
    ),
    'Opportunity' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
        'detail' => 'Crm:Opportunity.Detail',
      ),
      'sidePanels' => 
      array (
        'detail' => 
        array (
          0 => 
          array (
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities',
          ),
          1 => 
          array (
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities',
          ),
          2 => 
          array (
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task',
          ),
        ),
      ),
      'filterList' => 
      array (
        0 => 
        array (
          'name' => 'open',
        ),
        1 => 
        array (
          'name' => 'won',
          'style' => 'success',
        ),
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
      'additionalLayouts' => 
      array (
        'detailConvert' => 
        array (
          'type' => 'detail',
        ),
        'listForAccount' => 
        array (
          'type' => 'listSmall',
        ),
      ),
    ),
    'Target' => 
    array (
      'controller' => 'controllers/record',
      'views' => 
      array (
        'detail' => 'Crm:Target.Detail',
      ),
      'menu' => 
      array (
        'detail' => 
        array (
          'buttons' => 
          array (
            0 => 
            array (
              'label' => 'Convert to Lead',
              'action' => 'convertToLead',
              'acl' => 'edit',
            ),
          ),
        ),
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
    ),
    'TargetList' => 
    array (
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
    ),
    'Task' => 
    array (
      'controller' => 'controllers/record',
      'recordViews' => 
      array (
        'list' => 'crm:views/task/record/list',
        'detail' => 'crm:views/task/record/detail',
      ),
      'views' => 
      array (
        'list' => 'crm:views/task/list',
        'detail' => 'crm:views/task/detail',
      ),
      'formDependency' => 
      array (
        'status' => 
        array (
          'map' => 
          array (
            'Completed' => 
            array (
              0 => 
              array (
                'action' => 'show',
                'fields' => 
                array (
                  0 => 'dateCompleted',
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
                0 => 'dateCompleted',
              ),
            ),
          ),
        ),
      ),
      'filterList' => 
      array (
        0 => 'actual',
        1 => 
        array (
          'name' => 'completed',
          'style' => 'success',
        ),
        2 => 
        array (
          'name' => 'todays',
        ),
        3 => 
        array (
          'name' => 'overdue',
          'style' => 'danger',
        ),
      ),
      'boolFilterList' => 
      array (
        0 => 'onlyMy',
      ),
    ),
  ),
  'dashlets' => 
  array (
    'Stream' => 
    array (
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'autorefreshInterval' => 
          array (
            'type' => 'enumFloat',
            'options' => 
            array (
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10,
            ),
          ),
          'displayRecords' => 
          array (
            'type' => 'enumInt',
            'options' => 
            array (
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 10,
              4 => 15,
              5 => 20,
              6 => 30,
            ),
          ),
        ),
        'defaults' => 
        array (
          'displayRecords' => 10,
          'autorefreshInterval' => 0.5,
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'displayRecords',
                ),
                1 => 
                array (
                  'name' => 'autorefreshInterval',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'Activities' => 
    array (
      'view' => 'crm:views/dashlets/activities',
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'autorefreshInterval' => 
          array (
            'type' => 'enumFloat',
            'options' => 
            array (
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10,
            ),
          ),
          'displayRecords' => 
          array (
            'type' => 'enumInt',
            'options' => 
            array (
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 10,
              4 => 15,
              5 => 20,
              6 => 30,
            ),
          ),
        ),
        'defaults' => 
        array (
          'displayRecords' => 5,
          'autorefreshInterval' => 0.5,
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'displayRecords',
                ),
                1 => 
                array (
                  'name' => 'autorefreshInterval',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'Calendar' => 
    array (
      'view' => 'crm:views/dashlets/calendar',
      'aclScope' => 'Calendar',
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'autorefreshInterval' => 
          array (
            'type' => 'enumFloat',
            'options' => 
            array (
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10,
            ),
          ),
          'enabledScopeList' => 
          array (
            'type' => 'multiEnum',
            'options' => 
            array (
              0 => 'Meeting',
              1 => 'Call',
              2 => 'Task',
            ),
            'translation' => 'Global.scopeNamesPlural',
            'required' => true,
          ),
          'mode' => 
          array (
            'type' => 'enum',
            'options' => 
            array (
              0 => 'basicWeek',
              1 => 'agendaWeek',
              2 => 'month',
            ),
          ),
        ),
        'defaults' => 
        array (
          'autorefreshInterval' => 0.5,
          'mode' => 'basicWeek',
          'enabledScopeList' => 
          array (
            0 => 'Meeting',
            1 => 'Call',
            2 => 'Task',
          ),
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
                1 => 
                array (
                  'name' => 'autorefreshInterval',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'mode',
                ),
                1 => 
                array (
                  'name' => 'enabledScopeList',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'Calls' => 
    array (
      'view' => 'crm:views/dashlets/calls',
      'aclScope' => 'Call',
      'entityType' => 'Call',
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'autorefreshInterval' => 
          array (
            'type' => 'enumFloat',
            'options' => 
            array (
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10,
            ),
          ),
          'displayRecords' => 
          array (
            'type' => 'enumInt',
            'options' => 
            array (
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 10,
              4 => 15,
            ),
          ),
        ),
        'defaults' => 
        array (
          'sortBy' => 'dateStart',
          'asc' => true,
          'displayRecords' => 5,
          'expandedLayout' => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'name',
                  'link' => true,
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'dateStart',
                ),
              ),
            ),
          ),
          'searchData' => 
          array (
            'bool' => 
            array (
              'onlyMy' => true,
            ),
            'primary' => 'planned',
            'advanced' => 
            array (
              1 => 
              array (
                'type' => 'or',
                'value' => 
                array (
                  1 => 
                  array (
                    'type' => 'today',
                    'field' => 'dateStart',
                    'dateTime' => true,
                  ),
                  2 => 
                  array (
                    'type' => 'future',
                    'field' => 'dateEnd',
                    'dateTime' => true,
                  ),
                ),
              ),
            ),
          ),
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'displayRecords',
                ),
                1 => 
                array (
                  'name' => 'autorefreshInterval',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'Cases' => 
    array (
      'view' => 'views/dashlets/abstract/record-list',
      'aclScope' => 'Case',
      'entityType' => 'Case',
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'autorefreshInterval' => 
          array (
            'type' => 'enumFloat',
            'options' => 
            array (
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10,
            ),
          ),
          'displayRecords' => 
          array (
            'type' => 'enumInt',
            'options' => 
            array (
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 10,
              4 => 15,
            ),
          ),
        ),
        'defaults' => 
        array (
          'sortBy' => 'createdAt',
          'asc' => false,
          'displayRecords' => 5,
          'expandedLayout' => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'number',
                ),
                1 => 
                array (
                  'name' => 'name',
                  'link' => true,
                ),
                2 => 
                array (
                  'name' => 'type',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'status',
                ),
                1 => 
                array (
                  'name' => 'priority',
                ),
              ),
            ),
          ),
          'searchData' => 
          array (
            'bool' => 
            array (
              'onlyMy' => true,
            ),
            'primary' => 'open',
          ),
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'displayRecords',
                ),
                1 => 
                array (
                  'name' => 'autorefreshInterval',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'Leads' => 
    array (
      'view' => 'views/dashlets/abstract/record-list',
      'aclScope' => 'Lead',
      'entityType' => 'Lead',
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'autorefreshInterval' => 
          array (
            'type' => 'enumFloat',
            'options' => 
            array (
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10,
            ),
          ),
          'displayRecords' => 
          array (
            'type' => 'enumInt',
            'options' => 
            array (
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 10,
              4 => 15,
            ),
          ),
        ),
        'defaults' => 
        array (
          'sortBy' => 'createdAt',
          'asc' => false,
          'displayRecords' => 5,
          'expandedLayout' => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'name',
                  'link' => true,
                ),
                1 => 
                array (
                  'name' => 'addressCity',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'status',
                ),
                1 => 
                array (
                  'name' => 'source',
                ),
              ),
            ),
          ),
          'searchData' => 
          array (
            'bool' => 
            array (
              'onlyMy' => true,
            ),
            'primary' => 'actual',
          ),
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'displayRecords',
                ),
                1 => 
                array (
                  'name' => 'autorefreshInterval',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'Meetings' => 
    array (
      'view' => 'crm:views/dashlets/meetings',
      'aclScope' => 'Meeting',
      'entityType' => 'Meeting',
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'autorefreshInterval' => 
          array (
            'type' => 'enumFloat',
            'options' => 
            array (
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10,
            ),
          ),
          'displayRecords' => 
          array (
            'type' => 'enumInt',
            'options' => 
            array (
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 10,
              4 => 15,
            ),
          ),
        ),
        'defaults' => 
        array (
          'sortBy' => 'dateStart',
          'asc' => true,
          'displayRecords' => 5,
          'expandedLayout' => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'name',
                  'link' => true,
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'dateStart',
                ),
              ),
            ),
          ),
          'searchData' => 
          array (
            'bool' => 
            array (
              'onlyMy' => true,
            ),
            'primary' => 'planned',
            'advanced' => 
            array (
              1 => 
              array (
                'type' => 'or',
                'value' => 
                array (
                  1 => 
                  array (
                    'type' => 'today',
                    'field' => 'dateStart',
                    'dateTime' => true,
                  ),
                  2 => 
                  array (
                    'type' => 'future',
                    'field' => 'dateEnd',
                    'dateTime' => true,
                  ),
                ),
              ),
            ),
          ),
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'displayRecords',
                ),
                1 => 
                array (
                  'name' => 'autorefreshInterval',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'Opportunities' => 
    array (
      'view' => 'views/dashlets/abstract/record-list',
      'aclScope' => 'Opportunity',
      'entityType' => 'Opportunity',
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'autorefreshInterval' => 
          array (
            'type' => 'enumFloat',
            'options' => 
            array (
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10,
            ),
          ),
          'displayRecords' => 
          array (
            'type' => 'enumInt',
            'options' => 
            array (
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 10,
              4 => 15,
            ),
          ),
        ),
        'defaults' => 
        array (
          'sortBy' => 'createdAt',
          'asc' => false,
          'displayRecords' => 5,
          'expandedLayout' => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'name',
                  'link' => true,
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'stage',
                ),
                1 => 
                array (
                  'name' => 'amount',
                ),
              ),
            ),
          ),
          'searchData' => 
          array (
            'bool' => 
            array (
              'onlyMy' => true,
            ),
            'primary' => 'open',
          ),
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'displayRecords',
                ),
                1 => 
                array (
                  'name' => 'autorefreshInterval',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'OpportunitiesByLeadSource' => 
    array (
      'view' => 'crm:views/dashlets/opportunities-by-lead-source',
      'aclScope' => 'Opportunity',
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'dateFrom' => 
          array (
            'type' => 'date',
            'required' => true,
          ),
          'dateTo' => 
          array (
            'type' => 'date',
            'required' => true,
          ),
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'dateFrom',
                ),
                1 => 
                array (
                  'name' => 'dateTo',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'OpportunitiesByStage' => 
    array (
      'view' => 'crm:views/dashlets/opportunities-by-stage',
      'aclScope' => 'Opportunity',
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'dateFrom' => 
          array (
            'type' => 'date',
            'required' => true,
          ),
          'dateTo' => 
          array (
            'type' => 'date',
            'required' => true,
          ),
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'dateFrom',
                ),
                1 => 
                array (
                  'name' => 'dateTo',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'SalesByMonth' => 
    array (
      'view' => 'crm:views/dashlets/sales-by-month',
      'aclScope' => 'Opportunity',
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'dateFrom' => 
          array (
            'type' => 'date',
            'required' => true,
          ),
          'dateTo' => 
          array (
            'type' => 'date',
            'required' => true,
          ),
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'dateFrom',
                ),
                1 => 
                array (
                  'name' => 'dateTo',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'SalesPipeline' => 
    array (
      'view' => 'crm:views/dashlets/sales-pipeline',
      'aclScope' => 'Opportunity',
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'dateFrom' => 
          array (
            'type' => 'date',
            'required' => true,
          ),
          'dateTo' => 
          array (
            'type' => 'date',
            'required' => true,
          ),
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'dateFrom',
                ),
                1 => 
                array (
                  'name' => 'dateTo',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'Tasks' => 
    array (
      'view' => 'crm:views/dashlets/tasks',
      'aclScope' => 'Task',
      'entityType' => 'Task',
      'options' => 
      array (
        'fields' => 
        array (
          'title' => 
          array (
            'type' => 'varchar',
            'required' => true,
          ),
          'autorefreshInterval' => 
          array (
            'type' => 'enumFloat',
            'options' => 
            array (
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10,
            ),
          ),
          'displayRecords' => 
          array (
            'type' => 'enumInt',
            'options' => 
            array (
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 10,
              4 => 15,
            ),
          ),
        ),
        'defaults' => 
        array (
          'sortBy' => 'dateEnd',
          'asc' => true,
          'displayRecords' => 5,
          'expandedLayout' => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'name',
                  'link' => true,
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'status',
                ),
                1 => 
                array (
                  'name' => 'dateEnd',
                ),
              ),
            ),
          ),
          'searchData' => 
          array (
            'bool' => 
            array (
              'onlyMy' => true,
            ),
            'primary' => 'actualNotDeferred',
          ),
        ),
        'layout' => 
        array (
          0 => 
          array (
            'rows' => 
            array (
              0 => 
              array (
                0 => 
                array (
                  'name' => 'title',
                ),
              ),
              1 => 
              array (
                0 => 
                array (
                  'name' => 'displayRecords',
                ),
                1 => 
                array (
                  'name' => 'autorefreshInterval',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  'entityDefs' => 
  array (
    'Area' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
      ),
      'links' => 
      array (
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
      'indexes' => 
      array (
        'name' => 
        array (
          'columns' => 
          array (
            0 => 'name',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'Attachment' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'type' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
        ),
        'size' => 
        array (
          'type' => 'int',
          'min' => 0,
        ),
        'parent' => 
        array (
          'type' => 'linkParent',
        ),
        'related' => 
        array (
          'type' => 'linkParent',
          'noLoad' => true,
        ),
        'sourceId' => 
        array (
          'type' => 'varchar',
          'maxLength' => 36,
          'readOnly' => true,
          'disabled' => true,
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
        ),
        'contents' => 
        array (
          'type' => 'text',
          'notStorable' => true,
        ),
        'role' => 
        array (
          'type' => 'varchar',
          'maxLength' => 36,
        ),
        'global' => 
        array (
          'type' => 'bool',
          'default' => false,
        ),
      ),
      'links' => 
      array (
        'createdBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'parent' => 
        array (
          'type' => 'belongsToParent',
          'foreign' => 'attachments',
        ),
        'related' => 
        array (
          'type' => 'belongsToParent',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'parent' => 
        array (
          'columns' => 
          array (
            0 => 'parentType',
            1 => 'parentId',
          ),
        ),
      ),
      'sources' => 
      array (
        'Document' => 
        array (
          'insertModalView' => '',
        ),
      ),
    ),
    'AuthToken' => 
    array (
      'fields' => 
      array (
        'token' => 
        array (
          'type' => 'varchar',
          'maxLength' => '36',
          'index' => true,
        ),
        'hash' => 
        array (
          'type' => 'varchar',
          'maxLength' => 150,
          'index' => true,
        ),
        'userId' => 
        array (
          'type' => 'varchar',
          'maxLength' => '36',
        ),
        'user' => 
        array (
          'type' => 'link',
        ),
        'portal' => 
        array (
          'type' => 'link',
        ),
        'ipAddress' => 
        array (
          'type' => 'varchar',
          'maxLength' => '36',
        ),
        'lastAccess' => 
        array (
          'type' => 'datetime',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
      ),
      'links' => 
      array (
        'user' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'portal' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Portal',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'lastAccess',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'token' => 
        array (
          'columns' => 
          array (
            0 => 'token',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'Currency' => 
    array (
      'fields' => 
      array (
        'rate' => 
        array (
          'type' => 'float',
        ),
      ),
    ),
    'Email' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'subject' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'notStorable' => true,
          'view' => 'views/email/fields/subject',
          'disabled' => true,
          'trim' => true,
        ),
        'fromName' => 
        array (
          'type' => 'varchar',
        ),
        'fromString' => 
        array (
          'type' => 'varchar',
        ),
        'replyToString' => 
        array (
          'type' => 'varchar',
        ),
        'from' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'required' => true,
          'view' => 'views/email/fields/from-address-varchar',
        ),
        'to' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'required' => true,
          'view' => 'views/email/fields/email-address-varchar',
        ),
        'cc' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'view' => 'views/email/fields/email-address-varchar',
        ),
        'bcc' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'view' => 'views/email/fields/email-address-varchar',
        ),
        'replyTo' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'view' => 'views/email/fields/email-address-varchar',
        ),
        'personStringData' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'disabled' => true,
        ),
        'isRead' => 
        array (
          'type' => 'bool',
          'notStorable' => true,
          'default' => true,
        ),
        'isNotRead' => 
        array (
          'type' => 'bool',
          'notStorable' => true,
          'layoutListDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
        ),
        'isImportant' => 
        array (
          'type' => 'bool',
          'notStorable' => true,
          'default' => false,
        ),
        'inTrash' => 
        array (
          'type' => 'bool',
          'notStorable' => true,
          'default' => false,
        ),
        'isUsers' => 
        array (
          'type' => 'bool',
          'notStorable' => true,
          'default' => false,
        ),
        'nameHash' => 
        array (
          'type' => 'text',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'typeHash' => 
        array (
          'type' => 'text',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'idHash' => 
        array (
          'type' => 'text',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'messageId' => 
        array (
          'type' => 'varchar',
          'maxLength' => 255,
          'readOnly' => true,
        ),
        'messageIdInternal' => 
        array (
          'type' => 'varchar',
          'maxLength' => 300,
          'readOnly' => true,
          'index' => true,
        ),
        'emailAddress' => 
        array (
          'type' => 'base',
          'notStorable' => true,
          'view' => 'views/email/fields/email-address',
        ),
        'fromEmailAddress' => 
        array (
          'type' => 'link',
          'view' => 'views/fields/from-email-address',
        ),
        'toEmailAddresses' => 
        array (
          'type' => 'linkMultiple',
        ),
        'ccEmailAddresses' => 
        array (
          'type' => 'linkMultiple',
        ),
        'bodyPlain' => 
        array (
          'type' => 'text',
          'readOnly' => true,
          'seeMoreDisabled' => true,
        ),
        'body' => 
        array (
          'type' => 'wysiwyg',
          'seeMoreDisabled' => true,
        ),
        'isHtml' => 
        array (
          'type' => 'bool',
          'default' => true,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Draft',
            1 => 'Sending',
            2 => 'Sent',
            3 => 'Archived',
            4 => 'Failed',
          ),
          'readOnly' => true,
          'default' => 'Archived',
        ),
        'attachments' => 
        array (
          'type' => 'attachmentMultiple',
          'sourceList' => 
          array (
            0 => 'Document',
          ),
        ),
        'hasAttachment' => 
        array (
          'type' => 'bool',
          'readOnly' => true,
        ),
        'parent' => 
        array (
          'type' => 'linkParent',
          'entityList' => 
          array (
            0 => 'Account',
            1 => 'Lead',
            2 => 'Opportunity',
            3 => 'Case',
          ),
        ),
        'dateSent' => 
        array (
          'type' => 'datetime',
        ),
        'deliveryDate' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'required' => false,
          'view' => 'views/fields/user',
        ),
        'replied' => 
        array (
          'type' => 'link',
          'noJoin' => true,
          'readOnly' => true,
        ),
        'replies' => 
        array (
          'type' => 'linkMultiple',
          'readOnly' => true,
        ),
        'isSystem' => 
        array (
          'type' => 'bool',
          'default' => false,
          'readOnly' => true,
        ),
        'isJustSent' => 
        array (
          'type' => 'bool',
          'default' => false,
          'disabled' => true,
          'notStorable' => true,
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'users' => 
        array (
          'type' => 'linkMultiple',
          'noLoad' => true,
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'readOnly' => true,
        ),
        'assignedUsers' => 
        array (
          'type' => 'linkMultiple',
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'readOnly' => true,
        ),
        'account' => 
        array (
          'type' => 'link',
          'readOnly' => true,
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
        ),
        'assignedUsers' => 
        array (
          'type' => 'hasMany',
          'entity' => 'User',
          'relationName' => 'entityUser',
        ),
        'users' => 
        array (
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'emails',
          'additionalColumns' => 
          array (
            'isRead' => 
            array (
              'type' => 'bool',
              'default' => false,
            ),
            'isImportant' => 
            array (
              'type' => 'bool',
              'default' => false,
            ),
            'inTrash' => 
            array (
              'type' => 'bool',
              'default' => false,
            ),
          ),
        ),
        'attachments' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Attachment',
          'foreign' => 'parent',
          'relationName' => 'attachments',
        ),
        'parent' => 
        array (
          'type' => 'belongsToParent',
          'entityList' => 
          array (
          ),
          'foreign' => 'emails',
        ),
        'replied' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Email',
          'foreign' => 'replies',
        ),
        'replies' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Email',
          'foreign' => 'replied',
        ),
        'fromEmailAddress' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'EmailAddress',
        ),
        'toEmailAddresses' => 
        array (
          'type' => 'hasMany',
          'entity' => 'EmailAddress',
          'relationName' => 'emailEmailAddress',
          'conditions' => 
          array (
            'addressType' => 'to',
          ),
          'additionalColumns' => 
          array (
            'addressType' => 
            array (
              'type' => 'varchar',
              'len' => '4',
            ),
          ),
        ),
        'ccEmailAddresses' => 
        array (
          'type' => 'hasMany',
          'entity' => 'EmailAddress',
          'relationName' => 'emailEmailAddress',
          'conditions' => 
          array (
            'addressType' => 'cc',
          ),
          'additionalColumns' => 
          array (
            'addressType' => 
            array (
              'type' => 'varchar',
              'len' => '4',
            ),
          ),
        ),
        'bccEmailAddresses' => 
        array (
          'type' => 'hasMany',
          'entity' => 'EmailAddress',
          'relationName' => 'emailEmailAddress',
          'conditions' => 
          array (
            'addressType' => 'bcc',
          ),
          'additionalColumns' => 
          array (
            'addressType' => 
            array (
              'type' => 'varchar',
              'len' => '4',
            ),
          ),
        ),
        'account' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Account',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'dateSent',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'dateSentAssignedUser' => 
        array (
          'columns' => 
          array (
            0 => 'dateSent',
            1 => 'assignedUserId',
          ),
        ),
        'dateSent' => 
        array (
          'columns' => 
          array (
            0 => 'dateSent',
            1 => 'deleted',
          ),
        ),
        'dateSentStatus' => 
        array (
          'columns' => 
          array (
            0 => 'dateSent',
            1 => 'status',
            2 => 'deleted',
          ),
        ),
      ),
    ),
    'EmailAccount' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'emailAddress' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 100,
          'trim' => true,
          'view' => 'EmailAccount.Fields.EmailAddress',
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Active',
            1 => 'Inactive',
          ),
        ),
        'host' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'port' => 
        array (
          'type' => 'varchar',
          'default' => '143',
          'required' => true,
        ),
        'ssl' => 
        array (
          'type' => 'bool',
        ),
        'username' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'password' => 
        array (
          'type' => 'password',
        ),
        'monitoredFolders' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'default' => 'INBOX',
          'view' => 'EmailAccount.Fields.Folders',
          'tooltip' => true,
        ),
        'sentFolder' => 
        array (
          'type' => 'varchar',
          'view' => 'EmailAccount.Fields.Folder',
        ),
        'storeSentEmails' => 
        array (
          'type' => 'bool',
          'tooltip' => true,
        ),
        'keepFetchedEmailsUnread' => 
        array (
          'type' => 'bool',
        ),
        'fetchSince' => 
        array (
          'type' => 'date',
          'required' => true,
        ),
        'fetchData' => 
        array (
          'type' => 'jsonObject',
          'readOnly' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
      ),
      'links' => 
      array (
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
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
        'filters' => 
        array (
          'type' => 'hasChildren',
          'foreign' => 'parent',
          'entity' => 'EmailFilter',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
    ),
    'EmailAddress' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
        ),
        'lower' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'index' => true,
        ),
        'invalid' => 
        array (
          'type' => 'bool',
        ),
        'optOut' => 
        array (
          'type' => 'bool',
        ),
      ),
      'links' => 
      array (
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
    ),
    'EmailFilter' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 100,
          'tooltip' => true,
          'trim' => true,
        ),
        'from' => 
        array (
          'type' => 'varchar',
          'maxLength' => 255,
          'tooltip' => true,
          'trim' => true,
        ),
        'to' => 
        array (
          'type' => 'varchar',
          'maxLength' => 255,
          'tooltip' => true,
          'trim' => true,
        ),
        'subject' => 
        array (
          'type' => 'varchar',
          'maxLength' => 255,
          'tooltip' => true,
        ),
        'bodyContains' => 
        array (
          'type' => 'array',
          'tooltip' => true,
        ),
        'parent' => 
        array (
          'type' => 'linkParent',
          'tooltip' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
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
        'parent' => 
        array (
          'type' => 'belongsToParent',
          'entityList' => 
          array (
            0 => 'EmailAccount',
            1 => 'InboundEmail',
          ),
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
    ),
    'EmailTemplate' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'subject' => 
        array (
          'type' => 'varchar',
        ),
        'body' => 
        array (
          'type' => 'text',
          'view' => 'views/fields/wysiwyg',
        ),
        'isHtml' => 
        array (
          'type' => 'bool',
          'default' => true,
        ),
        'oneOff' => 
        array (
          'type' => 'bool',
          'default' => false,
          'tooltip' => true,
        ),
        'attachments' => 
        array (
          'type' => 'linkMultiple',
          'view' => 'views/fields/attachment-multiple',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
      ),
      'links' => 
      array (
        'attachments' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Attachment',
          'foreign' => 'parent',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
        ),
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
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
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
    ),
    'Encashment' => 
    array (
      'fields' => 
      array (
        'money' => 
        array (
          'type' => 'money',
          'readOnly' => true,
        ),
        'status' => 
        array (
          'type' => 'enum-check',
          'options' => 
          array (
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
          ),
          'default' => 0,
          'readOnly' => true,
        ),
        'account' => 
        array (
          'type' => 'link',
          'required' => true,
          'readOnly' => true,
        ),
        'desc' => 
        array (
          'type' => 'varchar',
          'readOnly' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'finishedTime' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'auditAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'auditBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
      ),
      'links' => 
      array (
        'auditBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'account' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Account',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => true,
      ),
      'indexes' => 
      array (
        'name' => 
        array (
          'columns' => 
          array (
            0 => 'deleted',
          ),
        ),
      ),
    ),
    'Extension' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
        ),
        'version' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 50,
        ),
        'fileList' => 
        array (
          'type' => 'jsonArray',
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'isInstalled' => 
        array (
          'type' => 'bool',
          'default' => false,
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
        ),
      ),
      'links' => 
      array (
        'createdBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
    ),
    'ExternalAccount' => 
    array (
      'fields' => 
      array (
        'id' => 
        array (
          'maxLength' => 64,
        ),
        'data' => 
        array (
          'type' => 'jsonObject',
        ),
        'enabled' => 
        array (
          'type' => 'bool',
        ),
      ),
    ),
    'Import' => 
    array (
      'fields' => 
      array (
        'entityType' => 
        array (
          'type' => 'enum',
          'translation' => 'Global.scopeNames',
          'required' => true,
        ),
        'file' => 
        array (
          'type' => 'file',
          'required' => true,
        ),
        'importedCount' => 
        array (
          'type' => 'int',
          'readOnly' => true,
          'notStorable' => true,
        ),
        'duplicateCount' => 
        array (
          'type' => 'int',
          'readOnly' => true,
          'notStorable' => true,
        ),
        'updatedCount' => 
        array (
          'type' => 'int',
          'readOnly' => true,
          'notStorable' => true,
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
        ),
      ),
      'links' => 
      array (
        'createdBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
    ),
    'InboundEmail' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'emailAddress' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 100,
          'view' => 'views/email-account/fields/email-address',
          'trim' => true,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Active',
            1 => 'Inactive',
          ),
        ),
        'host' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'port' => 
        array (
          'type' => 'varchar',
          'default' => '143',
          'required' => true,
        ),
        'ssl' => 
        array (
          'type' => 'bool',
        ),
        'username' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'password' => 
        array (
          'type' => 'password',
        ),
        'monitoredFolders' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'default' => 'INBOX',
          'view' => 'views/inbound-email/fields/folders',
        ),
        'fetchSince' => 
        array (
          'type' => 'date',
          'required' => true,
        ),
        'fetchData' => 
        array (
          'type' => 'jsonObject',
          'readOnly' => true,
        ),
        'assignToUser' => 
        array (
          'type' => 'link',
          'tooltip' => true,
        ),
        'team' => 
        array (
          'type' => 'link',
          'tooltip' => true,
        ),
        'addAllTeamUsers' => 
        array (
          'type' => 'bool',
          'tooltip' => true,
        ),
        'createCase' => 
        array (
          'type' => 'bool',
          'tooltip' => true,
        ),
        'caseDistribution' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => '',
            1 => 'Direct-Assignment',
            2 => 'Round-Robin',
            3 => 'Least-Busy',
          ),
          'default' => 'Direct-Assignment',
          'tooltip' => true,
        ),
        'targetUserPosition' => 
        array (
          'type' => 'enum',
          'view' => 'views/inbound-email/fields/target-user-position',
          'tooltip' => true,
        ),
        'reply' => 
        array (
          'type' => 'bool',
          'tooltip' => true,
        ),
        'replyEmailTemplate' => 
        array (
          'type' => 'link',
        ),
        'replyFromAddress' => 
        array (
          'type' => 'varchar',
        ),
        'replyToAddress' => 
        array (
          'type' => 'varchar',
          'tooltip' => true,
          'required' => true,
        ),
        'replyFromName' => 
        array (
          'type' => 'varchar',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
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
        'assignToUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'team' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Team',
        ),
        'replyEmailTemplate' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'EmailTemplate',
        ),
        'filters' => 
        array (
          'type' => 'hasChildren',
          'foreign' => 'parent',
          'entity' => 'EmailFilter',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
    ),
    'Integration' => 
    array (
      'fields' => 
      array (
        'data' => 
        array (
          'type' => 'jsonObject',
        ),
        'enabled' => 
        array (
          'type' => 'bool',
        ),
      ),
    ),
    'Job' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'view' => 'views/admin/job/fields/name',
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Pending',
            1 => 'Running',
            2 => 'Success',
            3 => 'Failed',
          ),
          'default' => 'Pending',
        ),
        'executeTime' => 
        array (
          'type' => 'datetime',
          'required' => true,
        ),
        'serviceName' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 100,
        ),
        'method' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 100,
        ),
        'data' => 
        array (
          'type' => 'jsonObject',
        ),
        'scheduledJob' => 
        array (
          'type' => 'link',
        ),
        'attempts' => 
        array (
          'type' => 'int',
        ),
        'failedAttempts' => 
        array (
          'type' => 'int',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
      ),
      'links' => 
      array (
        'scheduledJob' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'ScheduledJob',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'executeTime' => 
        array (
          'columns' => 
          array (
            0 => 'status',
            1 => 'executeTime',
          ),
        ),
        'status' => 
        array (
          'columns' => 
          array (
            0 => 'status',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'Note' => 
    array (
      'fields' => 
      array (
        'post' => 
        array (
          'type' => 'text',
        ),
        'data' => 
        array (
          'type' => 'jsonObject',
          'readOnly' => true,
        ),
        'type' => 
        array (
          'type' => 'varchar',
          'readOnly' => true,
        ),
        'targetType' => 
        array (
          'type' => 'varchar',
        ),
        'parent' => 
        array (
          'type' => 'linkParent',
          'readOnly' => true,
        ),
        'related' => 
        array (
          'type' => 'linkParent',
          'readOnly' => true,
        ),
        'attachments' => 
        array (
          'type' => 'linkMultiple',
          'view' => 'views/stream/fields/attachment-multiple',
        ),
        'number' => 
        array (
          'type' => 'autoincrement',
          'index' => true,
          'readOnly' => true,
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
          'noLoad' => true,
        ),
        'portals' => 
        array (
          'type' => 'linkMultiple',
          'noLoad' => true,
        ),
        'users' => 
        array (
          'type' => 'linkMultiple',
          'noLoad' => true,
        ),
        'isGlobal' => 
        array (
          'type' => 'bool',
        ),
        'notifiedUserIdList' => 
        array (
          'type' => 'jsonArray',
          'notStorable' => true,
        ),
        'isToSelf' => 
        array (
          'type' => 'bool',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
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
        'attachments' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Attachment',
          'relationName' => 'attachments',
          'foreign' => 'parent',
        ),
        'parent' => 
        array (
          'type' => 'belongsToParent',
          'foreign' => 'notes',
        ),
        'superParent' => 
        array (
          'type' => 'belongsToParent',
        ),
        'related' => 
        array (
          'type' => 'belongsToParent',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'foreign' => 'notes',
        ),
        'portals' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Portal',
          'foreign' => 'notes',
        ),
        'users' => 
        array (
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'notes',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'number',
        'asc' => false,
      ),
      'streamRelated' => 
      array (
        'Account' => 
        array (
          0 => 'meetings',
          1 => 'calls',
          2 => 'tasks',
        ),
        'Contact' => 
        array (
          0 => 'meetings',
          1 => 'calls',
          2 => 'tasks',
        ),
        'Lead' => 
        array (
          0 => 'meetings',
          1 => 'calls',
          2 => 'tasks',
        ),
        'Opportunity' => 
        array (
          0 => 'meetings',
          1 => 'calls',
          2 => 'tasks',
        ),
        'Case' => 
        array (
          0 => 'meetings',
          1 => 'calls',
          2 => 'tasks',
        ),
      ),
      'statusStyles' => 
      array (
        'Lead' => 
        array (
          'New' => 'primary',
          'Assigned' => 'primary',
          'In Process' => 'primary',
          'Converted' => 'success',
          'Recycled' => 'danger',
          'Dead' => 'danger',
        ),
        'Case' => 
        array (
          'New' => 'primary',
          'Assigned' => 'primary',
          'Pending' => 'default',
          'Closed' => 'success',
          'Rejected' => 'danger',
          'Duplicate' => 'danger',
        ),
        'Opportunity' => 
        array (
          'Prospecting' => 'primary',
          'Qualification' => 'primary',
          'Needs Analysis' => 'primary',
          'Value Proposition' => 'primary',
          'Id. Decision Makers' => 'primary',
          'Perception Analysis' => 'primary',
          'Proposal/Price Quote' => 'primary',
          'Negotiation/Review' => 'primary',
          'Closed Won' => 'success',
          'Closed Lost' => 'danger',
        ),
        'Task' => 
        array (
          'Completed' => 'success',
          'Started' => 'primary',
          'Canceled' => 'danger',
        ),
        'Meeting' => 
        array (
          'Held' => 'success',
        ),
        'Call' => 
        array (
          'Held' => 'success',
        ),
      ),
      'statusFields' => 
      array (
        'Lead' => 'status',
        'Case' => 'status',
        'Opportunity' => 'stage',
        'Task' => 'status',
        'Meeting' => 'status',
        'Call' => 'status',
        'Campaign' => 'status',
      ),
      'indexes' => 
      array (
        'createdAt' => 
        array (
          'type' => 'index',
          'columns' => 
          array (
            0 => 'createdAt',
          ),
        ),
        'parent' => 
        array (
          'type' => 'index',
          'columns' => 
          array (
            0 => 'parentId',
            1 => 'parentType',
          ),
        ),
        'parentAndSuperParent' => 
        array (
          'type' => 'index',
          'columns' => 
          array (
            0 => 'parentId',
            1 => 'parentType',
            2 => 'superParentId',
            3 => 'superParentType',
          ),
        ),
      ),
    ),
    'Notification' => 
    array (
      'fields' => 
      array (
        'number' => 
        array (
          'type' => 'autoincrement',
          'index' => true,
        ),
        'data' => 
        array (
          'type' => 'jsonObject',
        ),
        'noteData' => 
        array (
          'type' => 'jsonObject',
          'notStorable' => true,
        ),
        'type' => 
        array (
          'type' => 'varchar',
        ),
        'read' => 
        array (
          'type' => 'bool',
        ),
        'user' => 
        array (
          'type' => 'link',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'message' => 
        array (
          'type' => 'text',
        ),
        'related' => 
        array (
          'type' => 'linkParent',
          'readOnly' => true,
        ),
      ),
      'links' => 
      array (
        'user' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'related' => 
        array (
          'type' => 'belongsToParent',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'number',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'createdAt' => 
        array (
          'type' => 'index',
          'columns' => 
          array (
            0 => 'createdAt',
          ),
        ),
        'user' => 
        array (
          'type' => 'index',
          'columns' => 
          array (
            0 => 'userId',
            1 => 'createdAt',
          ),
        ),
      ),
    ),
    'Orders' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
          'readOnly' => true,
        ),
        'imgs' => 
        array (
          'type' => 'imgs',
          'readOnly' => true,
          'notStorable' => true,
        ),
        'buyerMobile' => 
        array (
          'type' => 'varchar',
          'readOnly' => true,
        ),
        'buyOrderNo' => 
        array (
          'type' => 'varchar',
          'readOnly' => true,
        ),
        'parentIncome' => 
        array (
          'type' => 'money',
          'readOnly' => true,
        ),
        'reason' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'auditStatus' => 
        array (
          'type' => 'enum-check',
          'options' => 
          array (
            0 => 3,
            1 => 1,
            2 => 2,
          ),
          'readOnly' => true,
        ),
        'flowType' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 0,
            1 => 1,
            2 => 2,
          ),
          'readOnly' => true,
        ),
        'flow' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
          ),
          'readOnly' => true,
        ),
        'money' => 
        array (
          'type' => 'money',
          'readOnly' => true,
        ),
        'isPaid' => 
        array (
          'type' => 'bool',
          'readOnly' => true,
        ),
        'payTime' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'seller' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'sellerMobile' => 
        array (
          'type' => 'varchar',
          'readOnly' => true,
        ),
        'finishedTime' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
          ),
          'readOnly' => true,
        ),
        'complaintStatus' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 0,
            1 => 1,
            2 => 2,
          ),
          'readOnly' => true,
        ),
        'auditAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'desc' => 
        array (
          'type' => 'varchar',
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'area' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'auditBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'modifiedBy' => 
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
        'reason' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Reason',
        ),
        'modifiedBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'area' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Area',
        ),
        'auditBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'seller' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Account',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
      'indexes' => 
      array (
        'name' => 
        array (
          'columns' => 
          array (
            0 => 'name',
            1 => 'deleted',
          ),
        ),
        'assignedUser' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'OrdersLimit' => 
    array (
      'fields' => 
      array (
        'flow' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
          ),
          'default' => 0,
          'required' => true,
        ),
        'reason' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'type' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 1,
            1 => 2,
            2 => 3,
          ),
          'default' => 1,
          'required' => true,
        ),
        'status' => 
        array (
          'type' => 'enum-check',
          'options' => 
          array (
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 5,
          ),
          'default' => 0,
          'readOnly' => true,
        ),
        'area' => 
        array (
          'type' => 'link',
          'required' => true,
        ),
        'desc' => 
        array (
          'type' => 'varchar',
        ),
        'num' => 
        array (
          'type' => 'varchar',
          'required' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'auditAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'auditBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
      ),
      'links' => 
      array (
        'reason' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'reason',
        ),
        'createdBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'auditBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'area' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Area',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => true,
      ),
      'indexes' => 
      array (
        'name' => 
        array (
          'columns' => 
          array (
            0 => 'deleted',
          ),
        ),
      ),
    ),
    'PasswordChangeRequest' => 
    array (
      'fields' => 
      array (
        'requestId' => 
        array (
          'type' => 'varchar',
          'maxLength' => 24,
          'index' => true,
        ),
        'user' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'index' => true,
        ),
        'url' => 
        array (
          'type' => 'url',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
      ),
      'links' => 
      array (
        'user' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
      ),
    ),
    'PhoneNumber' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 36,
          'index' => true,
        ),
        'type' => 
        array (
          'type' => 'enum',
        ),
      ),
      'links' => 
      array (
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
    ),
    'Portal' => 
    array (
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
        'articles' => 
        array (
          'type' => 'hasMany',
          'entity' => 'KnowledgeBaseArticle',
          'foreign' => 'portals',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
    ),
    'PortalRole' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'maxLength' => 150,
          'required' => true,
          'type' => 'varchar',
          'trim' => true,
        ),
        'data' => 
        array (
          'type' => 'jsonObject',
        ),
        'fieldData' => 
        array (
          'type' => 'jsonObject',
        ),
      ),
      'links' => 
      array (
        'users' => 
        array (
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'portalRoles',
        ),
        'portals' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Portal',
          'foreign' => 'portalRoles',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
    ),
    'Preferences' => 
    array (
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
          'default' => 'zh_CN',
          'view' => 'views/preferences/fields/language',
          'options' => 
          array (
            0 => 'zh_CN',
          ),
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
    ),
    'Reason' => 
    array (
      'fields' => 
      array (
        'type' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Tactics',
            1 => 'SetMeal',
            2 => 'OrdersLimit',
            3 => 'Orders',
          ),
          'default' => 'Orders',
          'required' => true,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 1,
            1 => 2,
          ),
          'default' => 1,
        ),
        'name' => 
        array (
          'type' => 'varchar',
        ),
      ),
      'links' => 
      array (
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
      'indexes' => 
      array (
        'name' => 
        array (
          'columns' => 
          array (
            0 => 'name',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'Role' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'maxLength' => 150,
          'required' => true,
          'type' => 'varchar',
          'trim' => true,
        ),
        'assignmentPermission' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'not-set',
            1 => 'all',
            2 => 'team',
            3 => 'no',
          ),
          'default' => 'not-set',
          'tooltip' => true,
          'translation' => 'Role.options.levelList',
        ),
        'userPermission' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'not-set',
            1 => 'all',
            2 => 'team',
            3 => 'no',
          ),
          'default' => 'not-set',
          'tooltip' => true,
          'translation' => 'Role.options.levelList',
        ),
        'portalPermission' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'not-set',
            1 => 'yes',
            2 => 'no',
          ),
          'default' => 'not-set',
          'tooltip' => true,
          'translation' => 'Role.options.levelList',
        ),
        'data' => 
        array (
          'type' => 'jsonObject',
        ),
        'fieldData' => 
        array (
          'type' => 'jsonObject',
        ),
      ),
      'links' => 
      array (
        'users' => 
        array (
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'roles',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'foreign' => 'roles',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
    ),
    'ScheduledJob' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
        ),
        'job' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'view' => 'views/scheduled-job/fields/job',
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Active',
            1 => 'Inactive',
          ),
        ),
        'scheduling' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'view' => 'views/scheduled-job/fields/scheduling',
          'tooltip' => true,
        ),
        'lastRun' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
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
        'log' => 
        array (
          'type' => 'hasMany',
          'entity' => 'ScheduledJobLogRecord',
          'foreign' => 'scheduledJob',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
      'jobSchedulingMap' => 
      array (
        'CheckInboundEmails' => '*/4 * * * *',
        'CheckEmailAccounts' => '*/5 * * * *',
        'SendEmailReminders' => '/2 * * * *',
        'Cleanup' => '1 1 * * 0',
        'AuthTokenControl' => '*/6 * * * *',
        'ProcessMassEmail' => '15 * * * *',
        'ControlKnowledgeBaseArticleStatus' => '10 1 * * *',
      ),
    ),
    'ScheduledJobLogRecord' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'readOnly' => true,
        ),
        'status' => 
        array (
          'type' => 'varchar',
          'readOnly' => true,
        ),
        'executionTime' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'scheduledJob' => 
        array (
          'type' => 'link',
        ),
      ),
      'links' => 
      array (
        'scheduledJob' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'ScheduledJob',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'executionTime',
        'asc' => false,
      ),
    ),
    'SetMeal' => 
    array (
      'fields' => 
      array (
        'flow' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
          ),
          'default' => 0,
          'required' => true,
        ),
        'reason' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'type' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 1,
            1 => 2,
            2 => 3,
            3 => 5,
          ),
          'default' => 1,
          'required' => true,
        ),
        'status' => 
        array (
          'type' => 'enum-check',
          'options' => 
          array (
            0 => 0,
            1 => 1,
            2 => 2,
          ),
          'default' => 0,
          'readOnly' => true,
        ),
        'area' => 
        array (
          'type' => 'link',
          'required' => true,
        ),
        'desc' => 
        array (
          'type' => 'varchar',
        ),
        'sellingPrice' => 
        array (
          'type' => 'money',
        ),
        'orderPrice' => 
        array (
          'type' => 'money',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'auditAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'auditBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
      ),
      'links' => 
      array (
        'reason' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'reason',
        ),
        'createdBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'auditBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'area' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Area',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
      'indexes' => 
      array (
        'name' => 
        array (
          'columns' => 
          array (
            0 => 'name',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'Settings' => 
    array (
      'fields' => 
      array (
        'useCache' => 
        array (
          'type' => 'bool',
          'default' => true,
        ),
        'recordsPerPage' => 
        array (
          'type' => 'int',
          'minValue' => 1,
          'maxValue' => 1000,
          'default' => 20,
          'required' => true,
          'tooltip' => true,
        ),
        'recordsPerPageSmall' => 
        array (
          'type' => 'int',
          'minValue' => 1,
          'maxValue' => 100,
          'default' => 10,
          'required' => true,
          'tooltip' => true,
        ),
        'timeZone' => 
        array (
          'type' => 'enum',
          'detault' => 'UTC',
          'options' => 
          array (
            0 => 'PRC',
            1 => 'UTC',
          ),
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
          'default' => 'MM/DD/YYYY',
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
          'default' => 'HH:mm',
        ),
        'weekStart' => 
        array (
          'type' => 'enumInt',
          'options' => 
          array (
            0 => 0,
            1 => 1,
          ),
          'default' => 0,
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
        'currencyList' => 
        array (
          'type' => 'multiEnum',
          'default' => 
          array (
            0 => 'USD',
            1 => 'EUR',
          ),
          'options' => 
          array (
            0 => 'AED',
            1 => 'ANG',
            2 => 'ARS',
            3 => 'AUD',
            4 => 'BGN',
            5 => 'BHD',
            6 => 'BND',
            7 => 'BOB',
            8 => 'BRL',
            9 => 'BWP',
            10 => 'CAD',
            11 => 'CHF',
            12 => 'CLP',
            13 => 'CNY',
            14 => 'COP',
            15 => 'CRC',
            16 => 'CZK',
            17 => 'DKK',
            18 => 'DOP',
            19 => 'DZD',
            20 => 'EEK',
            21 => 'EGP',
            22 => 'EUR',
            23 => 'FJD',
            24 => 'GBP',
            25 => 'HKD',
            26 => 'HNL',
            27 => 'HRK',
            28 => 'HUF',
            29 => 'IDR',
            30 => 'ILS',
            31 => 'INR',
            32 => 'JMD',
            33 => 'JOD',
            34 => 'JPY',
            35 => 'KES',
            36 => 'KRW',
            37 => 'KWD',
            38 => 'KYD',
            39 => 'KZT',
            40 => 'LBP',
            41 => 'LKR',
            42 => 'LTL',
            43 => 'LVL',
            44 => 'MAD',
            45 => 'MDL',
            46 => 'MKD',
            47 => 'MUR',
            48 => 'MXN',
            49 => 'MYR',
            50 => 'NAD',
            51 => 'NGN',
            52 => 'NIO',
            53 => 'NOK',
            54 => 'NPR',
            55 => 'NZD',
            56 => 'OMR',
            57 => 'PEN',
            58 => 'PGK',
            59 => 'PHP',
            60 => 'PKR',
            61 => 'PLN',
            62 => 'PYG',
            63 => 'QAR',
            64 => 'RON',
            65 => 'RSD',
            66 => 'RUB',
            67 => 'SAR',
            68 => 'SCR',
            69 => 'SEK',
            70 => 'SGD',
            71 => 'SKK',
            72 => 'SLL',
            73 => 'SVC',
            74 => 'THB',
            75 => 'TND',
            76 => 'TRY',
            77 => 'TTD',
            78 => 'TWD',
            79 => 'TZS',
            80 => 'UAH',
            81 => 'UGX',
            82 => 'USD',
            83 => 'UYU',
            84 => 'UZS',
            85 => 'VND',
            86 => 'YER',
            87 => 'ZAR',
            88 => 'ZMK',
          ),
          'required' => true,
        ),
        'defaultCurrency' => 
        array (
          'type' => 'enum',
          'default' => 'USD',
          'required' => true,
          'view' => 'views/settings/fields/default-currency',
        ),
        'baseCurrency' => 
        array (
          'type' => 'enum',
          'default' => 'USD',
          'required' => true,
          'view' => 'views/settings/fields/default-currency',
        ),
        'currencyRates' => 
        array (
          'type' => 'base',
          'view' => 'views/settings/fields/currency-rates',
        ),
        'outboundEmailIsShared' => 
        array (
          'type' => 'bool',
          'default' => false,
          'tooltip' => true,
        ),
        'outboundEmailFromName' => 
        array (
          'type' => 'varchar',
          'default' => 'CRM',
          'required' => true,
        ),
        'outboundEmailFromAddress' => 
        array (
          'type' => 'varchar',
          'default' => 'crm@example.com',
          'required' => true,
          'trim' => true,
        ),
        'smtpServer' => 
        array (
          'type' => 'varchar',
          'required' => true,
        ),
        'smtpPort' => 
        array (
          'type' => 'int',
          'required' => true,
          'min' => 0,
          'max' => 9999,
          'default' => 25,
        ),
        'smtpAuth' => 
        array (
          'type' => 'bool',
          'default' => true,
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
        'tabList' => 
        array (
          'type' => 'array',
          'translation' => 'Global.scopeNamesPlural',
          'view' => 'views/settings/fields/tab-list',
        ),
        'quickCreateList' => 
        array (
          'type' => 'array',
          'translation' => 'Global.scopeNames',
          'view' => 'views/settings/fields/quick-create-list',
        ),
        'language' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'zh_CN',
          ),
          'default' => 'zh_CN',
        ),
        'globalSearchEntityList' => 
        array (
          'type' => 'multiEnum',
          'translation' => 'Global.scopeNames',
          'view' => 'views/settings/fields/global-search-entity-list',
        ),
        'exportDelimiter' => 
        array (
          'type' => 'varchar',
          'default' => ',',
          'required' => true,
          'maxLength' => 1,
        ),
        'companyLogo' => 
        array (
          'type' => 'image',
        ),
        'authenticationMethod' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Fox',
            1 => 'LDAP',
          ),
          'default' => 'Fox',
        ),
        'ldapHost' => 
        array (
          'type' => 'varchar',
          'required' => true,
        ),
        'ldapPort' => 
        array (
          'type' => 'int',
          'max' => 9999,
          'min' => 0,
          'default' => 389,
        ),
        'ldapSecurity' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => '',
            1 => 'SSL',
            2 => 'TLS',
          ),
        ),
        'ldapAuth' => 
        array (
          'type' => 'bool',
        ),
        'ldapUsername' => 
        array (
          'type' => 'varchar',
          'required' => true,
        ),
        'ldapPassword' => 
        array (
          'type' => 'password',
        ),
        'ldapBindRequiresDn' => 
        array (
          'type' => 'bool',
        ),
        'ldapBaseDn' => 
        array (
          'type' => 'varchar',
        ),
        'ldapUserLoginFilter' => 
        array (
          'type' => 'varchar',
        ),
        'ldapAccountCanonicalForm' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Dn',
            1 => 'Username',
            2 => 'Backslash',
            3 => 'Principal',
          ),
        ),
        'ldapAccountDomainName' => 
        array (
          'type' => 'varchar',
        ),
        'ldapAccountDomainNameShort' => 
        array (
          'type' => 'varchar',
        ),
        'ldapAccountFilterFormat' => 
        array (
          'type' => 'varchar',
        ),
        'ldapTryUsernameSplit' => 
        array (
          'type' => 'bool',
        ),
        'ldapOptReferrals' => 
        array (
          'type' => 'bool',
        ),
        'ldapCreateFoxUser' => 
        array (
          'type' => 'bool',
          'default' => true,
        ),
        'exportDisabled' => 
        array (
          'type' => 'bool',
          'default' => false,
        ),
        'assignmentEmailNotifications' => 
        array (
          'type' => 'bool',
          'default' => false,
        ),
        'assignmentEmailNotificationsEntityList' => 
        array (
          'type' => 'multiEnum',
          'translation' => 'Global.scopeNamesPlural',
          'view' => 'views/settings/fields/assignment-email-notifications-entity-list',
        ),
        'assignmentNotificationsEntityList' => 
        array (
          'type' => 'multiEnum',
          'translation' => 'Global.scopeNamesPlural',
          'view' => 'views/settings/fields/assignment-notifications-entity-list',
        ),
        'b2cMode' => 
        array (
          'type' => 'bool',
          'default' => false,
        ),
        'avatarsDisabled' => 
        array (
          'type' => 'bool',
          'default' => false,
        ),
        'followCreatedEntities' => 
        array (
          'type' => 'bool',
          'default' => false,
          'tooltip' => true,
        ),
        'adminPanelIframeUrl' => 
        array (
          'type' => 'varchar',
        ),
        'displayListViewRecordCount' => 
        array (
          'type' => 'bool',
        ),
        'userThemesDisabled' => 
        array (
          'type' => 'bool',
          'tooltip' => true,
        ),
        'theme' => 
        array (
          'type' => 'enum',
          'view' => 'views/settings/fields/theme',
          'translation' => 'Global.themes',
        ),
        'emailMessageMaxSize' => 
        array (
          'type' => 'float',
          'min' => 0,
          'tooltip' => true,
        ),
        'inboundEmailMaxPortionSize' => 
        array (
          'type' => 'int',
        ),
        'personalEmailMaxPortionSize' => 
        array (
          'type' => 'int',
        ),
        'maxEmailAccountCount' => 
        array (
          'type' => 'int',
        ),
        'massEmailMaxPerHourCount' => 
        array (
          'type' => 'int',
          'min' => 0,
        ),
        'authTokenLifetime' => 
        array (
          'type' => 'float',
          'min' => 0,
          'default' => 0,
          'tooltip' => true,
        ),
        'authTokenMaxIdleTime' => 
        array (
          'type' => 'float',
          'min' => 0,
          'default' => 0,
          'tooltip' => true,
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
        'siteUrl' => 
        array (
          'type' => 'varchar',
        ),
        'readableDateFormatDisabled' => 
        array (
          'type' => 'bool',
        ),
      ),
    ),
    'Tactics' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 1,
            1 => 2,
            2 => 3,
            3 => 4,
          ),
          'default' => 1,
          'required' => true,
        ),
        'reason' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'status' => 
        array (
          'type' => 'enum-check',
          'options' => 
          array (
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 5,
          ),
          'default' => 0,
          'readOnly' => true,
        ),
        'v1' => 
        array (
          'type' => 'varchar',
          'required' => true,
        ),
        'v2' => 
        array (
          'type' => 'varchar',
        ),
        'v3' => 
        array (
          'type' => 'varchar',
        ),
        'v4' => 
        array (
          'type' => 'varchar',
        ),
        'desc' => 
        array (
          'type' => 'varchar',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'auditAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'auditBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
      ),
      'links' => 
      array (
        'reason' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'reason',
        ),
        'createdBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'auditBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
      'indexes' => 
      array (
        'name' => 
        array (
          'columns' => 
          array (
            0 => 'name',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'Team' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
          'trim' => true,
        ),
        'roles' => 
        array (
          'type' => 'linkMultiple',
          'tooltip' => true,
        ),
        'positionList' => 
        array (
          'type' => 'array',
          'tooltip' => true,
        ),
        'userRole' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'disabled' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
      ),
      'links' => 
      array (
        'users' => 
        array (
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'teams',
        ),
        'roles' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Role',
          'foreign' => 'teams',
        ),
        'notes' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Note',
          'foreign' => 'teams',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
    ),
    'Template' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'body' => 
        array (
          'type' => 'text',
          'view' => 'Fields.Wysiwyg',
        ),
        'header' => 
        array (
          'type' => 'text',
          'view' => 'Fields.Wysiwyg',
        ),
        'footer' => 
        array (
          'type' => 'text',
          'view' => 'Fields.Wysiwyg',
          'tooltip' => true,
        ),
        'entityType' => 
        array (
          'type' => 'enum',
          'required' => true,
          'translation' => 'Global.scopeNames',
          'view' => 'Fields.EntityType',
        ),
        'leftMargin' => 
        array (
          'type' => 'float',
          'default' => 10,
        ),
        'rightMargin' => 
        array (
          'type' => 'float',
          'default' => 10,
        ),
        'topMargin' => 
        array (
          'type' => 'float',
          'default' => 10,
        ),
        'bottomMargin' => 
        array (
          'type' => 'float',
          'default' => 25,
        ),
        'printFooter' => 
        array (
          'type' => 'bool',
        ),
        'footerPosition' => 
        array (
          'type' => 'float',
          'default' => 15,
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
      ),
      'links' => 
      array (
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
        ),
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
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
    ),
    'UniqueId' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'index' => true,
        ),
        'data' => 
        array (
          'type' => 'jsonObject',
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
        ),
      ),
      'links' => 
      array (
        'createdBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
    ),
    'User' => 
    array (
      'fields' => 
      array (
        'isAdmin' => 
        array (
          'type' => 'bool',
          'tooltip' => true,
        ),
        'userName' => 
        array (
          'type' => 'varchar',
          'maxLength' => 50,
          'required' => true,
          'view' => 'views/user/fields/user-name',
          'tooltip' => true,
        ),
        'name' => 
        array (
          'type' => 'personName',
          'view' => 'views/user/fields/name',
        ),
        'password' => 
        array (
          'type' => 'password',
          'maxLength' => 150,
          'internal' => true,
          'disabled' => true,
        ),
        'passwordConfirm' => 
        array (
          'type' => 'password',
          'maxLength' => 150,
          'internal' => true,
          'disabled' => true,
          'notStorable' => true,
        ),
        'salutationName' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => '',
            1 => 'Mr.',
            2 => 'Mrs.',
            3 => 'Ms.',
            4 => 'Dr.',
          ),
        ),
        'firstName' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
          'default' => '',
        ),
        'lastName' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
          'required' => true,
          'default' => '',
        ),
        'isActive' => 
        array (
          'type' => 'bool',
          'tooltip' => true,
          'default' => true,
        ),
        'isPortalUser' => 
        array (
          'type' => 'bool',
        ),
        'isSuperAdmin' => 
        array (
          'type' => 'bool',
          'default' => false,
          'disabled' => true,
        ),
        'title' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
          'trim' => true,
        ),
        'emailAddress' => 
        array (
          'type' => 'email',
          'required' => false,
        ),
        'phoneNumber' => 
        array (
          'type' => 'phone',
          'typeList' => 
          array (
            0 => 'Mobile',
            1 => 'Office',
            2 => 'Home',
            3 => 'Fax',
            4 => 'Other',
          ),
          'defaultType' => 'Mobile',
        ),
        'token' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'disabled' => true,
        ),
        'defaultTeam' => 
        array (
          'type' => 'link',
          'tooltip' => true,
        ),
        'acceptanceStatus' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'disabled' => true,
        ),
        'teamRole' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'disabled' => true,
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
          'tooltip' => true,
          'columns' => 
          array (
            'role' => 'userRole',
          ),
          'view' => 'views/user/fields/teams',
          'default' => 'javascript: return {teamsIds: []}',
        ),
        'roles' => 
        array (
          'type' => 'linkMultiple',
          'tooltip' => true,
        ),
        'portals' => 
        array (
          'type' => 'linkMultiple',
          'tooltip' => true,
        ),
        'portalRoles' => 
        array (
          'type' => 'linkMultiple',
          'tooltip' => true,
        ),
        'contact' => 
        array (
          'type' => 'link',
          'view' => 'views/user/fields/contact',
        ),
        'accounts' => 
        array (
          'type' => 'linkMultiple',
        ),
        'account' => 
        array (
          'type' => 'link',
          'notStorable' => true,
          'readOnly' => true,
        ),
        'portal' => 
        array (
          'type' => 'link',
          'notStorable' => true,
          'readOnly' => true,
        ),
        'avatar' => 
        array (
          'type' => 'image',
          'view' => 'views/user/fields/avatar',
          'previewSize' => 'small',
        ),
        'sendAccessInfo' => 
        array (
          'type' => 'bool',
          'notStorable' => true,
          'disabled' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
      ),
      'links' => 
      array (
        'defaultTeam' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Team',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'foreign' => 'users',
          'additionalColumns' => 
          array (
            'role' => 
            array (
              'type' => 'varchar',
              'len' => 100,
            ),
          ),
          'layoutRelationshipsDisabled' => true,
        ),
        'roles' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Role',
          'foreign' => 'users',
          'layoutRelationshipsDisabled' => true,
        ),
        'portals' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Portal',
          'foreign' => 'users',
          'layoutRelationshipsDisabled' => true,
        ),
        'portalRoles' => 
        array (
          'type' => 'hasMany',
          'entity' => 'PortalRole',
          'foreign' => 'users',
          'layoutRelationshipsDisabled' => true,
        ),
        'preferences' => 
        array (
          'type' => 'hasOne',
          'entity' => 'Preferences',
        ),
        'meetings' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Meeting',
          'foreign' => 'users',
        ),
        'calls' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Call',
          'foreign' => 'users',
        ),
        'emails' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Email',
          'foreign' => 'users',
        ),
        'notes' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Note',
          'foreign' => 'users',
        ),
        'contact' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Contact',
          'foreign' => 'portalUser',
        ),
        'accounts' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Account',
          'foreign' => 'portalUsers',
          'relationName' => 'AccountPortalUser',
        ),
        'targetLists' => 
        array (
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'users',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'userName',
        'asc' => true,
        'textFilterFields' => 
        array (
          0 => 'name',
          1 => 'userName',
        ),
      ),
    ),
    'Account' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'phoneNumber' => 
        array (
          'type' => 'phone',
          'typeList' => 
          array (
            0 => 'Office',
            1 => 'Fax',
            2 => 'Other',
          ),
          'defaultType' => 'Office',
        ),
        'type' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => '',
            1 => 'Customer',
            2 => 'Investor',
            3 => 'Partner',
            4 => 'Reseller',
          ),
          'default' => '',
        ),
        'industry' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => '',
            1 => 'Advertising',
            2 => 'Agriculture',
            3 => 'Apparel & Accessories',
            4 => 'Automotive',
            5 => 'Banking',
            6 => 'Biotechnology',
            7 => 'Building Materials & Equipment',
            8 => 'Chemical',
            9 => 'Computer',
            10 => 'Education',
            11 => 'Electronics',
            12 => 'Energy',
            13 => 'Entertainment & Leisure',
            14 => 'Finance',
            15 => 'Food & Beverage',
            16 => 'Grocery',
            17 => 'Healthcare',
            18 => 'Insurance',
            19 => 'Legal',
            20 => 'Manufacturing',
            21 => 'Publishing',
            22 => 'Real Estate',
            23 => 'Service',
            24 => 'Sports',
            25 => 'Software',
            26 => 'Technology',
            27 => 'Telecommunications',
            28 => 'Television',
            29 => 'Transportation',
            30 => 'Venture Capital',
          ),
          'default' => '',
          'isSorted' => true,
        ),
        'sicCode' => 
        array (
          'type' => 'varchar',
          'maxLength' => 40,
          'trim' => true,
        ),
        'balances' => 
        array (
          'type' => 'varchar',
          'maxLength' => 40,
          'trim' => true,
          'readOnly' => true,
        ),
        'blockedBalances' => 
        array (
          'type' => 'varchar',
          'maxLength' => 40,
          'trim' => true,
          'readOnly' => true,
        ),
        'openId' => 
        array (
          'type' => 'varchar',
          'trim' => true,
          'readOnly' => true,
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'parent' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'view' => 'views/fields/assigned-user',
        ),
        'targetLists' => 
        array (
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'importDisabled' => true,
          'noLoad' => true,
        ),
        'targetList' => 
        array (
          'type' => 'link',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutFiltersDisabled' => true,
          'entity' => 'TargetList',
        ),
      ),
      'links' => 
      array (
        'createdBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'parent' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Account',
        ),
        'modifiedBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'opportunities' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Opportunity',
          'foreign' => 'account',
        ),
        'cases' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Case',
          'foreign' => 'account',
        ),
        'documents' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Document',
          'foreign' => 'accounts',
        ),
        'meetingsPrimary' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Meeting',
          'foreign' => 'account',
          'layoutRelationshipsDisabled' => true,
        ),
        'emailsPrimary' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Email',
          'foreign' => 'account',
          'layoutRelationshipsDisabled' => true,
        ),
        'callsPrimary' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Call',
          'foreign' => 'account',
          'layoutRelationshipsDisabled' => true,
        ),
        'tasksPrimary' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Task',
          'foreign' => 'account',
          'layoutRelationshipsDisabled' => true,
        ),
        'meetings' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Meeting',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'calls' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Call',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'tasks' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Task',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'emails' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Email',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'targetLists' => 
        array (
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'accounts',
        ),
        'portalUsers' => 
        array (
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'accounts',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
      'indexes' => 
      array (
        'name' => 
        array (
          'columns' => 
          array (
            0 => 'name',
            1 => 'deleted',
          ),
        ),
        'assignedUser' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'Call' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Planned',
            1 => 'Held',
            2 => 'Not Held',
          ),
          'default' => 'Planned',
          'view' => 'Fields.EnumStyled',
          'style' => 
          array (
            'Held' => 'success',
          ),
          'audited' => true,
        ),
        'dateStart' => 
        array (
          'type' => 'datetime',
          'required' => true,
          'default' => 'javascript: return this.dateTime.getNow(15);',
          'audited' => true,
        ),
        'dateEnd' => 
        array (
          'type' => 'datetime',
          'required' => true,
          'after' => 'dateStart',
        ),
        'duration' => 
        array (
          'type' => 'duration',
          'start' => 'dateStart',
          'end' => 'dateEnd',
          'options' => 
          array (
            0 => 300,
            1 => 600,
            2 => 900,
            3 => 1800,
            4 => 2700,
            5 => 3600,
            6 => 7200,
          ),
          'default' => 300,
          'notStorable' => true,
        ),
        'reminders' => 
        array (
          'type' => 'jsonArray',
          'notStorable' => true,
          'view' => 'crm:views/meeting/fields/reminders',
        ),
        'direction' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Outbound',
            1 => 'Inbound',
          ),
          'default' => 'Outbound',
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'parent' => 
        array (
          'type' => 'linkParent',
          'entityList' => 
          array (
            0 => 'Account',
            1 => 'Lead',
            2 => 'Opportunity',
            3 => 'Case',
          ),
        ),
        'account' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'acceptanceStatus' => 
        array (
          'type' => 'enum',
          'notStorable' => true,
          'disabled' => true,
          'options' => 
          array (
            0 => 'None',
            1 => 'Accepted',
            2 => 'Tentative',
            3 => 'Declined',
          ),
        ),
        'users' => 
        array (
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'view' => 'crm:views/meeting/fields/users',
          'columns' => 
          array (
            'status' => 'acceptanceStatus',
          ),
        ),
        'contacts' => 
        array (
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'view' => 'crm:views/meeting/fields/contacts',
          'columns' => 
          array (
            'status' => 'acceptanceStatus',
          ),
        ),
        'leads' => 
        array (
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'view' => 'crm:views/meeting/fields/attendees',
          'columns' => 
          array (
            'status' => 'acceptanceStatus',
          ),
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'required' => true,
          'view' => 'views/fields/user',
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
      ),
      'links' => 
      array (
        'account' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Account',
        ),
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'users' => 
        array (
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'calls',
          'additionalColumns' => 
          array (
            'status' => 
            array (
              'type' => 'varchar',
              'len' => '36',
              'default' => 'None',
            ),
          ),
        ),
        'contacts' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'calls',
          'additionalColumns' => 
          array (
            'status' => 
            array (
              'type' => 'varchar',
              'len' => '36',
              'default' => 'None',
            ),
          ),
        ),
        'leads' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Lead',
          'foreign' => 'calls',
          'additionalColumns' => 
          array (
            'status' => 
            array (
              'type' => 'varchar',
              'len' => '36',
              'default' => 'None',
            ),
          ),
        ),
        'parent' => 
        array (
          'type' => 'belongsToParent',
          'foreign' => 'calls',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'dateStart',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'dateStartStatus' => 
        array (
          'columns' => 
          array (
            0 => 'dateStart',
            1 => 'status',
          ),
        ),
        'dateStart' => 
        array (
          'columns' => 
          array (
            0 => 'dateStart',
            1 => 'deleted',
          ),
        ),
        'status' => 
        array (
          'columns' => 
          array (
            0 => 'status',
            1 => 'deleted',
          ),
        ),
        'assignedUser' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'deleted',
          ),
        ),
        'assignedUserStatus' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'status',
          ),
        ),
      ),
    ),
    'Campaign' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Planning',
            1 => 'Active',
            2 => 'Inactive',
            3 => 'Complete',
          ),
          'default' => 'Planning',
        ),
        'type' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Email',
            1 => 'Newsletter',
            2 => 'Web',
            3 => 'Television',
            4 => 'Radio',
            5 => 'Mail',
          ),
          'default' => 'Email',
        ),
        'startDate' => 
        array (
          'type' => 'date',
        ),
        'endDate' => 
        array (
          'type' => 'date',
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'view' => 'views/fields/user',
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'targetLists' => 
        array (
          'type' => 'linkMultiple',
          'tooltip' => true,
        ),
        'excludingTargetLists' => 
        array (
          'type' => 'linkMultiple',
          'tooltip' => true,
        ),
        'sentCount' => 
        array (
          'type' => 'int',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'openedCount' => 
        array (
          'view' => 'crm:views/campaign/fields/int-with-percentage',
          'type' => 'int',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'clickedCount' => 
        array (
          'view' => 'crm:views/campaign/fields/int-with-percentage',
          'type' => 'int',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'optedOutCount' => 
        array (
          'view' => 'crm:views/campaign/fields/int-with-percentage',
          'type' => 'int',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'bouncedCount' => 
        array (
          'view' => 'crm:views/campaign/fields/int-with-percentage',
          'type' => 'int',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'hardBouncedCount' => 
        array (
          'type' => 'int',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'softBouncedCount' => 
        array (
          'type' => 'int',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'leadCreatedCount' => 
        array (
          'type' => 'int',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'openedPercentage' => 
        array (
          'type' => 'int',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'clickedPercentage' => 
        array (
          'type' => 'int',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'optedOutPercentage' => 
        array (
          'type' => 'int',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'bouncedPercentage' => 
        array (
          'type' => 'int',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'revenue' => 
        array (
          'type' => 'currency',
          'notStorable' => true,
          'readOnly' => true,
          'disabled' => true,
        ),
        'budget' => 
        array (
          'type' => 'currency',
        ),
        'revenueCurrency' => 
        array (
          'notStorable' => true,
          'readOnly' => true,
          'type' => 'varchar',
          'disabled' => true,
        ),
        'revenueConverted' => 
        array (
          'notStorable' => true,
          'readOnly' => true,
          'type' => 'currencyConverted',
        ),
        'budgetCurrency' => 
        array (
          'type' => 'varchar',
          'disabled' => true,
        ),
        'budgetConverted' => 
        array (
          'type' => 'currencyConverted',
          'readOnly' => true,
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'targetLists' => 
        array (
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'campaigns',
        ),
        'excludingTargetLists' => 
        array (
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'campaignsExcluding',
          'relationName' => 'campaignTargetListExcluding',
        ),
        'accounts' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Account',
          'foreign' => 'campaign',
        ),
        'contacts' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'campaign',
        ),
        'leads' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Lead',
          'foreign' => 'campaign',
        ),
        'opportunities' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Opportunity',
          'foreign' => 'campaign',
        ),
        'campaignLogRecords' => 
        array (
          'type' => 'hasMany',
          'entity' => 'CampaignLogRecord',
          'foreign' => 'campaign',
        ),
        'trackingUrls' => 
        array (
          'type' => 'hasMany',
          'entity' => 'CampaignTrackingUrl',
          'foreign' => 'campaign',
        ),
        'massEmails' => 
        array (
          'type' => 'hasMany',
          'entity' => 'MassEmail',
          'foreign' => 'campaign',
          'layoutRelationshipsDisabled' => true,
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'createdAt' => 
        array (
          'columns' => 
          array (
            0 => 'createdAt',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'CampaignLogRecord' => 
    array (
      'fields' => 
      array (
        'action' => 
        array (
          'type' => 'enum',
          'required' => true,
          'maxLength' => 50,
          'options' => 
          array (
            0 => 'Sent',
            1 => 'Opened',
            2 => 'Opted Out',
            3 => 'Bounced',
            4 => 'Clicked',
            5 => 'Lead Created',
          ),
        ),
        'actionDate' => 
        array (
          'type' => 'datetime',
          'required' => true,
        ),
        'data' => 
        array (
          'type' => 'jsonObject',
          'view' => 'crm:views/campaign-log-record/fields/data',
        ),
        'stringData' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
        ),
        'stringAdditionalData' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
        ),
        'application' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 36,
          'default' => 'Fox',
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
        ),
        'campaign' => 
        array (
          'type' => 'link',
        ),
        'parent' => 
        array (
          'type' => 'linkParent',
        ),
        'object' => 
        array (
          'type' => 'linkParent',
        ),
        'queueItem' => 
        array (
          'type' => 'link',
        ),
        'isTest' => 
        array (
          'type' => 'bool',
          'default' => false,
        ),
      ),
      'links' => 
      array (
        'createdBy' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'campaign' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'campaignLogRecords',
        ),
        'queueItem' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'EmailQueueItem',
          'noJoin' => true,
        ),
        'parent' => 
        array (
          'type' => 'belongsToParent',
          'entityList' => 
          array (
            0 => 'Account',
            1 => 'Contact',
            2 => 'Lead',
            3 => 'Opportunity',
            4 => 'User',
          ),
        ),
        'object' => 
        array (
          'type' => 'belongsToParent',
          'entityList' => 
          array (
            0 => 'Email',
          ),
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'actionDate',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'actionDate' => 
        array (
          'columns' => 
          array (
            0 => 'actionDate',
            1 => 'deleted',
          ),
        ),
        'action' => 
        array (
          'columns' => 
          array (
            0 => 'action',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'CampaignTrackingUrl' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'url' => 
        array (
          'type' => 'url',
          'required' => true,
        ),
        'urlToUse' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'readOnly' => true,
        ),
        'campaign' => 
        array (
          'type' => 'link',
          'required' => true,
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
        'campaign' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'trackingUrls',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
    ),
    'Case' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'number' => 
        array (
          'type' => 'autoincrement',
          'index' => true,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'New',
            1 => 'Assigned',
            2 => 'Pending',
            3 => 'Closed',
            4 => 'Rejected',
            5 => 'Duplicate',
          ),
          'default' => 'New',
          'view' => 'views/fields/enum-styled',
          'style' => 
          array (
            'Closed' => 'success',
            'Duplicate' => 'danger',
            'Rejected' => 'danger',
          ),
          'audited' => true,
        ),
        'priority' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Low',
            1 => 'Normal',
            2 => 'High',
            3 => 'Urgent',
          ),
          'default' => 'Normal',
          'audited' => true,
        ),
        'type' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => '',
            1 => 'Question',
            2 => 'Incident',
            3 => 'Problem',
          ),
          'audited' => true,
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'account' => 
        array (
          'type' => 'link',
        ),
        'contact' => 
        array (
          'type' => 'link',
          'view' => 'crm:views/case/fields/contact',
        ),
        'contacts' => 
        array (
          'type' => 'linkMultiple',
          'view' => 'crm:views/case/fields/contacts',
        ),
        'inboundEmail' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'view' => 'views/fields/user',
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'inboundEmail' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'InboundEmail',
        ),
        'account' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Account',
          'foreign' => 'cases',
        ),
        'contact' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Contact',
          'foreign' => 'casesPrimary',
        ),
        'contacts' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'cases',
          'layoutRelationshipsDisabled' => true,
        ),
        'meetings' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Meeting',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'calls' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Call',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'tasks' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Task',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'emails' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Email',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'articles' => 
        array (
          'type' => 'hasMany',
          'entity' => 'KnowledgeBaseArticle',
          'foreign' => 'cases',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'number',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'status' => 
        array (
          'columns' => 
          array (
            0 => 'status',
            1 => 'deleted',
          ),
        ),
        'assignedUser' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'deleted',
          ),
        ),
        'assignedUserStatus' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'status',
          ),
        ),
      ),
    ),
    'Contact' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'personName',
        ),
        'salutationName' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => '',
            1 => 'Mr.',
            2 => 'Mrs.',
            3 => 'Ms.',
            4 => 'Dr.',
          ),
        ),
        'firstName' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
          'default' => '',
        ),
        'lastName' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
          'required' => true,
          'default' => '',
        ),
        'accountId' => 
        array (
          'where' => 
          array (
            '=' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND account_id = {value})',
            'IN' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND account_id IN {value})',
            'NOT IN' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND account_id NOT IN {value})',
          ),
          'disabled' => true,
        ),
        'title' => 
        array (
          'type' => 'varchar',
          'maxLength' => 50,
          'notStorable' => true,
          'select' => 'accountContact.role',
          'orderBy' => 'accountContact.role {direction}',
          'where' => 
          array (
            'LIKE' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND role LIKE {value})',
            '=' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND role = {value})',
          ),
          'trim' => true,
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'emailAddress' => 
        array (
          'type' => 'email',
        ),
        'phoneNumber' => 
        array (
          'type' => 'phone',
          'typeList' => 
          array (
            0 => 'Mobile',
            1 => 'Office',
            2 => 'Home',
            3 => 'Fax',
            4 => 'Other',
          ),
          'defaultType' => 'Mobile',
        ),
        'doNotCall' => 
        array (
          'type' => 'bool',
        ),
        'address' => 
        array (
          'type' => 'address',
        ),
        'addressStreet' => 
        array (
          'type' => 'text',
          'maxLength' => 255,
          'dbType' => 'varchar',
        ),
        'addressCity' => 
        array (
          'type' => 'varchar',
        ),
        'addressState' => 
        array (
          'type' => 'varchar',
        ),
        'addressCountry' => 
        array (
          'type' => 'varchar',
        ),
        'addressPostalCode' => 
        array (
          'type' => 'varchar',
        ),
        'account' => 
        array (
          'type' => 'link',
        ),
        'accounts' => 
        array (
          'type' => 'linkMultiple',
          'view' => 'crm:views/contact/fields/accounts',
          'columns' => 
          array (
            'role' => 'contactRole',
          ),
        ),
        'accountRole' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'disabled' => true,
        ),
        'accountType' => 
        array (
          'type' => 'foreign',
          'link' => 'account',
          'field' => 'type',
        ),
        'opportunityRole' => 
        array (
          'type' => 'enum',
          'notStorable' => true,
          'disabled' => true,
          'options' => 
          array (
            0 => '',
            1 => 'Decision Maker',
            2 => 'Evaluator',
            3 => 'Influencer',
          ),
        ),
        'acceptanceStatus' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'disabled' => true,
        ),
        'campaign' => 
        array (
          'type' => 'link',
          'layoutListDisabled' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'view' => 'views/fields/assigned-user',
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'targetLists' => 
        array (
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'importDisabled' => true,
          'noLoad' => true,
        ),
        'targetList' => 
        array (
          'type' => 'link',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutFiltersDisabled' => true,
          'entity' => 'TargetList',
        ),
        'portalUser' => 
        array (
          'type' => 'link',
          'layoutMassUpdateDisabled' => true,
          'layoutListDisabled' => true,
          'readOnly' => true,
        ),
        'addressMap' => 
        array (
          'type' => 'map',
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'provider' => 'Google',
          'height' => 300,
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'account' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Account',
        ),
        'accounts' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Account',
          'foreign' => 'contacts',
          'additionalColumns' => 
          array (
            'role' => 
            array (
              'type' => 'varchar',
              'len' => 50,
            ),
          ),
          'layoutRelationshipsDisabled' => true,
        ),
        'opportunities' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Opportunity',
          'foreign' => 'contacts',
        ),
        'casesPrimary' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Case',
          'foreign' => 'contact',
          'layoutRelationshipsDisabled' => true,
        ),
        'cases' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Case',
          'foreign' => 'contacts',
        ),
        'meetings' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Meeting',
          'foreign' => 'contacts',
          'layoutRelationshipsDisabled' => true,
        ),
        'calls' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Call',
          'foreign' => 'contacts',
          'layoutRelationshipsDisabled' => true,
        ),
        'tasks' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Task',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'emails' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Email',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'campaign' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'contacts',
          'noJoin' => true,
        ),
        'campaignLogRecords' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'CampaignLogRecord',
          'foreign' => 'parent',
        ),
        'targetLists' => 
        array (
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'contacts',
        ),
        'portalUser' => 
        array (
          'type' => 'hasOne',
          'entity' => 'User',
          'foreign' => 'contact',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
        'textFilterFields' => 
        array (
          0 => 'name',
          1 => 'emailAddress',
        ),
      ),
      'indexes' => 
      array (
        'firstName' => 
        array (
          'columns' => 
          array (
            0 => 'firstName',
            1 => 'deleted',
          ),
        ),
        'name' => 
        array (
          'columns' => 
          array (
            0 => 'firstName',
            1 => 'lastName',
          ),
        ),
        'assignedUser' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'Document' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'view' => 'crm:views/document/fields/name',
          'trim' => true,
        ),
        'file' => 
        array (
          'type' => 'file',
          'required' => true,
          'view' => 'crm:views/document/fields/file',
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Active',
            1 => 'Draft',
            2 => 'Expired',
            3 => 'Canceled',
          ),
          'view' => 'views/fields/enum-styled',
          'style' => 
          array (
            'Canceled' => 'danger',
            'Expired' => 'danger',
          ),
        ),
        'source' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Fox',
          ),
          'default' => 'Fox',
        ),
        'type' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => '',
            1 => 'Contract',
            2 => 'NDA',
            3 => 'EULA',
            4 => 'License Agreement',
          ),
        ),
        'publishDate' => 
        array (
          'type' => 'date',
          'required' => true,
          'default' => 'javascript: return this.dateTime.getToday();',
        ),
        'expirationDate' => 
        array (
          'type' => 'date',
          'after' => 'publishDate',
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'view' => 'views/fields/user',
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'accounts' => 
        array (
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'importDisabled' => true,
          'noLoad' => true,
        ),
        'folder' => 
        array (
          'type' => 'link',
          'view' => 'views/fields/link-category-tree',
        ),
      ),
      'links' => 
      array (
        'accounts' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Account',
          'foreign' => 'documents',
        ),
        'opportunities' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Opportunity',
          'foreign' => 'documents',
        ),
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'folder' => 
        array (
          'type' => 'belongsTo',
          'foreign' => 'documents',
          'entity' => 'DocumentFolder',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
    ),
    'DocumentFolder' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'parent' => 
        array (
          'type' => 'link',
        ),
        'childList' => 
        array (
          'type' => 'jsonArray',
          'notStorable' => true,
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
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'parent' => 
        array (
          'type' => 'belongsTo',
          'foreign' => 'children',
          'entity' => 'DocumentFolder',
        ),
        'children' => 
        array (
          'type' => 'hasMany',
          'foreign' => 'parent',
          'entity' => 'DocumentFolder',
        ),
        'documents' => 
        array (
          'type' => 'hasMany',
          'foreign' => 'folder',
          'entity' => 'Document',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'parent',
        'asc' => true,
      ),
      'additionalTables' => 
      array (
        'DocumentFolderPath' => 
        array (
          'fields' => 
          array (
            'id' => 
            array (
              'type' => 'id',
              'dbType' => 'int',
              'len' => '11',
              'autoincrement' => true,
              'unique' => true,
            ),
            'ascendorId' => 
            array (
              'type' => 'varchar',
              'len' => '100',
              'index' => true,
            ),
            'descendorId' => 
            array (
              'type' => 'varchar',
              'len' => '24',
              'index' => true,
            ),
          ),
        ),
      ),
    ),
    'EmailQueueItem' => 
    array (
      'fields' => 
      array (
        'massEmail' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Pending',
            1 => 'Sent',
            2 => 'Failed',
          ),
          'readOnly' => true,
        ),
        'attemptCount' => 
        array (
          'type' => 'int',
          'readOnly' => true,
          'default' => 0,
        ),
        'target' => 
        array (
          'type' => 'linkParent',
          'readOnly' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'sentAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'emailAddress' => 
        array (
          'type' => 'varchar',
          'readOnly' => true,
        ),
        'isTest' => 
        array (
          'type' => 'bool',
        ),
      ),
      'links' => 
      array (
        'massEmail' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'MassEmail',
          'foreign' => 'queueItems',
        ),
        'target' => 
        array (
          'type' => 'belongsToParent',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
    ),
    'KnowledgeBaseArticle' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Draft',
            1 => 'In Review',
            2 => 'Published',
            3 => 'Archived',
          ),
          'view' => 'crm:views/knowledge-base-article/fields/status',
          'default' => 'Draft',
        ),
        'language' => 
        array (
          'type' => 'enum',
          'view' => 'crm:views/knowledge-base-article/fields/language',
          'default' => '',
        ),
        'type' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Article',
          ),
        ),
        'portals' => 
        array (
          'type' => 'linkMultiple',
          'tooltip' => true,
        ),
        'publishDate' => 
        array (
          'type' => 'date',
        ),
        'expirationDate' => 
        array (
          'type' => 'date',
          'after' => 'publishDate',
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'categories' => 
        array (
          'type' => 'linkMultiple',
          'view' => 'views/fields/link-multiple-category-tree',
        ),
        'attachments' => 
        array (
          'type' => 'attachmentMultiple',
        ),
        'body' => 
        array (
          'type' => 'wysiwyg',
        ),
      ),
      'links' => 
      array (
        'cases' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Case',
          'foreign' => 'articles',
        ),
        'portals' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Portal',
          'foreign' => 'articles',
        ),
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'categories' => 
        array (
          'type' => 'hasMany',
          'foreign' => 'articles',
          'entity' => 'KnowledgeBaseCategory',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'name',
        'asc' => true,
      ),
    ),
    'KnowledgeBaseCategory' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'order' => 
        array (
          'type' => 'int',
          'required' => true,
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'parent' => 
        array (
          'type' => 'link',
        ),
        'childList' => 
        array (
          'type' => 'jsonArray',
          'notStorable' => true,
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
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'parent' => 
        array (
          'type' => 'belongsTo',
          'foreign' => 'children',
          'entity' => 'KnowledgeBaseCategory',
        ),
        'children' => 
        array (
          'type' => 'hasMany',
          'foreign' => 'parent',
          'entity' => 'KnowledgeBaseCategory',
        ),
        'articles' => 
        array (
          'type' => 'hasMany',
          'foreign' => 'categories',
          'entity' => 'KnowledgeBaseArticle',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'parent',
        'asc' => true,
      ),
      'additionalTables' => 
      array (
        'KnowledgeBaseCategoryPath' => 
        array (
          'fields' => 
          array (
            'id' => 
            array (
              'type' => 'id',
              'dbType' => 'int',
              'len' => '11',
              'autoincrement' => true,
              'unique' => true,
            ),
            'ascendorId' => 
            array (
              'type' => 'varchar',
              'len' => '100',
              'index' => true,
            ),
            'descendorId' => 
            array (
              'type' => 'varchar',
              'len' => '24',
              'index' => true,
            ),
          ),
        ),
      ),
    ),
    'Lead' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'personName',
        ),
        'salutationName' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => '',
            1 => 'Mr.',
            2 => 'Mrs.',
            3 => 'Ms.',
            4 => 'Dr.',
          ),
        ),
        'firstName' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
          'default' => '',
        ),
        'lastName' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
          'required' => true,
          'default' => '',
        ),
        'title' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'New',
            1 => 'Assigned',
            2 => 'In Process',
            3 => 'Converted',
            4 => 'Recycled',
            5 => 'Dead',
          ),
          'default' => 'New',
          'view' => 'views/fields/enum-styled',
          'style' => 
          array (
            'Converted' => 'success',
            'Recycled' => 'danger',
            'Dead' => 'danger',
          ),
          'audited' => true,
        ),
        'source' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => '',
            1 => 'Call',
            2 => 'Email',
            3 => 'Existing Customer',
            4 => 'Partner',
            5 => 'Public Relations',
            6 => 'Web Site',
            7 => 'Campaign',
            8 => 'Other',
          ),
          'default' => '',
        ),
        'opportunityAmount' => 
        array (
          'type' => 'currency',
          'audited' => true,
        ),
        'opportunityAmountConverted' => 
        array (
          'type' => 'currencyConverted',
          'readOnly' => true,
        ),
        'website' => 
        array (
          'type' => 'url',
        ),
        'address' => 
        array (
          'type' => 'address',
        ),
        'addressStreet' => 
        array (
          'type' => 'text',
          'maxLength' => 255,
          'dbType' => 'varchar',
        ),
        'addressCity' => 
        array (
          'type' => 'varchar',
        ),
        'addressState' => 
        array (
          'type' => 'varchar',
        ),
        'addressCountry' => 
        array (
          'type' => 'varchar',
        ),
        'addressPostalCode' => 
        array (
          'type' => 'varchar',
        ),
        'emailAddress' => 
        array (
          'type' => 'email',
        ),
        'phoneNumber' => 
        array (
          'type' => 'phone',
          'typeList' => 
          array (
            0 => 'Mobile',
            1 => 'Office',
            2 => 'Home',
            3 => 'Fax',
            4 => 'Other',
          ),
          'defaultType' => 'Mobile',
        ),
        'doNotCall' => 
        array (
          'type' => 'bool',
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'accountName' => 
        array (
          'type' => 'varchar',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'view' => 'views/fields/user',
        ),
        'acceptanceStatus' => 
        array (
          'type' => 'varchar',
          'notStorable' => true,
          'disabled' => true,
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'campaign' => 
        array (
          'type' => 'link',
          'layoutListDisabled' => true,
        ),
        'createdAccount' => 
        array (
          'type' => 'link',
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
        ),
        'createdContact' => 
        array (
          'type' => 'link',
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
        ),
        'createdOpportunity' => 
        array (
          'type' => 'link',
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
        ),
        'targetLists' => 
        array (
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'importDisabled' => true,
          'noLoad' => true,
        ),
        'targetList' => 
        array (
          'type' => 'link',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutFiltersDisabled' => true,
          'entity' => 'TargetList',
        ),
        'opportunityAmountCurrency' => 
        array (
          'type' => 'varchar',
          'disabled' => true,
        ),
        'addressMap' => 
        array (
          'type' => 'map',
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'provider' => 'Google',
          'height' => 300,
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'opportunities' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Opportunity',
          'foreign' => 'leads',
        ),
        'meetings' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Meeting',
          'foreign' => 'leads',
          'layoutRelationshipsDisabled' => true,
        ),
        'calls' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Call',
          'foreign' => 'leads',
          'layoutRelationshipsDisabled' => true,
        ),
        'tasks' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Task',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'emails' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Email',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'createdAccount' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Account',
          'noJoin' => true,
        ),
        'createdContact' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Contact',
          'noJoin' => true,
        ),
        'createdOpportunity' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Opportunity',
          'noJoin' => true,
        ),
        'campaign' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'leads',
          'noJoin' => true,
        ),
        'campaignLogRecords' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'CampaignLogRecord',
          'foreign' => 'parent',
        ),
        'targetLists' => 
        array (
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'leads',
        ),
      ),
      'convertEntityList' => 
      array (
        0 => 'Account',
        1 => 'Contact',
        2 => 'Opportunity',
      ),
      'convertFields' => 
      array (
        'Contact' => 
        array (
        ),
        'Account' => 
        array (
          'name' => 'accountName',
          'billingAddressStreet' => 'addressStreet',
          'billingAddressCity' => 'addressCity',
          'billingAddressState' => 'addressState',
          'billingAddressPostalCode' => 'addressPostalCode',
          'billingAddressCountry' => 'addressCountry',
        ),
        'Opportunity' => 
        array (
          'amount' => 'opportunityAmount',
          'leadSource' => 'source',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
        'textFilterFields' => 
        array (
          0 => 'name',
          1 => 'accountName',
          2 => 'emailAddress',
        ),
      ),
      'indexes' => 
      array (
        'firstName' => 
        array (
          'columns' => 
          array (
            0 => 'firstName',
            1 => 'deleted',
          ),
        ),
        'name' => 
        array (
          'columns' => 
          array (
            0 => 'firstName',
            1 => 'lastName',
          ),
        ),
        'status' => 
        array (
          'columns' => 
          array (
            0 => 'status',
            1 => 'deleted',
          ),
        ),
        'createdAt' => 
        array (
          'columns' => 
          array (
            0 => 'createdAt',
            1 => 'deleted',
          ),
        ),
        'createdAtStatus' => 
        array (
          'columns' => 
          array (
            0 => 'createdAt',
            1 => 'status',
          ),
        ),
        'assignedUser' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'deleted',
          ),
        ),
        'assignedUserStatus' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'status',
          ),
        ),
      ),
    ),
    'MassEmail' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Draft',
            1 => 'Pending',
          ),
          'default' => 'Pending',
        ),
        'storeSentEmails' => 
        array (
          'type' => 'bool',
          'default' => false,
        ),
        'optOutEntirely' => 
        array (
          'type' => 'bool',
          'default' => false,
          'tooltip' => true,
        ),
        'fromAddress' => 
        array (
          'type' => 'varchar',
          'trim' => true,
          'view' => 'crm:views/mass-email/fields/from-address',
        ),
        'fromName' => 
        array (
          'type' => 'varchar',
        ),
        'replyToAddress' => 
        array (
          'type' => 'varchar',
          'trim' => true,
        ),
        'replyToName' => 
        array (
          'type' => 'varchar',
        ),
        'startAt' => 
        array (
          'type' => 'datetime',
          'required' => true,
        ),
        'emailTemplate' => 
        array (
          'type' => 'link',
          'required' => true,
          'view' => 'crm:views/mass-email/fields/email-template',
        ),
        'campaign' => 
        array (
          'type' => 'link',
        ),
        'targetLists' => 
        array (
          'type' => 'linkMultiple',
          'required' => true,
          'tooltip' => true,
        ),
        'excludingTargetLists' => 
        array (
          'type' => 'linkMultiple',
          'tooltip' => true,
        ),
        'inboundEmail' => 
        array (
          'type' => 'link',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'createdBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
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
        'emailTemplate' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'EmailTemplate',
        ),
        'campaign' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'massEmails',
        ),
        'targetLists' => 
        array (
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'massEmails',
        ),
        'excludingTargetLists' => 
        array (
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'massEmailsExcluding',
          'relationName' => 'massEmailTargetListExcluding',
        ),
        'inboundEmail' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'InboundEmail',
        ),
        'queueItems' => 
        array (
          'type' => 'hasMany',
          'entity' => 'EmailQueueItem',
          'foreign' => 'massEmail',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
    ),
    'Meeting' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Planned',
            1 => 'Held',
            2 => 'Not Held',
          ),
          'default' => 'Planned',
          'view' => 'views/fields/enum-styled',
          'style' => 
          array (
            'Held' => 'success',
          ),
          'audited' => true,
        ),
        'dateStart' => 
        array (
          'type' => 'datetime',
          'required' => true,
          'default' => 'javascript: return this.dateTime.getNow(15);',
          'audited' => true,
        ),
        'dateEnd' => 
        array (
          'type' => 'datetime',
          'required' => true,
          'after' => 'dateStart',
        ),
        'duration' => 
        array (
          'type' => 'duration',
          'start' => 'dateStart',
          'end' => 'dateEnd',
          'options' => 
          array (
            0 => 900,
            1 => 1800,
            2 => 3600,
            3 => 7200,
            4 => 10800,
            5 => 86400,
          ),
          'default' => 3600,
          'notStorable' => true,
        ),
        'reminders' => 
        array (
          'type' => 'jsonArray',
          'notStorable' => true,
          'view' => 'crm:views/meeting/fields/reminders',
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'parent' => 
        array (
          'type' => 'linkParent',
          'entityList' => 
          array (
            0 => 'Account',
            1 => 'Lead',
            2 => 'Opportunity',
            3 => 'Case',
          ),
        ),
        'account' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'acceptanceStatus' => 
        array (
          'type' => 'enum',
          'notStorable' => true,
          'disabled' => true,
          'options' => 
          array (
            0 => 'None',
            1 => 'Accepted',
            2 => 'Tentative',
            3 => 'Declined',
          ),
        ),
        'users' => 
        array (
          'type' => 'linkMultiple',
          'view' => 'crm:views/meeting/fields/users',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'columns' => 
          array (
            'status' => 'acceptanceStatus',
          ),
        ),
        'contacts' => 
        array (
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'view' => 'crm:views/meeting/fields/contacts',
          'columns' => 
          array (
            'status' => 'acceptanceStatus',
          ),
        ),
        'leads' => 
        array (
          'type' => 'linkMultiple',
          'view' => 'crm:views/meeting/fields/attendees',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'columns' => 
          array (
            'status' => 'acceptanceStatus',
          ),
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'required' => true,
          'view' => 'views/fields/user',
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
      ),
      'links' => 
      array (
        'account' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Account',
        ),
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'users' => 
        array (
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'meetings',
          'additionalColumns' => 
          array (
            'status' => 
            array (
              'type' => 'varchar',
              'len' => '36',
              'default' => 'None',
            ),
          ),
        ),
        'contacts' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'meetings',
          'additionalColumns' => 
          array (
            'status' => 
            array (
              'type' => 'varchar',
              'len' => '36',
              'default' => 'None',
            ),
          ),
        ),
        'leads' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Lead',
          'foreign' => 'meetings',
          'additionalColumns' => 
          array (
            'status' => 
            array (
              'type' => 'varchar',
              'len' => '36',
              'default' => 'None',
            ),
          ),
        ),
        'parent' => 
        array (
          'type' => 'belongsToParent',
          'foreign' => 'meetings',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'dateStart',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'dateStartStatus' => 
        array (
          'columns' => 
          array (
            0 => 'dateStart',
            1 => 'status',
          ),
        ),
        'dateStart' => 
        array (
          'columns' => 
          array (
            0 => 'dateStart',
            1 => 'deleted',
          ),
        ),
        'status' => 
        array (
          'columns' => 
          array (
            0 => 'status',
            1 => 'deleted',
          ),
        ),
        'assignedUser' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'deleted',
          ),
        ),
        'assignedUserStatus' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'status',
          ),
        ),
      ),
    ),
    'Opportunity' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'amount' => 
        array (
          'type' => 'currency',
          'required' => true,
          'audited' => true,
        ),
        'amountConverted' => 
        array (
          'type' => 'currencyConverted',
          'readOnly' => true,
        ),
        'amountWeightedConverted' => 
        array (
          'type' => 'float',
          'readOnly' => true,
          'notStorable' => true,
          'select' => 'opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100',
          'where' => 
          array (
            '=' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) = {value}',
            '<' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) < {value}',
            '>' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) > {value}',
            '<=' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) <= {value}',
            '>=' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) >= {value}',
            '<>' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) <> {value}',
          ),
          'orderBy' => 'amountWeightedConverted {direction}',
          'view' => 'views/fields/currency-converted',
        ),
        'account' => 
        array (
          'type' => 'link',
        ),
        'contacts' => 
        array (
          'type' => 'linkMultiple',
          'view' => 'crm:views/opportunity/fields/contacts',
          'columns' => 
          array (
            'role' => 'opportunityRole',
          ),
        ),
        'stage' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Prospecting',
            1 => 'Qualification',
            2 => 'Needs Analysis',
            3 => 'Value Proposition',
            4 => 'Id. Decision Makers',
            5 => 'Perception Analysis',
            6 => 'Proposal/Price Quote',
            7 => 'Negotiation/Review',
            8 => 'Closed Won',
            9 => 'Closed Lost',
          ),
          'view' => 'crm:views/opportunity/fields/stage',
          'default' => 'Prospecting',
          'audited' => true,
        ),
        'probability' => 
        array (
          'type' => 'int',
          'required' => true,
          'min' => 0,
          'max' => 100,
        ),
        'leadSource' => 
        array (
          'type' => 'enum',
          'view' => 'crm:views/opportunity/fields/lead-source',
          'customizationOptionsDisabled' => true,
          'default' => '',
        ),
        'closeDate' => 
        array (
          'type' => 'date',
          'required' => true,
          'audited' => true,
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'campaign' => 
        array (
          'type' => 'link',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'required' => false,
          'view' => 'views/fields/user',
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'amountCurrency' => 
        array (
          'type' => 'varchar',
          'disabled' => true,
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'account' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Account',
          'foreign' => 'opportunities',
        ),
        'contacts' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'opportunities',
          'additionalColumns' => 
          array (
            'role' => 
            array (
              'type' => 'varchar',
              'len' => 50,
            ),
          ),
        ),
        'meetings' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Meeting',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'calls' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Call',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'tasks' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Task',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'emails' => 
        array (
          'type' => 'hasChildren',
          'entity' => 'Email',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
        ),
        'documents' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Document',
          'foreign' => 'opportunities',
        ),
        'campaign' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'opportunities',
          'noJoin' => true,
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
      'probabilityMap' => 
      array (
        'Prospecting' => 10,
        'Qualification' => 10,
        'Needs Analysis' => 20,
        'Value Proposition' => 50,
        'Id. Decision Makers' => 60,
        'Perception Analysis' => 70,
        'Proposal/Price Quote' => 75,
        'Negotiation/Review' => 90,
        'Closed Won' => 100,
        'Closed Lost' => 0,
      ),
      'indexes' => 
      array (
        'stage' => 
        array (
          'columns' => 
          array (
            0 => 'stage',
            1 => 'deleted',
          ),
        ),
        'assignedUser' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'deleted',
          ),
        ),
        'createdAt' => 
        array (
          'columns' => 
          array (
            0 => 'createdAt',
            1 => 'deleted',
          ),
        ),
        'createdAtStage' => 
        array (
          'columns' => 
          array (
            0 => 'createdAt',
            1 => 'stage',
          ),
        ),
        'assignedUserStage' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'stage',
          ),
        ),
      ),
    ),
    'Reminder' => 
    array (
      'fields' => 
      array (
        'remindAt' => 
        array (
          'type' => 'datetime',
          'index' => true,
        ),
        'startAt' => 
        array (
          'type' => 'datetime',
          'index' => true,
        ),
        'type' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Popup',
            1 => 'Email',
          ),
          'maxLength' => 36,
          'index' => true,
          'default' => 'Popup',
        ),
        'seconds' => 
        array (
          'type' => 'enumInt',
          'options' => 
          array (
            0 => 0,
            1 => 60,
            2 => 120,
            3 => 300,
            4 => 600,
            5 => 900,
            6 => 1800,
            7 => 3600,
            8 => 7200,
            9 => 10800,
            10 => 18000,
            11 => 86400,
          ),
          'default' => 0,
        ),
        'entityType' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
        ),
        'entityId' => 
        array (
          'type' => 'varchar',
          'maxLength' => 50,
        ),
        'userId' => 
        array (
          'type' => 'varchar',
          'maxLength' => 50,
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'remindAt',
        'asc' => false,
      ),
    ),
    'Target' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'personName',
        ),
        'salutationName' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => '',
            1 => 'Mr.',
            2 => 'Mrs.',
            3 => 'Ms.',
            4 => 'Dr.',
            5 => 'Drs.',
          ),
        ),
        'firstName' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
          'default' => '',
        ),
        'lastName' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
          'required' => true,
          'default' => '',
        ),
        'title' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
        ),
        'accountName' => 
        array (
          'type' => 'varchar',
          'maxLength' => 100,
        ),
        'website' => 
        array (
          'type' => 'url',
        ),
        'address' => 
        array (
          'type' => 'address',
        ),
        'addressStreet' => 
        array (
          'type' => 'text',
          'maxLength' => 255,
          'dbType' => 'varchar',
        ),
        'addressCity' => 
        array (
          'type' => 'varchar',
        ),
        'addressState' => 
        array (
          'type' => 'varchar',
        ),
        'addressCountry' => 
        array (
          'type' => 'varchar',
        ),
        'addressPostalCode' => 
        array (
          'type' => 'varchar',
        ),
        'emailAddress' => 
        array (
          'type' => 'email',
        ),
        'phoneNumber' => 
        array (
          'type' => 'phone',
          'typeList' => 
          array (
            0 => 'Mobile',
            1 => 'Office',
            2 => 'Home',
            3 => 'Fax',
            4 => 'Other',
          ),
          'defaultType' => 'Mobile',
        ),
        'doNotCall' => 
        array (
          'type' => 'bool',
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'view' => 'views/fields/user',
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'addressMap' => 
        array (
          'type' => 'map',
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'provider' => 'Google',
          'height' => 300,
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'firstName' => 
        array (
          'columns' => 
          array (
            0 => 'firstName',
            1 => 'deleted',
          ),
        ),
        'name' => 
        array (
          'columns' => 
          array (
            0 => 'firstName',
            1 => 'lastName',
          ),
        ),
        'assignedUser' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'TargetList' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'entryCount' => 
        array (
          'type' => 'int',
          'readOnly' => true,
          'notStorable' => true,
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'view' => 'views/fields/user',
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'campaigns' => 
        array (
          'type' => 'link',
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'campaigns' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Campaign',
          'foreign' => 'targetLists',
        ),
        'massEmails' => 
        array (
          'type' => 'hasMany',
          'entity' => 'MassEmail',
          'foreign' => 'targetLists',
        ),
        'campaignsExcluding' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Campaign',
          'foreign' => 'excludingTargetLists',
        ),
        'massEmailsExcluding' => 
        array (
          'type' => 'hasMany',
          'entity' => 'MassEmail',
          'foreign' => 'excludingTargetLists',
        ),
        'accounts' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Account',
          'foreign' => 'targetLists',
          'additionalColumns' => 
          array (
            'optedOut' => 
            array (
              'type' => 'bool',
            ),
          ),
        ),
        'contacts' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'targetLists',
          'additionalColumns' => 
          array (
            'optedOut' => 
            array (
              'type' => 'bool',
            ),
          ),
        ),
        'leads' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Lead',
          'foreign' => 'targetLists',
          'additionalColumns' => 
          array (
            'optedOut' => 
            array (
              'type' => 'bool',
            ),
          ),
        ),
        'users' => 
        array (
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'targetLists',
          'additionalColumns' => 
          array (
            'optedOut' => 
            array (
              'type' => 'bool',
            ),
          ),
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'createdAt' => 
        array (
          'columns' => 
          array (
            0 => 'createdAt',
            1 => 'deleted',
          ),
        ),
      ),
    ),
    'Task' => 
    array (
      'fields' => 
      array (
        'name' => 
        array (
          'type' => 'varchar',
          'required' => true,
          'trim' => true,
        ),
        'status' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Not Started',
            1 => 'Started',
            2 => 'Completed',
            3 => 'Canceled',
            4 => 'Deferred',
          ),
          'view' => 'views/fields/enum-styled',
          'style' => 
          array (
            'Completed' => 'success',
          ),
          'default' => 'Not Started',
          'audited' => true,
        ),
        'priority' => 
        array (
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Low',
            1 => 'Normal',
            2 => 'High',
            3 => 'Urgent',
          ),
          'default' => 'Normal',
          'audited' => true,
        ),
        'dateStart' => 
        array (
          'type' => 'datetimeOptional',
          'before' => 'dateEnd',
        ),
        'dateEnd' => 
        array (
          'type' => 'datetimeOptional',
          'after' => 'dateStart',
          'view' => 'crm:views/task/fields/date-end',
          'audited' => true,
        ),
        'dateStartDate' => 
        array (
          'type' => 'date',
          'disabled' => true,
        ),
        'dateEndDate' => 
        array (
          'type' => 'date',
          'disabled' => true,
        ),
        'dateCompleted' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'isOverdue' => 
        array (
          'type' => 'bool',
          'readOnly' => true,
          'notStorable' => true,
          'view' => 'crm:views/task/fields/is-overdue',
          'disabled' => true,
        ),
        'description' => 
        array (
          'type' => 'text',
        ),
        'parent' => 
        array (
          'type' => 'linkParent',
          'entityList' => 
          array (
            0 => 'Account',
            1 => 'Contact',
            2 => 'Lead',
            3 => 'Opportunity',
            4 => 'Case',
          ),
        ),
        'account' => 
        array (
          'type' => 'link',
          'readOnly' => true,
        ),
        'createdAt' => 
        array (
          'type' => 'datetime',
          'readOnly' => true,
        ),
        'modifiedAt' => 
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
        'modifiedBy' => 
        array (
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
        ),
        'assignedUser' => 
        array (
          'type' => 'link',
          'required' => true,
          'view' => 'views/fields/user',
        ),
        'teams' => 
        array (
          'type' => 'linkMultiple',
        ),
        'attachments' => 
        array (
          'type' => 'attachmentMultiple',
          'sourceList' => 
          array (
            0 => 'Document',
          ),
          'layoutListDisabled' => true,
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
        'assignedUser' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'User',
        ),
        'teams' => 
        array (
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true,
        ),
        'parent' => 
        array (
          'type' => 'belongsToParent',
          'foreign' => 'tasks',
        ),
        'account' => 
        array (
          'type' => 'belongsTo',
          'entity' => 'Account',
        ),
      ),
      'collection' => 
      array (
        'sortBy' => 'createdAt',
        'asc' => false,
      ),
      'indexes' => 
      array (
        'dateStartStatus' => 
        array (
          'columns' => 
          array (
            0 => 'dateStart',
            1 => 'status',
          ),
        ),
        'dateEndStatus' => 
        array (
          'columns' => 
          array (
            0 => 'dateEnd',
            1 => 'status',
          ),
        ),
        'dateStart' => 
        array (
          'columns' => 
          array (
            0 => 'dateStart',
            1 => 'deleted',
          ),
        ),
        'dateEnd' => 
        array (
          'columns' => 
          array (
            0 => 'dateStart',
            1 => 'deleted',
          ),
        ),
        'status' => 
        array (
          'columns' => 
          array (
            0 => 'status',
            1 => 'deleted',
          ),
        ),
        'assignedUser' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'deleted',
          ),
        ),
        'assignedUserStatus' => 
        array (
          'columns' => 
          array (
            0 => 'assignedUserId',
            1 => 'status',
          ),
        ),
      ),
    ),
  ),
  'fields' => 
  array (
    'address' => 
    array (
      'actualFields' => 
      array (
        0 => 'street',
        1 => 'city',
        2 => 'state',
        3 => 'country',
        4 => 'postalCode',
      ),
      'fields' => 
      array (
        'street' => 
        array (
          'type' => 'text',
          'maxLength' => 255,
          'dbType' => 'varchar',
        ),
        'city' => 
        array (
          'type' => 'varchar',
        ),
        'state' => 
        array (
          'type' => 'varchar',
        ),
        'country' => 
        array (
          'type' => 'varchar',
        ),
        'postalCode' => 
        array (
          'type' => 'varchar',
        ),
        'map' => 
        array (
          'type' => 'map',
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'provider' => 'Google',
          'height' => 300,
        ),
      ),
      'mergable' => false,
      'notCreatable' => false,
      'filter' => true,
      'fieldDefs' => 
      array (
        'skipOrmDefs' => true,
      ),
    ),
    'array' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'options',
          'type' => 'array',
        ),
        2 => 
        array (
          'name' => 'translation',
          'type' => 'varchar',
          'hidden' => true,
        ),
        3 => 
        array (
          'name' => 'noEmptyString',
          'type' => 'bool',
          'default' => false,
        ),
      ),
      'filter' => true,
      'notCreatable' => false,
      'fieldDefs' => 
      array (
        'type' => 'jsonArray',
      ),
    ),
    'arrayInt' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'options',
          'type' => 'arrayInt',
        ),
        2 => 
        array (
          'name' => 'translation',
          'type' => 'varchar',
          'hidden' => true,
        ),
        3 => 
        array (
          'name' => 'noEmptyString',
          'type' => 'bool',
          'default' => false,
        ),
      ),
      'filter' => true,
      'notCreatable' => true,
      'fieldDefs' => 
      array (
        'type' => 'jsonArray',
      ),
    ),
    'attachmentMultiple' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'sourceList',
          'type' => 'multiEnum',
          'view' => 'views/admin/field-manager/fields/source-list',
        ),
      ),
      'actualFields' => 
      array (
        0 => 'ids',
      ),
      'notActualFields' => 
      array (
        0 => 'names',
      ),
      'linkDefs' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Attachment',
        'foreign' => 'parent',
        'layoutRelationshipsDisabled' => true,
        'relationName' => 'attachments',
      ),
      'filter' => false,
      'fieldDefs' => 
      array (
        'layoutListDisabled' => true,
      ),
    ),
    'autoincrement' => 
    array (
      'params' => 
      array (
      ),
      'notCreatable' => false,
      'filter' => true,
      'fieldDefs' => 
      array (
        'type' => 'int',
        'autoincrement' => true,
        'unique' => true,
      ),
    ),
    'base' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
        ),
      ),
      'filter' => false,
      'notCreatable' => true,
      'fieldDefs' => 
      array (
        'notStorable' => true,
      ),
    ),
    'bool' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'default',
          'type' => 'bool',
        ),
        1 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'filter' => true,
    ),
    'currency' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'min',
          'type' => 'float',
        ),
        2 => 
        array (
          'name' => 'max',
          'type' => 'float',
        ),
        3 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'actualFields' => 
      array (
        0 => 'currency',
        1 => '',
      ),
      'fields' => 
      array (
        'currency' => 
        array (
          'type' => 'varchar',
          'disabled' => true,
        ),
        'converted' => 
        array (
          'type' => 'currencyConverted',
          'readOnly' => true,
        ),
      ),
      'filter' => true,
    ),
    'currencyConverted' => 
    array (
      'params' => 
      array (
      ),
      'filter' => true,
      'notCreatable' => true,
      'fieldDefs' => 
      array (
        'skipOrmDefs' => true,
      ),
    ),
    'date' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'default',
          'type' => 'varchar',
        ),
        2 => 
        array (
          'name' => 'after',
          'type' => 'varchar',
        ),
        3 => 
        array (
          'name' => 'before',
          'type' => 'varchar',
        ),
        4 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'filter' => true,
      'fieldDefs' => 
      array (
        'notNull' => false,
      ),
    ),
    'datetime' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'default',
          'type' => 'varchar',
        ),
        2 => 
        array (
          'name' => 'after',
          'type' => 'varchar',
        ),
        3 => 
        array (
          'name' => 'before',
          'type' => 'varchar',
        ),
        4 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'filter' => true,
      'fieldDefs' => 
      array (
        'notNull' => false,
      ),
    ),
    'datetimeOptional' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'default',
          'type' => 'varchar',
        ),
        2 => 
        array (
          'name' => 'after',
          'type' => 'varchar',
        ),
        3 => 
        array (
          'name' => 'before',
          'type' => 'varchar',
        ),
        4 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'actualFields' => 
      array (
        0 => '',
        1 => 'date',
      ),
      'fields' => 
      array (
        'date' => 
        array (
          'type' => 'date',
          'disabled' => true,
        ),
      ),
      'filter' => true,
      'notCreatable' => true,
      'fieldDefs' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'view' => 'Fields.DatetimeOptional',
    ),
    'duration' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'default',
          'type' => 'int',
        ),
        1 => 
        array (
          'name' => 'options',
          'type' => 'arrayInt',
        ),
      ),
      'notCreatable' => true,
      'fieldDefs' => 
      array (
        'type' => 'int',
      ),
    ),
    'email' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
      ),
      'notActualFields' => 
      array (
        0 => 'data',
      ),
      'notCreatable' => true,
      'filter' => true,
      'fieldDefs' => 
      array (
        'notStorable' => true,
      ),
    ),
    'enum' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'options',
          'type' => 'array',
          'view' => 'views/admin/field-manager/fields/options',
        ),
        2 => 
        array (
          'name' => 'default',
          'type' => 'varchar',
        ),
        3 => 
        array (
          'name' => 'isSorted',
          'type' => 'bool',
        ),
        4 => 
        array (
          'name' => 'translation',
          'type' => 'varchar',
          'hidden' => true,
        ),
        5 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'filter' => true,
      'fieldDefs' => 
      array (
        'type' => 'varchar',
      ),
    ),
    'enumFloat' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'options',
          'type' => 'array',
        ),
        1 => 
        array (
          'name' => 'default',
          'type' => 'float',
        ),
      ),
      'filter' => true,
      'notCreatable' => true,
      'fieldDefs' => 
      array (
        'type' => 'float',
      ),
    ),
    'enumInt' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'options',
          'type' => 'array',
        ),
        1 => 
        array (
          'name' => 'default',
          'type' => 'int',
        ),
      ),
      'filter' => true,
      'notCreatable' => true,
      'fieldDefs' => 
      array (
        'type' => 'int',
      ),
    ),
    'file' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
      ),
      'actualFields' => 
      array (
        0 => 'id',
      ),
      'notActualFields' => 
      array (
        0 => 'name',
      ),
      'filter' => false,
      'linkDefs' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Attachment',
      ),
      'fieldDefs' => 
      array (
        'skipOrmDefs' => true,
      ),
    ),
    'float' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'default',
          'type' => 'float',
        ),
        2 => 
        array (
          'name' => 'min',
          'type' => 'float',
        ),
        3 => 
        array (
          'name' => 'max',
          'type' => 'float',
        ),
        4 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'filter' => true,
      'fieldDefs' => 
      array (
        'notNull' => false,
      ),
    ),
    'foreign' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'link',
          'type' => 'varchar',
        ),
        1 => 
        array (
          'name' => 'field',
          'type' => 'varchar',
        ),
      ),
      'filter' => true,
      'notCreatable' => true,
    ),
    'image' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'previewSize',
          'type' => 'enum',
          'default' => 'small',
          'options' => 
          array (
            0 => 'x-small',
            1 => 'small',
            2 => 'medium',
            3 => 'large',
          ),
        ),
        2 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'actualFields' => 
      array (
        0 => 'id',
      ),
      'notActualFields' => 
      array (
        0 => 'name',
      ),
      'filter' => false,
      'linkDefs' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Attachment',
      ),
      'fieldDefs' => 
      array (
        'skipOrmDefs' => true,
      ),
    ),
    'int' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'default',
          'type' => 'int',
        ),
        2 => 
        array (
          'name' => 'min',
          'type' => 'int',
        ),
        3 => 
        array (
          'name' => 'max',
          'type' => 'int',
        ),
        4 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'filter' => true,
    ),
    'link' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'actualFields' => 
      array (
        0 => 'id',
      ),
      'notActualFields' => 
      array (
        0 => 'name',
      ),
      'filter' => true,
      'notCreatable' => true,
    ),
    'linkMultiple' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
      ),
      'actualFields' => 
      array (
        0 => 'ids',
      ),
      'notActualFields' => 
      array (
        0 => 'names',
      ),
      'notCreatable' => true,
      'filter' => true,
      'fieldDefs' => 
      array (
        'layoutListDisabled' => true,
      ),
    ),
    'linkParent' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'entityList',
          'type' => 'multiEnum',
          'view' => 'Admin.FieldManager.Fields.EntityList',
        ),
        2 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'actualFields' => 
      array (
        0 => 'id',
        1 => 'type',
      ),
      'notActualFields' => 
      array (
        0 => 'name',
      ),
      'filter' => true,
      'notCreatable' => true,
      'fieldDefs' => 
      array (
        'notStorable' => true,
      ),
    ),
    'map' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'provider',
          'type' => 'enum',
          'options' => 
          array (
            0 => 'Google',
          ),
          'default' => 'Google',
        ),
        1 => 
        array (
          'name' => 'height',
          'type' => 'int',
          'default' => 300,
        ),
      ),
      'filter' => false,
      'notCreatable' => true,
      'fieldDefs' => 
      array (
        'notStorable' => true,
      ),
    ),
    'multiEnum' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'options',
          'type' => 'array',
        ),
        2 => 
        array (
          'name' => 'translation',
          'type' => 'varchar',
          'hidden' => true,
        ),
      ),
      'filter' => true,
      'notCreatable' => false,
      'fieldDefs' => 
      array (
        'type' => 'jsonArray',
      ),
    ),
    'password' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
      ),
      'notCreatable' => true,
      'filter' => false,
    ),
    'personName' => 
    array (
      'actualFields' => 
      array (
        0 => 'salutation',
        1 => 'first',
        2 => 'last',
      ),
      'fields' => 
      array (
        'salutation' => 
        array (
          'type' => 'enum',
        ),
        'first' => 
        array (
          'type' => 'varchar',
        ),
        'last' => 
        array (
          'type' => 'varchar',
        ),
      ),
      'naming' => 'prefix',
      'mergable' => false,
      'notCreatable' => true,
      'filter' => true,
      'fieldDefs' => 
      array (
        'notStorable' => true,
      ),
    ),
    'phone' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'typeList',
          'type' => 'array',
          'default' => 
          array (
            0 => 'Mobile',
            1 => 'Office',
            2 => 'Home',
            3 => 'Fax',
            4 => 'Other',
          ),
          'view' => 'views/admin/field-manager/fields/options',
        ),
        2 => 
        array (
          'name' => 'defaultType',
          'type' => 'varchar',
          'default' => 'Mobile',
        ),
      ),
      'notActualFields' => 
      array (
        0 => 'data',
      ),
      'notCreatable' => true,
      'filter' => true,
      'fieldDefs' => 
      array (
        'notStorable' => true,
      ),
    ),
    'rangeCurrency' => 
    array (
      'actualFields' => 
      array (
        0 => 'from',
        1 => 'to',
      ),
      'fields' => 
      array (
        'from' => 
        array (
          'type' => 'currency',
        ),
        'to' => 
        array (
          'type' => 'currency',
        ),
      ),
      'naming' => 'prefix',
      'mergable' => false,
      'notCreatable' => true,
      'filter' => false,
      'fieldDefs' => 
      array (
        'notStorable' => true,
      ),
    ),
    'rangeFloat' => 
    array (
      'actualFields' => 
      array (
        0 => 'from',
        1 => 'to',
      ),
      'fields' => 
      array (
        'from' => 
        array (
          'type' => 'float',
        ),
        'to' => 
        array (
          'type' => 'float',
        ),
      ),
      'naming' => 'prefix',
      'mergable' => false,
      'notCreatable' => true,
      'filter' => false,
      'fieldDefs' => 
      array (
        'notStorable' => true,
      ),
    ),
    'rangeInt' => 
    array (
      'actualFields' => 
      array (
        0 => 'from',
        1 => 'to',
      ),
      'fields' => 
      array (
        'from' => 
        array (
          'type' => 'int',
        ),
        'to' => 
        array (
          'type' => 'int',
        ),
      ),
      'naming' => 'prefix',
      'mergable' => false,
      'notCreatable' => true,
      'filter' => false,
      'fieldDefs' => 
      array (
        'notStorable' => true,
      ),
    ),
    'text' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'default',
          'type' => 'text',
        ),
        2 => 
        array (
          'name' => 'maxLength',
          'type' => 'int',
        ),
        3 => 
        array (
          'name' => 'seeMoreDisabled',
          'type' => 'bool',
        ),
        4 => 
        array (
          'name' => 'rows',
          'type' => 'int',
          'default' => 4,
          'min' => 1,
        ),
        5 => 
        array (
          'name' => 'lengthOfCut',
          'type' => 'int',
          'default' => 400,
          'min' => 1,
        ),
      ),
      'filter' => true,
    ),
    'url' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'default',
          'type' => 'varchar',
        ),
        2 => 
        array (
          'name' => 'maxLength',
          'type' => 'int',
        ),
        3 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'filter' => true,
      'fieldDefs' => 
      array (
        'type' => 'varchar',
      ),
    ),
    'varchar' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'default',
          'type' => 'varchar',
        ),
        2 => 
        array (
          'name' => 'maxLength',
          'type' => 'int',
        ),
        3 => 
        array (
          'name' => 'trim',
          'type' => 'bool',
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'audited',
          'type' => 'bool',
        ),
      ),
      'filter' => true,
    ),
    'wysiwyg' => 
    array (
      'params' => 
      array (
        0 => 
        array (
          'name' => 'required',
          'type' => 'bool',
          'default' => false,
        ),
        1 => 
        array (
          'name' => 'default',
          'type' => 'text',
        ),
        2 => 
        array (
          'name' => 'maxLength',
          'type' => 'int',
        ),
        3 => 
        array (
          'name' => 'seeMoreDisabled',
          'type' => 'bool',
        ),
        4 => 
        array (
          'name' => 'height',
          'type' => 'int',
        ),
        5 => 
        array (
          'name' => 'minHeight',
          'type' => 'int',
        ),
      ),
      'filter' => true,
      'fieldDefs' => 
      array (
        'type' => 'text',
      ),
    ),
  ),
  'scopes' => 
  array (
    'Area' => 
    array (
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => false,
      'customizable' => true,
      'stream' => true,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'Attachment' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'AuthToken' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'Currency' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'Dashboard' => 
    array (
      'entity' => false,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'Email' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'aclPortal' => 'recordAllAccountContactOwnNo',
      'notifications' => true,
      'object' => true,
      'customizable' => false,
    ),
    'EmailAccount' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
    ),
    'EmailAccountScope' => 
    array (
      'entity' => false,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
    ),
    'EmailAddress' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'EmailFilter' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'notifications' => false,
      'object' => false,
      'customizable' => false,
    ),
    'EmailTemplate' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'customizable' => false,
    ),
    'Encashment' => 
    array (
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'customizable' => true,
      'stream' => true,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'Extension' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'ExternalAccount' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'aclPortal' => false,
      'customizable' => false,
    ),
    'Import' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'InboundEmail' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
    ),
    'Integration' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'Job' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'Note' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'Notification' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'Orders' => 
    array (
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'customizable' => true,
      'stream' => false,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'OrdersLimit' => 
    array (
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'customizable' => true,
      'stream' => false,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'PasswordChangeRequest' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'PhoneNumber' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'Portal' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'Preferences' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'Reason' => 
    array (
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'customizable' => true,
      'stream' => false,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'Role' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'ScheduledJob' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'ScheduledJobLogRecord' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'SetMeal' => 
    array (
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'customizable' => true,
      'stream' => false,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'Stream' => 
    array (
      'entity' => false,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'customizable' => false,
    ),
    'Tactics' => 
    array (
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'customizable' => true,
      'stream' => false,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'Team' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'Template' => 
    array (
      'entity' => false,
      'layouts' => false,
      'tab' => false,
      'acl' => 'recordAllTeamNo',
      'customizable' => false,
      'disabled' => true,
    ),
    'UniqueId' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
    ),
    'User' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'customizable' => false,
      'object' => true,
      'recycled' => false,
    ),
    'Account' => 
    array (
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'aclPortal' => 'recordAllAccountOwnNo',
      'module' => 'Crm',
      'customizable' => true,
      'stream' => true,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'Activities' => 
    array (
      'entity' => false,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'aclPortal' => 'boolean',
      'module' => 'Crm',
      'customizable' => false,
    ),
    'Calendar' => 
    array (
      'entity' => false,
      'tab' => true,
      'acl' => false,
      'module' => 'Crm',
    ),
    'Call' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'aclPortal' => 'recordAllAccountContactOwnNo',
      'module' => 'Crm',
      'customizable' => false,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'Campaign' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'module' => 'Crm',
      'customizable' => false,
      'stream' => false,
      'importable' => false,
      'object' => true,
    ),
    'CampaignLogRecord' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'module' => 'Crm',
      'customizable' => false,
      'stream' => false,
      'importable' => false,
    ),
    'CampaignTrackingUrl' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'module' => 'Crm',
      'customizable' => false,
      'stream' => false,
      'importable' => false,
    ),
    'Case' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'aclPortal' => 'recordAllAccountContactOwnNo',
      'module' => 'Crm',
      'customizable' => false,
      'stream' => true,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'Contact' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'aclPortal' => 'recordAllAccountContactOwnNo',
      'module' => 'Crm',
      'customizable' => false,
      'stream' => true,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'Document' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'aclPortal' => 'recordAllAccountOwnNo',
      'module' => 'Crm',
      'customizable' => false,
      'importable' => false,
      'notifications' => true,
      'object' => true,
    ),
    'DocumentFolder' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'aclPortal' => 'recordAllNo',
      'module' => 'Crm',
      'customizable' => false,
      'importable' => false,
      'type' => 'CategoryTree',
      'stream' => false,
      'notifications' => false,
    ),
    'EmailQueueItem' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'notifications' => false,
      'object' => false,
      'customizable' => false,
      'module' => 'Crm',
    ),
    'KnowledgeBaseArticle' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'aclPortal' => 'recordAllNo',
      'module' => 'Crm',
      'customizable' => false,
      'importable' => true,
      'notifications' => false,
      'object' => true,
    ),
    'KnowledgeBaseCategory' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'aclPortal' => 'recordAllNo',
      'module' => 'Crm',
      'customizable' => false,
      'importable' => false,
      'type' => 'CategoryTree',
      'stream' => false,
      'notifications' => false,
    ),
    'Lead' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'aclPortal' => 'recordAllOwnNo',
      'module' => 'Crm',
      'customizable' => false,
      'stream' => true,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'MassEmail' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'notifications' => false,
      'object' => false,
      'customizable' => false,
      'module' => 'Crm',
    ),
    'Meeting' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'aclPortal' => 'recordAllAccountContactOwnNo',
      'module' => 'Crm',
      'customizable' => false,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'Opportunity' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'aclPortal' => 'recordAllAccountContactOwnNo',
      'module' => 'Crm',
      'customizable' => false,
      'stream' => true,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
    'Reminder' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'module' => 'Crm',
      'customizable' => false,
      'importable' => false,
    ),
    'Target' => 
    array (
      'entity' => false,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'module' => 'Crm',
      'customizable' => false,
      'importable' => false,
      'notifications' => false,
      'object' => true,
    ),
    'TargetList' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'module' => 'Crm',
      'customizable' => false,
      'stream' => false,
      'importable' => false,
      'notifications' => true,
      'object' => true,
    ),
    'Task' => 
    array (
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'aclPortal' => 'recordAllAccountContactOwnNo',
      'module' => 'Crm',
      'customizable' => false,
      'importable' => true,
      'notifications' => true,
      'object' => true,
    ),
  ),
  'themes' => 
  array (
    'FoxVertical' => 
    array (
      'stylesheet' => 'client/css/fox-vertical.css',
      'navbarIsVertical' => true,
      'navbarStaticItemsHeight' => 65,
      'recordTopButtonsStickTop' => 61,
      'recordTopButtonsBlockHeight' => 21,
      'dashboardCellHeight' => 155,
      'dashboardCellMargin' => 19,
    ),
  ),
);
?>