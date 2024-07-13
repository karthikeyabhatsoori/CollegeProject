<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Started</title>
    <link rel="stylesheet" href="log2worker.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    

    <div class="wrapper">

        <span id="redirection" class="icon-close"><i class='bx bx-x'></i></span>

        <div class="form-box login">
            <h2>Login</h2>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><i class='bx bxl-gmail'></i></span>
                    <input type="text" class="email" name="email" required>
                    <label for="">email</label>

                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                    <input type="password" class="password" name="passwords" required>
                    <label for="">password</label>
                    
                </div>
                <div class="remeber-forgot">
                    <label for=""><input type="checkbox" class="checkbox">
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
                    <input type="text" class="text" name="workername" required>
                    <label for="">Username</label>

                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                    <input type="password" class="password3" name="password" required>
                    <label for="">password</label>
                    
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="number" name="contact" required>
                    <label for="">Phone number</label>
                    
                </div>

                <div class="input-box">
                    <span class="icon"></span>
                    <input type="text" class="city" name="city" required>
                    <label for="">City</label>
                </div>


                <section class="worksFor">
                    <label for="works" style="color: #00ffee;">Works for</label><br>

                    <input type="radio" name="works" id="option1" value="Utensil Cleaning">
                    <label for="option1" class="utensils_washing">Utensil Cleaning</label>

                    <input type="radio" name="works" id="option2" value="Home Nursing">
                    <label for="option2" class="home_nursing" style="color: #00ffee;">Home Nursing </label>   

                    <input type="radio" name="works" id="option3" value="Home Guard">
                    <label for="option3" class="home_guard" style="color: #00ffee;">Home Guard  </label>

                    <br>
                    <input type="radio" name="works" id="option4" value="Floor Cleaning">
                    <label for="option4" class="Floor_Cleaning" style="color: #00ffee;">Floor Cleaning </label>

                    <input type="radio" name="works" id="option5" value="Cooking" style="margin-left: 15px;">
                    <label for="option5" class="Cooking" style="color: #00ffee;">Cooking </label>   

                    <input type="radio" name="works" id="option6" value="Farming" style="margin-left: 45px;">
                    <label for="option6" class="Farming" style="color: #00ffee;">Farming </label>
                    <br> <br>
                </section>


                
                <div class="remeber-forgot">
                    <label for=""><input class="remember" type="checkbox">
                    I agree to the terms & conditions</label>
                    
                </div>
                <button type="submit" class="btn" name="registration">Registration</button>
                <div class="login-register">
                    <p>Already have an account?
                    <a href=""class="login-link"> Login</a></p>
                   
                </div>
            </form>
    
        </div>
    </div>

   <?php
if(isset($_POST['Login'])){ // Corrected to 'Login' instead of 'login'
    echo "Form submitted"; // This should appear on successful form submission for debugging

    $email = $_POST['email']; // Corrected to 'email' instead of 'email2'
    $password = $_POST['passwords']; // Corrected to 'password' instead of 'password2'

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

    
    // Query to fetch user from database
    $sql = "SELECT * FROM worker WHERE USERNAME='$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if ($password == $row['PASSWORD']) {
            // Password is correct, login successful
            // header("Location: index.php");
            echo "<script>alert('Login successful')</script>";
            // Redirect to dashboard or another page
            
        } else {
            echo "<script>alert('Invalid password')</script>";
        }
    } else {
        echo "<script>alert('User not found')</script>";
    }

    $conn->close();
}
?>



    <?php
        if(isset($_POST['registration'])){

            $worker_name = $_POST['workername'];
            $passwords = $_POST['password'];
            $contact = $_POST['contact'];
            $city = $_POST['city'];

            if(isset($_POST['works'])) {
                $works = $_POST['works'];
            } else {
                echo "No work option selected";
            }

            $servername = 'localhost';
            $username = 'root';
            $password = '';
            $database_name = 'PROJECT';

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database_name);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql="INSERT INTO `worker`(`USERNAME`, `PASSWORD`, `CONTACT`, `CITY`, `WORKS`) VALUES ('$worker_name','$passwords','$contact','$city','$works')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Registration successfull')</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        
            // Close connection
            $conn->close();
            
        }
    ?>



    <script src="log2.js"></script>
</body>
</html>