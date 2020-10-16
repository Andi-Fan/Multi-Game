<?php
/*
Made by Yuhao Jiang
*/
	// So I don't have to deal with uninitialized $_REQUEST['guess']
	$_REQUEST['square']=!empty($_REQUEST['square']) ? $_REQUEST['square'] : '';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
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
			.button_p{
    			border-width:0px; 
    			width:100px; 
    			height:100px; 
    			padding:0px;
			}
		</style>
		<title>15 Puzzle Game</title>
	</head>
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
	<body bgcolor="lightblue">
		<center>
		<h1>Welcome to 15 Puzzle Game</h1>
		<h3>Made by Yuhao Jiang</h3>
		<?php if($_SESSION["PuzzleGame"]->getState()!="win"){ [$src1, $src2, $src3, $src4, $src5, $src6, $src7, $src8, $src9, $src10, $src11, $src12, $src13, $src14, $src15, $src16] = $_SESSION["PuzzleGame"]->getPicture(); //$_SESSION["PuzzleGame"]->getTest();?>
			<form method="post">
				<!--<input type="submit" name="submit" value="guess" />-->
				<tr>
					<td><button type='submit' id="square0" class="button_p" name="square" value="0"><img src="<?php echo $src1;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src1, $matches); echo 'square '.$matches[1];?>"></button></td>
					<td><button type='submit' id="square1" class="button_p" name="square" value="1"><img src="<?php echo $src2;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src2, $matches); echo 'square '.$matches[1];?>"></button></td>
					<td><button type='submit' id="square2" class="button_p" name="square" value="2"><img src="<?php echo $src3;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src3, $matches); echo 'square '.$matches[1];?>"></button></td>
					<td><button type='submit' id="square3" class="button_p" name="square" value="3"><img src="<?php echo $src4;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src4, $matches); echo 'square '.$matches[1];?>"></button></td>
				</tr>
				<br/>
				<tr>
					<td><button type='submit' id="square4" class="button_p" name="square" value="4"><img src="<?php echo $src5;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src5, $matches); echo 'square '.$matches[1];?>"></button></td>
					<td><button type='submit' id="square5" class="button_p" name="square" value="5"><img src="<?php echo $src6;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src6, $matches); echo 'square '.$matches[1];?>"></button></td>
					<td><button type='submit' id="square6" class="button_p" name="square" value="6"><img src="<?php echo $src7;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src7, $matches); echo 'square '.$matches[1];?>"></button></td>
					<td><button type='submit' id="square7" class="button_p" name="square" value="7"><img src="<?php echo $src8;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src8, $matches); echo 'square '.$matches[1];?>"></button></td>
				</tr>
				<br/>
				<tr>
					<td><button type='submit' id="square8" class="button_p" name="square" value="8"><img src="<?php echo $src9;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src9, $matches); echo 'square '.$matches[1];?>"></button></td>
					<td><button type='submit' id="square9" class="button_p" name="square" value="9"><img src="<?php echo $src10;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src10, $matches); echo 'square '.$matches[1];?>"></button></td>
					<td><button type='submit' id="square10" class="button_p" name="square" value="10"><img src="<?php echo $src11;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src11, $matches); echo 'square '.$matches[1];?>"></button></td>
					<td><button type='submit' id="square11" class="button_p" name="square" value="11"><img src="<?php echo $src12;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src12, $matches); echo 'square '.$matches[1];?>"></button></td>
				</tr>
				<br/>
				<tr>
					<td><button type='submit' id="square12" class="button_p" name="square" value="12"><img src="<?php echo $src13;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src13, $matches); echo 'square '.$matches[1];?>"></button></td>
					<td><button type='submit' id="square13" class="button_p" name="square" value="13"><img src="<?php echo $src14;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src14, $matches); echo 'square '.$matches[1];?>"></button></td>
					<td><button type='submit' id="square14" class="button_p" name="square" value="14"><img src="<?php echo $src15;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src15, $matches); echo 'square '.$matches[1];?>"></button></td>
					<td><button type='submit' id="square15" class="button_p" name="square" value="15"><img src="<?php echo $src16;?>" alt="<?php $matches = array(); preg_match('/images\/(\w+)\.png/', $src16, $matches); echo 'square '.$matches[1];?>"></button></td>
				</tr>
				<br/>
				<tr>
					<td>
						<button type="submit" id="Shuffle" name="square" value="shuffle">Shuffle</button>
						<button type="submit" id="Restoration" name="square" value="restoration">Restoration</button>
						<button type="submit" id="Menu" name="square" value="menu">Give up and back to Menu</button>
					</td>
				</tr>
			</form>
			<h1>
      			The number of movements is:
      			<br/>
      			<?php echo $_SESSION["PuzzleGame"]->getNumMove(); ?>
    		</h1>
		<?php } else if($_SESSION["PuzzleGame"]->getState()=="win"){ ?>
			<h1>
      			You Win !
      			<br/>
      			The number of movements is:
      			<br/>
      			<?php echo $_SESSION["PuzzleGame"]->getNumMove(); ?>
    		</h1>
    		<br/>
    		<form method="post">
				<tr>
					<td>
						<button type="submit" id="Restart" name="square" value="restart">Restart</button>
						<button type="submit" id="Menu" name="square" value="menu">Back to Menu</button>
					</td>
				</tr>
			</form>
    		<?php 
			foreach($_SESSION['PuzzleGame']->history as $key=>$value){
				echo("<br/> Round".(intval($key)+1)." : Number of moves to win : $value");
			}?>
		
		<?php }?>
		
		<?php echo(view_errors($errors)); ?> 

	<center>
	</body>
</html>
