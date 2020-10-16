
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
        <style type="text/css">
            .button {
                background-color: #555555; /* Black */
                border: none;
                color: white;
                width: 90%;
                height: 10%;
                padding: 16px 32px;
                margin: 4px 5%;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                transition-duration: 0.3s;
                cursor: pointer;
            }
            .button_b {
                background-color: white;
                color: black;
                width: 90%;
                border: 2px solid #555555;
            }
            .button_b:hover {
                background-color: #555555;
                width: 90%;
                color: white;
            }
        </style>
		<title>A1group18</title>
	</head>
		<header><h1>Main Menu</h1></header>
	<nav>
        <ul>
            <li><h3> • Navigational Bar </h3>
            <li> 
                <form action="index.php" method="post">
                    <button class="button button_b" type='submit' name="menubtn" value="menubtn"/><a>Menu</a></button>
                </form>
            <li> 
                <form action="index.php" method="post">
                    <button class="button button_b" type='submit' name="profilebtn" value="profilebtn"/><a>Player Profile</a></button>
                </form>
            <li>    
                <form action="index.php" method="post">
                    <button class="button button_b" type='submit' name="statsbtn" value="statsbtn"/><a>Game Stats</a></button>
                </form>
            <li>    
                <form action="index.php" method="post">
                    <button class="button button_b" type='submit' name="ggbtn" value="ggbtn"/><a>Guess Game</a></button>
                </form>
            <li>
                <form action="index.php" method="post">
                    <button class="button button_b" type='submit' name="15puzzlebtn" value="15puzzlebtn"/><a>15 Puzzle</a></button>
                </form>
            <li>
                <form action="index.php" method="post">
                    <button class="button button_b" type='submit' name="pegbtn" value="pegbtn"/><a>Peg Solitaire</a></button>
                </form>
            <li>
                <form action="index.php" method="post">
                    <button class="button button_b" type='submit' name="mastermindbtn" value="mastermindbtn"/><a>Mastermind</a></button>
                </form>
            <li>
                <form action="index.php" method="post">
                    <button class="button button_b" type='submit' name="logoutbtn" value="logoutbtn"/><a>Log Out</a></button>
                </form>
        </ul>
    </nav>
		<main>
        <body>
        <h1>Update your profile</h1>
        <form action="index.php" method="post">
            <label>Username and Password (*Required):</label><br>
            <input type="text" size="20" name="prof_username" value="<?php echo($_SESSION['user']); ?>"/></input>
            <input type="text" size="20" name="prof_password" value="<?php echo($_SESSION['password']); ?>"/></input><br><br>

            <label>Gender:</label><br>
            <input type="radio" name="prof_gender" value="male" 
            <?php if (($_SESSION['gender']) == 'male') {echo 'checked="checked"';} ?>>Male</input><br>
            <input type="radio" name="prof_gender" value="female"
            <?php if (($_SESSION['gender']) == 'female') {echo 'checked="checked"';} ?>>Female</input><br>
            <input type="radio" name="prof_gender" value="other"
            <?php if (($_SESSION['gender']) == 'other') {echo 'checked="checked"';} ?>>Other</input><p></p>

            <label>Favorite Color:</label>
            <select name="prof_Favorite_color">
                <option value="Blue" <?php if (($_SESSION['color']) == 'Blue') {echo 'selected="selected"';} ?>>Blue</option>
                <option value="Black" <?php if (($_SESSION['color']) == 'Black') {echo 'selected="selected"';} ?>>Black</option>
                <option value="Red" <?php if (($_SESSION['color']) == 'Red') {echo 'selected="selected"';} ?>>Red</option>
                <option value="yellow" <?php if (($_SESSION['color']) == 'yellow') {echo 'selected="selected"';} ?>>Yellow</option>
                <option value="Orange" <?php if (($_SESSION['color']) == 'Orange') {echo 'selected="selected"';} ?>>Orange</option>
                <option value="Pink" <?php if (($_SESSION['color']) == 'Pink') {echo 'selected="selected"';} ?>>Pink</option>
                <option value="Green" <?php if (($_SESSION['color']) == 'Green') {echo 'selected="selected"';} ?>>Green</option>
            </select><p></p>
            
            <label>Employment Status:</label><br>
            <input type="checkbox" name="prof_check_student" value="True" <?php if (($_SESSION['check_student']) == 'True') {echo 'checked="checked"';} ?>>Student</input><br>
            <input type="checkbox" name="prof_check_fulltime" value="True" <?php if (($_SESSION['check_fulltime']) == 'True') {echo 'checked="checked"';} ?>>Full-Time</input><br>
            <input type="checkbox" name="prof_check_parttime" value="True" <?php if (($_SESSION['check_parttime']) == 'True') {echo 'checked="checked"';} ?>>Part-Time</input><br>
            <input type="checkbox" name="prof_check_unemp" value="True" <?php if (($_SESSION['check_unemp']) == 'True') {echo 'checked="checked"';} ?>>Unemployed</input><p></p>

            <label>Email Address (*Required)</label>
            <input type="text" name="prof_email" value="<?php echo($_SESSION['email']); ?>"/></input><p></p>

            <label>Phone Number</label>
            <input type="text" name="prof_phone" value="<?php echo($_SESSION['phone']); ?>"/></input><p></p>


            <input type="submit" size="30" name="updateinfo" value="Update"></input><br>
            <table>
                <tr><th>&nbsp;</th><td><?php echo(view_errors($errors)); ?></td></tr>
            </table>
        </form>
        <!--<a href="index.php"><button name="Login">Login</button></a>-->
        <form action="index.php" method="post">
				<input type="submit" name="menubtn" value="menu"/>
        </form>
        

    
		</main>
		<footer>
		</footer>
	</body>
</html>




