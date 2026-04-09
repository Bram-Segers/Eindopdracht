<?php
global $conn;


function StartConnection($dbname){

    global $conn;

    $host = "localhost";
    //$dbname = "testdb";
    $username = "root";
    $password = ""; // Empty on default in XAMPP

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

        // Turns on PDO errors
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Verbinding met $dbname gemaakt!";
        return $conn;

    }
    catch (PDOException $e) {
        echo "Verbinding mislukt: " . $e->getMessage();
    }
}

function ExecuteSelectQuery($query){

    global $conn;
    //echo "Query $query";
    try {

        //$conn = startConnection($dbname);

        $stmt = $conn->prepare($query);
        $stmt->execute();

        // Resultaat als associatieve array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //echo "Query $query";
        return $result;
    }
    catch (PDOException $e) {
        echo "Query fout: " . $e->getMessage();
        return [];
    }
}

function ExecuteQuery($query){
    global $conn;

    try {
        $result = $conn->exec($query);

        //exec() gives direct number of affected rows
        return $result;
    }
    catch (PDOException $e){
        echo "Query fout: ". $e->getMessage();
        return 0;
    }
}
?>