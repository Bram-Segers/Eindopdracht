<?php
// Start of PHP script
global $conn;
// Declare global database connection variable


function StartConnection($dbname){
    // Function to establish database connection

    global $conn;
    // Access global connection variable

    $host = "localhost";
    // Database server hostname
    //$dbname = "testdb";
    // Commented out default database name
    $username = "root";
    // Database username
    $password = ""; // Empty on default in XAMPP
    // Database password (empty for XAMPP default)

    try {
        // Try to create PDO connection
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        // Create PDO instance with MySQL host, database, and charset

        // Turns on PDO errors
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_ERRMODE_EXCEPTION);
        // Set error mode to exception for better error handling
        //echo "Verbinding met $dbname gemaakt!";
        // Commented out success message
        return $conn;
        // Return the connection object

    }
    catch (PDOException $e) {
        // Catch connection errors
        echo "Verbinding mislukt: " . $e->getMessage();
        // Display connection failure message with error details
    }
}

function ExecuteSelectQuery($query, $params = []){
    // Function to execute SELECT queries with parameters

    global $conn;
    // Access global connection variable
    //echo "Query $query";
    // Commented out query debug output
    try {
        // Try to execute the query

        //$conn = startConnection($dbname);
        // Commented out connection start (assuming already connected)

        $stmt = $conn->prepare($query);
        // Prepare the SQL statement
        $stmt->execute($params);
        // Execute the prepared statement with parameters

        // Resultaat als associatieve array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Fetch all results as associative array

        //echo "Query $query";
        // Commented out query debug output
        return $result;
        // Return the result array
    }
    catch (PDOException $e) {
        // Catch query execution errors
        echo "Query fout: " . $e->getMessage();
        // Display query error message
        return [];
        // Return empty array on error
    }
}

function ExecuteQuery($query){
    // Function to execute non-prepared queries (deprecated, use prepared statements)
    global $conn;
    // Access global connection variable

    try {
        // Try to execute the query
        $result = $conn->exec($query);
        // Execute the query and get affected rows

        //exec() gives direct number of affected rows
        return $result;
        // Return number of affected rows
    }
    catch (PDOException $e){
        // Catch query execution errors
        echo "Query fout: ". $e->getMessage();
        // Display query error message
        return 0;
        // Return 0 on error
    }
}

// New function for prepared statements to prevent SQL injection
function ExecutePreparedQuery($query, $params = []){
    // Function to execute prepared INSERT/UPDATE/DELETE queries
    global $conn;
    // Access global connection variable

    try {
        // Try to execute the prepared query
        $stmt = $conn->prepare($query);
        // Prepare the SQL statement
        $stmt->execute($params);
        // Execute with parameters

        // Return affected rows for INSERT/UPDATE/DELETE
        return $stmt->rowCount();
        // Return number of affected rows
    }
    catch (PDOException $e) {
        // Catch execution errors
        echo "Prepared query fout: ". $e->getMessage();
        // Display prepared query error
        return false;
        // Return false on error
    }
}

// Function to validate and sanitize input
function ValidateInput($input, $type = 'string', $maxLength = 255) {
    // Function to validate and sanitize user input based on type
    // Remove whitespace from beginning and end
    $input = trim($input);
    // Trim whitespace from input

    // Check if input is empty
    if (empty($input)) {
        // If input is empty after trimming
        return false;
        // Return false for empty input
    }

    // Type-specific validation
    switch ($type) {
        // Switch based on validation type
        case 'email':
            // For email type validation
            // Validate email format
            if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                // If email format is invalid
                return false;
                // Return false
            }
            break;
            // End email case
        case 'date':
            // For date type validation
            // Validate date format (YYYY-MM-DD)
            $date = DateTime::createFromFormat('Y-m-d', $input);
            // Try to create DateTime object from input
            if (!$date || $date->format('Y-m-d') !== $input) {
                // If date creation failed or format doesn't match
                return false;
                // Return false
            }
            break;
            // End date case
        case 'int':
            // For integer type validation
            // Validate integer
            if (!is_numeric($input) || intval($input) != $input) {
                // If not numeric or not integer
                return false;
                // Return false
            }
            $input = intval($input);
            // Convert to integer
            break;
            // End int case
        case 'string':
        default:
            // For string type validation (default)
            // Basic string validation - allow unicode letters, numbers, spaces, and common punctuation
            if (!preg_match('/^[\p{L}\p{N}\s\-\.\,\(\)\'\"]+$/u', $input)) {
                // If input contains invalid characters
                return false;
                // Return false
            }
            break;
            // End string case
    }

    // Check maximum length
    if (strlen($input) > $maxLength) {
        // If input exceeds max length
        return false;
        // Return false
    }

    return $input;
    // Return validated input
}
?>