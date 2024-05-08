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
        header("Location: user_page.php");
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
    header("Location: userlogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
