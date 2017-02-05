        <?php
            //Displays the selected file in the browser
            $file = $_GET['file'];
            $user = $_GET['user'];
            $dir = sprintf("/srv/%s/%s", $user, $file);
            view($dir);

            function view($dir)
            {
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime = $finfo->file($dir);
                header("Content-Type: ".$mime);
                readfile($dir);
            }
        ?>