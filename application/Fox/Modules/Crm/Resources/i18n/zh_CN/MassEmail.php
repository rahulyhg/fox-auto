<?php
return array (
  'fields' => 
  array (
    'name' => 'Name',
    'status' => 'Status',
    'storeSentEmails' => 'Store Sent Emails',
    'startAt' => 'Date Start',
    'fromAddress' => 'From Address',
    'fromName' => 'From Name',
    'replyToAddress' => 'Reply-to Address',
    'replyToName' => 'Reply-to Name',
    'campaign' => 'Campaign',
    'emailTemplate' => 'Email Template',
    'inboundEmail' => 'Email Account',
    'targetLists' => 'Target Lists',
  ),
  'links' => 
  array (
    'targetLists' => 'Target Lists',
    'queueItems' => 'Queue Items',
    'campaign' => 'Campaign',
    'emailTemplate' => 'Email Template',
    'inboundEmail' => 'Email Account',
  ),
  'options' => 
  array (
    'status' => 
    array (
      'Draft' => 'Draft',
      'Pending' => 'Pending',
      'In Process' => 'In Process',
      'Complete' => 'Complete',
      'Canceled' => 'Canceled',
      'Failed' => 'Failed',
    ),
  ),
  'labels' => 
  array (
    'Create MassEmail' => 'Create Mass Email',
    'Send Test' => 'Send Test',
  ),
  'messages' => 
  array (
    'selectAtLeastOneTarget' => 'Select at least one target.',
    'testSent' => 'Test email(s) supposed to be sent',
  ),
);
?>