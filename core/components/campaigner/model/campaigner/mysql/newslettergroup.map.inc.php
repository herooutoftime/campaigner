<?php
$xpdo_meta_map['NewsletterGroup']= array (
  'package' => 'campaigner',
  'table' => 'newsletter_group',
  'fields' => 
  array (
    'newsletter' => NULL,
    'group' => NULL,
  ),
  'fieldMeta' => 
  array (
    'newsletter' => 
    array (
      'dbtype' => 'smallint',
      'precision' => '5',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
    ),
    'group' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '3',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
    ),
  ),
  'indexes' => 
  array (
    'PRIMARY' => 
    array (
      'alias' => 'PRIMARY',
      'primary' => true,
      'unique' => true,
      'columns' => 
      array (
        'id' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'Newsletter' => 
    array (
      'class' => 'Newsletter',
      'local' => 'newsletter',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Group' => 
    array (
      'class' => 'Group',
      'local' => 'group',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
