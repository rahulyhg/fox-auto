<?php
return array (
  'fields' => 
  array (
    'name' => 'Name',
    'status' => 'Status',
    'target' => 'Target',
    'sentAt' => 'Date Sent',
    'attemptCount' => 'Attempts',
    'emailAddress' => 'Email Address',
    'massEmail' => 'Mass Email',
    'isTest' => 'Is Test',
  ),
  'links' => 
  array (
    'target' => 'Target',
    'massEmail' => 'Mass Email',
  ),
  'options' => 
  array (
    'status' => 
    array (
      'Pending' => 'Pending',
      'Sent' => 'Sent',
      'Failed' => 'Failed',
    ),
  ),
  'presetFilters' => 
  array (
    'pending' => 'Pending',
    'sent' => 'Sent',
    'failed' => 'Failed',
  ),
);
?>