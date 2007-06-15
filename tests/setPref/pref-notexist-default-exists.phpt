--TEST--
Auth_PrefManager::setPref(): Preference does not exist.
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
