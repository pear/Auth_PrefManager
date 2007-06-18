--TEST--
Auth_PrefManager::getDefaultPref(): Preference does exist. Default does not exist.
--FILE--
<?php

require 'setup.php';

createDatabase(
    array(
      'jbloggs' => array(
        'foo' => 'baz',
        ),
      ));

$pref = new Auth_PrefManager($GLOBALS['dsn'],
    array(
      'table' => $GLOBALS['tableName'],
      ));

$defaultvalue = $pref->getdefaultpref('foo');
$uservalue = $pref->getpref('jbloggs', 'foo');

print "default:foo:".formatvalue($defaultvalue)
  ."\n"
  ."jbloggs:foo:".formatvalue($uservalue);

?>
--EXPECT--
default:foo:NULL
jbloggs:foo:"baz"
