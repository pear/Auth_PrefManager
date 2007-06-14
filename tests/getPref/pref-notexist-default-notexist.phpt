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

$value = $pref->getPref('jbloggs', 'foo');

print "jbloggs:foo:".$value;

if (is_null($value))
	print "NULL";

?>
--EXPECT--
jbloggs:foo:NULL
