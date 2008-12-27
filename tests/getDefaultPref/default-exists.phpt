--TEST--
Auth_PrefManager::getDefaultPref(): Preference does exist. Default does.
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
      ));

$defaultValue = $pref->getDefaultPref('foo');
$userValue = $pref->getPref('jbloggs', 'foo');

print "default:foo:".formatValue($defaultValue)
  ."\n"
  ."jbloggs:foo:".formatValue($userValue);

?>
--EXPECT--
default:foo:"bar"
jbloggs:foo:"baz"
