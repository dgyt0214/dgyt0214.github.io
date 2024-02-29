<?php
session_start();

// Include the database connection file
include('conn.php');

$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is a registration form
    if (isset($_POST["reg_username"]) && isset($_POST["reg_password"]) && isset($_POST["telephone"]) && isset($_POST["email"])) {
        // Registration process
        $reg_username = $_POST["reg_username"];
        $reg_password = $_POST["reg_password"];
        $telephone = $_POST["telephone"];
        $email = $_POST["email"];

        // Check if the username is already taken
        $check_query = "SELECT * FROM users WHERE username = '$reg_username'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows == 0) {
            // Insert new user into the database
            $insert_query = "INSERT INTO users (username, password, telephone, email) VALUES ('$reg_username', '$reg_password', '$telephone', '$email')";
            $conn->query($insert_query);

            // Set success message for registration
            $success_message = "Registration successful!";
        } else {
            // Display an error message for duplicate username
            echo "Username already taken. Please choose another username.";
        }
    } else {
        // Check if the form is a login form
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            // Login process
            $username = $_POST["username"];
            $password = $_POST["password"];
             header("Location:home.html");

            // Check if admin credentials
            if ($username === "venti" && $password === "0214") {
                // Redirect to admin.php
                header("Location: admin.php");
                exit();
            }

            // Check credentials using the database
            $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                // Start a session and store the username
                $_SESSION["username"] = $username;

                // Set success message for login
                $success_message = "Login successful!";
            } else {
                // Display an error message for invalid credentials
                echo "Invalid username or password";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylr.css">
    <title>Ventify</title>
</head>
<body>
    <div class="circle">
        <p>𝕍𝕖𝕟𝕥𝕚𝕗𝕪</p>
    </div>

    <div id="sidebar" class="sidebar">
        <p>Please log in or sign up to continue.</p>
        <h3>Login</h3>
        <button onclick="closeSidebar()">Close</button>
        <?php
        if (!empty($success_message) && isset($_POST["username"])) {
            echo "<p style='color: green;'>$success_message</p>";
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Login">
        </form>

        <h3>Register</h3>
    <?php
    if (!empty($success_message) && isset($_POST["reg_username"])) {
        echo "<p style='color: green;'>$success_message</p>";
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="reg_username">Username:</label>
        <input type="text" id="reg_username" name="reg_username" required>
        <br>
        <label for="reg_password">Password:</label>
        <input type="password" id="reg_password" name="reg_password" required>
        <br>
        <label for="telephone">Telephone:</label>
        <input type="text" id="telephone" name="telephone" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <input type="submit" value="Register">
    </form>
    </div>

    <script src="scrpit.js"></script>
</body>
</html>
