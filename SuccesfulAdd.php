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
    <title>Document</title>
</head>
<body>
    <?php
        //get song name 
        $song = $_SESSION['song_to_add'];
        //get user
        $username = $_SESSION['currentuser'];
        $current_user = unserialize($_SESSION['a' . $username]);
        //get playlists
        $playlists = unserialize($current_user->get_playlists());

        //get name of playlist
        $name = $_POST['Add'];

        //create key for playlists
        $key = 'a' . $name;
       
        //get desired playlist
        $playlist = unserialize($playlists[$key]);
        
        //echo var_dump($playlist);
        if($playlist->song_exists($song)){
            echo '<h1><b>Song already exists in playlist, you will be redirected to your library shortly</b></h1>';
            header( "refresh:2;url=Library.php" );
        }else{
            //get array from playlist object
            //add song to playlist
            $playlist->add_song($song);
           
            //update playlist
            $playlists[$key] = serialize($playlist);

            //update user's list of playlists
            $current_user->set_playlists(serialize($playlists));

            //update user data
            $updated_user = serialize($current_user);

            //update user for the session
            $_SESSION['a' . $current_user->get_username()] = $updated_user;

             //update file info
             update_file_info($current_user->get_username(),$updated_user);

            echo '<h1><b>Song was succesfully added, you will be redirected to your library shortly</b></h1>';
            header( "refresh:2;url=Library.php" );
        }
    ?>
    
</body>
</html>