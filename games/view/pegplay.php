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

        <body>
            <h1>PegSolitaire Test<h1>
            <?php if(!$_SESSION["PegSolitaire"]->no_moves()){ [$src1, $src2, $src3, $src4, $src5, $src6, $src7, $src8, $src9, $src10, 
                $src11, $src12, $src13, $src14, $src15, $src16, $src17, $src18, $src19, $src20, $src21, 
                $src22, $src23, $src24, $src25] = $_SESSION["PegSolitaire"]->get_image();} 
                else {
                    [$src1, $src2, $src3, $src4, $src5, $src6, $src7, $src8, $src9, $src10, 
                $src11, $src12, $src13, $src14, $src15, $src16, $src17, $src18, $src19, $src20, $src21, 
                $src22, $src23, $src24, $src25] = $_SESSION["PegSolitaire"]->get_image();
                    if ($_SESSION['PegSolitaire']->ball_remain==1){
                        echo "you won in " . $_SESSION['PegSolitaire']->num_moves;
                    }
                    else{
                        echo "Game Over, you made " . $_SESSION['PegSolitaire']->num_moves . " moves";
                    }
                
                    
            ?>
                <form action="index.php" method="post">
                    <input type="submit" name="startagain" value="Restart">
                </form>

                <?php
                }
                ?>
                
            
        <form action="index.php" method="post">
            <table>
                <tr>
                    <td><button type="submit" id="ball0" name="ball" value="0"> <img src="<?php echo $src1;?>"></td>
                    <td><button type="submit" id="ball1" name="ball" value="1"> <img src="<?php echo $src2;?>"></td>
                    <td><button type="submit" id="ball2" name="ball" value="2"> <img src="<?php echo $src3;?>"></td>
                    <td><button type="submit" id="ball3" name="ball" value="3"> <img src="<?php echo $src4;?>"></td>
                    <td><button type="submit" id="ball4" name="ball" value="4"> <img src="<?php echo $src5;?>"></td>
                </tr> 
                <tr>   
                    <td><button type="submit" id="ball5" name="ball" value="5"> <img src="<?php echo $src6;?>"></td>
                    <td><button type="submit" id="ball6" name="ball" value="6"> <img src="<?php echo $src7;?>"></td>
                    <td><button type="submit" id="ball7" name="ball" value="7"> <img src="<?php echo $src8;?>"></td>
                    <td><button type="submit" id="ball8" name="ball" value="8"> <img src="<?php echo $src9;?>"></td>
                    <td><button type="submit" id="ball9" name="ball" value="9"> <img src="<?php echo $src10;?>"></td>
                </tr>
                <tr>
                    <td><button type="submit" id="ball10" name="ball" value="10"> <img src="<?php echo $src11;?>"></td>
                    <td><button type="submit" id="ball11" name="ball" value="11"> <img src="<?php echo $src12;?>"></td>
                    <td><button type="submit" id="ball12" name="ball" value="12"> <img src="<?php echo $src13;?>"></td>
                    <td><button type="submit" id="ball13" name="ball" value="13"> <img src="<?php echo $src14;?>"></td>
                    <td><button type="submit" id="ball14" name="ball" value="14"> <img src="<?php echo $src15;?>"></td>
                </tr>
                <tr>
                    <td><button type="submit" id="ball15" name="ball" value="15"> <img src="<?php echo $src16;?>"></td>
                    <td><button type="submit" id="ball16" name="ball" value="16"> <img src="<?php echo $src17;?>"></td>
                    <td><button type="submit" id="ball17" name="ball" value="17"> <img src="<?php echo $src18;?>"></td>
                    <td><button type="submit" id="ball18" name="ball" value="18"> <img src="<?php echo $src19;?>"></td>
                    <td><button type="submit" id="ball19" name="ball" value="19"> <img src="<?php echo $src20;?>"></td>
                </tr>
                <tr>
                    <td><button type="submit" id="ball20" name="ball" value="20"> <img src="<?php echo $src21;?>"></td>
                    <td><button type="submit" id="ball21" name="ball" value="21"> <img src="<?php echo $src22;?>"></td>
                    <td><button type="submit" id="ball22" name="ball" value="22"> <img src="<?php echo $src23;?>"></td>
                    <td><button type="submit" id="ball23" name="ball" value="23"> <img src="<?php echo $src24;?>"></td>
                    <td><button type="submit" id="ball24" name="ball" value="24"> <img src="<?php echo $src25;?>"></td>
                </tr>
            </table>
        </form>
        </body>
</html>