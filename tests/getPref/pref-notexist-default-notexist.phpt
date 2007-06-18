--TEST--
Auth_PrefManager::getPref(): Preference does not exist. Default does not exist.
--FILE--
<?php

require 'setup.php';

createDatabase();

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
default:foo:NULL
jbloggs:foo:NULL
