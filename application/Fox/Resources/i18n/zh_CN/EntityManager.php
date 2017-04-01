<?php
return array (
  'labels' => 
  array (
    'Fields' => '字段',
    'Relationships' => '关系',
  ),
  'fields' => 
  array (
    'name' => '名字',
    'type' => '类型',
    'labelSingular' => 'Label Singular',
    'labelPlural' => 'Label Plural',
    'stream' => 'Stream',
    'label' => '标签',
    'linkType' => 'Link Type',
    'entityForeign' => 'Foreign Entity',
    'linkForeign' => 'Foreign Link',
    'link' => '链接',
    'labelForeign' => 'Foreign Label',
    'sortBy' => '默认顺序 (字段)',
    'sortDirection' => '默认顺序 (方向)',
  ),
  'options' => 
  array (
    'type' => 
    array (
      '' => 'None',
      'Base' => 'Base',
      'Person' => 'Person',
      'CategoryTree' => '分类树',
    ),
    'linkType' => 
    array (
      'manyToMany' => '多对多',
      'oneToMany' => '一对多',
      'manyToOne' => '多对一',
      'parentToChildren' => 'Parent-to-Children',
      'childrenToParent' => 'Children-to-Parent',
    ),
    'sortDirection' => 
    array (
      'asc' => '递增',
      'desc' => '递减',
    ),
  ),
  'messages' => 
  array (
    'entityCreated' => '创建实体',
    'linkAlreadyExists' => '冲突：链接已存在.',
  ),
);
?>