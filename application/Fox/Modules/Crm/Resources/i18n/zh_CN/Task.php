<?php
return array (
  'fields' => 
  array (
    'name' => 'Name',
    'parent' => 'Parent',
    'status' => 'Status',
    'dateStart' => 'Date Start',
    'dateEnd' => 'Date Due',
    'dateStartDate' => 'Date Start (all day)',
    'dateEndDate' => 'Date End (all day)',
    'priority' => 'Priority',
    'description' => 'Description',
    'isOverdue' => 'Is Overdue',
    'account' => 'Account',
    'dateCompleted' => 'Date Completed',
    'attachments' => 'Attachments',
  ),
  'links' => 
  array (
    'attachments' => 'Attachments',
  ),
  'options' => 
  array (
    'status' => 
    array (
      'Not Started' => 'Not Started',
      'Started' => 'Started',
      'Completed' => 'Completed',
      'Canceled' => 'Canceled',
      'Deferred' => 'Deferred',
    ),
    'priority' => 
    array (
      'Low' => 'Low',
      'Normal' => 'Normal',
      'High' => 'High',
      'Urgent' => 'Urgent',
    ),
  ),
  'labels' => 
  array (
    'Create Task' => 'Create Task',
    'Complete' => 'Complete',
  ),
  'presetFilters' => 
  array (
    'actual' => 'Actual',
    'completed' => 'Completed',
    'todays' => 'Today\'s',
    'overdue' => 'Overdue',
  ),
);
?>