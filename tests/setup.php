<?php

set_include_path(dirname(dirname(__FILE__)) . ':' .get_include_path());

require_once 'PrefManager.php';

$dsn = "pgsql://test:test@unix(/var/run/postgresql/)/test";
$tableName = null;

function createDatabase($defaultPrefs = array(), $tableName = null, $fieldNames = null) {

    $names = array(
            'user'    => 'user_id',
            'pref'    => 'pref_id',
            'value'    => 'pref_value',
            );

    if (!is_null($fieldNames))
        $names = array_merge($names, $fieldNames);

    if (is_null($tableName))
        $tableName = basename($_SERVER['SCRIPT_FILENAME'], ".php");

    $db = &DB::connect($GLOBALS['dsn']);

    if (DB::isError($db)) {

        print "Failure connecting to database.\n"
            .$db->getMessage()."\n";

        exit($db->getCode());

    } else {

        $sql = "CREATE TABLE ".$db->quoteIdentifier($tableName)." ("
            .$db->quoteIdentifier($names['user'])." varchar( 255 ) NOT null default '', "
            .$db->quoteIdentifier($names['pref'])." varchar( 32 ) NOT null default '', "
            .$db->quoteIdentifier($names['value'])." text NOT null, "
            ."PRIMARY KEY ( ".$db->quoteIdentifier($names['user']).", ".$db->quoteIdentifier($names['pref'])." ) "
            .");";

        $result = $db->query($sql);

        if (DB::isError($result)) {

            print "Failure creating required tables in database.\n"
                .$db->getMessage()."\n";

            exit($result->getCode());

        } else {

            register_shutdown_function('cleanUpDatabase', $tableName);

            foreach ($defaultPrefs as $user => $prefs) {

                foreach ($prefs as $pref => $value) {

                    $sql = "INSERT INTO ".$db->quoteIdentifier($tableName)." ("
                        .$db->quoteIdentifier($names['user']).", "
                        .$db->quoteIdentifier($names['pref']).", "
                        .$db->quoteIdentifier($names['value']).") "
                        ."VALUES (?, ?, ?);";

                    $result = $db->query($sql, array($user, $pref, $value));

                    if (DB::isError($result)) {

                        print "Unable to create default preference.\n"
                            ."User: $user\n"
                            ."Pref: $pref\n"
                            ."Value: $value\n"
                            .$result->getMessage()."\n";

                        exit($result->getCode());

                    }

                }

            }

        }

        $GLOBALS['tableName'] = $tableName;

    }

}

function cleanUpDatabase($tableName) {

    $db = DB::connect($GLOBALS['dsn']);
    if (DB::isError($db)) {
        print "DB Cleanup Failure\n"
            .$db->getMessage()."\n";

        exit($db->getCode());
    }

    $result = $db->query("DROP TABLE ".$db->quoteIdentifier($tableName));
    if (DB::isError($result)) {
        print "DB Cleanup Failure\n"
            .$result->getMessage()."\n";

        exit($result->getCode());
    }

}

function formatValue($value) {

    if (is_null($value)) {

        return "NULL";

    } elseif (!isset($value)) {

        return "(not set)";

    } elseif (is_bool($value)) {

        if ($value === true) {

            return "TRUE";

        } else {

            return "FALSE";

        }

    } elseif (is_string($value)) {

        return "\"$value\"";

    } elseif (is_array($value)) {

        return "Array(".count($value).")";

    } elseif (is_object($value)) {

        return "object ".get_class($value);

    } else {

        return $value;

    }

}

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
?>
