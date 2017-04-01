<?php
return array (
  'controller' => 'controllers/record',
  'views' => 
  array (
    'detail' => 'Crm:Target.Detail',
  ),
  'menu' => 
  array (
    'detail' => 
    array (
      'buttons' => 
      array (
        0 => 
        array (
          'label' => 'Convert to Lead',
          'action' => 'convertToLead',
          'acl' => 'edit',
        ),
      ),
    ),
  ),
  'boolFilterList' => 
  array (
    0 => 'onlyMy',
  ),
);
?>