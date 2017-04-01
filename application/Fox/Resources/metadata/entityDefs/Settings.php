<?php
return array (
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
        1 => 'UTC'
      
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
        0 => 'en_US',
      ),
      'default' => 'en_US',
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
);
?>