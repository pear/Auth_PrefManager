--TEST--
Auth_PrefManager::deletePref(): Preference exists. Default exists.
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

$defaultvalue = $pref->getdefaultpref('foo');
$uservalue = $pref->getpref('jbloggs', 'foo');

print "default:foo:".formatvalue($defaultvalue)
  ."\n"
  ."jbloggs:foo:".formatvalue($uservalue);

$result = $pref->deletePref('jbloggs', 'foo');

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
default:foo:"bar"
jbloggs:foo:"baz"
default:foo:"bar"
jbloggs:foo:"bar"
