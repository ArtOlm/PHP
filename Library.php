<?php session_start();
      include ("User.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Library</title>
</head>
<body>
      <h1><b>Library</b></h1>
      <h5><b><u>*Note:songs removed from library will also be removed from all playlist containing song</u></b></h5>
      
      <?php 
            //get current user info
            $username = $_SESSION['currentuser'];
            $current_user = unserialize($_SESSION['a' . $username]);
            $current_library = unserialize($current_user->get_library());

            //print out songs and options on what to do with them
            //still need to implement adding to playlist
            foreach($current_library as $song){
                  echo $song . '<form method="post" action="AddToPlaylist.php"> <button type="submit" name = "append" value="add ' . $song . ' to playlist"> add to playlist</button></form>';
                  echo '<form method="post" action="RemoveFromLib.php"> <button type="submit" name = "remove"  value="remove ' . $song . ' from library">remove from library</button></form>';
            }
      ?>
      <br>
      <br>
      <form method="post" action="UserAccountMenu.php">
        <input type="submit" label = "hh" value="return to main menu">
      </form>
      
</body>
</html>

