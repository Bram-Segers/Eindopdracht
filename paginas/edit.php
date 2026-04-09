<!doctype html>
<html lang="nl">
<head>
    <title>Bewerken Student</title>
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
<main>
    <?php
    // Include database functions file
    include "../includes/db_functions.php";
    // Establish connection to the student database
    StartConnection("studenten_db");

    // Validate and sanitize the StudentID from GET parameter
    $updateStudentID = ValidateInput($_GET["StudentID"], 'int');

    // Check if StudentID validation failed
    if ($updateStudentID === false) {
        // Display invalid student ID message
        echo "Ongeldige student ID.";
        // Exit script
        exit();
    }

    // Create query to select student data for update
    $querySelect4Update = "SELECT * FROM studenten WHERE StudentID = ?";
    // Execute select query with StudentID parameter
    $resultUpdateStudent = ExecuteSelectQuery($querySelect4Update, [$updateStudentID]);
    // Check if student was found
    if (empty($resultUpdateStudent)) {
        // Display student not found message
        echo "Student niet gevonden.";
        // Exit script
        exit();
    }
    // Get the first (and only) row from results
    $onlyRow = $resultUpdateStudent[0];
    // Extract original values from database row
    $orgVoornaam = $onlyRow["Voornaam"];
    $orgAchternaam = $onlyRow["Achternaam"];
    $orgEmail = $onlyRow["Email"];
    $orgGeboortedatum = $onlyRow["Geboortedatum"];
    $orgGeslacht = $onlyRow["Geslacht"];
    $orgStudierichting = $onlyRow["Studierichting"];
    $orgStudieStatus = $onlyRow["StudieStatus"];

    // Check if modify student form was submitted
    if(isset($_POST["modifyStudent"])) {
        // Validate and sanitize all input data
        $voornaam = ValidateInput($_POST["studentvoornaam"], 'string', 50);
        $achternaam = ValidateInput($_POST["studentachternaam"], 'string', 50);
        $geboortedatum = ValidateInput($_POST["geboortedatum"], 'date');
        $geslacht = ValidateInput($_POST["geslacht"], 'string', 10);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $studiestatus = ValidateInput($_POST["studiestatus"], 'string', 20);
        $studierichting = ValidateInput($_POST["studierichting"], 'string', 100);

        // Check if all validations passed
        if ($voornaam === false || $achternaam === false || $geboortedatum === false ||
            $geslacht === false || $email === false || $studiestatus === false || $studierichting === false) {
            // Display invalid input message
            echo "Ongeldige invoer. Controleer alle velden.";
        } else {
            // Create prepared statement query to update student data
            $queryUpdate = "UPDATE studenten SET Voornaam = ?, Achternaam = ?, Geboortedatum = ?, Geslacht = ?, Email = ?, Studierichting = ?, StudieStatus = ? WHERE StudentID = ?";

            // Execute prepared query with parameters
            $rowsAffected = ExecutePreparedQuery($queryUpdate, [$voornaam, $achternaam, $geboortedatum, $geslacht, $email, $studierichting, $studiestatus, $updateStudentID]);
            // Check if update was successful
            if($rowsAffected !== false)
            {
                // Display success message
                echo "Update uitgevoerd.";
                // Update the original values to reflect the changes
                $orgVoornaam = $voornaam;
                $orgAchternaam = $achternaam;
                $orgGeboortedatum = $geboortedatum;
                $orgGeslacht = $geslacht;
                $orgEmail = $email;
                $orgStudierichting = $studierichting;
                $orgStudieStatus = $studiestatus;
            }
            else
            {
                // Display error message
                echo "Fout bij update.";
            }
        }
    }
    ?>

    <form method="POST">
        <div class="input-group mb-3">
            <input type="text" class="form-control" value="<?php echo $orgVoornaam ?>" aria-label="Voornaam" name="studentvoornaam" required>
            <input type="text" class="form-control" value="<?php echo $orgAchternaam ?>" aria-label="Achternaam" name="studentachternaam" required>
        </div>
        <div class="input-group mb-3">
            <input type="date" class="form-control" value="<?php echo $orgGeboortedatum ?>" aria-label="Geboortedatum" aria-describedby="basic-addon1" name="geboortedatum" required>
        </div>
        <div class="input-group mb-3">
            <select class="form-select" name="geslacht" required>
                <option value="Man" <?php echo ($orgGeslacht == "Man") ? "selected" : ""; ?>>Man</option>
                <option value="Vrouw" <?php echo ($orgGeslacht == "Vrouw") ? "selected" : ""; ?>>Vrouw</option>
                <option value="Anders" <?php echo ($orgGeslacht == "Anders") ? "selected" : ""; ?>>Anders</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" value="<?php echo $orgEmail ?>" aria-label="Email" aria-describedby="basic-addon2" name="email" required>
        </div>
        <div class="input-group mb-3">
            <select class="form-select" name="studierichting" required>
                <option value="Verpleegkunde" <?php echo ($orgStudierichting == "Verpleegkunde") ? "selected" : ""; ?>>Verpleegkunde</option>
                <option value="Logistiek" <?php echo ($orgStudierichting == "Logistiek") ? "selected" : ""; ?>>Logistiek</option>
                <option value="Toerisme" <?php echo ($orgStudierichting == "Toerisme") ? "selected" : ""; ?>>Toerisme</option>
                <option value="ICT" <?php echo ($orgStudierichting == "ICT") ? "selected" : ""; ?>>ICT</option>
                <option value="Autotechniek" <?php echo ($orgStudierichting == "Autotechniek") ? "selected" : ""; ?>>Autotechniek</option>
                <option value="Bouwkunde" <?php echo ($orgStudierichting == "Bouwkunde") ? "selected" : ""; ?>>Bouwkunde</option>
                <option value="Maatschappelijke Zorg" <?php echo ($orgStudierichting == "Maatschappelijke Zorg") ? "selected" : ""; ?>>Maatschappelijke Zorg</option>
                <option value="Onderwijsassistent" <?php echo ($orgStudierichting == "Onderwijsassistent") ? "selected" : ""; ?>>Onderwijsassistent</option>
                <option value="Economie" <?php echo ($orgStudierichting == "Economie") ? "selected" : ""; ?>>Economie</option>
                <option value="Marketing" <?php echo ($orgStudierichting == "Marketing") ? "selected" : ""; ?>>Marketing</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <select class="form-select" name="studiestatus" required>
                <option value="Actief" <?php echo ($orgStudieStatus == "Actief") ? "selected" : ""; ?>>Actief</option>
                <option value="Gestopt" <?php echo ($orgStudieStatus == "Gestopt") ? "selected" : ""; ?>>Gestopt</option>
                <option value="Afgestudeerd" <?php echo ($orgStudieStatus == "Afgestudeerd") ? "selected" : ""; ?>>Afgestudeerd</option>
            </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
            <input type="hidden" name="updateID" value="<?php echo $updateStudentID ?>">
            <button type="submit" class="btn btn-primary" name="modifyStudent" value="true">Bewerking opslaan</button>
        </div>
    </form>

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
</body>
</html>