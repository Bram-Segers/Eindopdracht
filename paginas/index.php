<!doctype html>
<html lang="en">
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
    <?php
    include "../includes/db_functions.php";

    StartConnection("studenten_db");

    ?>

</header>
<main>
    <form action="index.php" method="get">
    <div class="input-group flex-nowrap">
        <span class="input-group-text"</span>
        <input type="text" class="form-control" placeholder="" aria-label="naamStudent">
        <input type="submit" value="Zoeken">
    </div>
    </form>

    <?php
    if(isset($_GET["studentZoeken"])) {
        $searchName = $_GET["naamStudent"];

        $query = "SELECT * FROM studenten WHERE Voornaam LIKE '%$searchName%' OR Achternaam LIKE '%$searchName%';";


        $resultSearchStudent = ExecuteSelectQuery($query);


        foreach ($resultSearchStudent as $row) {
            $voornaam = $row["Voornaam"];

            echo "<article>";
            echo $row["Voornaam"];
            echo "</article>";
        }
    }

//    echo $resultSearchStudent;


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
