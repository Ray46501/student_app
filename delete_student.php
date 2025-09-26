<?php
include 'connect.php';

if (isset($_GET['deleteid'])) {
    $id = (int) $_GET['deleteid']; // force integer to prevent injection

    $sql = "DELETE FROM `students` WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>
                alert('Student deleted successfully!');
                window.location.href = 'index.php';
              </script>";
    } else {
        die(mysqli_error($con));
    }
}
?>
