<?php
    include 'connect.php';
    if (isset($_POST['submit'])) {
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $age=$_POST['age'];
        $grade=$_POST['grade'];

        $sql="insert into `students` (first_name,last_name,age,grade) value('$first_name', '$last_name', '$age', '$grade')";
        $result=mysqli_query($con,$sql);

        if ($result) {
            header('location:index.php');
        }else{
            die(mysqli_error($con));
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Add Student</title>
  </head>
  <body>
    <div class="container my-5">
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

            return true;
        }
    </script>

  </body>
</html>