        <?php
            //Displays the file in the browser 
            ob_clean();
            $file = $_GET['file'];
            $user = $_GET['user'];
            $dir = sprintf("/srv/%s/%s", $user, $file);
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($dir);
            header("Content-Type: ".$mime);
            readfile($dir);
        ?>
