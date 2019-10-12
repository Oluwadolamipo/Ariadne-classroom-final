<?php
    session_start();


    $con=mysqli_connect('localhost','id1103850_root','1111111111') or die("Cannot connect to localhost");
    mysqli_select_db($con,'id11033850_localhost') or die("Cannot Select Database");
    //require 'includes/config.php';


 // Function to sanitize user input
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }

    //Function to set error message if user input is empty
    function display_input_error(&$input,$session_name,$error_message) {
        $input = trim($input);
        if(  (isset($input) === true) && ($input === '') )  {
            $_SESSION[$session_name] = $error_message;
            return 1;
        } else {
            $input = test_input($input);
            return 0;
        }
    }
    
    $fullname = $username = $email = $password = $cpassword = '';
    $errors = $empty_email_flag = 0;

  if(isset($_POST['register'])) {

    // Extract and store form data
    $_SESSION['fullname'] = $fullname = $_POST['fullname'];
    $_SESSION['username'] = $username = $_POST['username'];
    $_SESSION['email'] = $email = $_POST['email'];   
    $password = $_POST['password'];      
    $cpassword = $_POST['password_confirm'];
      
    $errors += display_input_error($fullname,'empty_fullname','-Enter name',$errors);
    $errors += display_input_error($username,'empty_username','-Enter username',$errors);  
      
    //Set error message if email field is empty
    if(empty($email)){
        $_SESSION['empty_email'] = "-Enter your email";
        $empty_email_flag = 1;
        $errors += 1;
    } else {
        $email = test_input($email);
        $empty_email_flag = 0;
    }  
    
    //Validate email format
    if((! filter_var($email,FILTER_VALIDATE_EMAIL)) && $empty_email_flag == 0){
        $_SESSION['incorrect_email'] = "-Invalid email format";
        $errors += 1;
    }
      
    // Set error message if password field is empty
    $password_length = strlen($password);
    if(empty($password)){
        $_SESSION['blank_password'] = "-Enter password";
        $errors += 1;
    } else if($password_length < 8){
        $_SESSION['short_password'] = "-Password shouldn't be less than 8 characters";
        $errors += 1;
    } else if($password_length > 50){
        $_SESSION['long_password'] = "-Password is too long";
        $errors += 1;
    } else if(!preg_match("#[0-9]+#",$password)){
        $_SESSION['invalid_password'] = "-Password must contain at least one number,capital letter and lowercase letter";
        $errors += 1;
    } else if(!preg_match("#[A-Z]+#",$password)){
        $_SESSION['invalid_password'] = "-Password must contain at least one number,capital letter and lowercase letter";
        $errors += 1;
    } else if(!preg_match("#[a-z]+#",$password)){
        $_SESSION['invalid_password'] = "-Password must contain at least one number,capital letter and lowercase letter";
        $errors += 1;
    } else if($password !== $cpassword){
        $_SESSION['password_mismatch'] = "-Passwords do not match";
        $errors += 1;
    }
      
    // If there are no errors, check if email is already linked to an account, if there are errors redirect back to sign up page
    if($errors == 0){
        
        $check_email = mysqli_prepare($con,"SELECT * from users WHERE email = ?");
        mysqli_stmt_bind_param($check_email,'s',$email);
        mysqli_stmt_execute($check_email);
        mysqli_stmt_store_result($check_email);
        $email_row = mysqli_stmt_num_rows($check_email);
        mysqli_stmt_close($check_email);
    
        /* If email already exists, redirect back to sign up page else, hash password and store all user input */
        if($email_row > 0){
                $_SESSION['emailerr'] = "-A user with this email already exists";
                if($con){mysqli_close($con);}
                header('location: sign-up.php');
                exit();
        }
      
        else {
            $password = password_hash("$password",PASSWORD_DEFAULT);
            $insert = mysqli_prepare($con,"INSERT INTO users (fullname, username, email, password) VALUES (?,?,?,?)");
            mysqli_stmt_bind_param($insert,'ssss',$fullname,$username,$email,$password);
            mysqli_stmt_execute($insert);
            mysqli_stmt_close($insert);
            
            $_SESSION['fullname'] = $fullname;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            
            $_SESSION['login_success'] = 'Signup successul, you may now login !';
            
            if($con){mysqli_close($con);}
            header('Location: login.php');
            exit();
        }
    }
        
    else {
        if($con){mysqli_close($con);}
        header('Location: sign-up.php');
        exit();
    }
      
    }
if($con){
mysqli_close($con);
}

?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>Sign Up form</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>

<body>
    <div class="header">
        <div class="logo">
            <a href="index.html"><img src="https://res.cloudinary.com/enema/image/upload/v1569433441/Ariadne_Class_pnlixb.png" style="width: 110px;" alt="logo">
            </a>
        </div>
        <div class="topnav" id="myTopnav">
            <a href="javascript:void(0);" class="icon" onclick="myFunction()"><img src="https://res.cloudinary.com/siyfa/image/upload/v1568922461/ovqrbsa6t7nhghflejve.png" style="width: 30px;">
            </a>
            <a href="Login.html">Login</a>
            <a href="#">Contact Us</a>
            <a href="#">FAQ</a>
            <a href="#">Courses</a>
            <a href="about-us.html">How it works</a>
            <a href="class.html">Create Class</a>
            <a href="#">Home</a>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
    </header>

    <body>
        <div>
            <h2>Welcome to Ariadne Class, <br>Enrol today and enjoy the definition of online education.</h2>
        </div>
        <form action="action_page.php" method="post">
            <div class="imgcontainer">
                <img src="https://res.cloudinary.com/enema/image/upload/v1569433441/Ariadne_Class_pnlixb.png" style="width: 110px;" alt="logo">
                </a>" alt="Avatar" class="avatar" height="100" width="50">
            </div>

            <div class="container">
                <label for="FullName"><b>Full name</b></label>
                <input type="text" placeholder="Enter full name" name="FullName" required>

                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                <label for="psw"><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat password">
                <div class="coursegroup">
                    <select name="subjects" class="subjects" required>
            <option value="">--Please choose a class--</option>
            <option value="Web Development">Web Development</option>
            <option value="Data Science">Data Science</option>
            <option value="AI">Artificial Intelligence</option>
            <option value="Machine Learning">Machine Learning</option>
            <option value="Oracle DataBase">Oracle DataBase</option>
            <option value="Cisco Networking">Cisco Networking</option>
            <option value="RedHat Linux">RedHat Linux</option>
            <option value="Digital Marketing">Digital Marketing</option>
            <option value="Microsoft">Microsoft System Administration</option>
          </select>

                    <button type="submit">Sign Up</button>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" class="cancelbtn">Cancel</button>
                    <span class="psw"><a href="#">Forgot password?</a></span>
                </div>
            </div>
        </form>

        <section>
            <footer>
                <img src="https://res.cloudinary.com/enema/image/upload/v1569508194/screencapture-file-C-Users-pc-Desktop-TEAM-ARIADNE-HOMEPAGE-homepage-html-2019-09-25-21_51_33_vqmtxf.png" width="100%">
            </footer>
        </section>
    </body>

</html>
