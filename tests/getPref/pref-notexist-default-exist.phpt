--TEST--
Auth_PrefManager::getPref(): Preference does not exist. Default does.
--FILE--
<?php

require 'setup.php';

createDatabase(
		array(
			'__default__' => array(
				'foo' => 'bar',
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
jbloggs:foo:bar
