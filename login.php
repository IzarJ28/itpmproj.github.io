<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "laundrys";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user from the database
    $sql = "SELECT * FROM adminaccount WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        // Start the session
        session_start();

        // Store username in session variable
        $_SESSION['username'] = $username;

        // Redirect to admin page
        header("Location: adminpage.php");
        exit();
    } else {
        // Redirect back to login page with error message
        header("Location: login.php?error=Invalid username or password");
        exit();
    }

    // Close database connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect back to login page
    header("Location: loginpage.php");
    exit();
}
?>
