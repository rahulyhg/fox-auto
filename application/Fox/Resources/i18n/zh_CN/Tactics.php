<?php
return array (
  'fields' => 
  array (
    'name' => '策略类型',
    'status' => '审核状态',
    'province' => '省份',
    'v1' => '字段1',
    'auditAt' => '审核时间',
    'auditBy' => '审核人',
    'createdAt' => '创建时间',
    'createdBy' => '创建人',
    'v2' => '字段2',
    'v3' => '字段3',
    'v4' => '字段4',
    'desc' => '说明',
    'reason' => '审核理由',
  ),
  'links' => 
  array (
  ),
  'labels' => 
  array (
    'Create Tactics' => '添加策略',
  ),
  'options' => 
  array (
    'name' => 
    array (
      1 => '粉丝分成设置',
      2 => '用户异常投诉时段',
      3 => '订单导入时间间隔',
      4 => '抢单过期时间',
    ),
    'status' => 
    array (
      0 => '未审核',
      1 => '通过',
      2 => '否决',
      5 => '无效',
    ),
  ),
  'actions' => 
  array (
    'read' => '查看',
    'edit' => '编辑',
    'delete' => '删除',
    'examine' => '审核',
  ),
);
?>