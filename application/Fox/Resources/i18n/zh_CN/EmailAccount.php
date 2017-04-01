<?php
return array (
  'fields' => 
  array (
    'name' => '名字',
    'status' => '状态',
    'host' => '主机',
    'username' => '用户名',
    'password' => '密码',
    'port' => '端口',
    'monitoredFolders' => '监控文件夹',
    'ssl' => 'SSL',
    'fetchSince' => 'Fetch Since',
    'emailAddress' => 'Email Address',
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
  ),
  'labels' => 
  array (
    'Create EmailAccount' => '创建电子邮件账户',
    'IMAP' => 'IMAP',
    'Main' => 'Main',
    'Test Connection' => '测试连接',
  ),
  'messages' => 
  array (
    'couldNotConnectToImap' => '无法链接到 IMAP 服务器',
    'connectionIsOk' => '连接成功',
  ),
  'tooltips' => 
  array (
    'monitoredFolders' => '你可以添加“发送”文件夹同步电子邮件从外部电子邮件客户端发送.',
  ),
);
?>