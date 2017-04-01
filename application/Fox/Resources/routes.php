<?php
return array (
  array (
    'route' => '/',
    'method' => 'get',
    'params' => '<h1>CRM REST API</h1>',
  ),
  array (
    'route' => '/App/user',
    'method' => 'get',
    'params' => 
    array (
      'controller' => 'App',
      'action' => 'user',
    ),
  ),
  array (
        'route' => '/Activities',
        'method' => 'get',
        'params' =>
        array (
            'controller' => 'Activities',
            'action' => 'listCalendarEvents',
        ),
    ),
  array (
        'route' => '/Activities/:scope/:id/:name',
        'method' => 'get',
        'params' =>
        array (
            'controller' => 'Activities',
            'action' => 'list',
            'scope' => ':scope',
            'id' => ':id',
            'name' => ':name',
        ),
    ),
  array (
    'route' => '/App/returnordernum/:id',
    'method' => 'get',
    'params' => 
    array (
      'controller' => 'App',
      'action' => 'returnordernum',
      'id' => ':id',
    ),
  ),
  array (
    'route' => '/App/WechatAuth',
    'method' => 'post',
    'conditions' => 
    array (
      'auth' => false,
    ),
    'params' => 
    array (
      'controller' => 'App',
      'action' => 'WechatAuth',
    ),
  ),
  array (
    'route' => '/App/WechatAuth',
    'method' => 'get',
    'conditions' => 
    array (
      'auth' => false,
    ),
    'params' => 
    array (
      'controller' => 'App',
      'action' => 'WechatAuth',
    ),
  ),
  array (
    'route' => '/Metadata',
    'method' => 'get',
    'params' => 
    array (
      'controller' => 'Metadata',
        'action' => 'Read'
    ),
  ),
  array (
    'route' => '/I18n',
    'params' => 
    array (
      'controller' => 'I18n',
        'action' => 'Read'
    ),
    'conditions' => 
    array (
      'auth' => false,
    ),
  ),
  array (
    'route' => '/Settings',
    'method' => 'get',
    'params' => 
    array (
      'controller' => 'Settings',
        'action' => 'Read'
    ),
    'conditions' => 
    array (
      'auth' => false,
    ),
  ),
  12 => 
  array (
    'route' => '/Settings',
    'method' => 'patch',
    'params' => 
    array (
      'controller' => 'Settings',
        'action' => 'Read'
    ),
  ),
  13 => 
  array (
    'route' => 'User/passwordChangeRequest',
    'method' => 'post',
    'params' => 
    array (
      'controller' => 'User',
      'action' => 'passwordChangeRequest',
    ),
    'conditions' => 
    array (
      'auth' => false,
    ),
  ),
  array (
    'route' => 'User/changePasswordByRequest',
    'method' => 'post',
    'params' => 
    array (
      'controller' => 'User',
      'action' => 'changePasswordByRequest',
    ),
    'conditions' => 
    array (
      'auth' => false,
    ),
  ),
  array (
    'route' => '/Stream',
    'method' => 'get',
    'params' => 
    array (
      'controller' => 'Stream',
      'action' => 'list',
      'scope' => 'User',
    ),
  ),
  array (
    'route' => '/GlobalSearch',
    'method' => 'get',
    'params' => 
    array (
      'controller' => 'GlobalSearch',
      'action' => 'search',
    ),
  ),
    array (
        'route' => '/:controller',
        'method' => 'get',
        'params' =>
        array (
            'controller' => ':controller',
            'action' => 'list',
        ),
    ),
  array (
    'route' => '/:controller/action/:action',
    'method' => 'post',
    'params' => 
    array (
      'controller' => ':controller',
      'action' => ':action',
    ),
  ),
  array (
    'route' => '/:controller/action/:action',
    'method' => 'put',
    'params' => 
    array (
      'controller' => ':controller',
      'action' => ':action',
    ),
  ),
  array (
    'route' => '/:controller/action/:action',
    'method' => 'get',
    'params' => 
    array (
      'controller' => ':controller',
      'action' => ':action',
    ),
  ),
  array (
    'route' => '/:controller/action/:action/:id',
    'method' => 'get',
    'params' => 
    array (
      'controller' => ':controller',
      'action' => ':action',
      'id' => ':id',
    ),
  ),
  array (
    'route' => '/:controller/layout/:name',
    'method' => 'get',
    'params' => 
    array (
      'controller' => 'Layout',
      'scope' => ':controller',
        'action' => 'read'
    ),
  ),
  array (
    'route' => '/:controller/layout/:name',
    'method' => 'put',
    'params' => 
    array (
      'controller' => 'Layout',
      'scope' => ':controller',
        'action' => 'update'
    ),
  ),
  array (
    'route' => '/:controller/layout/:name',
    'method' => 'patch',
    'params' => 
    array (
      'controller' => 'Layout',
      'scope' => ':controller',
        'action' => 'patch'
    ),
  ),
  array (
    'route' => '/Admin/rebuild',
    'method' => 'post',
    'params' => 
    array (
      'controller' => 'Admin',
      'action' => 'rebuild',
    ),
  ),
  array (
    'route' => '/Admin/clearCache',
    'method' => 'post',
    'params' => 
    array (
      'controller' => 'Admin',
      'action' => 'clearCache',
    ),
  ),
  array (
    'route' => '/Admin/jobs',
    'method' => 'get',
    'params' => 
    array (
      'controller' => 'Admin',
      'action' => 'jobs',
    ),
  ),
  array (
    'route' => '/Admin/fieldManager/:scope/:name',
    'method' => 'get',
    'params' => 
    array (
      'controller' => 'FieldManager',
      'action' => 'read',
      'scope' => ':scope',
      'name' => ':name',
    ),
  ),
  array (
    'route' => '/Admin/fieldManager/:scope',
    'method' => 'post',
    'params' => 
    array (
      'controller' => 'FieldManager',
      'action' => 'create',
      'scope' => ':scope',
    ),
  ),
  array (
    'route' => '/Admin/fieldManager/:scope/:name',
    'method' => 'put',
    'params' => 
    array (
      'controller' => 'FieldManager',
      'action' => 'update',
      'scope' => ':scope',
      'name' => ':name',
    ),
  ),
  array (
    'route' => '/Admin/fieldManager/:scope/:name',
    'method' => 'delete',
    'params' => 
    array (
      'controller' => 'FieldManager',
      'action' => 'delete',
      'scope' => ':scope',
      'name' => ':name',
    ),
  ),
  array (
    'route' => '/:controller/:id',
    'method' => 'get',
    'params' => 
    array (
      'controller' => ':controller',
      'action' => 'read',
      'id' => ':id',
    ),
  ),
 
  array (
    'route' => '/:controller',
    'method' => 'post',
    'params' => 
    array (
      'controller' => ':controller',
      'action' => 'create',
    ),
  ),
  array (
    'route' => '/:controller/:id',
    'method' => 'put',
    'params' => 
    array (
      'controller' => ':controller',
      'action' => 'update',
      'id' => ':id',
    ),
  ),
  array (
    'route' => '/:controller/:id',
    'method' => 'patch',
    'params' => 
    array (
      'controller' => ':controller',
      'action' => 'patch',
      'id' => ':id',
    ),
  ),
  array (
    'route' => '/:controller/:id',
    'method' => 'delete',
    'params' => 
    array (
      'controller' => ':controller',
      'action' => 'delete',
      'id' => ':id',
    ),
  ),
  array (
    'route' => '/:controller/:id/stream',
    'method' => 'get',
    'params' => 
    array (
      'controller' => 'Stream',
      'action' => 'list',
      'id' => ':id',
      'scope' => ':controller',
    ),
  ),
  array (
    'route' => '/:controller/:id/subscription',
    'method' => 'put',
    'params' => 
    array (
      'controller' => ':controller',
      'id' => ':id',
      'action' => 'follow',
    ),
  ),
  array (
    'route' => '/:controller/:id/subscription',
    'method' => 'delete',
    'params' => 
    array (
      'controller' => ':controller',
      'id' => ':id',
      'action' => 'unfollow',
    ),
  ),
  array (
    'route' => '/:controller/:id/:link',
    'method' => 'get',
    'params' => 
    array (
      'controller' => ':controller',
      'action' => 'listLinked',
      'id' => ':id',
      'link' => ':link',
    ),
  ),
  array (
    'route' => '/:controller/:id/:link',
    'method' => 'post',
    'params' => 
    array (
      'controller' => ':controller',
      'action' => 'createLink',
      'id' => ':id',
      'link' => ':link',
    ),
  ),
  array (
    'route' => '/:controller/:id/:link',
    'method' => 'delete',
    'params' => 
    array (
      'controller' => ':controller',
      'action' => 'removeLink',
      'id' => ':id',
      'link' => ':link',
    ),
  ),
);
