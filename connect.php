<?php

$con = new mysqli('localhost', 'root', '', 'student_records');

if (!$con) {
    die(mysqli_error($con));

} 

?>