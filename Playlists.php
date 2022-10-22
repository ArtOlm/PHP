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
    <title>Playlists</title>
</head>
<body>
    <?php
        $username = $_SESSION['currentuser'];
        $current_user = unserialize($_SESSION['a' . $username]);
        $playlists = unserialize($current_user->get_playlists());
        echo '<h1><b>'. $current_user->get_username() .' Playlists</h1>'; 
        echo '<h5><b><u>*Note:to add songs go to your library and select the songs you would like to add</u></b></h5>';
        foreach($playlists as $plist){
            //gets playlist object
            $playlist = unserialize($plist);
            echo $playlist->get_name() . '<form method="post" action="ViewPlaylist.php"> <button type="submit" name = "View"  value="View ' . $playlist->get_name() . '">View</button></form>';
            echo '<form method="get" action="RenamePlaylist.php"> <button type="submit" name = "rename"  value="Rename ' . $playlist->get_name() . '">Rename</button></form>';
            echo '<form method="post" action="RemovePlaylist.php"> <button type="submit" name = "remove"  value="Remove ' . $playlist->get_name() . ' from playlists">Delete</button></form>';
        }
    ?>
    <br>
    <form method="post" action="CreatePlaylist.php">
        <input type="submit" value="Create New Playlist">
    </form>
    <br>
    <form method="post" action="UserAccountMenu.php">
        <input type="submit" value="return to main menu">
    </form>
</body>
</html>