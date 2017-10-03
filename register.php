<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            Summa school
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

                    if(!empty($_POST))
                    {
                        // includes
                        include("inc/settings.inc.php");
                        include("inc/database.inc.php");
                        include("inc/user.inc.php");

                        // variables
                        $database = new Database();
                        $user     = new User();

                        if($result = $user->register($database, $_POST))
                        {
                            echo "Registration successful, click <a href='login.php' target='_self'>here</a> to login!";
                        }

                    }else{
                ?>
                
                <form method="POST" enctype="application/x-www-form-urlencoded">
                    <fieldset>
                    <legend>Register</legend>
                    <table>
                        <tr>
                            <td><label for="firstname">Firstname</label></td>
                            <td><input id="firstname" name="firstname" type="text" placeholder="First name" required/></td>
                        </tr>
                        <tr>
                            <td><label for="preposition">Preposition</label></td>
                            <td><input id="preposition" name="preposition" type="text" placeholder="Preposition"/></td>
                        </tr>
                        <tr>
                            <td><label for="lastname">Lastname</label></td>
                            <td><input id="lastname" name="lastname" type="text" placeholder="Last name" required/></td>
                        </tr>
                         <tr>
                            <td><label for="dob">Date of birth</label></td>
                            <td><input id="dob" name="dob" type="text" placeholder="dd-mm-yyyy" required/></td>
                        </tr>
                        <tr>
                            <td><label for="function">Function</label></td>
                            <td>
                                <select id="function" name="function" style="width:173px;">
                                    <option value="0" selected>-- Select --</option>
                                    <option value="1">CEO</option>
                                    <option value="2">Manager</option>
                                    <option value="3">Genator</option>
                                    <option value="4">Teacher</option>
                                    <option value="5">Instructor</option>
                                    <option value="6">Student</option>
                                </select>
                            </td>
                        </tr>
                         <tr>
                            <td><label for="address">Address</label></td>
                            <td><input id="address" name="address" type="text" placeholder="address" style="width:118px;" /> <input name="housenumber" type"text" length="2" placeholder="Nr" size="2" required/></td>
                        </tr>
                        <tr>
                            <td><label for="postalcode">Postal code</label></td>
                            <td><input id="postalcode" name="postalcode" type="text" placeholder="Postal code" pattern="[1-9][0-9]{3}\s?[a-zA-Z]{2}" /></td>
                        </tr>
                        <tr>
                            <td><label for="city">City</label></td>
                            <td><input id="city" name="city" type="text" placeholder="City" /></td>
                        </tr>
                        <tr>
                            <td><label for="username">Username</label></td>
                            <td><input id="username" name="username" type="text" placeholder="Username" /></td>
                        </tr>
                        <tr>
                            <td><label for="password">Password</label></td>
                            <td><input id="password" name="password" type="password" placeholder="Password" required/></td>
                        </tr>
                        <tr>
                            <td><label for="repeat_password">Repeat password</label></td>
                            <td><input id="repeat_password" name="repeat_password" type="password" placeholder="Repeat password" required/></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input id="email" name="email" type="email" placeholder="you@somecompany.nl" required/></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="Register" style="float:right;"/>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php } ?>
            </div>
            <p class="footer">Footer information 2017 &copy;</p>
        </div>

    </body>
</html>