<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            Inlog Formulier
        </title>
        <link href="assets/style/theme.css" rel="stylesheet" />
    </head>
    <body>
        <div id="container">
            <h1>
                Classroom manager
                <div class="logo"></div>
            </h1>
            <div id="body">

                <?php

                    $submitted_username = "";
                    $login_ok    = false;

                    if(!empty($_POST))
                    {
                        // includes
                        include_once("inc/database.inc.php");
                        include_once("inc/session.inc.php");
                        include_once("inc/user.inc.php");
                        // variables
                        
                        $database   = new Database();
                        $query      = sprintf("SELECT id, username, salt, password, email FROM `users` WHERE username = '%s'", $_POST["username"]); 
                        
                        try
                        {
                            if($result = $database->execute($query))
                            {
                                if($row = $result->fetch_assoc()){
                                    
                                    $check_password = hash('sha256', $_POST['password'] . $row['salt']);

                                    for($round = 0; $round < 65536; $round++)
                                    {
                                        $check_password = hash('sha256', $check_password . $row['salt']);
                                    }

                                    if($check_password === $row['password'])
                                    {
                                        $login_ok = true;
                                    }
                                    
                                    if($login_ok)
                                    {
                                        unset($row["salt"]);
                                        unset($row["password"]);
                                        $_SESSION["user"] = $row;

                                        header("Location:dashboard.php");
                                    }else{
                                        $submitted_username = htmlentities($_POST["username"], ENT_QUOTES, 'UTF-8');
                                    }
                                }
                            }
                        }

                        catch(Exception $ex)
                        {
                            die("Failed to execute query :" . $ex->getMessage());
                        }
                        
                        /* free result set */
                        //$database->disconnect();
                    } 
                ?>
                <fieldset>
                    <legend>Login</legend>
                        <form method="POST" enctype="application/x-www-form-urlencoded">
                            <table>
                                <?php if(!empty($_POST)){ ?>
                                <tr>
                                    <td colspan="2" style="color:red;"><?=$login_ok ? null : "Login failed";?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td><label for="username">Username :</label></td>
                                    <td><input id="username" name="username" type="text" placeholder="Username" value="<?=$submitted_username?>" required /></td>
                                </tr>
                                <tr>   
                                    <td><label for="password">Password :</label></td>
                                    <td><input id="password" name="password" type="password" placeholder="Password" required /></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="submit" value="Login" style="float:right;"/>
                                        <input type="button" value="Register" style="float:right;" onclick="location.href='register.php'"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </fieldset>
                
            <p class="footer">Footer information 2017 &copy;</p>
        </div>
    </body>
</html>