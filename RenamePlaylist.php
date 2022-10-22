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
    <title>Rename Playlist</title>
</head>
<body>
    <form method= post>
        Enter New Name For Playlist:  <input type="text" name='new_name'><br>
        <input type="submit" name = "create" value="Rename Playlist"><br>
       
    </form>

    <?php
        $cancelButton = '<form method= post action = "Playlists.php"> <input type="submit" name = "cancel" value="Cancel"> </form>';

        if(array_key_exists('new_name',$_POST)){
            //get new name
            $new_name_passed = $_POST['new_name'];
            if(containsWhiteSpace($new_name_passed)){
                echo $cancelButton;
                echo 'Name must <b>not</b> have any Whitespace';

            }elseif(strlen($new_name_passed) == 0){
                echo $cancelButton;
                echo 'Name must conatin at least one character';
            }else{
                //get value passed down containing name for playlsit
                $val = $_GET['rename'];
                
                //split value to separate name
                $split_val = explode(' ',$val);
                
                //save name in variable
                $name = $split_val[1];
                
                //get user
                $username = $_SESSION['currentuser'];
                
                $current_user = unserialize($_SESSION['a' . $username]);
                
                //get playlists
                global $playlist;
                $playlists = unserialize($current_user->get_playlists());
                

                if(array_key_exists('a' . $new_name_passed,$playlists)){
                    echo $cancelButton;
                    echo 'Playlist name already in use';
                }else{
                    //playlist key
                    $playlist_key = 'a' . $name;
                    //get playlist to be renamed
                    $playlist = unserialize($playlists[$playlist_key]);
            
                    //set the new name
                    $playlist->set_name($new_name_passed);
                
                    //remove name from playlist
                    unset($playlists[$playlist_key]);

                    //update playlist with new name
                    $playlists['a' . $new_name_passed] = serialize($playlist);
        
                    //serialize new playlist to store
                    $ser_playlists = serialize($playlists);
                    //update playlists of user
                    $current_user->set_playlists($ser_playlists);

                    //update user info for the session
                    $updated_user = serialize($current_user);

                    $_SESSION['a' . $current_user->get_username()] = $updated_user;
                    //update file info
                    update_file_info($current_user->get_username(),$updated_user);

                    echo '<b>Your playlist has been successfuly renamed, you will be redirected shortly</b>';
                    header( "refresh:1;url=Playlists.php" );
                }   
            }    
        }else{
            echo $cancelButton;
        }
    ?>
</body>
</html>