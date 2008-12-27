--TEST--
Auth_PrefManager::deletePref(): Database Error. Classic Error Reporting.
--SKIPIF--
<?php require dirname(dirname(__FILE__)) . '/setup.php'; ?>
--FILE--
<?php

require dirname(dirname(__FILE__)) . '/setup.php';

createDatabase(
    array(
      '__default__' => array(
        'foo' => 'bar',
        ),
      'jbloggs' => array(
        'foo' => 'baz',
        ),
      )
    );

$pref = new Auth_PrefManager($GLOBALS['dsn'],
    array(
      'table' => $GLOBALS['tableName'],
      'userColumn' => 'notexist',
      ));

$value = $pref->deletePref('jbloggs', 'foo');

if ($value === false) {

  print "ok\n"
    .$pref->_lastError;

} else {

  print "failure\n";
  print_r($value);

}

?>
--EXPECT--
ok
DB Error: no such field
