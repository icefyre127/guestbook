<?php
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



//get post data
$name = $_POST['name'];
$email = $_POST['email'];
$entry = $_POST['entry'];

 

//create the database

$db->exec("CREATE TABLE guestbook (Id INTEGER PRIMARY KEY, Date DATETIME, Name TEXT, Email TEXT, Entry TEXT)");   



//insert some data...


if (name_exists($name))
{
    die("ERROR NAME EXISTS");
}

$db->exec("INSERT INTO guestbook (Date, Name, Email,Entry) VALUES (date(),'$name','$email','$entry' );");

 
//now output the data to a simple html table...

print "<table border=1>";

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

print_r($_POST);
?>