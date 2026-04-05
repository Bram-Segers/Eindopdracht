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
                        <a class="nav-link active" aria-current="page" href="../paginas/bootstrap.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/C++.html">Embedded</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/IRW.html">Interactive responsive website</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/brb.html">Reddingsbrigade</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/bram.html">Over mij</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>
<?php
include "../includes/db_functions.php";
StartConnection("studenten_db");
?>
<main>
    <?php
    if(isset($_POST["addStudent"])) {
        //var_dump($_POST);
        $voornaam = $_POST["studentvoornaam"];
        $achternaam = $_POST["studentachternaam"];
        $geboortedatum = $_POST["geboortedatum"];
        $geslacht = $_POST["geslacht"];
        $email = $_POST["email"];
        $studierichting = $_POST["studierichting"];

        $query = "INSERT INTO studenten (Voornaam, Achternaam, Geboortedatum, Geslacht, Email, Studierichting) VALUES ('$voornaam', '$achternaam', '$geboortedatum', '$geslacht', '$email','$studierichting');";
        echo $query;
        $insert = ($query);


        $rowsAffected = ExecuteQuery($query);
        if($rowsAffected >= 1)
        {
            echo "U heeft een student toegevoegd.";
        }
        else
        {
            echo "helaas is er iets mis gegaan.";
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Voeg student toe
        </button>
    </div>

    <!-- Modal -->
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
                            <input type="text" class="form-control" placeholder="Geboortedatum" aria-label="Geboortedatum" aria-describedby="basic-addon1" name="geboortedatum" required>
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


    <?php
    $htmleditknop = <<<HTML
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Bewerk
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bewerk formulier</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Voornaam" aria-label="Voornaam" name="studentvoornaam" required>
                        <input type="text" class="form-control" placeholder="Achternaam" aria-label="Achternaam" name="studentachternaam" required>
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
                    <div class="input-group mb-3">
                        <select class="form-select" name="studiestatus" required>
                            <option selected disabled>Studiestatus</option>
                            <option value="Actief">Actief</option>
                            <option value="Gestopt">Gestopt</option>
                            <option value="Afgestudeerd">Afgestudeerd</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                        <button type="submit" class="btn btn-primary" name="addStudent" value="true">Sla bewerking op</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

HTML;

    if(isset($_POST["deleteStudent"])) {
        $id = $_POST["deleteID"];

        $query = "DELETE FROM studenten WHERE StudentID = '$id'";
        $result = ExecuteQuery($query);

        if($result >= 1) {
            echo "Student verwijderd.";
        } else {
            echo "Verwijderen mislukt.";
        }
    }

    if(isset($_GET["studentZoeken"])) {
        $searchName = $_GET["naamStudent"];

        $query = "SELECT * FROM studenten WHERE Voornaam LIKE '%$searchName%' OR Achternaam LIKE '%$searchName%' OR StudentID = '$searchName';";


        $resultSearchStudent = ExecuteSelectQuery($query);
            //echo var_dump();
        echo "<table class='table-responsive'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope='col'>Student ID</th>";
        echo "<th scope='col'>Voornaam</th>";
        echo "<th scope='col'>Achternaam</th>";
        echo "<th scope='col'>Studierichting</th>";
        echo "</tr>";
        echo "</thead>";
        foreach ($resultSearchStudent as $row) {
            $voornaam = $row["Voornaam"];
            $achternaam = $row["Achternaam"];
            $studentID = $row["StudentID"];
            $studierichting = $row["Studierichting"];

            echo "<tbody>";
            echo "<tr>";
            echo "<td>";
            echo $studentID . "</td>";
            echo "<td>";
            echo  $voornaam . "</td>";
            echo "<td>";
            echo  $achternaam . "</td>";
            echo "<td>";
            echo $studierichting . "</td>";
            echo "<td>";
            echo $htmleditknop;

// DELETE FORM
            echo "
<form method='POST' style='display:inline;'>
    <input type='hidden' name='deleteID' value='$studentID'>
    <input type='submit' name='deleteStudent' class='btn btn-danger' value='Verwijder' onclick=\"return confirm('Weet je het zeker?')\">
</form>
";

            echo "</td>";
        }
            echo "</table>";

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
</body>
</html>
