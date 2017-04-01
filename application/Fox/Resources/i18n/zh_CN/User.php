<?php
return array (
  'fields' => 
  array (
    'name' => '姓名',
    'userName' => '用户名',
    'title' => '标题',
    'isAdmin' => '是否管理员',
    'defaultTeam' => '默认团队',
    'emailAddress' => '邮箱',
    'phoneNumber' => '电话',
    'roles' => '角色',
    'teamRole' => '职位',
    'password' => '密码',
    'currentPassword' => '原密码',
    'passwordConfirm' => '确认密码',
    'newPassword' => '新密码',
    'newPasswordConfirm' => '确认新密码',
    'avatar' => '头像',
    'isActive' => '是否激活',
    'agent' => '分机号',
    'company' => '公司名称',
    'loginTimes' => '登陆次数',
    'isCompanyAdmin' => '是否公司管理员',
    'lastLoginTime' => '最后登录时间',
  ),
  'links' => 
  array (
    'teams' => '团队',
    'roles' => '角色',
  ),
  'labels' => 
  array (
    'Create User' => '创建用户',
    'Generate' => '密码生成',
    'Access' => '访问',
    'Preferences' => '参数选择',
    'Change Password' => '修改密码',
    'Teams and Access Control' => '团队和访问控制',
    'Forgot Password?' => '忘记密码?',
    'Password Change Request' => '密码变更请求',
    'Email Address' => '邮箱地址',
    'External Accounts' => '对外账户',
    'Email Accounts' => '邮箱帐号',
  ),
  'tooltips' => 
  array (
    'defaultTeam' => '这个用户创建的所有记录将默认关联到团队.',
    'userName' => '只能填写字母 a-z, 数字 0-9 和下划线.',
    'isAdmin' => 'Admin用户拥有所有权限.',
    'isActive' => '未经验证的用户无法登录.',
    'teams' => '用户所属的团队. 访问控制权限是继承自团队中的角色.',
    'roles' => '附加访问规则. 如果用户不属于任何团队或者你需要为这个用户扩展访问控制权限时使用它.',
  ),
  'messages' => 
  array (
    'passwordWillBeSent' => '密码将会发送到用户的邮箱.',
    'accountInfoEmailSubject' => 'FoxCRM 用户访问信息',
    'accountInfoEmailBody' => '你的访问信息:

Username: {userName}
Password: {password}

{siteUrl}',
    'passwordChangeLinkEmailSubject' => '更改密码请求',
    'passwordChangeLinkEmailBody' => '你可以在这个链接更改你的密码 {link}. 这个唯一的 url 将很快失效.',
    'passwordChanged' => '密码已经被更改',
    'userCantBeEmpty' => '用户名不能为空',
    'wrongUsernamePasword' => '错误 用户名/密码',
    'emailAddressCantBeEmpty' => '邮箱地址不能为空',
    'userNameEmailAddressNotFound' => '找不到用户名/邮箱地址',
    'forbidden' => '禁止, 请稍后再试',
    'uniqueLinkHasBeenSent' => '那个唯一的链接已经发送到指定邮箱地址.',
    'passwordChangedByRequest' => '密码已经更改.',
  ),
  'boolFilters' => 
  array (
    'onlyMyTeam' => '只有我的团队',
  ),
);
?>