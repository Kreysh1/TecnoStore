<?php
$host = 'localhost';
$user = 'root';
$dbpass= '';
$dbname= 'db_tecnostore';
$dbport= '3307';

try {
    $pdo = new PDO('mysql:host=localhost;port=3307;dbname=db_tecnostore', $user, $dbpass);
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>