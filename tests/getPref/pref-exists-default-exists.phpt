--TEST--
Auth_PrefManager::getPref(): Preference exists.
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

$value = $pref->getPref('jbloggs', 'foo');

print "jbloggs:foo:".$value;

?>
--EXPECT--
jbloggs:foo:baz
