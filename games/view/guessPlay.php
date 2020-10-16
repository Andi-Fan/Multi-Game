
<?php

/* 
made by andi fan
*/
?>

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


<?php
	// So I don't have to deal with uninitialized $_REQUEST['guess']
	$_REQUEST['guess']=!empty($_REQUEST['guess']) ? $_REQUEST['guess'] : '';
?>
	<body>
		<h1>Welcome to GuessGame</h1>
	
		<form action="index.php" method="post">
       	 	<input type="text" name="guess">
        	<input type="submit" name="submitguess" value="submitguess">
    	</form>

    <?php 
    
			foreach($_SESSION['GuessGame']->history as $key=>$value){
				echo("<br/> $value");
			}
			if($_SESSION["GuessGame"]->getState()=="correct"){ 
				echo "<br>";
			}
			
	?>
	<?php
			if($_SESSION["GuessGame"]->getState()=="correct"){ 
	?>
				<form method="post">
					<input type="submit" name="restartbtn" value="start again" />
				</form>
	<?php 
			} 
	?>
    
        
    <form action="index.php" method="post">
				<input type="submit" name="menubtn" value="menu"/>
    </form>
    


	</body>
</html>