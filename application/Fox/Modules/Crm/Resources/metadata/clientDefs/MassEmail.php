<?php
return array (
  'controller' => 'controllers/record',
  'acl' => 'crm:acl/mass-email',
  'recordViews' => 
  array (
    'detail' => 'crm:views/mass-email/record/detail',
  ),
  'views' => 
  array (
    'detail' => 'crm:views/mass-email/detail',
  ),
  'formDependency' => 
  array (
    'status' => 
    array (
      'map' => 
      array (
        'Complete' => 
        array (
          0 => 
          array (
            'action' => 'setReadOnly',
            'fields' => 
            array (
              0 => 'status',
            ),
          ),
        ),
        'In Process' => 
        array (
          0 => 
          array (
            'action' => 'setReadOnly',
            'fields' => 
            array (
              0 => 'status',
            ),
          ),
        ),
        'Failed' => 
        array (
          0 => 
          array (
            'action' => 'setReadOnly',
            'fields' => 
            array (
              0 => 'status',
            ),
          ),
        ),
      ),
      'default' => 
      array (
        0 => 
        array (
          'action' => 'setNotReadOnly',
          'fields' => 
          array (
            0 => 'status',
          ),
        ),
      ),
    ),
  ),
);
?>