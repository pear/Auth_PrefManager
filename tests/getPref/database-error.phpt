--TEST--
Auth_PrefManager::getPref(): Database Error. Classic Error Reporting.
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
			));

$value = $pref->getPref('jbloggs', 'foo');

if (is_null($value)) {

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
