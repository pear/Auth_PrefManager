--TEST--
Auth_PrefManager::getDefaultPref(): Database Error. PEAR Error Reporting.
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
			'userColumn' => 'notexist',
			'usePEARError' => true,
			));

$value = $pref->getDefaultPref('foo');

if (PEAR::isError($value)) {

	print "ok\n"
		.$pref->_lastError;

} else {

	print "failure\n";
	print_r($value);

}

?>
--EXPECT--
ok
DB Error: no such field
