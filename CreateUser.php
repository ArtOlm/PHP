<?php session_start();
    include ("User.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Create Account</title>
</head>
<body>
    <form method="get">
        <b>Please enter the following information</b><br>
        Username:  <input type="text" name="username"><br>
        Password:  <input type="text" name="password"><br>
        <input type="submit" name = "create" value="Create Account">
    </form>
    <?php 
        if(array_key_exists('create', $_GET)){
            //get username variable passed down from prev page
            $new_username = (string)$_GET['username'];
            $new_password = (string)$_GET['password'];
            //create key used for session array
            $new_key = 'a' . $new_username;
            //check if the user exists, that the input is not empty and that it dows not contain a whitespace
            if(array_key_exists($new_key, $_SESSION)){
                echo '<form method="get" action="LogInMenu.php"><input type="submit"value="Cancel"></form>';
                echo 'Unable to create account username already in use';
                    
            }elseif((strlen($new_username) == 0)||(strlen($new_password) == 0)){
                echo '<form method="get" action="LogInMenu.php"><input type="submit"value="Cancel"></form>';
                echo 'Username and Password must conatin at least one character';
            }elseif(containsWhiteSpace($new_username) || containsWhiteSpace($new_password)){
                echo '<form method="get" action="LogInMenu.php"><input type="submit"value="Cancel"></form>';
                echo 'Username and Password must <b>not</b> conatin whitespace';
            }else{
                //create new user and give the user data
                $newuser = new user();
                $newuser->set_username($new_username);
                $newuser->set_password((string)$_GET['password']);
                //array for library to store songs
                $a = array();
                //serialize array for use later
                $lib = serialize($a);
                $newuser->set_library($lib);
                $b = array();
                $playlist_data = serialize($b);
                $newuser->set_playlists($playlist_data);
                echo '<b>' . $newuser->get_username() . " your account has been successfuly created, you will be redirected shortly</b>";
                //add the serialized version of the user to the session array
                $ser_user = serialize($newuser);
                $_SESSION['a' . $newuser->get_username()] = $ser_user;
                //create file to save user data
                $user_file = fopen('writable/' . $newuser->get_username() . '.txt',"w");
                fwrite($user_file,$ser_user);
                fclose($user_file);
                //add user to users file
                $users_file = fopen('writable/Users.txt',"a");
                $data = $newuser->get_username() . "\n";
                fwrite($users_file,$data);
                fclose($users_file);
                header( "refresh:2;url=LogInMenu.php" );
            }
        }else{
            echo '<form method="get" action="LogInMenu.php"><input type="submit"value="Cancel"></form>';
        }
    ?>
    

</body>
</html>