<?php
/*
Made by Yuhao Jiang, andi fan
*/
	// So I don't have to deal with uninitialized $_REQUEST['guess']
	$_REQUEST['ball']=!empty($_REQUEST['ball']) ? $_REQUEST['ball'] : '';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
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
			.button_m{
    			border-width:0px; 
    			width:29px; 
    			height:29px; 
    			padding:0px;
			}
		</style>
		<title>Mastermind Game</title>
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
	<body bgcolor="cream">
		<center>
		<h1>Welcome to Mastermind Game</h1>
		<h3>Made by Yuhao Jiang, Andi Fan</h3>
		<?php if($_SESSION["MasterGame"]->getState()!="win" && $_SESSION["MasterGame"]->getState()!="lose"){ 
			[[$b0, $b1, $b2, $b3, $b4, $b5], 
			[$t1, $c1_1, $c1_2, $c1_3, $c1_4, $s1_1, $s1_2, $s1_3, $s1_4], 
			[$t2, $c2_1, $c2_2, $c2_3, $c2_4, $s2_1, $s2_2, $s2_3, $s2_4],
			[$t3, $c3_1, $c3_2, $c3_3, $c3_4, $s3_1, $s3_2, $s3_3, $s3_4],
			[$t4, $c4_1, $c4_2, $c4_3, $c4_4, $s4_1, $s4_2, $s4_3, $s4_4],
			[$t5, $c5_1, $c5_2, $c5_3, $c5_4, $s5_1, $s5_2, $s5_3, $s5_4],
			[$t6, $c6_1, $c6_2, $c6_3, $c6_4, $s6_1, $s6_2, $s6_3, $s6_4],
			[$t7, $c7_1, $c7_2, $c7_3, $c7_4, $s7_1, $s7_2, $s7_3, $s7_4],
			[$t8, $c8_1, $c8_2, $c8_3, $c8_4, $s8_1, $s8_2, $s8_3, $s8_4],
			[$t9, $c9_1, $c9_2, $c9_3, $c9_4, $s9_1, $s9_2, $s9_3, $s9_4],
			[$t10, $c10_1, $c10_2, $c10_3, $c10_4, $s10_1, $s10_2, $s10_3, $s10_4]] = $_SESSION["MasterGame"]->getPicture();
			echo implode(" ",$_SESSION["MasterGame"]->getSecretSolution());
			//$_SESSION["MasterGame"]->getTest();
			?>
			<form method="post">
				<tr>
					<td><button type='submit' id="ball0" class="button_m" name="ball" value="1"><img src="<?php echo $b0;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $b0, $m); echo 'ball '.$m[1];?>"></td>
					<td><button type='submit' id="ball0" class="button_m" name="ball" value="2"><img src="<?php echo $b1;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $b1, $m); echo 'ball '.$m[1];?>"></td>
					<td><button type='submit' id="ball0" class="button_m" name="ball" value="3"><img src="<?php echo $b2;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $b2, $m); echo 'ball '.$m[1];?>"></td>
					<td><button type='submit' id="ball0" class="button_m" name="ball" value="4"><img src="<?php echo $b3;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $b3, $m); echo 'ball '.$m[1];?>"></td>
					<td><button type='submit' id="ball0" class="button_m" name="ball" value="5"><img src="<?php echo $b4;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $b4, $m); echo 'ball '.$m[1];?>"></td>
					<td><button type='submit' id="ball0" class="button_m" name="ball" value="6"><img src="<?php echo $b5;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $b5, $m); echo 'ball '.$m[1];?>"></td>
				</tr>
			</form>
			<br/>
			<form method="post">
				<tr>
					<td>
						<button type="submit" id="Check" name="ball" value="check">Check</button>
						<button type="submit" id="Delete" name="ball" value="delete">Delete</button>
						<button type="submit" id="Restart" name="ball" value="restart">Restart</button>
						<button type="submit" id="Menu" name="ball" value="menu">Give up and back to Menu</button>
					</td>
				</tr>
			</form>
			<h1>
				<?php if($_SESSION["MasterGame"]->getState() == "error"){?>
				Wrong action:
				<?php echo $_SESSION["MasterGame"]->getError(); ?>
				<br/>
				<?php }?>
      			The number of your tries is:
      			<br/>
      			<?php echo $_SESSION["MasterGame"]->getNumTries(); ?>
    		</h1>
    		<tr> 
    			<!-- Round 1 -->
    			<td><img src="<?php echo $t1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$t1,$m);echo 'round '.$m[1];?>"></td>
    			<td><img src="<?php echo $c1_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c1_1,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c1_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c1_2,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c1_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c1_3,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c1_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c1_4,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $s1_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s1_1,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s1_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s1_2,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s1_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s1_3,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s1_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s1_4,$m);echo 'state '.$m[1];?>"></td>
    		</tr>
    		<br/>
    		<tr> 
    			<!-- Round 2 -->
    			<td><img src="<?php echo $t2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$t2,$m);echo 'round '.$m[1];?>"></td>
    			<td><img src="<?php echo $c2_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c2_1,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c2_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c2_2,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c2_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c2_3,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c2_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c2_4,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $s2_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s2_1,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s2_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s2_2,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s2_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s2_3,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s2_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s2_4,$m);echo 'state '.$m[1];?>"></td>
    		</tr>
    		<br/>
    		<tr> 
    			<!-- Round 3 -->
    			<td><img src="<?php echo $t3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$t3,$m);echo 'round '.$m[1];?>"></td>
    			<td><img src="<?php echo $c3_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c3_1,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c3_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c3_2,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c3_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c3_3,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c3_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c3_4,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $s3_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s3_1,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s3_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s3_2,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s3_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s3_3,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s3_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s3_4,$m);echo 'state '.$m[1];?>"></td>
    		</tr>
    		<br/>
    		<tr> 
    			<!-- Round 4 -->
    			<td><img src="<?php echo $t4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$t4,$m);echo 'round '.$m[1];?>"></td>
    			<td><img src="<?php echo $c4_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c4_1,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c4_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c4_2,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c4_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c4_3,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c4_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c4_4,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $s4_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s4_1,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s4_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s4_2,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s4_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s4_3,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s4_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s4_4,$m);echo 'state '.$m[1];?>"></td>
    		</tr>
    		<br/>
    		<tr> 
    			<!-- Round 5 -->
    			<td><img src="<?php echo $t5;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$t5,$m);echo 'round '.$m[1];?>"></td>
    			<td><img src="<?php echo $c5_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c5_1,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c5_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c5_2,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c5_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c5_3,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c5_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c5_4,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $s5_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s5_1,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s5_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s5_2,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s5_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s5_3,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s5_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s5_4,$m);echo 'state '.$m[1];?>"></td>
    		</tr>
    		<br/>
    		<tr> 
    			<!-- Round 6 -->
    			<td><img src="<?php echo $t6;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$t6,$m);echo 'round '.$m[1];?>"></td>
    			<td><img src="<?php echo $c6_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c6_1,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c6_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c6_2,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c6_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c6_3,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c6_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c6_4,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $s6_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s6_1,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s6_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s6_2,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s6_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s6_3,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s6_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s6_4,$m);echo 'state '.$m[1];?>"></td>
    		</tr>
    		<br/>
    		<tr> 
    			<!-- Round 7 -->
    			<td><img src="<?php echo $t7;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$t7,$m);echo 'round '.$m[1];?>"></td>
    			<td><img src="<?php echo $c7_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c7_1,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c7_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c7_2,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c7_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c7_3,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c7_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c7_4,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $s7_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s7_1,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s7_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s7_2,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s7_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s7_3,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s7_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s7_4,$m);echo 'state '.$m[1];?>"></td>
    		</tr>
    		<br/>
    		<tr> 
    			<!-- Round 8 -->
    			<td><img src="<?php echo $t8;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$t8,$m);echo 'round '.$m[1];?>"></td>
    			<td><img src="<?php echo $c8_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c8_1,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c8_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c8_2,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c8_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c8_3,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c8_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c8_4,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $s8_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s8_1,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s8_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s8_2,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s8_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s8_3,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s8_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s8_4,$m);echo 'state '.$m[1];?>"></td>
    		</tr>
    		<br/>
    		<tr> 
    			<!-- Round 9 -->
    			<td><img src="<?php echo $t9;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$t9,$m);echo 'round '.$m[1];?>"></td>
    			<td><img src="<?php echo $c9_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c9_1,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c9_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c9_2,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c9_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c9_3,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c9_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c9_4,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $s9_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s9_1,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s9_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s9_2,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s9_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s9_3,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s9_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s9_4,$m);echo 'state '.$m[1];?>"></td>
    		</tr>
    		<br/>
    		<tr> 
    			<!-- Round 10 -->
    			<td><img src="<?php echo $t10;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$t10,$m);echo 'round '.$m[1];?>"></td>
    			<td><img src="<?php echo $c10_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c10_1,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c10_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c10_2,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c10_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c10_3,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $c10_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$c10_4,$m);echo 'ball '.$m[1];?>"></td>
    			<td><img src="<?php echo $s10_1;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s10_1,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s10_2;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s10_2,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s10_3;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s10_3,$m);echo 'state '.$m[1];?>"></td>
    			<td><img src="<?php echo $s10_4;?>" alt="<?php $m=array();preg_match('/images\/(\w+)\.png/',$s10_4,$m);echo 'state '.$m[1];?>"></td>
    		</tr>
    		<br/>


		<?php } else if($_SESSION["MasterGame"]->getState()=="win"){ [$r1, $r2, $r3, $r4] = $_SESSION["MasterGame"]->getSolutionPicture();?>
			<h1>
      			You Win !
      			<br/>
      			The SOLUTION is:
      			<br/>
      			<tr>
      				<td><img src="<?php echo $r1;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $r1, $m); echo 'ball '.$m[1];?>"></td>
      				<td><img src="<?php echo $r2;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $r2, $m); echo 'ball '.$m[1];?>"></td>
      				<td><img src="<?php echo $r3;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $r3, $m); echo 'ball '.$m[1];?>"></td>
      				<td><img src="<?php echo $r4;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $r4, $m); echo 'ball '.$m[1];?>"></td>
      			</tr>
      			<br/>
      			The number of tries you used to win is:
      			<br/>
      			<?php echo $_SESSION["MasterGame"]->getNumTries(); ?>
    		</h1>
    		<br/>
    		<form method="post">
				<tr>
					<td>
						<button type="submit" id="Restart" name="ball" value="restart">Restart</button>
						<button type="submit" id="Menu" name="ball" value="menu">Back to Menu</button>
					</td>
				</tr>
			</form>
    		<?php 
			foreach($_SESSION['MasterGame']->history as $key=>$value){
				if($value == -1){
					echo("<br/> Round ".(intval($key)+1)." : You Lose");
				}else{
					echo("<br/> Round ".(intval($key)+1)." : Number of tries to win : $value");
				}
			}?>
		
		<?php } else if($_SESSION["MasterGame"]->getState()=="lose"){ [$r1, $r2, $r3, $r4] = $_SESSION["MasterGame"]->getSolutionPicture();?>
			<h1>
      			Game Over
      			<br/>
      			You lose, the correct SOLUTION is:
      			<br/>
      			<tr>
      				<td><img src="<?php echo $r1;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $r1, $m); echo 'ball '.$m[1];?>"></td>
      				<td><img src="<?php echo $r2;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $r2, $m); echo 'ball '.$m[1];?>"></td>
      				<td><img src="<?php echo $r3;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $r3, $m); echo 'ball '.$m[1];?>"></td>
      				<td><img src="<?php echo $r4;?>" alt="<?php $m=array(); preg_match('/images\/(\w+)\.png/', $r4, $m); echo 'ball '.$m[1];?>"></td>
      			</tr>
    		</h1>
    		<br/>
    		<form method="post">
				<tr>
					<td>
						<button type="submit" id="Restart" name="ball" value="restart">Restart</button>
						<button type="submit" id="Menu" name="ball" value="menu">Back to Menu</button>
					</td>
				</tr>
			</form>
    		<?php 
			foreach($_SESSION['MasterGame']->history as $key=>$value){
				if($value == -1){
					echo("<br/> Round ".(intval($key)+1)." : You Lose");
				}else{
					echo("<br/> Round ".(intval($key)+1)." : Number of tries to win : $value");
				}
			}?>
		
		<?php }?>
		
		<?php echo(view_errors($errors)); ?> 

	<center>
	</body>
</html>
