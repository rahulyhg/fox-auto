<?php
return array (
  'controller' => 'controllers/record',
  'recordViews' => 
  array (
    'detail' => 'Template.Record.Detail',
  ),
  'formDependency' => 
  array (
    'printFooter' => 
    array (
      'map' => 
      array (
        'true' => 
        array (
          0 => 
          array (
            'action' => 'show',
            'fields' => 
            array (
              0 => 'footer',
              1 => 'footerPosition',
            ),
          ),
        ),
      ),
      'default' => 
      array (
        0 => 
        array (
          'action' => 'hide',
          'fields' => 
          array (
            0 => 'footer',
            1 => 'footerPosition',
          ),
        ),
      ),
    ),
  ),
);
?>