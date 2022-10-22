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
        //get string containing song name
        $post_val = $_POST['append'];

        //split stirng containing the song name
        $split_val = explode(' ',$post_val);

        //save song name whoch will be added to playlist
        $_SESSION['song_to_add'] = $split_val[1];

        //get user
        $username = $_SESSION['currentuser'];
        $current_user = unserialize($_SESSION['a' . $username]);
        
        //get list of playlists
        $playlists = unserialize($current_user->get_playlists());
        if(sizeof($playlists) == 0){
            echo 'No playlist has been created please create a playlist or return to library<br>';
            echo '<h5><b>Note: creating a playlist will not add the song, you have to return to library and add it afterwards</b></h5>';
        }else{
            echo 'Which of the following playlists would you like to add the song to?<br>';
        }
        //display all playlists
        foreach($playlists as $plist){
            //gets playlist object
            $playlist = unserialize($plist);
            echo '<form method="post" action="SuccesfulAdd.php"> <input type="submit" name = "Add"  value="' . $playlist->get_name() . '"></form><br>';
        }
    ?>  <br>
        <form method="post" action="CreatePlaylist.php">
            <input type="submit" value="Create Playlist">
        </form>
        <br>
        <form method="post" action="Library.php">
            <input type="submit" value="return to library">
        </form>
</body>
</html>