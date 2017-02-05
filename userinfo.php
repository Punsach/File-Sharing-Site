<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>User Info Page</title>
        <style type="text/css">
            h1
            {
                color: black;
                text-align:center;
            }
            body
            {
                width: 760px; /* how wide to make your web page */
                background-color: teal; /* what color to make the background */
                margin: 0 auto;
                padding: 0;
                font:12px/16px Verdana, sans-serif; /* default font */
            }
            div#main
            {
                background-color: #FFF;
                margin: 0;
                padding: 10px;
            }
        </style>
    </head>
    
    <body><div id = "main">
        <h1>FILE SHARING WEBSITE</h1>
        <?php
            session_start();
        ?>
        <?php
            if($_SESSION['validLogin'] === false)
            {
                header("Location: login.php");
            }
        ?>
        
        <form enctype="multipart/form-data" method="POST" >
            <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
            <label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
            </p>
            <p>
            <input type="submit" value="Upload File" id = "submit" name = "submit"/>
            </p>
        </form>
        
        <?php
            //Determines the user that is logged in and displays the files associated with the user 
            if(isset($_SESSION['use']))
            {
                $username = htmlentities($_SESSION['use']);
                echo "Welcome <strong>" . $username . "</strong>\n" . "<br>";
                $dir    = sprintf("/srv/%s", $username) ;
                $files = array_diff(scandir($dir), array('..','.'));
                listfiles($files, $dir, $username);
                
                //Allows the user to select a file to upload, and uploads file if it is valid 
                if(isset($_POST['submit']))
                {
                    $filename = basename($_FILES['uploadedfile']['name']);
                    if( !preg_match('/^[\w_\.\-]+$/', $filename) )
                    {
                        echo "Invalid filename";
                        exit;
                    }
                    
                    $full_path = sprintf("/srv/%s/%s", $username, $filename);
         
                    if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) )
                    {
                        header("Refresh: 0");
                        $files = array_diff(scandir($dir), array('..','.'));
                        listFiles($files, $dir, $username);
                    }
                    else
                    {
                        echo "Fail";
                        exit;
                    }
                }
            }
            else
            {
                header("Location: login.php");
                session_unset();
            }
            //Function that lists all the files and assigns them View, Delete, and Share Options 
            function listFiles($files, $dir, $username)
            {
                foreach($files as $value)
                {
                    echo "<br>" . $value . "<br>";
                    echo "<a href='delete.php?user=$username&file=$value'>Delete</a> ";
                    echo "<a href='view.php?user=$username&file=$value'>View</a> ";
                    echo "<a href='share.php?user=$username&file=$value'>Share</a> ";
                }
            }
            ?>
            <!-- Provides a logout function -->
            <form action = "logout.php" method="POST">
                <p>
                    <input type="submit" name ="logoutButton" id = "logoutButton" value="Logout" />
                </p>
            </form>
        </div>
    </body>
</html>