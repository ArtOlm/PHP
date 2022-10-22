<?php session_start();
      include ("Playlist.php");
      include ("User.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Playlist</title>
</head>
<body>
    <form method= post>
        Enter Name For Playlist:  <input type="text" name='name'><br>
        <input type="submit" name = "create" value="Create Playlist"><br>
       
    </form>
  
    <?php
        $cancelButton = '  <form method= post action = "UserAccountMenu.php"><input type="submit" name = "cancel" value="Cancel"></form>';
        if(array_key_exists('name',$_POST)){
            //get current user
            $username = $_SESSION['currentuser'];
            $current_user = unserialize($_SESSION['a' . $username]);
            //create new playlist with the given name
            $ser_playlists = $current_user->get_playlists();
            $playlists = unserialize($ser_playlists);
            $name = $_POST['name'];
            if(array_key_exists('a' . $name, $playlists)){
                echo $cancelButton;
                echo 'Playlist name already exists';
            }elseif(strlen($name) == 0){
                echo $cancelButton;
                echo "Name must contain at least one character";
            }elseif(containsWhiteSpace($name)){
                echo $cancelButton;
                echo 'Name must <b>not</b> have any Whitespace';
            }else{
                $plylst = new playlist();
                $plylst->set_name($name);
                $p = array();
                $ser_p = serialize($p);
                $plylst->set_playlist($ser_p);
                $new_plylst = serialize($plylst);
                //add playlist to current user playlist list
                $current_user->add_playlist($new_plylst);
                //update user information
                $updated_user = serialize($current_user);
                $_SESSION['a' . $username] = $updated_user;
                //update file info
                update_file_info($current_user->get_username(),$updated_user);
                echo '<b>Playlist ' . $name . ' creation was succesful! you will be redirected shortly</b>';
                header( "refresh:1;url=Playlists.php" );
            }

        }else{
            echo $cancelButton;
        }

    ?>
</body>
</html>