<?php
return array (
  'fields' => 
  array (
    'name' => '名字',
    'status' => '状态',
    'job' => '工作',
    'scheduling' => '线程调度 (crontab 符号)',
  ),
  'links' => 
  array (
    'log' => '日志',
  ),
  'labels' => 
  array (
    'Create ScheduledJob' => '创建计划工作',
  ),
  'options' => 
  array (
    'job' => 
    array (
      'Cleanup' => '清除',
    ),
    'cronSetup' => 
    array (
      'linux' => 'Note: Add this line to the crontab file to run Fox Scheduled Jobs:',
      'mac' => 'Note: Add this line to the crontab file to run Fox Scheduled Jobs:',
      'windows' => 'Note: Create a batch file with the following commands to run Fox Scheduled Jobs using Windows Scheduled Tasks:',
      'default' => 'Note: Add this command to Cron Job (Scheduled Task):',
    ),
    'status' => 
    array (
      'Active' => '活跃',
      'Inactive' => '不活跃',
    ),
  ),
);
?>