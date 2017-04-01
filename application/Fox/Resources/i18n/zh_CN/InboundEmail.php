<?php
return array (
  'fields' => 
  array (
    'name' => '名字',
    'team' => '团队',
    'status' => '状态',
    'assignToUser' => '分配给用户',
    'host' => '主机',
    'username' => '用户名',
    'password' => '密码',
    'port' => '端口',
    'monitoredFolders' => 'Monitored Folders',
    'trashFolder' => 'Trash Folder',
    'ssl' => 'SSL',
    'createCase' => '创建案例',
    'reply' => '自动回复',
    'caseDistribution' => '案例分配',
    'replyEmailTemplate' => '回复邮件模版',
    'replyFromAddress' => '回复地址',
    'replyToAddress' => '回复地址',
    'replyFromName' => '回复名字',
    'targetUserPosition' => '目标用户地址',
  ),
  'tooltips' => 
  array (
    'reply' => '通知发件人邮件已收到.',
    'createCase' => '从收到的邮件自动创建案例.',
    'replyToAddress' => 'Specify email address of this mailbox to make responses come here.',
    'caseDistribution' => 'How cases will be assigned to. Assigned directly to the user or among the team.',
    'assignToUser' => 'User emails/cases will be assigned to.',
    'team' => 'Team emails/cases will be related to.',
    'targetUserPosition' => 'Define the position of users which will be destributed with cases.',
  ),
  'links' => 
  array (
  ),
  'options' => 
  array (
    'status' => 
    array (
      'Active' => '活跃',
      'Inactive' => '不活跃',
    ),
    'caseDistribution' => 
    array (
      'Direct-Assignment' => 'Direct-Assignment',
      'Round-Robin' => '循环',
      'Least-Busy' => 'Least-Busy',
    ),
  ),
  'labels' => 
  array (
    'Create InboundEmail' => '创建邮箱账户',
    'IMAP' => 'IMAP',
    'Actions' => '动作',
    'Main' => '主要',
  ),
  'messages' => 
  array (
    'couldNotConnectToImap' => '不能连接到 IMAP 服务器',
  ),
);
?>