<?php
    require_once("Auth/preferences.php");
    $options = array("table" => "user_prefs");
    $prefs = new PrefManager($dsn, $options);
    
    $prefs->setDefaultValue("fullname", "New User");
    $prefs->setValue("jon", "fullname", "Jon Wood");
    
    $jonName = $prefs->getPref("jon", "fullname");
    $billName = $prefs->getPref("bill", "")
    
    /*
    * Outputs:
    * <p>Jon's name is Jon Wood<br/>
    *    Bills's name is New User</p>
    */
    echo "<p>Jon's name is $jonName<br/>";
    echo "   Bill's name is $billName</p>";
?>