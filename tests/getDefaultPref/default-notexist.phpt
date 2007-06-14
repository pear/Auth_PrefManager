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

$value = $pref->getDefaultPref('foo');

print "default:foo:".$value;

if (is_null($value))
	print "NULL";

?>
--EXPECT--
default:foo:NULL
