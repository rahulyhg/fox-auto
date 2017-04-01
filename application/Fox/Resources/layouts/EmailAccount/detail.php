<?php
return array (
  0 => 
  array (
    'label' => 'Main',
    'rows' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'emailAddress',
        ),
        1 => 
        array (
          'name' => 'status',
        ),
      ),
      1 => 
      array (
        0 => 
        array (
          'name' => 'name',
        ),
        1 => 
        array (
          'name' => 'fetchSince',
        ),
      ),
    ),
  ),
  1 => 
  array (
    'label' => 'IMAP',
    'rows' => 
    array (
      0 => 
      array (
        0 => 
        array (
          'name' => 'host',
        ),
        1 => 
        array (
          'name' => 'ssl',
        ),
      ),
      1 => 
      array (
        0 => 
        array (
          'name' => 'port',
        ),
        1 => 
        array (
          'name' => 'username',
        ),
      ),
      2 => 
      array (
        0 => 
        array (
          'name' => 'monitoredFolders',
        ),
        1 => 
        array (
          'name' => 'password',
        ),
      ),
      3 => 
      array (
        0 => false,
        1 => 
        array (
          'name' => 'keepFetchedEmailsUnread',
        ),
      ),
      4 => 
      array (
        0 => 
        array (
          'name' => 'testConnection',
          'customLabel' => NULL,
          'view' => 'EmailAccount.Fields.TestConnection',
        ),
        1 => false,
      ),
    ),
  ),
);
?>