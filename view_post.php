<?php

echo <<<END
<html>
<head>
<link rel="stylesheet" type="text/css" href="guestbook.css">
<title>Guestbook Entries</title>
</head>
<body>
END;


function name_exists($name)
{
    global $db;
    
    $result = $db->query("SELECT * FROM guestbook where name = '$name'");
    if (count($result->fetchall()) > 0) 
        return true;

    return false;
}

try
{

//open the database

$db = new PDO('sqlite:guestbook_PDO.sqlite');

 
//now output the data to a simple html table...

print "<table class=\"entries_table\" border=1>";

print "<tr><td>Date</td><td>Name</td><td>email</td><td>entry</td></tr>";

$result = $db->query('SELECT * FROM guestbook');


foreach($result as $row)
{

print "<tr><td>".$row['Date']."</td>";

print "<td>".$row['Name']."</td>";

print "<td>".$row['Email']."</td>";

print "<td>".$row['Entry']."</td></tr>";

}

print "</table>";

// close the database connection

$db = NULL;

}

catch(PDOException $e)

{

print 'Exception : '.$e->getMessage();

}


echo <<<END
</body>
</html>
END;

?>