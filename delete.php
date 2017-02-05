     <?php
            //Deletes selected file by completely removing it from the directory 
            $file = $_GET['file'];
            $user = $_GET['user'];
            $dir = sprintf("/srv/%s/%s", $user, $file);
            delete($dir);
            header("Location: userinfo.php");
            
            function delete($filepath)
            {
                unlink($filepath);
            }
        ?>
  
