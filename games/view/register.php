<?php
// So I don't have to deal with unset $_REQUEST['user'] when refilling the form
// You can also take a look at the new ?? operator in PHP7

/*$_REQUEST['user']=!empty($_REQUEST['user']) ? $_REQUEST['user'] : '';
$_REQUEST['password']=!empty($_REQUEST['password']) ? $_REQUEST['password'] : '';*/
$_REQUEST['reg_username']=!empty($_REQUEST['reg_username']) ? $_REQUEST['reg_username'] : '';
$_REQUEST['reg_password']=!empty($_REQUEST['reg_password']) ? $_REQUEST['reg_password'] : '';
$_REQUEST['email']=!empty($_REQUEST['email']) ? $_REQUEST['email'] : '';
$_REQUEST['phone']=!empty($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
$_REQUEST['gender']=!empty($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
$_REQUEST['Favorite_color']=!empty($_REQUEST['Favorite_color']) ? $_REQUEST['Favorite_color'] : '';
$_REQUEST['check_student']=!empty($_REQUEST['check_student']) ? $_REQUEST['check_student'] : '';
$_REQUEST['check_fulltime']=!empty($_REQUEST['check_fulltime']) ? $_REQUEST['check_fulltime'] : '';
$_REQUEST['check_parttime']=!empty($_REQUEST['check_parttime']) ? $_REQUEST['check_parttime'] : '';
$_REQUEST['check_unemp']=!empty($_REQUEST['check_unemp']) ? $_REQUEST['check_unemp'] : '';


?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Register</title>
    </head>
    <body>
        <h1>Register your account</h1>
        <form action="index.php" method="post">
            <label>Username and Password (*Required):</label><br>
            <input type="text" size="20" name="reg_username" value="<?php echo($_REQUEST['reg_username']); ?>"/></input>
            <input type="text" size="20" name="reg_password" value="<?php echo($_REQUEST['reg_password']); ?>"/></input><br><br>

            <label>Gender:</label><br>
            <input type="radio" name="gender" value="male" 
            <?php if (($_REQUEST['gender']) == 'male') {echo 'checked="checked"';} ?>>Male</input><br>
            <input type="radio" name="gender" value="female"
            <?php if (($_REQUEST['gender']) == 'female') {echo 'checked="checked"';} ?>>Female</input><br>
            <input type="radio" name="gender" value="other"
            <?php if (($_REQUEST['gender']) == 'other') {echo 'checked="checked"';} ?>>Other</input><p></p>

            <label>Favorite Color:</label>
            <select name="Favorite_color">
                <option value="Blue" <?php if (($_REQUEST['Favorite_color']) == 'Blue') {echo 'selected="selected"';} ?>>Blue</option>
                <option value="Black" <?php if (($_REQUEST['Favorite_color']) == 'Black') {echo 'selected="selected"';} ?>>Black</option>
                <option value="Red" <?php if (($_REQUEST['Favorite_color']) == 'Red') {echo 'selected="selected"';} ?>>Red</option>
                <option value="yellow" <?php if (($_REQUEST['Favorite_color']) == 'yellow') {echo 'selected="selected"';} ?>>Yellow</option>
                <option value="Orange" <?php if (($_REQUEST['Favorite_color']) == 'Orange') {echo 'selected="selected"';} ?>>Orange</option>
                <option value="Pink" <?php if (($_REQUEST['Favorite_color']) == 'Pink') {echo 'selected="selected"';} ?>>Pink</option>
                <option value="Green" <?php if (($_REQUEST['Favorite_color']) == 'Green') {echo 'selected="selected"';} ?>>Green</option>
            </select><p></p>
            
            <label>Employment Status:</label><br>
            <input type="checkbox" name="check_student" value="True" <?php if (($_REQUEST['check_student']) == 'True') {echo 'checked="checked"';} ?>>Student</input><br>
            <input type="checkbox" name="check_fulltime" value="True" <?php if (($_REQUEST['check_fulltime']) == 'True') {echo 'checked="checked"';} ?>>Full-Time</input><br>
            <input type="checkbox" name="check_parttime" value="True" <?php if (($_REQUEST['check_parttime']) == 'True') {echo 'checked="checked"';} ?>>Part-Time</input><br>
            <input type="checkbox" name="check_unemp" value="True" <?php if (($_REQUEST['check_unemp']) == 'True') {echo 'checked="checked"';} ?>>Unemployed</input><p></p>

            <label>Email Address (*Required)</label>
            <input type="text" name="email" value="<?php echo($_REQUEST['email']); ?>"/></input><p></p>

            <label>Phone Number</label>
            <input type="text" name="phone" value="<?php echo($_REQUEST['phone']); ?>"/></input><p></p>


            <input type="submit" size="30" name="sendinfo" value="Create"></input><br>
            <table>
                <tr><th>&nbsp;</th><td><?php echo(view_errors($errors)); ?></td></tr>
            </table>
        </form>
        
        
        <form action="index.php" method="post">
				<input type="submit" name="loginbtn" value="login"/>
		</form>
    </body>
</html>
