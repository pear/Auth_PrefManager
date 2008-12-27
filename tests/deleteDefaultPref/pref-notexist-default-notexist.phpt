--TEST--
Auth_PrefManager::getPref(): Preference does not exist. Default does not exist.
--SKIPIF--
<?php require dirname(dirname(__FILE__)) . '/setup.php'; ?>
--FILE--
<?php

require dirname(dirname(__FILE__)) . '/setup.php';

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

$result = $pref->deleteDefaultPref('foo');

print "\n";

if ($result === false) {

  print "failure\n"
    .$pref->_lastError;

} else {

  $defaultvalue = $pref->getdefaultpref('foo');
  $uservalue = $pref->getpref('jbloggs', 'foo');

  print "default:foo:".formatvalue($defaultvalue)
    ."\n"
    ."jbloggs:foo:".formatvalue($uservalue);

}

?>
--EXPECT--
default:foo:NULL
jbloggs:foo:NULL
default:foo:NULL
jbloggs:foo:NULL
