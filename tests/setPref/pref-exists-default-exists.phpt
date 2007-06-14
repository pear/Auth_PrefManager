--TEST--
Auth_PrefManager::setPref(): Preference exists.
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

$result = $pref->setPref('jbloggs', 'foo', 'spoon');

if ($result === false) {

	print "failure\n"
		.$pref->_lastError;

} else {

	$value = $pref->getPref('jbloggs', 'foo');

	print "jbloggs:foo:".$value;

}

?>
--EXPECT--
jbloggs:foo:spoon
