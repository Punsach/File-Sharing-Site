<!DOCTYPE html>
<html>
    <head>
         <meta charset="utf-8"/>
        <title>File Sharing Site Login</title>
        <style type="text/css">
            h1{
                color: black;
                text-align:center;
            }
            div.box
            {
                width: 600px;
                margin: 0 auto;
                padding: 25px;
                background-color: green;
                border: 10px solid black;
                border-style: double;
            }
        </style>
    </head>
<body>
    <div class = "box">
            <h1>LOGIN</h1>
            <form method="POST">
                <p>
                    <label for="user">Enter your username:</label>
                    <input type="text" name="user" id="user" />
                </p>
                <p>
                    <input type="submit" name ="loginButton" id = "loginButton" value="Login" />
                </p>
            </form>
            
            <form method="post"> 
<label>Add new user: </label>
<input type="text" name="addition"/> 
<input type="submit"/> 
</form>
            <?php
                //If new user is selected, it will create a new user and a directory to store his/her files
                //http://www.dynamicdrive.com/forums/showthread.php?4539-how-do-i-modify-existing-txt-files-with-php
                $fn = "/home/punsach/filesharing/users.txt"; 
                $file = fopen($fn, "a+"); 
                $size = filesize($fn);
                
                if(isset($_POST['addition']))
                {
                    $newuser = htmlentities($_POST['addition']);
                     fwrite($file, $newuser . "\n");
                    $text = fread($file, $size); 
                    fclose($file);
                    $newdir = sprintf("/srv/%s", $_POST['addition']);
                    mkdir($newdir, 0777);
                }
                //end citation 
                //If user logs in, starts a session and passes the information to the userinfo.php page
                session_start();
                session_unset();
                $user = "";
                $validLogin = false; 
                if(isset($_POST['loginButton']))
                {
                    //Determines if the uername entered exists in users.txt
                    $user = $_POST['user'];
                    if( strpos(file_get_contents("/home/punsach/filesharing/users.txt"),$_POST['user']) !== false)    
                    {
                        $validLogin = true;
                        $_SESSION['use'] = $user;
                        if(!isset($_SESSION['validLogin']))
                        {
                            $_SESSION['validLogin'] = $validLogin;
                        }
                        header("Location: userinfo.php");
                        exit;
                    }
                    else
                    {
                        $validLogin = false; 
                        echo "Invalid Login";
                    }
                }
            ?>
        </div>
    </body>
</html>