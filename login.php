<?php
    session_start();
?>


<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>login form</title>
    <link rel="stylesheet" type="text/css" href="login.css">
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
            var x = document.getElementById("myTopnav ");
            if (x.className === "topnav ") {
                x.className += " responsive ";
            } else {
                x.className = "topnav ";
            }
        }
    </script>
    </header>
    <br>
    <br>
    <br>
    <br>
    <div class="wrapper ">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <form class="form-signin ">
            <form action="action_page.php" method="post">
                <div class="imgcontainer">
                    <img src="https://res.cloudinary.com/enema/image/upload/v1569433441/Ariadne_Class_pnlixb.png" style="width: 110px;" alt="logo">
                    </a>
                </div>
                <h1 class="form-signin-heading ">Welcome</h1>
                <input type="text" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" />
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                <label class="checkbox">
                <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
              </label>
                <button type="button" class="btn btn-warning">Login</button>
                <b>
   <p> <a href="sign up.html ">Not a Member? Signup </a></p>
    </b>
            </form>
    </div>
    <footer>
        <img src="https://res.cloudinary.com/enema/image/upload/v1569508194/screencapture-file-C-Users-pc-Desktop-TEAM-ARIADNE-HOMEPAGE-homepage-html-2019-09-25-21_51_33_vqmtxf.png " width="100% ">
    </footer>
    </section>
</body>

</html>
