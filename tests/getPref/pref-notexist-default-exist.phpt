--TEST--
Auth_PrefManager::getPref(): Preference does not exist. Default does.
--FILE--
<?php

require 'setup.php';

createDatabase(
    array(
      '__default__' => array(
        'foo' => 'bar',
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
jbloggs:foo:"bar"
