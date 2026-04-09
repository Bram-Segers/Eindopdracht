<!doctype html>
<html lang="nl">
<head>
    <title>Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../paginas/opmaak.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../paginas/index.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>
<?php
// Start PHP session for user authentication
session_start();
// Include database functions file
include "../includes/db_functions.php";
// Establish connection to the student database
StartConnection("studenten_db");
?>
<main>
    <?php
    // Check if user is admin for add/edit/delete operations
    $isAdmin = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["username"]) && $_SESSION["username"] === "admin";

    // Check if admin user submitted the add student form
    if($isAdmin && isset($_POST["addStudent"])) {
        // Validate and sanitize all input data
        $voornaam = ValidateInput($_POST["studentvoornaam"], 'string', 50);
        $achternaam = ValidateInput($_POST["studentachternaam"], 'string', 50);
        $geboortedatum = ValidateInput($_POST["geboortedatum"], 'date');
        $geslacht = ValidateInput($_POST["geslacht"], 'string', 10);
        $email = ValidateInput($_POST["email"], 'string', 50);
        $studierichting = ValidateInput($_POST["studierichting"], 'string', 100);

        // Check if all validations passed
        if ($voornaam === false || $achternaam === false || $geboortedatum === false ||
            $geslacht === false || $email === false || $studierichting === false) {
            echo "Ongeldige invoer. Controleer alle velden.";
        } else {
            // Create prepared statement query to insert new student
            $query = "INSERT INTO studenten (Voornaam, Achternaam, Geboortedatum, Geslacht, Email, Studierichting, StudieStatus, Startjaar) VALUES (?, ?, ?, ?, CONCAT(?,'@student.kw1c.nl'), ?, 'Actief', YEAR(NOW()))";

            // Execute prepared query with parameters
            $rowsAffected = ExecutePreparedQuery($query, [$voornaam, $achternaam, $geboortedatum, $geslacht, $email, $studierichting]);

            // Check if insertion was successful
            if($rowsAffected >= 1) {
                echo "U heeft een student toegevoegd.";
            } else {
                echo "Helaas is er iets misgegaan bij het toevoegen.";
            }
        }
    }
    ?>
    <div class="d-flex gap-2 mb-3">
        <form action="index.php" method="get" style="flex: 1;">
            <div class="input-group flex-nowrap">
                <span class="input-group-text"</span>
                <input type="text" class="form-control" placeholder="" aria-label="naamStudent" name="naamStudent">
                <!-- input type="submit" value="Zoeken" -->
                <input type="submit" name="studentZoeken" value="Zoeken">
            </div>
        </form>
        <!-- Button trigger modal -->
        <?php if ($isAdmin): ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Voeg student toe
        </button>
        <?php endif; ?>
    </div>

    <!-- Modal -->
    <?php if ($isAdmin): ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Invoeg formulier</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Voornaam" aria-label="Voornaam" name="studentvoornaam" required>
                            <input type="text" class="form-control" placeholder="Achternaam" aria-label="Achternaam" name="studentachternaam" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" placeholder="Geboortedatum" aria-label="Geboortedatum" aria-describedby="basic-addon1" name="geboortedatum" required>
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-select" name="geslacht" required>
                                <option selected disabled>Kies geslacht</option>
                                <option value="Man">Man</option>
                                <option value="Vrouw">Vrouw</option>
                                <option value="Anders">Anders</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon2" name="email" required>
                            <span class="input-group-text" id="basic-addon2">@student.kw1c.nl</span>
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-select" name="studierichting" required>
                                <option selected disabled>Kies studierichting</option>
                                <option value="Verpleegkunde">Verpleegkunde</option>
                                <option value="Logistiek">Logistiek</option>
                                <option value="Toerisme">Toerisme</option>
                                <option value="ICT">ICT</option>
                                <option value="Autotechniek">Autotechniek</option>
                                <option value="Bouwkunde">Bouwkunde</option>
                                <option value="Maatschappelijke Zorg">Maatschappelijke Zorg</option>
                                <option value="Onderwijsassistent">Onderwijsassistent</option>
                                <option value="Economie">Economie</option>
                                <option value="Marketing">Marketing</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                            <button type="submit" class="btn btn-primary" name="addStudent" value="true">Voeg student toe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <?php
    // Check if modify student form was submitted
    if(isset($_POST["modifyStudent"])) {
        // Check if user is not admin, deny access
        if (!$isAdmin) {
            // Display access denied message
            echo "U heeft geen toestemming om studenten te bewerken.";
            // Stop script execution
            exit();
        }

        // Validate and sanitize all input data
        $id = ValidateInput($_POST["updateID"], 'int');
        $voornaam = ValidateInput($_POST["studentvoornaam"], 'string', 50);
        $achternaam = ValidateInput($_POST["studentachternaam"], 'string', 50);
        $geboortedatum = ValidateInput($_POST["geboortedatum"], 'date');
        $geslacht = ValidateInput($_POST["geslacht"], 'string', 10);
        $email = ValidateInput($_POST["email"], 'string', 50);
        $studiestatus = ValidateInput($_POST["studiestatus"], 'string', 20);
        $studierichting = ValidateInput($_POST["studierichting"], 'string', 100);

        // Check if all validations passed
        if ($id === false || $voornaam === false || $achternaam === false || $geboortedatum === false ||
            $geslacht === false || $email === false || $studiestatus === false || $studierichting === false) {
            echo "Ongeldige invoer. Controleer alle velden.";
        } else {
            // Create prepared statement query to update student data
            $queryUpdate = "UPDATE studenten SET Voornaam = ?, Achternaam = ?, Geboortedatum = ?, Geslacht = ?, Email = ?, Studierichting = ?, StudieStatus = ? WHERE StudentID = ?";

            // Execute prepared query with parameters
            $rowsAffected = ExecutePreparedQuery($queryUpdate, [$voornaam, $achternaam, $geboortedatum, $geslacht, $email, $studierichting, $studiestatus, $id]);

            // Check if update was successful
            if($rowsAffected >= 1) {
                echo "Student succesvol bijgewerkt.";
            } else {
                echo "Bijwerken mislukt of geen wijzigingen gemaakt.";
            }
        }
    }


    // Check if delete student form was submitted
    if(isset($_POST["deleteStudent"])) {
        // Check if user is not admin, deny access
        if (!$isAdmin) {
            // Display access denied message
            echo "U heeft geen toestemming om studenten te verwijderen.";
            // Stop script execution
            exit();
        }

        // Validate and sanitize the student ID
        $id = ValidateInput($_POST["deleteID"], 'int');

        // Check if validation passed
        if ($id === false) {
            echo "Ongeldige student ID.";
        } else {
            // Create prepared statement query to delete student
            $query = "DELETE FROM studenten WHERE StudentID = ?";

            // Execute prepared query with parameters
            $result = ExecutePreparedQuery($query, [$id]);

            // Check if deletion was successful
            if($result >= 1) {
                echo "Student succesvol verwijderd.";
            } else {
                echo "Verwijderen mislukt - student niet gevonden.";
            }
        }
    }

    // Check if search form was submitted
    if(isset($_GET["studentZoeken"])) {
        // Validate and sanitize search input
        $searchName = ValidateInput($_GET["naamStudent"], 'string', 100);

        if ($searchName === false) {
            echo "Ongeldige zoekterm.";
        } else {
            // Create prepared statement query to search for students by name or ID
            $query = "SELECT * FROM studenten WHERE Voornaam LIKE ? OR Achternaam LIKE ? OR StudentID = ?";

            // Execute the search query with parameters (add wildcards for LIKE)
            $resultSearchStudent = ExecuteSelectQuery($query, ["%$searchName%", "%$searchName%", $searchName]);
            //echo var_dump();
            // Start building HTML table with Bootstrap classes
            echo "<table class='table table-striped table-hover table-bordered'>";
            // Create table header with dark background
            echo "<thead class='table-dark'>";
            echo "<tr>";
            // Always show basic columns
            echo "<th scope='col' class='px-3'>Student ID</th>";
            echo "<th scope='col' class='px-3'>Voornaam</th>";
            echo "<th scope='col' class='px-3'>Achternaam</th>";
            echo "<th scope='col' class='px-3'>Studierichting</th>";
            // Show additional columns only for admin users
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["username"]) && $_SESSION["username"] === "admin") {
                echo "<th scope='col' class='px-3'>Geboortedatum</th>";
                echo "<th scope='col' class='px-3'>Geslacht</th>";
                echo "<th scope='col' class='px-3'>Email</th>";
                echo "<th scope='col' class='px-3'>Startjaar</th>";
                echo "<th scope='col' class='px-3'>Studiestatus</th>";
                echo "<th scope='col' class='px-3'>Acties</th>";
            }
            echo "</tr>";
            echo "</thead>";
            // Start table body
            echo "<tbody>";
            // Loop through each search result
            foreach ($resultSearchStudent as $row) {
                // Extract data from current row
                $voornaam = $row["Voornaam"];
                $achternaam = $row["Achternaam"];
                $studentID = $row["StudentID"];
                $studierichting = $row["Studierichting"];
                $geboortedatum = $row["Geboortedatum"];
                $geslacht = $row["Geslacht"];
                $email = $row["Email"];
                $startjaar = $row["Startjaar"];
                $studiestatus = $row["StudieStatus"];

                // Start new table row
                echo "<tr>";
                // Always show basic data columns
                echo "<td>" . $studentID . "</td>";
                echo "<td>" . $voornaam . "</td>";
                echo "<td>" . $achternaam . "</td>";
                echo "<td>" . $studierichting . "</td>";
                // Show additional columns only for admin users
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["username"]) && $_SESSION["username"] === "admin") {
                    echo "<td>" . $geboortedatum . "</td>";
                    echo "<td>" . $geslacht . "</td>";
                    echo "<td>" . $email . "</td>";
                    echo "<td>" . $startjaar . "</td>";
                    echo "<td>" . $studiestatus . "</td>";
                    // Start actions column
                    echo "<td>";
                    // Create edit button with orange styling
                    echo "<button type='button' class='btn btn-warning text-white' data-bs-toggle='modal' data-bs-target='editModal'><a href='./edit.php?StudentID=$studentID' class='text-white text-decoration-none'>Bewerk</a></button>";

                    // DELETE FORM
                    echo "
<form method='POST' style='display:inline;'>
    <input type='hidden' name='deleteID' value='$studentID'>
    <input type='submit' name='deleteStudent' class='btn btn-danger' value='Verwijder' onclick=\"return confirm('Weet je het zeker?')\">
</form>
";

                    // End actions column
                    echo "</td>";
                }
                // End table row
                echo "</tr>";
            }
            // End table body
            echo "</tbody>";
            // End table
            echo "</table>";
        }
    }
    ?>
</main>
<footer>
</footer>
<!-- Bootstrap JavaScript Libraries -->
<script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous">
</script>

<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous">
</script>

<script>
// Auto-logout if user closes the tab or browser window
<?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["username"]) && $_SESSION["username"] === "admin"): ?>
// Add event listener for when the page is about to be unloaded (closed/refreshed)
window.addEventListener('beforeunload', function(event) {
    // Create XMLHttpRequest to send logout request to server when page is closed
    var xhr = new XMLHttpRequest();
    // Configure the request: POST method, target URL, synchronous (false = sync)
    xhr.open('POST', 'login.php', false); 
    // Set the content type header for form data
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Send the logout request with the logout parameter
    xhr.send('logout=true');
});
// End of beforeunload event listener
<?php endif; ?>
// End of auto-logout script
</script>
</body>
</html>



