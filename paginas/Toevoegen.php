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

    $query = "INSERT INTO pokemon VALUES ('$voornaam', '$achternaam', '$geboortedatum', '$geslacht', '$email','$studierichting');";
    echo $query;
    $insert = ($query);

    include "../includes/db_functions.php";

    StartConnection("studenten_db");

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
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Voeg student toe
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
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Voornaam" aria-label="Voornaam" name="studentvoornaam">
                        <input type="text" class="form-control" placeholder="Achternaam" aria-label="Achternaam" name="Studentachternaam">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Geboortedatum" aria-label="Geboortedatum" aria-describedby="basic-addon1" name="geboortedatum">
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" name="geslacht">Geslacht</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Man</a></li>
                            <li><a class="dropdown-item" href="#">Vrouw</a></li>
                            <li><a class="dropdown-item" href="#">Anders</a></li>
                        </ul>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon2" name="email">
                        <span class="input-group-text" id="basic-addon2">@student.kw1c.nl</span>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" name="studierichting">Kies studierichting</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Verpleegkunde</a></li>
                            <li><a class="dropdown-item" href="#">Logistiek</a></li>
                            <li><a class="dropdown-item" href="#">Toerisme</a></li>
                            <li><a class="dropdown-item" href="#">ICT</a></li>
                            <li><a class="dropdown-item" href="#">Autotechniek</a></li>
                            <li><a class="dropdown-item" href="#">Bouwkunde</a></li>
                            <li><a class="dropdown-item" href="#">Maatschappelijke Zorg</a></li>
                            <li><a class="dropdown-item" href="#">Onderwijsassistent</a></li>
                            <li><a class="dropdown-item" href="#">Economie</a></li>
                            <li><a class="dropdown-item" href="#">Marketing</a></li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary" name="addStudent">Voeg student toe</button>
                </div>
            </div>
        </div>
    </div>
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