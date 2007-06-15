--TEST--
Auth_PrefManager::getPref(): Preference exists. Default does not exist.
--FILE--
<?php

require 'setup.php';

createDatabase(
		array(
			'jbloggs' => array(
				'foo' => 'baz',
				),
			)
		);

$pref = new Auth_PrefManager($GLOBALS['dsn'],
		array(
			'table' => $GLOBALS['tableName'],
			));

$defaultValue = $pref->getDefaultPref('foo');
$userValue = $pref->getPref('jbloggs', 'foo');

print "default:foo:".formatValue($defaultValue)
	."\n"
	."jbloggs:foo:".formatValue($userValue);

?>
--EXPECT--
default:foo:NULL
jbloggs:foo:"baz"
