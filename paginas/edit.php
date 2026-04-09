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
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/admin.php">Beheer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/help.html">Handleiding</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>
<main>
    <?php
    include "../includes/db_functions.php";
    StartConnection("studenten_db");
    $updateStudentID = $_GET["StudentID"];

    $querySelect4Update = "SELECT * FROM studenten WHERE StudentID = $updateStudentID;";
    // echo $querySelect4Update;
    $resultUpdateStudent = ExecuteSelectQuery($querySelect4Update);
    // Since StudentID is a primary key and since it is invoked from the search result, the studentID should exist and only one row will return.
    // TODO: if the page is invoked directly and the StudentID does not exist. An error shoud be handled.
    $onlyRow = $resultUpdateStudent[0];
    $orgVoornaam = $onlyRow["Voornaam"];
    $orgAchternaam = $onlyRow["Achternaam"];
    $orgEmail = $onlyRow["Email"];
    $orgGeboortedatum = $onlyRow["Geboortedatum"];
    $orgGeslacht = $onlyRow["Geslacht"];
    $orgStudierichting = $onlyRow["Studierichting"];
    $orgStudieStatus = $onlyRow["StudieStatus"];

    if(isset($_POST["modifyStudent"])) {
        //var_dump($_POST);
        //$id = $_POST["updateID"];
        $voornaam = $_POST["studentvoornaam"];
        $achternaam = $_POST["studentachternaam"];
        $geboortedatum = $_POST["geboortedatum"];
        $geslacht = $_POST["geslacht"];
        $email = $_POST["email"];
        $studiestatus = $_POST["studiestatus"];
        $studierichting = $_POST["studierichting"];

        $queryUpdate = "UPDATE studenten SET Voornaam = '$voornaam', Achternaam = '$achternaam', Geboortedatum = '$geboortedatum', Geslacht = '$geslacht', Email = '$email', Studierichting = '$studierichting', StudieStatus = '$studiestatus' WHERE StudentID = $updateStudentID;";
        // echo $queryUpdate;



        $rowsAffected = ExecuteQuery($queryUpdate);
        if($rowsAffected >= 1)
        {
            echo "U heeft een student gewijzigd.";
        }
        else
        {
            echo "helaas is er iets mis gegaan.";
        }
    }
    ?>

    <form method="POST">
        <div class="input-group mb-3">
            <input type="text" class="form-control" value="<?php echo $orgVoornaam ?>" aria-label="Voornaam" name="studentvoornaam" required>
            <input type="text" class="form-control" value="<?php echo $orgAchternaam ?>" aria-label="Achternaam" name="studentachternaam" required>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" value="<?php echo $orgGeboortedatum ?>" aria-label="Geboortedatum" aria-describedby="basic-addon1" name="geboortedatum" required>
        </div>
        <div class="input-group mb-3">
            <select class="form-select" name="geslacht" required>
                <option selected><?php echo $orgGeslacht ?></option>
                <option value="Man">Man</option>
                <option value="Vrouw">Vrouw</option>
                <option value="Anders">Anders</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" value="<?php echo $orgEmail ?>" aria-label="Email" aria-describedby="basic-addon2" name="email" required>
        </div>
        <div class="input-group mb-3">
            <select class="form-select" name="studierichting" required>
                <option selected><?php echo $orgStudierichting ?></option>
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
        <div class="input-group mb-3">
            <select class="form-select" name="studiestatus" required>
                <option selected><?php echo $orgStudieStatus ?></option>
                <option value="Actief">Actief</option>
                <option value="Gestopt">Gestopt</option>
                <option value="Afgestudeerd">Afgestudeerd</option>
            </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
            <input type="hidden" name="updateID" value="$updateStudentID">
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