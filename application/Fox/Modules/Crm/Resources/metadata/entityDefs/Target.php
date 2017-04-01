<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'personName',
    ),
    'salutationName' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => '',
        1 => 'Mr.',
        2 => 'Mrs.',
        3 => 'Ms.',
        4 => 'Dr.',
        5 => 'Drs.',
      ),
    ),
    'firstName' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
      'default' => '',
    ),
    'lastName' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
      'required' => true,
      'default' => '',
    ),
    'title' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
    ),
    'accountName' => 
    array (
      'type' => 'varchar',
      'maxLength' => 100,
    ),
    'website' => 
    array (
      'type' => 'url',
    ),
    'address' => 
    array (
      'type' => 'address',
    ),
    'addressStreet' => 
    array (
      'type' => 'text',
      'maxLength' => 255,
      'dbType' => 'varchar',
    ),
    'addressCity' => 
    array (
      'type' => 'varchar',
    ),
    'addressState' => 
    array (
      'type' => 'varchar',
    ),
    'addressCountry' => 
    array (
      'type' => 'varchar',
    ),
    'addressPostalCode' => 
    array (
      'type' => 'varchar',
    ),
    'emailAddress' => 
    array (
      'type' => 'email',
    ),
    'phoneNumber' => 
    array (
      'type' => 'phone',
      'typeList' => 
      array (
        0 => 'Mobile',
        1 => 'Office',
        2 => 'Home',
        3 => 'Fax',
        4 => 'Other',
      ),
      'defaultType' => 'Mobile',
    ),
    'doNotCall' => 
    array (
      'type' => 'bool',
    ),
    'description' => 
    array (
      'type' => 'text',
    ),
    'createdAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'modifiedAt' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
    ),
    'createdBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
      'view' => 'views/fields/user',
    ),
    'modifiedBy' => 
    array (
      'type' => 'link',
      'readOnly' => true,
      'view' => 'views/fields/user',
    ),
    'assignedUser' => 
    array (
      'type' => 'link',
      'view' => 'views/fields/user',
    ),
    'teams' => 
    array (
      'type' => 'linkMultiple',
    ),
  ),
  'links' => 
  array (
    'createdBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'modifiedBy' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'assignedUser' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'User',
    ),
    'teams' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Team',
      'relationName' => 'entityTeam',
      'layoutRelationshipsDisabled' => true,
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
    'asc' => false,
  ),
  'indexes' => 
  array (
    'firstName' => 
    array (
      'columns' => 
      array (
        0 => 'firstName',
        1 => 'deleted',
      ),
    ),
    'name' => 
    array (
      'columns' => 
      array (
        0 => 'firstName',
        1 => 'lastName',
      ),
    ),
    'assignedUser' => 
    array (
      'columns' => 
      array (
        0 => 'assignedUserId',
        1 => 'deleted',
      ),
    ),
  ),
);
?>