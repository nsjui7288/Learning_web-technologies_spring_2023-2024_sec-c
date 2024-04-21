<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
     body {
            font-family: Arial, sans-serif;
        }
       
        h1 {
            text-align: center;
        }
   
        form {
            text-align: center;
            margin-top: 30px;
        }
     
        input[type="text"],
        input[type="password"] {
            width: 250px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        /* Style for the submit button */
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        /* Style for error message */
        .error-msg {
            margin-top: 30px;
            color: red;
            text-align: center;
        }
    </style>
    <script>
        function validateForm() {
            var username = document.getElementById("username").value.trim();
            var password = document.getElementById("password").value.trim();
 
            if (username === "") {
                alert("Please enter your username.");
                return false;
            }
 
            if (password === "") {
                alert("Please enter your password.");
                return false;
            }
 
            return true;
        }
    </script>
</head>
 
<body>
    <?php include 'navbar.php'; ?>
 
    <h1>Admin Login</h1>
 
    <?php echo $msg; ?>
 
    <form action="" method="post" onsubmit="return validateForm()">
        <input id="username" type="text" name="username" placeholder="Username"><br><br>
        <input id="password" type="password" name="password" placeholder="Password"><br><br>
        <button type="submit" name="submit">Login</button>
    </form>
</body>
 
</html>