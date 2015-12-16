<?php
function name_exists($name)
{
    global $db;
    $result = $db->prepare("SELECT * FROM guestbook where name = ?");
    $result->execute(array($name));
    //echo " HELLO : $stmt->fetchall()";
    //$result = $db->query("SELECT * FROM guestbook where name = '$name'");
    //print_r($result->fetchall());
    
    if (count($result->fetchall()) > 0) 
        return true;

    return false;
}


?>