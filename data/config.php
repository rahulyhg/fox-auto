<?php
return [
    'cacheTimestamp' => 1489745438,
    'database' => [
        'driver' => 'pdo_mysql',
        'dbname' => 'zzcrm_dev',
        'user' => 'root',
        'password' => '123456',
        'host' => 'localhost',//'192.168.0.232',
        'port' => '3306'
    ],
    'wechat' => [
        'auth_expired' => 1036800,
        'debug' => true,
        'app_id' => 'wx85f2a70a49f05b17',
        'secret' => 'fde1ebe37836a5ee7fa65e41f9b9b04f',
        'token' => 'sds23ej2sdjkazz5jga19u',
        'aes_key' => 'avKCmyX5x6zTDYIUiOOwVq4HsPJB40T6DQROpaQbp1X',
        'log' => [
            'level' => 'debug',
            'permission' => 511,
            'file' => 'data/logs/easywechat.log'
        ],
        'oauth' => [
            'scopes' => [
                0 => 'snsapi_userinfo'
            ],
            'callback' => 'http://wxapi.iflow800.cn/api/v1/WechatOauth'
        ],
        'payment' => [
            'merchant_id' => '1250254601',
            'key' => 'ncncbvbvbvhfkdmcir6sd21kf9po3zvm',
            'cert_path' => '',
            'key_path' => '',
            'notify_url' => 'http://wxapi.iflow800.cn/api/v1/WechatPay'
        ],
        'guzzle' => [
            'timeout' => 3
        ]
    ],
    'useCache' => true,
    'recordsPerPage' => 20,
    'recordsPerPageSmall' => 5,
    'applicationName' => 'CRM',
    'version' => '4.0.1',
    'timeZone' => 'Asia/Shanghai',
    'dateFormat' => 'YYYY-MM-DD',
    'timeFormat' => 'HH:mm',
    'weekStart' => 1,
    'thousandSeparator' => ',',
    'decimalMark' => '.',
    'exportDelimiter' => ';',
    'currencyList' => [
        0 => 'USD'
    ],
    'defaultCurrency' => 'USD',
    'baseCurrency' => 'USD',
    'currencyRates' => [
        
    ],
    'outboundEmailIsShared' => false,
    'outboundEmailFromName' => '',
    'outboundEmailFromAddress' => '',
    'smtpServer' => '',
    'smtpPort' => '25',
    'smtpAuth' => false,
    'smtpSecurity' => '',
    'smtpUsername' => '',
    'smtpPassword' => '',
    'languageList' => [
        0 => 'zh_CN'
    ],
    'language' => 'zh_CN',
    'logger' => [
        'path' => 'data/logs/fox.log',
        'level' => 'WARNING',
        'rotation' => true,
        'maxFileNumber' => 30
    ],
    'authenticationMethod' => 'Fox',
    'globalSearchEntityList' => [
        0 => 'Account',
        1 => 'Contact',
        2 => 'Lead',
        3 => 'Opportunity'
    ],
    'tabList' => [
        0 => 'Account',
        1 => 'SetMeal',
        2 => 'User',
        3 => 'Role',
        4 => 'Team',
        5 => 'OrdersLimit',
        6 => 'Tactics',
        7 => 'Orders'
    ],
    'quickCreateList' => [
        0 => 'Account'
    ],
    'calendarDefaultEntity' => 'Meeting',
    'exportDisabled' => false,
    'assignmentEmailNotifications' => false,
    'assignmentEmailNotificationsEntityList' => [
        0 => 'Lead',
        1 => 'Opportunity',
        2 => 'Task',
        3 => 'Case'
    ],
    'assignmentNotificationsEntityList' => [
        0 => 'Meeting',
        1 => 'Call',
        2 => 'Task',
        3 => 'Email'
    ],
    'emailMessageMaxSize' => 10,
    'notificationsCheckInterval' => 10,
    'disabledCountQueryEntityList' => [
        0 => 'Email'
    ],
    'maxEmailAccountCount' => 2,
    'followCreatedEntities' => false,
    'b2cMode' => false,
    'restrictedMode' => false,
    'theme' => 'FoxVertical',
    'massEmailMaxPerHourCount' => 100,
    'personalEmailMaxPortionSize' => 10,
    'inboundEmailMaxPortionSize' => 20,
    'authTokenLifetime' => 0,
    'authTokenMaxIdleTime' => 120,
    'userNameRegularExpression' => '[^a-z0-9\\-@_\\.\\s]',
    'displayListViewRecordCount' => true,
    'dashboardLayout' => [
        0 => (object) [
            'name' => 'My Fox',
            'layout' => [
                0 => (object) [
                    'id' => 'default-activities',
                    'name' => 'Activities',
                    'x' => 2,
                    'y' => 2,
                    'width' => 2,
                    'height' => 2
                ],
                1 => (object) [
                    'id' => 'default-stream',
                    'name' => 'Stream',
                    'x' => 0,
                    'y' => 0,
                    'width' => 2,
                    'height' => 4
                ],
                2 => (object) [
                    'id' => 'default-tasks',
                    'name' => 'Tasks',
                    'x' => 2,
                    'y' => 0,
                    'width' => 2,
                    'height' => 2
                ]
            ]
        ]
    ],
    'isInstalled' => true,
    'siteUrl' => 'http://_:8081',
    'passwordSalt' => 'ddfcab38e841d8ef',
    'defaultPermissions' => [
        'user' => 501,
        'group' => 501
    ],
    'avatarsDisabled' => false,
    'userThemesDisabled' => false,
    'dashletsOptions' => (object) [
        
    ]
];
?>