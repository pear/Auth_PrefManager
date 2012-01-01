--TEST--
Auth_PrefManager::setDefaultPref(): Database Error. PEAR Error Reporting.
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
      'usePEARError' => true,
      ));

$result = $pref->setDefaultPref('foo', 'spoon');

if (PEAR::isError($result)) {

  print "ok\n"
    .$result->getMessage();

} else {

  print "failure\n";
  print_r($result);

}

?>
--EXPECT--
ok
DB Error: no such field
