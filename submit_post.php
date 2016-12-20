<?php
require("askdb.php");

try
{

//open the database

$db = new PDO('sqlite:guestbook_PDO.sqlite');


//get post data
$name = $_POST['name'];
$email = $_POST['email'];
$entry = $_POST['entry'];
$title = $_POST['title'];
$ip = $_SERVER['REMOTE_ADDR'];





//create the database

$db->exec("CREATE TABLE guestbook (Id INTEGER PRIMARY KEY, Date DATETIME, Name TEXT, Email TEXT, Title TEXT, Entry TEXT, ip_address TEXT)");   



//prepare SQL query for inserting data into database
$stmt = $db->prepare("INSERT INTO guestbook (Date, Name,Email,Title,Entry,ip_address) VALUES (datetime(),:name,:email,:title,:entry,:ip);");
//$stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':entry', $entry);
$stmt->bindParam(':ip', $ip);

$stmt->execute();




//insert some data...

/*
if (name_exists($name))
{
    die("ERROR NAME EXISTS");
}
*/

//print_r($_POST);
//$db->exec("INSERT INTO guestbook (Date, Name,Email,Title,Entry,ip_address) VALUES (datetime(),'$name','$email','$title','$entry','$ip');");

//debug
//echo  "INSERT INTO guestbook (Date, Name,Email,Title,Entry,ip_address) VALUES (datetime(),'$name','$email','$title','$entry','$ip');";
//now output the data to a simple html table...

print "<table border=1>";

print "<tr><td>Date</td><td>Name</td><td>email</td><td>title</td><td>entry</td><td>IP address</td></tr>";

$result = $db->query('SELECT * FROM guestbook');

foreach($result as $row)
{

echo $row['Date'];
$date = date("M-d-Y",strftime($row['Date']));
print "<tr><td>".$date."</td>";
//print "<tr><td>".$row['Date']."</td>";

print "<td>".$row['Name']."</td>";

print "<td>".$row['Email']."</td>";

print "<td>".$row['Title']."</td>";

print "<td>".$row['Entry']."</td>";

print "<td>".$row['ip_address']."</td></tr>";
}

print "</table>";

 

// close the database connection

$db = NULL;

}

catch(PDOException $e)

{

print 'Exception : '.$e->getMessage();

}

?>