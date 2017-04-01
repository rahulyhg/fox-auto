<?php
return array (
  'fields' => 
  array (
    'from' => 'From',
    'to' => 'To',
    'subject' => 'Subject',
    'bodyContains' => 'Body Contains',
  ),
  'labels' => 
  array (
    'Create EmailFilter' => 'Create Email Filter',
  ),
  'tooltips' => 
  array (
    'name' => 'Just a name of the filter.',
    'subject' => 'Use wildcard *:

text* - starts with text,
*text* - contains text,
*text - ends with text.',
    'bodyContains' => 'Body of email contains any of specified words or phrases.',
    'from' => 'Emails being sent from the specified address. Leave empty if not needed.',
    'to' => 'Emails being sent to the specified address. Leave empty if not needed.',
    'parent' => 'Leave it empty to apply this filter globally (to all incoming emails).',
  ),
);
?>