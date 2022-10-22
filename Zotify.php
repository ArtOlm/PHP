<?php session_start();
      include ("User.php"); 
?>
<!DOCTYPE html>
    <title>Zotify</title>
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
        
        Song 1 <button type="submit" name="buy"
                class="button" value="song1">buy</button>  
        <br>  
        Song 2 <button type="submit" name="buy"
                class="button" value="song2">buy</button>  
        <br>  
        Song 3 <button type="submit" name="buy"
                class="button" value="song3">buy</button>  
        <br>  
        Song 4 <button type="submit" name="buy"
                class="button" value="song4">buy</button>  
        <br>  
        Song 5 <button type="submit" name="buy"
                class="button" value="song5">buy</button>  
        <br>  
        Song 6 <button type="submit" name="buy"
                class="button" value="song6">buy</button>  
        <br>  
        Song 7 <button type="submit" name="buy"
                class="button" value="song7">buy</button>  
        <br>  
        Song 8 <button type="submit" name="buy"
                class="button" value="song8">buy</button>      
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