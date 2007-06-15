--TEST--
Auth_PrefManager::setPref(): Database Error. PEAR Error Reporting.
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

$result = $pref->setPref('jbloggs', 'foo', 'spoon');

if (PEAR::isError($result)) {

	print "ok\n"
		.$result->getMessage();

} else {

	print "failure\n";
	print_r($result);

}

?>
--EXPECT--
ok
DB Error: no such field
