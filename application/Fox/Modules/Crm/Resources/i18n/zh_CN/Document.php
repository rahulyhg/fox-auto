<?php
return array (
  'labels' => 
  array (
    'Create Document' => 'Create Document',
    'Details' => 'Details',
  ),
  'fields' => 
  array (
    'name' => 'Name',
    'status' => 'Status',
    'file' => 'File',
    'type' => 'Type',
    'source' => 'Source',
    'publishDate' => 'Publish Date',
    'expirationDate' => 'Expiration Date',
    'description' => 'Description',
    'accounts' => 'Accounts',
    'folder' => 'Folder',
  ),
  'links' => 
  array (
    'accounts' => 'Accounts',
    'opportunities' => 'Opportunities',
    'folder' => 'Folder',
  ),
  'options' => 
  array (
    'status' => 
    array (
      'Active' => 'Active',
      'Draft' => 'Draft',
      'Expired' => 'Expired',
      'Canceled' => 'Canceled',
    ),
    'type' => 
    array (
      '' => 'None',
      'Contract' => 'Contract',
      'NDA' => 'NDA',
      'EULA' => 'EULA',
      'License Agreement' => 'License Agreement',
    ),
  ),
  'presetFilters' => 
  array (
    'active' => 'Active',
    'draft' => 'Draft',
  ),
);
?>