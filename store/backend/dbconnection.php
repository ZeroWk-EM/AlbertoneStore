<?php
//DATI PER LA CONNESSIONE AL DATABASE

$host = "localhost";

//CONFIGURATION DATA CONFIG
$db_user = "root";
$db_psw = "root";
$db_name = "store";
$db_port = "3309";
$mysqli = new mysqli($host, $db_user, $db_psw, $db_name, $db_port);


if ($mysqli->connect_error) {
    //die("ERRORE NELLA CONNESSIONE [" . $mysqli->connect_errno . "] " . $mysqli->connect_error);
} else {
    //echo "<hr>DB CONNESSO CON SUCCESSO" . $mysqli->host_info . "<hr>";
}
