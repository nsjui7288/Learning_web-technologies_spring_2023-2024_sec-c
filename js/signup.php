<?php
sleep(5);
$firstname = $_REQUEST['firstname'];
echo "Your firstname is: " . $firstname;
$lastname = $_REQUEST['lastname'];
echo "Your lastname is: " . $lastname;
$email = $_REQUEST['username'];
echo "Your Username is: " . $username;
$username = $_REQUEST['username'];
echo "Your Username is: " . $username;

session_start();
$msg = "";
if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($connection, strtolower($_POST['firstname']));
    $lastname = mysqli_real_escape_string($connection, strtolower($_POST['lastname']));
    $email = mysqli_real_escape_string($connection, strtolower($_POST['email']));
    $username = mysqli_real_escape_string($connection, strtolower($_POST['username']));
    $password = mysqli_real_escape_string($connection, strtolower($_POST['password']));
    $account_type = mysqli_real_escape_string($connection, strtolower($_POST['account_type']));
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $signup_query = "INSERT INTO `users`(`user_id`, `first_name`, `last_name`, `email`, `username`, `password`,account_type) VALUES ('', '$firstname', '$lastname', '$email', '$username', '$password','$account_type')";
    $check_query = "SELECT * FROM `users` WHERE username='$username' or email='$email'";
    $check_res = mysqli_query($connection, $check_query);
    if ($account_type == "admin") {
        $signup_query = "INSERT INTO `admin`(`admin_id`,  `username`, `password`) VALUES ('', '$username', '$password')";
        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($connection, $query);
    } else {
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($connection, $query);
    }
    if (mysqli_num_rows($check_res) > 0) {
        $msg = "Username or Email already exists.";
    } else {
        $signup_res = mysqli_query($connection, $signup_query);
        if ($signup_res) {
            // Redirect to login page
            header("Location: login.php");
            exit();
        } else {
            $msg = "Registration Failed.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            text-align: center;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
</style>
</head>
<body>
<div class="container">
<h1>Sign Up</h1>
<form action="" method="post" onsubmit="return validateForm()">
<input id="firstname" type="text" name="firstname" placeholder="First Name"><br>
<input id="lastname" type="text" name="lastname" placeholder="Last Name"><br>
<input id="email" type="email" name="email" placeholder="Email"><br>
<input id="username" type="text" name="username" placeholder="Username"><br>
<input id="password" type="password" name="password" placeholder="Password"><br>
<input id="confirm_password" type="password" name="confirm_password" placeholder="Confirm Password"><br>
<label for="account_type">Account Type:</label>
<select id="account_type" name="account_type">
<option value="">Select Account Type</option>
<option value="customer">Customer</option>
<option value="admin">Admin</option>
</select><br>
<button type="submit" name="submit">Sign Up</button>
</form>
<p class="error" id="error-message"><?php echo $msg; ?></p>
</div>
<script>
        function validateForm() {
            var firstname = document.getElementById("firstname").value;
            var lastname = document.getElementById("lastname").value;
            var email = document.getElementById("email").value;
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;
            var account_type = document.getElementById("account_type").value;

            if (!/^[a-zA-Z]+$/.test(firstname)) {
                alert("First name should not be empty or contain digits!");
                document.getElementById("firstname").focus();
                return false;
            }
            if (!/^[a-zA-Z]+$/.test(lastname)) {
                alert("Last name should not be empty or contain digits!");
                document.getElementById("lastname").focus();
                return false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Invalid email address!");
                document.getElementById("email").focus();
                return false;
            }

            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{6,}$/;
            if (!passwordRegex.test(password)) {
                alert("Password must contain at least one lowercase letter, one uppercase letter, one number, one special character, and be at least 6 characters long!");
                document.getElementById("password").focus();
                return false;
            }

            if (password !== confirm_password) {
                alert("Passwords do not match!");
                document.getElementById("confirm_password").focus();
                return false;
            }
            if (username.trim() === "") {
                alert("Username cannot be empty!");
                document.getElementById("username").focus();
                return false;
            }

            if (account_type === "") {
                alert("Please select an account type!");
                document.getElementById("account_type").focus();
                return false;
            }
            return true;
        }
</script>
</body>
</html>