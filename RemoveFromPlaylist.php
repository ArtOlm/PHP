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
        if(array_key_exists('remove_from_playlist',$_POST)){

            $username = $_SESSION['currentuser'];
            $current_user = unserialize($_SESSION['a' . $username]);

            //get playlists
            $playlists = unserialize($current_user->get_playlists());

            //get name of playlist
            $p_name = $_SESSION['playlist_name'];
            
            //create key for playlist
            $key = 'a' . $p_name;

            //get value of string with song name
            $val_str = $_POST['remove_from_playlist'];

            //split str to get song name
            $split_val = explode(' ', $val_str);

            $song = $split_val[1];
            
            //get desired playlist
            $playlist = unserialize($playlists[$key]);

            $ply_array = unserialize($playlist->get_playlist());
            
            //remove song from playlist
            $playlist->remove_song($song);
            //update playlist
            $playlists[$key] = serialize($playlist);

            //update user's list of playlists
            $current_user->set_playlists(serialize($playlists));

            //serialize user
            $updated_user = serialize($current_user);

            //update user for the session
            $_SESSION['a' . $current_user->get_username()] = $updated_user;
            //update file info
            update_file_info($current_user->get_username(),$updated_user);
            header( "refresh:0;url=ViewPlaylist.php" );
    
            }
    ?>
</body>
</html>