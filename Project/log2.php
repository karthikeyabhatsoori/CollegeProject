<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Started</title>
    <link rel="stylesheet" href="log2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    

    <div class="wrapper">

        <span class="icon-close"><i class='bx bx-x'></i></span>
        <div class="form-box login">
            <h2>Login</h2>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><i class='bx bxl-gmail'></i></span>
                    <input type="text" name="email" required>
                    <label for="">email</label>

                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                    <input type="password" name="password" required>
                    <label for="">password</label>
                    
                </div>
                <div class="remeber-forgot">
                    <label for=""><input type="checkbox">
                   remeber me</label>
                   <p><a href="">forgot password?</a></p>
                </div>    
                  
                <button type="submit" class="btn" name="Login">Login</button>
                <div class="login-register">
                    <p>Don't have an account?<a href=""class="register-link"> Register</a></p>
                </div>
            </form>
        </div>


        <div class="form-box Register" id="registration">
            <h2>Registration</h2>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-contact'></i></i></span>
                    <input type="text" name="username" required>
                    <label for="">Username</label>

                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                    <input type="password" name="password" required>
                    <label for="">password</label>
                    
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="number" name="numbers" required>
                    <label for="">Phone number</label>
                    
                </div>
                <div class="remeber-forgot">
                    <label for=""><input type="checkbox">
                    I agree to the terms & conditions</label>
                    
                </div>
                <button type="submit" class="btn" name="Registration">Registration</button>
                <div class="login-register">
                    <p>Already have an account?
                    <a href=""class="login-link"> Login</a></p>
                </div>
            </form>
    
        </div>
    </div>
    <?php
        if(isset($_POST['Registration'])){
            $Username = $_POST['username'];
            $passwords = $_POST['password'];
            $contact = $_POST['numbers'];
            
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "PROJECT";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            echo "Connection established";

                // Insert user data into the database
                // $sql = "INSERT INTO REGISTRATION (username, password, phone) VALUES ('$Username', '$hashed_password', '$contact')";
                $sql="INSERT INTO `registration`(`USERNAME`, `PASSWORD`, `PHONE_NUMBER`) VALUES ('$Username','$passwords','$contact')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Registration successfull')</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
        }
    ?>

<?php
session_start(); // Start session to persist login state

if(isset($_POST['Login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $servername = "localhost";
    $dbusername = "root"; // Replace with your database username
    $dbpassword = ""; // Replace with your database password
    $dbname = "PROJECT"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape special characters to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to fetch user from database
    $sql = "SELECT * FROM registration WHERE USERNAME='$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if ($password == $row['PASSWORD']) {
            // Password is correct, login successful
            $_SESSION['username'] = $row['USERNAME']; // Store username in session variable
            
            // Print username and password (for demonstration purposes)
            echo "Username: " . $row['USERNAME'] . "<br>";
            echo "Password: " . $row['PASSWORD'] . "<br>";

            echo "<script>alert('Login successful')</script>";
            // Redirect to dashboard or another page
            header("Location: index.php");
        } else {
            echo "<script>alert('Invalid password')</script>";
        }
    } else {
        echo "<script>alert('User not found')</script>";
    }

    $conn->close();
}
?>

    <script src="log2.js"></script>
</body>
</html>