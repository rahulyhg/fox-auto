<?php
return array (
  'fields' => 
  array (
    'name' => '语音导航名称',
    'prompt' => '提示语音',
    'timeoutPrompt' => '超时语音提示',
    'invalidPrompt' => '错误语音提示',
    'timeout' => '超时时间',
    'repeat' => '语音重复次数',
    'timeCheck' => '导航的有效时间检查',
    'queue' => '导航所属呼入组',
    'status' => '状态',
    'checkReason' => '审核理由',
    'callTime' => '话务时间',
  ),
  'labels' => 
  array (
    'Create Ivr' => '创建 IVR配置',
  ),
  'options' => 
  array (
    'timeCheck' => 
    array (
      1 => '检查',
      0 => '不检查',
    ),
    'status' => 
    array (
      1 => '审核通过',
      0 => '未审核',
      2 => '审核不通过',
    ),
    'callTime' => 
    array (
      '0900-1800' => '0900-1800 - 0900-2100',
      '12pm-5pm' => '12pm-5pm - default 12pm to 5pm calling',
      '12pm-9pm' => '12pm-9pm - default 12pm to 9pm calling',
      '24hours' => '24hours - default 24 hours calling',
      '5pm-9pm' => '5pm-9pm - default 5pm to 9pm calling',
      '8am-9am' => '8am-9am - default 8am to 9am calling',
      '9am-21pm' => '9am-21pm - 9am-21pm',
      '9am-5pm' => '9am-5pm - default 9am to 5pm calling',
      '9am-9pm' => '9am-9pm - default 8am to 10am calling',
      'GDB_IVR' => 'GDB_IVR - GDB_IVR',
      'MINI_IB' => 'MINI_IB - 9:00---21:00',
      'MINIIB_HD' => 'MINIIB_HD - MINIIB_HD',
      'tsib' => 'tsib - tsib',
    ),
  ),
);
?>