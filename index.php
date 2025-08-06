<?php
    include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="add_student.php" class="text-light">Add Student</a></button>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    $sql="SELECT * FROM `students`";
                    $result=mysqli_query($con,$sql);
                    if($result) {
                        while($row=mysqli_fetch_assoc($result)) {
                            $id=$row['id'];
                            $first_name=$row['first_name'];
                            $last_name=$row['last_name'];
                            $age=$row['age'];
                            $grade=$row['grade'];
                            echo '
                            
                                <tr>
                                    <th scope="row">'.$id.'</th>
                                    <td>'.$first_name.'</td>
                                    <td>'.$last_name.'</td>
                                    <td>'.$age.'</td>
                                    <td>'.$grade.'</td>
                                    <td>
                                        <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light">Update</a></button>
                                        <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                                    </td>
                                </tr>
                                
                            
                            
                            ';
                        }
                    }

                ?>
            </tbody>
        </table>
    </div>
</body>
</html>