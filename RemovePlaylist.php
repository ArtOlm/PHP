<?php session_start();
      include ("User.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(array_key_exists('remove',$_POST)){
            $username = $_SESSION['currentuser'];
            $current_user = unserialize($_SESSION['a' . $username]);

            $current_playlists = unserialize($current_user->get_playlists());
            //get value passed down by button
            $value = $_POST['remove'];
            
            //split value into string tokens, second token has playlist name
            $tokens = explode(' ',$value);
            $playlist_name = $tokens[1];
            //get playlsits key
            $key = 'a' . $playlist_name;
            //remove song from playlist
            unset($current_playlists[$key]);
            //update user
            $new_plylsts = serialize($current_playlists);
            $current_user->set_playlists($new_plylsts);
            $updated_user = serialize($current_user);
            $_SESSION['a' . $current_user->get_username()] = $updated_user;
            //update file info
            update_file_info($current_user->get_username(),$updated_user);
        }
    ?>
    <meta http-equiv="refresh" content="0; URL='Playlists.php'"/>
</body>
</html>