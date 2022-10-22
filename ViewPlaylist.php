<?php session_start();
    include ("Playlist.php");
      include ("User.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Playlist</title>
</head>
<body>
    <?php
        $username = $_SESSION['currentuser'];
        $current_user = unserialize($_SESSION['a' . $username]);
        //get playlists
        $playlists = unserialize($current_user->get_playlists());

        //initialize null
        $name = null;

        //check if coming from playlists
        if(array_key_exists('View', $_POST)){
            //get values passed down
            $val = $_POST['View'];
            //split claue to get name
            $split_val = explode(' ',$val);

            //get name of playlist
            $name = $split_val[1];

            //save name for use in song removal
            $_SESSION['playlist_name'] = $name;
        }else{
            //returning from removal
            $name = $_SESSION['playlist_name'];
        }

        //get desired playlist
        $playlist = unserialize($playlists['a' . $name]);

        echo '<h1><b>'. $playlist->get_name() .'</b></h1><br>';

        //get array from playlist
        $pl_arr = unserialize($playlist->get_playlist());
        
        foreach($pl_arr as $song){
            echo $song . '<form method="post" action="RemoveFromPlaylist.php"> <button type="submit" name = "remove_from_playlist"  value="Remove ' . $song . ' from playlist">remove from playlist</button></form>';
        }



    ?>
    <br>
    <form method="post" action="Playlists.php">
        <input type="submit" label = "hh" value="return to playlists">
    </form>
    <br>
    <form method="post" action="UserAccountMenu.php">
        <input type="submit" label = "hh" value="return to main menu">
    </form>
</body>
</html>