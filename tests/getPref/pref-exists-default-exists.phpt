--TEST--
Auth_PrefManager::getPref(): Preference exists. Default exists.
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
      ));

$defaultvalue = $pref->getdefaultpref('foo');
$uservalue = $pref->getpref('jbloggs', 'foo');

print "default:foo:".formatvalue($defaultvalue)
  ."\n"
  ."jbloggs:foo:".formatvalue($uservalue);

?>
--expect--
default:foo:"bar"
jbloggs:foo:"baz"
