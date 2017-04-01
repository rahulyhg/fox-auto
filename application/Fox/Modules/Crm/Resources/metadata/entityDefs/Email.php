<?php
return array (
  'fields' => 
  array (
    'account' => 
    array (
      'type' => 'link',
      'readOnly' => true,
    ),
    'parent' => 
    array (
      'entityList' => 
      array (
        0 => 'Account',
        1 => 'Lead',
        2 => 'Opportunity',
        3 => 'Case',
      ),
    ),
  ),
  'links' => 
  array (
    'account' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Account',
    ),
  ),
);
?>