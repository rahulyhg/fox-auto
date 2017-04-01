<?php
return array (
  'fields' => 
  array (
    'name' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'trim' => true,
    ),
    'amount' => 
    array (
      'type' => 'currency',
      'required' => true,
      'audited' => true,
    ),
    'amountConverted' => 
    array (
      'type' => 'currencyConverted',
      'readOnly' => true,
    ),
    'amountWeightedConverted' => 
    array (
      'type' => 'float',
      'readOnly' => true,
      'notStorable' => true,
      'select' => 'opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100',
      'where' => 
      array (
        '=' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) = {value}',
        '<' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) < {value}',
        '>' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) > {value}',
        '<=' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) <= {value}',
        '>=' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) >= {value}',
        '<>' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) <> {value}',
      ),
      'orderBy' => 'amountWeightedConverted {direction}',
      'view' => 'views/fields/currency-converted',
    ),
    'account' => 
    array (
      'type' => 'link',
    ),
    'contacts' => 
    array (
      'type' => 'linkMultiple',
      'view' => 'crm:views/opportunity/fields/contacts',
      'columns' => 
      array (
        'role' => 'opportunityRole',
      ),
    ),
    'stage' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Prospecting',
        1 => 'Qualification',
        2 => 'Needs Analysis',
        3 => 'Value Proposition',
        4 => 'Id. Decision Makers',
        5 => 'Perception Analysis',
        6 => 'Proposal/Price Quote',
        7 => 'Negotiation/Review',
        8 => 'Closed Won',
        9 => 'Closed Lost',
      ),
      'view' => 'crm:views/opportunity/fields/stage',
      'default' => 'Prospecting',
      'audited' => true,
    ),
    'probability' => 
    array (
      'type' => 'int',
      'required' => true,
      'min' => 0,
      'max' => 100,
    ),
    'leadSource' => 
    array (
      'type' => 'enum',
      'view' => 'crm:views/opportunity/fields/lead-source',
      'customizationOptionsDisabled' => true,
      'default' => '',
    ),
    'closeDate' => 
    array (
      'type' => 'date',
      'required' => true,
      'audited' => true,
    ),
    'description' => 
    array (
      'type' => 'text',
    ),
    'campaign' => 
    array (
      'type' => 'link',
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
      'required' => false,
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
    'account' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Account',
      'foreign' => 'opportunities',
    ),
    'contacts' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Contact',
      'foreign' => 'opportunities',
      'additionalColumns' => 
      array (
        'role' => 
        array (
          'type' => 'varchar',
          'len' => 50,
        ),
      ),
    ),
    'meetings' => 
    array (
      'type' => 'hasChildren',
      'entity' => 'Meeting',
      'foreign' => 'parent',
      'layoutRelationshipsDisabled' => true,
    ),
    'calls' => 
    array (
      'type' => 'hasChildren',
      'entity' => 'Call',
      'foreign' => 'parent',
      'layoutRelationshipsDisabled' => true,
    ),
    'tasks' => 
    array (
      'type' => 'hasChildren',
      'entity' => 'Task',
      'foreign' => 'parent',
      'layoutRelationshipsDisabled' => true,
    ),
    'emails' => 
    array (
      'type' => 'hasChildren',
      'entity' => 'Email',
      'foreign' => 'parent',
      'layoutRelationshipsDisabled' => true,
    ),
    'documents' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Document',
      'foreign' => 'opportunities',
    ),
    'campaign' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Campaign',
      'foreign' => 'opportunities',
      'noJoin' => true,
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'createdAt',
    'asc' => false,
  ),
  'probabilityMap' => 
  array (
    'Prospecting' => 10,
    'Qualification' => 10,
    'Needs Analysis' => 20,
    'Value Proposition' => 50,
    'Id. Decision Makers' => 60,
    'Perception Analysis' => 70,
    'Proposal/Price Quote' => 75,
    'Negotiation/Review' => 90,
    'Closed Won' => 100,
    'Closed Lost' => 0,
  ),
  'indexes' => 
  array (
    'stage' => 
    array (
      'columns' => 
      array (
        0 => 'stage',
        1 => 'deleted',
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
    'createdAt' => 
    array (
      'columns' => 
      array (
        0 => 'createdAt',
        1 => 'deleted',
      ),
    ),
    'createdAtStage' => 
    array (
      'columns' => 
      array (
        0 => 'createdAt',
        1 => 'stage',
      ),
    ),
    'assignedUserStage' => 
    array (
      'columns' => 
      array (
        0 => 'assignedUserId',
        1 => 'stage',
      ),
    ),
  ),
);
?>