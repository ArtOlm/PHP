<?php 
      session_start();
      include ("User.php");
      //load all users
      $usernames_file = fopen("writable/Users.txt","r");
      $usernames_array = [];
      //read from file
      while(!(feof($usernames_file))){
        //get line
        $username_tmp = fgets($usernames_file);
        //remove all whitespace from line
        $trimed_name = trim($username_tmp," \n");
        //add to array for use later
        $usernames_array[] = $trimed_name;
      }
      fclose($usernames_file);
      //load all users into the sessions array
      foreach($usernames_array as $user_tmp){
        //helps solve server issue where non extisitng file is found
        if(strlen($user_tmp) == 0){
            continue;
        }
        $user_file_str = "writable/$user_tmp.txt"; 
        $user_file = fopen($user_file_str, "r");
        $ser_user = fgets($user_file);
        //key for sessions, this allows numbers at the begginign of name
        $key = 'a' . $user_tmp;
        //add to $_SESSION
        $_SESSION[$key] = $ser_user;
        fclose($user_file);
      }

      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    <?php 

        echo "Hello welcome to your music, please log in or create an account";
    ?>
    <form method= post>
         Username:  <input type="text" name='username'>
         Password:  <input type="text" name='password'><br>
         <input type="submit" name = "in" value="log in">
    </form>
    <?php
        //wait for user to click on button
        if(array_key_exists('in',$_POST)){
            //get input values
            $username1 = (string)$_POST['username'];
            $password1 = (string)$_POST['password'];
            //create key to see if user exists
            $key = 'a' . $username1;

            //check if the user exists
            if(array_key_exists($key, $_SESSION)){
                //get user object
                $user = unserialize($_SESSION['a' . $username1]);
            
                //check user has correct passowrd
                if($user->get_password() == $password1){
                //save the current user for session
                $_SESSION['currentuser'] = (string)$_POST['username'];
                //redirect to account menu page
                header('Location: UserAccountMenu.php');
                }else{
                  //bad password for account  
                  echo 'incorrect password<br>';
                }
            }else{
                echo "no user found<br>";
            }
        }
    ?>
    <a href="createuser.php">Create Account</a>
</body>
</html>