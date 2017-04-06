<?php
/*
Plugin Name: Multipage Forms by Colin
Plugin URI: http://trepidation.co.uk/colingell
Description: Plugin to publish multipage forms
Author: Colin Gell
Version: 1.0
Author URI: http://trepidation.co.uk
*/

add_shortcode( 'trepi-shortcode', 'trepidloginform' );



function trepidloginform(){




   ob_start();
   session_start();

   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<h2>Enter Username and Password</h2> 
      <div class = "container form-signin">
         
         <?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['username'] == 'admin' && 
                  $_POST['password'] == '1234') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'admin';
                  
                  echo 'You have entered valid use name and password';
               }else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "username = tutorialspoint" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password = 1234" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
			
         Click here to clean <a href = "logout.php" tite = "Logout">Session.
         
      </div> 
<?php
}
?>


<?php

add_shortcode( 'trepi-testdb', 'testdatabase' );
function testdatabase() 
{
mysql_connect("localhost", "%username%", "%password%") or die(mysql_error()); // Connect to database server(localhost) with username and password.
    mysql_select_db("%database%") or die(mysql_error()); // Select registration database.
    if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['password']) && !empty($_POST['password']) AND isset($_POST['name']) && !empty($_POST['name'])){
                $username = mysql_escape_string($_POST['name']);
                $password = mysql_escape_string(md5($_POST['password']));

                $search = mysql_query("SELECT username, password, active FROM %table% WHERE username='".$username."' AND password='".$password."' AND active='1'") or die(mysql_error()); 
                $match  = mysql_num_rows($search);

                if($match = 1){
                    $msg = 'Login Complete! Thanks';
                    //$email = $row['EmailAddress'];  
                    //;  
                    //$_SESSION['EmailAddress'] = $email;  
                    //$_SESSION['LoggedIn'] = 1; 
                    $session->set_userdata( 'username', $username);
                    header ("Location: /"); 
                }else{
                    $msg = 'Login Failed!<br /> Please make sure that you enter the correct details and that you have activated your account.';
                }
            }


        ?>
        <!-- stop PHP Code -->

        <!-- title and description -->  
        <h2>Login Form</h2>
        <p>Please enter your name and password to login</p>

        <?php 
            if(isset($msg)){ // Check if $msg is not empty
                echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and add a div around it with the class statusmsg
            } ?>

        <!-- start sign up form --> 
        <form action="" method="post">
            <label for="name">Username:</label>
            <input type="text" name="name" value="" />
            <label for="password">Password:</label>
            <input type="password" name="password" value="" />

            <input type="submit" class="submit_button" value="login" />
        </form>
<?php }
?>