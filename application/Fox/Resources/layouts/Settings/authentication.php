<?php
return array (
  0 => 
  array (
    'label' => 'Configuration',
    'rows' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'authenticationMethod',
        ),
        1 => 
        array (
          'name' => 'authTokenLifetime',
        ),
      ),
      1 => 
      array (
        0 => false,
        1 => 
        array (
          'name' => 'authTokenMaxIdleTime',
        ),
      ),
    ),
  ),
  1 => 
  array (
    'label' => 'LDAP',
    'name' => 'LDAP',
    'rows' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'ldapHost',
        ),
        1 => 
        array (
          'name' => 'ldapPort',
        ),
      ),
      1 => 
      array (
        0 => 
        array (
          'name' => 'ldapAuth',
        ),
        1 => 
        array (
          'name' => 'ldapSecurity',
        ),
      ),
      2 => 
      array (
        0 => 
        array (
          'name' => 'ldapUsername',
        ),
        1 => false,
      ),
      3 => 
      array (
        0 => 
        array (
          'name' => 'ldapPassword',
        ),
        1 => false,
      ),
      4 => 
      array (
        0 => 
        array (
          'name' => 'ldapBindRequiresDn',
        ),
        1 => 
        array (
          'name' => 'ldapUserLoginFilter',
        ),
      ),
      5 => 
      array (
        0 => 
        array (
          'name' => 'ldapBaseDn',
        ),
        1 => false,
      ),
      6 => 
      array (
        0 => 
        array (
          'name' => 'ldapAccountCanonicalForm',
        ),
        1 => false,
      ),
      7 => 
      array (
        0 => 
        array (
          'name' => 'ldapAccountDomainName',
        ),
        1 => 
        array (
          'name' => 'ldapAccountDomainNameShort',
        ),
      ),
      8 => 
      array (
        0 => 
        array (
          'name' => 'ldapTryUsernameSplit',
        ),
        1 => 
        array (
          'name' => 'ldapOptReferrals',
        ),
      ),
      9 => 
      array (
        0 => 
        array (
          'name' => 'ldapCreateFoxUser',
        ),
        1 => false,
      ),
    ),
  ),
);
?>