<?php
include 'connect.php'; // Connect to the database

$id = isset($_GET['updateid']) ? (int)$_GET['updateid'] : 0; // Get the student ID from the URL and cast to integer

$sql = "SELECT * FROM `students` WHERE id=$id"; // Query to get student info
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Student not found"); // Stop if student doesn't exist
}

$first_name = $row['first_name']; // Fetch first name
$last_name = $row['last_name'];   // Fetch last name
$age = $row['age'];               // Fetch age
$grade = $row['grade'];           // Fetch grade

if (isset($_POST['submit'])) {
    // Basic sanitization of user inputs
    $first_name = htmlspecialchars(trim($_POST['first_name']), ENT_QUOTES, 'UTF-8'); // Remove whitespace & escape HTML
    $last_name = htmlspecialchars(trim($_POST['last_name']), ENT_QUOTES, 'UTF-8');   // Same for last name
    $age = (int) $_POST['age']; // Cast age to integer
    $grade = (int) $_POST['grade']; // Cast grade to integer

    $sql = "UPDATE `students` SET first_name='$first_name', last_name='$last_name', age=$age, grade=$grade WHERE id=$id"; // Update student info
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>
                alert('Student updated successfully!');
                window.location.href = 'index.php';
              </script>"; // Show success and redirect
    } else {
        die(mysqli_error($con)); // Stop on error
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- Custom CSS -->

    <title>Edit Student</title>
</head>
<body>
<div class="container my-5">
    <h1>Edit Student</h1>
    <hr>

    <!-- Form to edit student -->
    <form method="post" onsubmit="return validateForm()">
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" id="first_name" autocomplete="off" value="<?php echo htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8'); ?>"> <!-- Pre-fill first name -->
        </div>

        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" autocomplete="off" value="<?php echo htmlspecialchars($last_name, ENT_QUOTES, 'UTF-8'); ?>"> <!-- Pre-fill last name -->
        </div>

        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" class="form-control" name="age" id="age" autocomplete="off" value="<?php echo $age; ?>"> <!-- Pre-fill age -->
        </div>

        <div class="mb-3">
            <label class="form-label">Grade</label>
            <input type="number" class="form-control" name="grade" id="grade" autocomplete="off" value="<?php echo $grade; ?>"> <!-- Pre-fill grade -->
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
</div>

<script>
function validateForm() {
    const firstName = document.getElementById("first_name").value.trim();
    const lastName = document.getElementById("last_name").value.trim();
    const age = document.getElementById("age").value.trim();
    const grade = document.getElementById("grade").value.trim();

    if (firstName.length > 255) { alert("First Name must not exceed 255 characters."); return false; } // Validate first name
    if (lastName.length > 255) { alert("Last Name must not exceed 255 characters."); return false; }   // Validate last name
    if (age.length > 3 || isNaN(age)) { alert("Age must be a number with at most 3 digits."); return false; } // Validate age
    if (grade > 12 || grade < 0 || isNaN(grade)) { alert("Grade must be a number between 0 and 12."); return false; } // Validate grade
    return true; // Form is valid
}
</script>
</body>
</html>
