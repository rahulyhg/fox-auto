<?php
return array (
  'fields' => 
  array (
    'name' => 'Name',
    'parent' => 'Parent',
    'status' => 'Status',
    'dateStart' => 'Date Start',
    'dateEnd' => 'Date End',
    'direction' => 'Direction',
    'duration' => 'Duration',
    'description' => 'Description',
    'users' => 'Users',
    'contacts' => 'Contacts',
    'leads' => 'Leads',
    'reminders' => 'Reminders',
    'account' => 'Account',
  ),
  'links' => 
  array (
  ),
  'options' => 
  array (
    'status' => 
    array (
      'Planned' => 'Planned',
      'Held' => 'Held',
      'Not Held' => 'Not Held',
    ),
    'direction' => 
    array (
      'Outbound' => 'Outbound',
      'Inbound' => 'Inbound',
    ),
    'acceptanceStatus' => 
    array (
      'None' => 'None',
      'Accepted' => 'Accepted',
      'Declined' => 'Declined',
      'Tentative' => 'Tentative',
    ),
  ),
  'massActions' => 
  array (
    'setHeld' => 'Set Held',
    'setNotHeld' => 'Set Not Held',
  ),
  'labels' => 
  array (
    'Create Call' => 'Create Call',
    'Set Held' => 'Set Held',
    'Set Not Held' => 'Set Not Held',
    'Send Invitations' => 'Send Invitations',
  ),
  'presetFilters' => 
  array (
    'planned' => 'Planned',
    'held' => 'Held',
    'todays' => 'Today\'s',
  ),
);
?>