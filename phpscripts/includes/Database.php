<?php
$mysqli = new mysqli("localhost", "root", "edwin", "store");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$id = 3;

/* create a prepared statement */
if ($stmt = $mysqli->prepare("SELECT email FROM customers  WHERE ID=?")) {

    /* bind parameters for markers */
    $stmt->bind_param("s", $id);

    /* execute query */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($district);

    /* fetch value */
    $stmt->fetch();

    printf("%s is in district %s\n", $city, $district);

    /* close statement */
    $stmt->close();
}

/* close connection */
$mysqli->close();
?> 