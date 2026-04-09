<?php
// Start the PHP session to store user data
session_start();


// Define an array of valid users with their passwords
$users = [
    "admin" => "1234" //This should be a more robust non password revealing method instead of this.
];

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
    // Get the username from the login form
    $username = $_POST["username"];
    // Get the password from the login form
    $password = $_POST["password"];

    // Check if the username exists in the users array and the password matches
    if (isset($users[$username]) && $users[$username] === $password) {
        // Set session variable to indicate user is logged in
        $_SESSION["loggedin"] = true;
        // Store the username in the session for later use
        $_SESSION["username"] = $username;
        // Redirect to the index page after successful login
        header("Location: index.php");
        // Stop execution of the script
        exit();
    } else {
        // Set error message if login credentials are incorrect
        $error = "Foute gebruikersnaam of wachtwoord";
    }
}

// Check if the logout button was clicked
if (isset($_POST["logout"])) {
    // Destroy the current session
    session_destroy();
    // Start a new session
    session_start();
    // Set loggedin to false to clear the login state
    $_SESSION["loggedin"] = false;
    // Clear the username from the session
    $_SESSION["username"] = "";
    // Redirect back to the login page
    header("Location: login.php");
    // Stop execution of the script
    exit();
}
?>

<!doctype html>
<html lang="nl">
<head>
    <title>Login</title>
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
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body p-5">

                    <h2 class="card-title text-center mb-4">Login</h2>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" class="mb-3">

                        <div class="mb-3">
                            <input
                                type="text"
                                name="username"
                                placeholder="Gebruikersnaam"
                                class="form-control"
                                autocomplete="off"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <input
                                type="password"
                                name="password"
                                placeholder="Wachtwoord"
                                class="form-control"
                                autocomplete="new-password"
                                required
                            >
                        </div>

                        <button
                            type="submit"
                            name="login"
                            class="btn btn-primary w-100"
                        >
                            Inloggen
                        </button>

                    </form>




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