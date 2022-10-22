<?php session_start();
      include ("User.php"); 
?>
<!DOCTYPE html>
    <title>ZTunes</title>
</head>
<body>
    <?php
        //current user is defined in login.php
        $username = $_SESSION['currentuser'];
        //unserialaize user data
        $current_user = unserialize($_SESSION['a' . $username]);
        echo 'Welcome to Zotify ' . $current_user->get_username() . " what songs would you like to buy today? <br>"; 
    ?>
    <form method="post">
        
        Song 11 <button type="submit" name="buy"
                class="button" value="song11">buy</button>  
        <br>  
        Song 12 <button type="submit" name="buy"
                class="button" value="song12">buy</button>  
        <br>  
        Song 13 <button type="submit" name="buy"
                class="button" value="song13">buy</button>  
        <br>  
        Song 14 <button type="submit" name="buy"
                class="button" value="song14">buy</button>  
        <br>  
        Song 15 <button type="submit" name="buy"
                class="button" value="song15">buy</button>  
        <br>  
        Song 16 <button type="submit" name="buy"
                class="button" value="song16">buy</button>  
        <br>  
        Song 17 <button type="submit" name="buy"
                class="button" value="song17">buy</button>  
        <br>  
        Song 18 <button type="submit" name="buy"
                class="button" value="song18">buy</button>      
    </form>
    <br>
    <?php
        //check if user has clicked item
        if(array_key_exists('buy',$_POST)){
            //get array used to store songs for user
            $user_library = unserialize($current_user->get_library());
            $song_name = $_POST['buy'];
            //check to see if the user has already bought the song
            if(array_key_exists($song_name, $user_library)){
                echo 'song was already bought';
            }else{
                echo 'you have bought ' . $song_name;
                //if not bought then create key
                $user_library[$song_name] = $song_name;
                //serialize the updated array
                $new_lib = serialize($user_library);
                //update user library
                $current_user->set_library($new_lib);
                //update the user data for other pages
                $updated_user = serialize($current_user);
                $_SESSION['a' . $current_user->get_username()] = $updated_user;
                //update file info
                update_file_info($current_user->get_username(),$updated_user);
            }
        }
    ?>
    <form method="post" action="UserAccountMenu.php">
        <input type="submit" value="return to main menu">
   </form>
</body>
</html>