 <!-- Allows user to enter username to share file with -->
 <!DOCTYPE html>
<html>
   <body>
 <form method="POST">
    <p>
    <label for="user">Enter the username you would like to share with:</label>
    <input type="text" name="shareuser" id="shareuser" />
    </p>
    <p>
    <input type="submit" name ="shareButton" id = "shareButton" value="Share" />
    </p>
    <input type="submit" name ="returnHome" id = "returnHome" value= "Home Page" />
 </form>

<?php
    //Shares file with another user by placing a copy of the file in the associated directory 
    $file = $_GET['file'];
    $user = $_GET['user'];
    $dir = sprintf("/srv/%s/%s", $user, $file);
    
    if(isset($_POST['shareButton']))
    {
        $shareuser = $_POST['shareuser'];
        $newdir = sprintf("/srv/%s/%s", $shareuser,$file);
         if( strpos(file_get_contents("/home/punsach/filesharing/users.txt"),$_POST['shareuser']) !== false)
         {
            copy($dir, $newdir);
            echo "Successfully shared file with " . $shareuser;
         }
         //Will also test if the user does not exist, and indicate if the user does not exist
         else
         {
            echo "Invalid User";
         }
    }
    
    if(isset($_POST['returnHome']))
    {
        header("Location: userinfo.php");
    }
    
?>

</body>
</html>
            
            