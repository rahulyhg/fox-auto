<?php
return array (
  0 => 
  array (
    'label' => 'SMTP',
    'rows' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'smtpServer',
        ),
        1 => 
        array (
          'name' => 'smtpPort',
        ),
      ),
      1 => 
      array (
        0 => 
        array (
          'name' => 'smtpAuth',
        ),
        1 => 
        array (
          'name' => 'smtpSecurity',
        ),
      ),
      2 => 
      array (
        0 => 
        array (
          'name' => 'smtpUsername',
        ),
        1 => 
        array (
          'name' => 'testSend',
          'customLabel' => NULL,
          'view' => 'OutboundEmail.Fields.TestSend',
        ),
      ),
      3 => 
      array (
        0 => 
        array (
          'name' => 'smtpPassword',
        ),
        1 => false,
      ),
    ),
  ),
  1 => 
  array (
    'label' => 'Configuration',
    'rows' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'outboundEmailFromAddress',
        ),
        1 => 
        array (
          'name' => 'outboundEmailIsShared',
        ),
      ),
      1 => 
      array (
        0 => 
        array (
          'name' => 'outboundEmailFromName',
        ),
        1 => false,
      ),
    ),
  ),
  2 => 
  array (
    'label' => 'Mass Email',
    'rows' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'massEmailMaxPerHourCount',
        ),
        1 => false,
      ),
    ),
  ),
);
?>