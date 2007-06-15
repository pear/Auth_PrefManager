--TEST--
Auth_PrefManager::setDefaultPref(): Preference exists. Default does not exist.
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

$result = $pref->setDefaultPref('foo', 'spoon');

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
default:foo:"spoon"
jbloggs:foo:"baz"
