--TEST--
Auth_PrefManager::setDefaultPref(): Database Error. Classic Reporting.
--SKIPIF--
<?php require dirname(dirname(__FILE__)) . '/setup.php'; ?>
--FILE--
<?php

require 'setup.php';

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

$result = $pref->setDefaultPref('foo', 'spoon');

if ($result === false) {

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
