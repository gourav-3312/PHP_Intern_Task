<?php

// development connection 
$server = "localhost";
$db = "signup";
$user = "root";
$password = "";
$charset = 'utf8mb4';

$con = mysqli_connect($server, $user, $password, $db);

if ($con) {
?>

    <script>
        alert("Connected");
    </script>
<?php
} else {
?>

    <script>
        alert("Not Connected");
    </script>
<?php
}
?>