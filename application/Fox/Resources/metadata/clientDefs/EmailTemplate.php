<?php
return array (
  'controller' => 'controllers/record',
  'recordViews' => 
  array (
    'edit' => 'views/email-template/record/edit',
    'detail' => 'views/email-template/record/detail',
    'editQuick' => 'views/email-template/record/edit-quick',
  ),
  'sidePanels' => 
  array (
    'detail' => 
    array (
      0 => 
      array (
        'name' => 'information',
        'label' => 'Info',
        'view' => 'views/email-template/record/panels/information',
      ),
    ),
    'edit' => 
    array (
      0 => 
      array (
        'name' => 'information',
        'label' => 'Info',
        'view' => 'views/email-template/record/panels/information',
      ),
    ),
  ),
  'boolFilterList' => 
  array (
    0 => 'onlyMy',
  ),
  'filterList' => 
  array (
    0 => 'actual',
  ),
);
?>