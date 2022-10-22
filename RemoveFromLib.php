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
        if(array_key_exists('remove',$_POST)){
            //get current user
            $username = $_SESSION['currentuser'];
            $current_user = unserialize($_SESSION['a' . $username]);

            //get library
            $current_library = unserialize($current_user->get_library());

            //get value passeddown by button
            $value = $_POST['remove'];
            
            //split value into string tokens, second token has song name
            $tokens = explode(' ',$value);
            $song_name = $tokens[1];
            
            //remove song from library
            unset($current_library[$song_name]);

            //remove song from all playlists containging the song
            $playlists = unserialize($current_user->get_playlists());
            foreach($playlists as $plist){
                //gets playlist object
                $playlist = unserialize($plist);
                //remove song from playlist
                $playlist->remove_song($song_name);
                //serialize data to update the playlsit
                $updated_lst = serialize($playlist);
                //update data
                $playlists['a' . $playlist->get_name()] = $updated_lst;
            }
            //serialize playlist for update
            $ser_playlists = serialize($playlists);

            //update the users playlists
            $current_user->set_playlists($ser_playlists);

            //update user
            $new_lib = serialize($current_library);
            $current_user->set_library($new_lib);
            $updated_user = serialize($current_user);
            $_SESSION['a' . $current_user->get_username()] = $updated_user;
            //update file info
            update_file_info($current_user->get_username(),$updated_user);
        }
    ?><meta http-equiv="refresh" content="0; URL='Library.php'"/>
    
</body>
</html>