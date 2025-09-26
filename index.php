<?php
include 'connect.php'; // Connect to the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css"> <!-- Custom CSS -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1>Students</h1>
    <hr>

    <!-- Button to add a new student -->
    <button class="btn btn-primary my-5">
        <a href="add_student.php" class="text-light">Add Student</a>
    </button>

    <!-- Search input for filtering students -->
    <div class="my-3">
        <input type="text" id="searchInput" placeholder="Search students..." style="width:100%; padding:10px; border-radius:5px; border:1px solid #ccc;">
    </div>

    <!-- Students table -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col" data-column="0">ID ↑↓</th>
                <th scope="col" data-column="1">First Name ↑↓</th>
                <th scope="col" data-column="2">Last Name ↑↓</th>
                <th scope="col" data-column="3">Age ↑↓</th>
                <th scope="col" data-column="4">Grade ↑↓</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql="SELECT * FROM `students`"; // Get all students from database
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
                            <a href="edit_student.php?updateid='.$id.'" class="btn btn-primary text-light">Edit</a>
                            <a href="delete_student.php?deleteid='.$id.'" class="btn btn-danger text-light" onclick="return confirm(\'Are you sure you want to delete this student?\')">Delete</a>
                        </td>
                    </tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    // --- Search feature ---
    const searchInput = document.getElementById("searchInput");
    searchInput.addEventListener("keyup", function() {
        const filter = searchInput.value.toLowerCase();
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            let rowText = rows[i].textContent.toLowerCase();
            rows[i].style.display = rowText.includes(filter) ? "" : "none"; // Hide rows not matching search
        }
    });

    // --- Sort feature ---
    const headers = document.querySelectorAll("table thead th[data-column]");
    headers.forEach(header => {
        header.style.cursor = "pointer"; // Make headers look clickable
        header.addEventListener("click", function() {
            const table = document.querySelector("table tbody");
            const rows = Array.from(table.querySelectorAll("tr"));
            const columnIndex = parseInt(header.getAttribute("data-column"));
            const asc = header.asc = !(header.asc || false); // Toggle ascending/descending

            // Remove sort classes from other headers
            headers.forEach(h => { if (h !== header) h.classList.remove("asc", "desc"); });
            header.classList.toggle("asc", asc);
            header.classList.toggle("desc", !asc);

            // Sort rows numerically if possible, otherwise alphabetically
            rows.sort((a, b) => {
                let aText = a.children[columnIndex].textContent.trim();
                let bText = b.children[columnIndex].textContent.trim();
                if (!isNaN(aText) && !isNaN(bText)) return asc ? aText - bText : bText - aText;
                return asc ? aText.localeCompare(bText) : bText.localeCompare(aText);
            });

            // Append sorted rows back to table
            rows.forEach(row => table.appendChild(row));
        });
    });
</script>
</body>
</html>
