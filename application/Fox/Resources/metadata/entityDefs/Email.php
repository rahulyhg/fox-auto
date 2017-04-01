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
    'subject' => 
    array (
      'type' => 'varchar',
      'required' => true,
      'notStorable' => true,
      'view' => 'views/email/fields/subject',
      'disabled' => true,
      'trim' => true,
    ),
    'fromName' => 
    array (
      'type' => 'varchar',
    ),
    'fromString' => 
    array (
      'type' => 'varchar',
    ),
    'replyToString' => 
    array (
      'type' => 'varchar',
    ),
    'from' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'required' => true,
      'view' => 'views/email/fields/from-address-varchar',
    ),
    'to' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'required' => true,
      'view' => 'views/email/fields/email-address-varchar',
    ),
    'cc' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'view' => 'views/email/fields/email-address-varchar',
    ),
    'bcc' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'view' => 'views/email/fields/email-address-varchar',
    ),
    'replyTo' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'view' => 'views/email/fields/email-address-varchar',
    ),
    'personStringData' => 
    array (
      'type' => 'varchar',
      'notStorable' => true,
      'disabled' => true,
    ),
    'isRead' => 
    array (
      'type' => 'bool',
      'notStorable' => true,
      'default' => true,
    ),
    'isNotRead' => 
    array (
      'type' => 'bool',
      'notStorable' => true,
      'layoutListDisabled' => true,
      'layoutDetailDisabled' => true,
      'layoutMassUpdateDisabled' => true,
    ),
    'isImportant' => 
    array (
      'type' => 'bool',
      'notStorable' => true,
      'default' => false,
    ),
    'inTrash' => 
    array (
      'type' => 'bool',
      'notStorable' => true,
      'default' => false,
    ),
    'isUsers' => 
    array (
      'type' => 'bool',
      'notStorable' => true,
      'default' => false,
    ),
    'nameHash' => 
    array (
      'type' => 'text',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'typeHash' => 
    array (
      'type' => 'text',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'idHash' => 
    array (
      'type' => 'text',
      'notStorable' => true,
      'readOnly' => true,
      'disabled' => true,
    ),
    'messageId' => 
    array (
      'type' => 'varchar',
      'maxLength' => 255,
      'readOnly' => true,
    ),
    'messageIdInternal' => 
    array (
      'type' => 'varchar',
      'maxLength' => 300,
      'readOnly' => true,
      'index' => true,
    ),
    'emailAddress' => 
    array (
      'type' => 'base',
      'notStorable' => true,
      'view' => 'views/email/fields/email-address',
    ),
    'fromEmailAddress' => 
    array (
      'type' => 'link',
      'view' => 'views/fields/from-email-address',
    ),
    'toEmailAddresses' => 
    array (
      'type' => 'linkMultiple',
    ),
    'ccEmailAddresses' => 
    array (
      'type' => 'linkMultiple',
    ),
    'bodyPlain' => 
    array (
      'type' => 'text',
      'readOnly' => true,
      'seeMoreDisabled' => true,
    ),
    'body' => 
    array (
      'type' => 'wysiwyg',
      'seeMoreDisabled' => true,
    ),
    'isHtml' => 
    array (
      'type' => 'bool',
      'default' => true,
    ),
    'status' => 
    array (
      'type' => 'enum',
      'options' => 
      array (
        0 => 'Draft',
        1 => 'Sending',
        2 => 'Sent',
        3 => 'Archived',
        4 => 'Failed',
      ),
      'readOnly' => true,
      'default' => 'Archived',
    ),
    'attachments' => 
    array (
      'type' => 'attachmentMultiple',
      'sourceList' => 
      array (
        0 => 'Document',
      ),
    ),
    'hasAttachment' => 
    array (
      'type' => 'bool',
      'readOnly' => true,
    ),
    'parent' => 
    array (
      'type' => 'linkParent',
    ),
    'dateSent' => 
    array (
      'type' => 'datetime',
    ),
    'deliveryDate' => 
    array (
      'type' => 'datetime',
      'readOnly' => true,
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
    'replied' => 
    array (
      'type' => 'link',
      'noJoin' => true,
      'readOnly' => true,
    ),
    'replies' => 
    array (
      'type' => 'linkMultiple',
      'readOnly' => true,
    ),
    'isSystem' => 
    array (
      'type' => 'bool',
      'default' => false,
      'readOnly' => true,
    ),
    'isJustSent' => 
    array (
      'type' => 'bool',
      'default' => false,
      'disabled' => true,
      'notStorable' => true,
    ),
    'teams' => 
    array (
      'type' => 'linkMultiple',
    ),
    'users' => 
    array (
      'type' => 'linkMultiple',
      'noLoad' => true,
      'layoutDetailDisabled' => true,
      'layoutListDisabled' => true,
      'layoutMassUpdateDisabled' => true,
      'readOnly' => true,
    ),
    'assignedUsers' => 
    array (
      'type' => 'linkMultiple',
      'layoutListDisabled' => true,
      'layoutMassUpdateDisabled' => true,
      'readOnly' => true,
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
    ),
    'assignedUsers' => 
    array (
      'type' => 'hasMany',
      'entity' => 'User',
      'relationName' => 'entityUser',
    ),
    'users' => 
    array (
      'type' => 'hasMany',
      'entity' => 'User',
      'foreign' => 'emails',
      'additionalColumns' => 
      array (
        'isRead' => 
        array (
          'type' => 'bool',
          'default' => false,
        ),
        'isImportant' => 
        array (
          'type' => 'bool',
          'default' => false,
        ),
        'inTrash' => 
        array (
          'type' => 'bool',
          'default' => false,
        ),
      ),
    ),
    'attachments' => 
    array (
      'type' => 'hasChildren',
      'entity' => 'Attachment',
      'foreign' => 'parent',
      'relationName' => 'attachments',
    ),
    'parent' => 
    array (
      'type' => 'belongsToParent',
      'entityList' => 
      array (
      ),
      'foreign' => 'emails',
    ),
    'replied' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'Email',
      'foreign' => 'replies',
    ),
    'replies' => 
    array (
      'type' => 'hasMany',
      'entity' => 'Email',
      'foreign' => 'replied',
    ),
    'fromEmailAddress' => 
    array (
      'type' => 'belongsTo',
      'entity' => 'EmailAddress',
    ),
    'toEmailAddresses' => 
    array (
      'type' => 'hasMany',
      'entity' => 'EmailAddress',
      'relationName' => 'emailEmailAddress',
      'conditions' => 
      array (
        'addressType' => 'to',
      ),
      'additionalColumns' => 
      array (
        'addressType' => 
        array (
          'type' => 'varchar',
          'len' => '4',
        ),
      ),
    ),
    'ccEmailAddresses' => 
    array (
      'type' => 'hasMany',
      'entity' => 'EmailAddress',
      'relationName' => 'emailEmailAddress',
      'conditions' => 
      array (
        'addressType' => 'cc',
      ),
      'additionalColumns' => 
      array (
        'addressType' => 
        array (
          'type' => 'varchar',
          'len' => '4',
        ),
      ),
    ),
    'bccEmailAddresses' => 
    array (
      'type' => 'hasMany',
      'entity' => 'EmailAddress',
      'relationName' => 'emailEmailAddress',
      'conditions' => 
      array (
        'addressType' => 'bcc',
      ),
      'additionalColumns' => 
      array (
        'addressType' => 
        array (
          'type' => 'varchar',
          'len' => '4',
        ),
      ),
    ),
  ),
  'collection' => 
  array (
    'sortBy' => 'dateSent',
    'asc' => false,
  ),
  'indexes' => 
  array (
    'dateSentAssignedUser' => 
    array (
      'columns' => 
      array (
        0 => 'dateSent',
        1 => 'assignedUserId',
      ),
    ),
    'dateSent' => 
    array (
      'columns' => 
      array (
        0 => 'dateSent',
        1 => 'deleted',
      ),
    ),
    'dateSentStatus' => 
    array (
      'columns' => 
      array (
        0 => 'dateSent',
        1 => 'status',
        2 => 'deleted',
      ),
    ),
  ),
);
?>