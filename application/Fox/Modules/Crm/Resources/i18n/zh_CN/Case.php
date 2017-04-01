<?php
return array (
  'fields' => 
  array (
    'name' => 'Name',
    'number' => 'Number',
    'status' => 'Status',
    'account' => 'Account',
    'contact' => 'Contact',
    'contacts' => 'Contacts',
    'priority' => 'Priority',
    'type' => 'Type',
    'description' => 'Description',
    'inboundEmail' => 'Inbound Email',
  ),
  'links' => 
  array (
    'inboundEmail' => 'Inbound Email',
    'account' => 'Account',
    'contact' => 'Contact (Primary)',
    'Contacts' => 'Contacts',
    'meetings' => 'Meetings',
    'calls' => 'Calls',
    'tasks' => 'Tasks',
    'emails' => 'Emails',
  ),
  'options' => 
  array (
    'status' => 
    array (
      'New' => 'New',
      'Assigned' => 'Assigned',
      'Pending' => 'Pending',
      'Closed' => 'Closed',
      'Rejected' => 'Rejected',
      'Duplicate' => 'Duplicate',
    ),
    'priority' => 
    array (
      'Low' => 'Low',
      'Normal' => 'Normal',
      'High' => 'High',
      'Urgent' => 'Urgent',
    ),
    'type' => 
    array (
      'Question' => 'Question',
      'Incident' => 'Incident',
      'Problem' => 'Problem',
    ),
  ),
  'labels' => 
  array (
    'Create Case' => 'Create Case',
    'Close' => 'Close',
    'Reject' => 'Reject',
    'Closed' => 'Closed',
    'Rejected' => 'Rejected',
  ),
  'presetFilters' => 
  array (
    'open' => 'Open',
    'closed' => 'Closed',
  ),
);
?>