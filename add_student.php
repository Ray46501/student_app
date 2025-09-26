<?php
// Connect to the database
include 'connect.php';

if (isset($_POST['submit'])) {
    // Basic sanitization of input
    $first_name = htmlspecialchars(trim($_POST['first_name']), ENT_QUOTES, 'UTF-8'); // Removes whitespace and converts special HTML characters
    $last_name = htmlspecialchars(trim($_POST['last_name']), ENT_QUOTES, 'UTF-8'); // Same for last name
    $age = (int) $_POST['age']; // Casts to integer
    $grade = (int) $_POST['grade']; // Casts to integer

    // Insert student data into the database
    $sql = "INSERT INTO `students` (first_name,last_name,age,grade) 
            VALUES ('$first_name', '$last_name', $age, $grade)";
    $result = mysqli_query($con, $sql); // Executes query

    if ($result) {
        // Alert success and redirect to index page
        echo "<script>
                alert('Student added successfully!');
                window.location.href = 'index.php';
              </script>";
    } else {
        die(mysqli_error($con));
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css"> <!-- Custom CSS file -->

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Add Student</title>
</head>
<body>
    
<div class="container my-5">
    <h1>Add Student</h1>
    <hr>
    <!-- Form submits back to this page -->
    <form method="post" onsubmit="return validateForm()">
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" autocomplete="off">
        </div>

        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" autocomplete="off">
        </div>

        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" class="form-control" placeholder="Age" name="age" id="age" autocomplete="off">
        </div>

        <div class="mb-3">
            <label class="form-label">Grade</label>
            <input type="number" class="form-control" placeholder="Enter your Grade" name="grade" id="grade" autocomplete="off">
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>

<script>
    // Client-side validation before submitting
    function validateForm() {
        const firstName = document.getElementById("first_name").value.trim();
        const lastName = document.getElementById("last_name").value.trim();
        const age = document.getElementById("age").value.trim();
        const grade = document.getElementById("grade").value.trim();

        if (firstName.length > 255) {
            alert("First Name must not exceed 255 characters.");
            return false;
        }

        if (lastName.length > 255) {
            alert("Last Name must not exceed 255 characters.");
            return false;
        }

        if (age.length > 3 || isNaN(age)) {
            alert("Age must be a number with at most 3 digits.");
            return false;
        }

        if (grade > 12 || grade < 0 || isNaN(grade)) {
            alert("Grade must be a number between 0 and 12.");
            return false;
        }

        return true; // Form passes validation
    }
</script>

</body>
</html>
