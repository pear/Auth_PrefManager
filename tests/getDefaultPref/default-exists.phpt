--TEST--
Auth_PrefManager::getDefaultPref(): Preference does exist. Default does.
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

$value = $pref->getDefaultPref('foo');

print "default:foo:".$value;

?>
--EXPECT--
default:foo:bar
