<?php
return array (
  'labels' => 
  array (
    'Create Campaign' => '创建 任务',
  ),
  'fields' => 
  array (
    'hopperLevel' => '每次期望提取Lead数量',
    'resetHopper' => '强制设置提取Leads数量',
    'dialMethod' => '拨号模式',
    'autoDialLevel' => '按比例拨号，如2.0是按照2倍进行拨号外呼',
    'availableOnlyRatioTally' => '通话和队列的用户是否为可用状态',
    'adaptiveDroppedPercentage' => '最小掉线率(%)',
    'adaptiveMaximumLevel' => '预拨号级别(仅支持数字)',
    'waitforsilenceOptions' => '固定预测外拨线程数',
    'amdSendToVmx' => '是否固定外拨线程数',
    'adaptiveIntensity' => '预拨号强度',
    'adaptiveDlDiffTarget' => '不同的拨号目标',
    'concurrentTransfers' => '并发派CALL数量',
    'queuePriority' => '队列级别',
    'dropRateGroup' => '活动组的掉线率控制',
    'autoAltDial' => '自动拨打备用号',
    'nextAgentCall' => '派Call策略',
    'localCallTime' => '话务时间',
    'dialTimeout' => '拨号超时(秒)',
    'dialPrefix' => '拨号前缀(该活动中外拨号码不想加前缀请用大写X)',
    'omitPhoneCode' => '屏蔽区号',
    'campaignCid' => '活动外线显示号码',
    'campaignId' => '任务ID',
    'users' => 'Users',
    'autoactive' => '外呼开关',
    'active' => '激活',
    'adaptiveLatestServerTime' => '拨号停止的时间，格式为小时+分钟，如下午六点钟：1800',
    'name' => '任务名称',
    'description' => '描述',
    'status' => '状态',
    'importCount' => '号码总数',
    'dialedCount' => '已拨打数',
    'type' => '类型',
  ),
  'options' => 
  array (
    'hopperLevel' => 
    array (
      1 => '1',
      5 => '5',
      10 => '10',
      20 => '20',
    ),
    'dialMethod' => 
    array (
    ),
    'autoDialLevel' => 
    array (
      1 => '1',
      2 => '2',
      3 => '3',
      4 => '4',
      5 => '5',
      6 => '6',
      7 => '7',
      8 => '8',
    ),
    'adaptiveDroppedPercentage' => 
    array (
    ),
    'adaptiveIntensity' => 
    array (
    ),
    'adaptiveDlDiffTarget' => 
    array (
    ),
    'concurrentTransfers' => 
    array (
    ),
    'queuePriority' => 
    array (
    ),
    'dropRateGroup' => 
    array (
    ),
    'autoAltDial' => 
    array (
    ),
    'nextAgentCall' => 
    array (
    ),
    'localCallTime' => 
    array (
    ),
    'status' => 
    array (
      'Planning' => 'Planning',
      'Active' => 'Active',
      'Inactive' => 'Inactive',
      'Complete' => 'Complete',
    ),
    'type' => 
    array (
      'click' => '手动外呼',
      'auto' => '自动外呼',
    ),
  ),
  'links' => 
  array (
    'users' => 'Users',
  ),
);
?>