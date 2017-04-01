<?php
return array (
  'view' => 'crm:views/dashlets/sales-pipeline',
  'aclScope' => 'Opportunity',
  'options' => 
  array (
    'fields' => 
    array (
      'title' => 
      array (
        'type' => 'varchar',
        'required' => true,
      ),
      'dateFrom' => 
      array (
        'type' => 'date',
        'required' => true,
      ),
      'dateTo' => 
      array (
        'type' => 'date',
        'required' => true,
      ),
    ),
    'layout' => 
    array (
      0 => 
      array (
        'rows' => 
        array (
          0 => 
          array (
            0 => 
            array (
              'name' => 'title',
            ),
          ),
          1 => 
          array (
            0 => 
            array (
              'name' => 'dateFrom',
            ),
            1 => 
            array (
              'name' => 'dateTo',
            ),
          ),
        ),
      ),
    ),
  ),
);
?>