<?php session_start();
      include ("User.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Menu</title>
</head>
<body>
    <?php
        //current user
        $username = $_SESSION['currentuser'];
        //unserialaize user data
        $user = unserialize($_SESSION['a' . $username]);
        echo "Hello " . $user->get_username() . " welcome to your music, what plataform would you like to do?<br>";
    ?>
    <br>
    <form method="post" action="Library.php">
        <input type="submit" value="View Library">
    </form>
    <br>
    <form method="post" action="Playlists.php">
        <input type="submit" value="Veiw Playlists">
    </form>
    <br>
    <form method="post" action="Zotify.php">
        <input type="submit" value="Go To Zotify Store">
    </form>
    <br>
    <form method="post" action="ZTunes.php">
        <input type="submit" value="Go To Ztunes Store">
    </form>
    <br>
    <form method="post" action="LogInMenu.php">
        <input type="submit" value="Log Out">
    </form>
</body>
</html>