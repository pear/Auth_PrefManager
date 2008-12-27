--TEST--
Auth_PrefManager::setPref(): Preference exists.
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

$result = $pref->setPref('jbloggs', 'foo', 'spoon');

if ($result === false) {

  print "failure\n"
    .$pref->_lastError;

} else {

  $defaultValue = $pref->getDefaultPref('foo');
  $userValue = $pref->getPref('jbloggs', 'foo');

  print "default:foo:".formatValue($defaultValue)
    ."\n"
    ."jbloggs:foo:".formatValue($userValue);

}

?>
--EXPECT--
default:foo:"bar"
jbloggs:foo:"spoon"
