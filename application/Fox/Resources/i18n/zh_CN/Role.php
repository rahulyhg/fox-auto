<?php
return array (
  'fields' => 
  array (
    'name' => '标题',
    'companyName' => '公司名称',
    'companyId' => '选择公司',
    'roles' => '角色',
    'assignmentPermission' => '作业许可',
    'userPermission' => '用户许可',
    'showPhonenumber' => '是否隐藏电话号码',
    'campaignAssign' => '任务分配许可',
    'import' => '导入许可',
    'export' => '导出许可',
    'company' => '公司名称',
    'msgPermission' => '发送短信许可',
  ),
  'links' => 
  array (
    'users' => '用户',
    'teams' => '团队',
  ),
  'tooltips' => 
  array (
    'assignmentPermission' => '允许有权限的用户可以分配记录给其他用户.

all - no restriction

team - can assign users from own teams

no - can assign only to self',
  ),
  'labels' => 
  array (
    'Access' => '存取',
    'Create Role' => '创建角色',
  ),
  'options' => 
  array (
    'accessList' => 
    array (
      'not-set' => 'not-set',
      'enabled' => '启用',
      'disabled' => '禁用',
    ),
    'levelList' => 
    array (
      'all' => '所有',
      'team' => '团队',
      'own' => '个人',
      'no' => 'no',
    ),
    'assignmentPermission' => 
    array (
      'all' => '所有',
      'team' => '团队',
      'not-set' => 'not-set',
    ),
  ),
  'actions' => 
  array (
    'read' => '查看',
    'edit' => '编辑',
    'delete' => '删除',
  ),
  'messages' => 
  array (
    'changesAfterClearCache' => '所有修改将到清除缓存后生效.',
  ),
);
?>