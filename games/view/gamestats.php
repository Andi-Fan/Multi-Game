
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
        <h1>Game Stats</h1>
        <h2>Your Stats:</h2>
            

                    <h3>GuessGame Stats:</h3>
                    <?php //echo substr($_SESSION['statguess'], 1, -1);
                        $arr=array();
                        if (!empty($_SESSION['statguess'])){
                            $newstr=substr($_SESSION['statguess'], 1, -1);
                            $arr=explode(",", $newstr);
                        }
                        if (!empty($arr[0])){
                            for ($i=0; $i<count($arr);$i++){
                                echo "play session #". ($i+1) . " took " . $arr[$i] . " guesses";
                                echo "<br>";
                            }
                        }
                        else{
                            echo "No game history yet";
                        }
                        
                    ?>
                    <h3>PegSolitaire Stats:</h3>
                    <?php //echo substr($_SESSION['statguess'], 1, -1);
                        $arr=array();
                        if (!empty($_SESSION['statpeg'])){
                            $newstr=substr($_SESSION['statpeg'], 1, -1);
                            $arr=explode(",", $newstr);
                        }
                        
                        if (!empty($arr[0])){
                            for ($i=0; $i<count($arr);$i++){
                                echo "play session #". ($i+1) . " took " . $arr[$i] . " moves";
                                echo "<br>";
                            }
                        }
                        else{
                            echo "No game history yet";
                        }
                        
                    ?>

                    <h3>15-Puzzle Stats:</h3>
                    <?php //echo substr($_SESSION['statguess'], 1, -1);
                        $arr=array();
                        if (!empty($_SESSION['statpuzzle'])){
                            $newstr=substr($_SESSION['statpuzzle'], 1, -1);
                            $arr=explode(",", $newstr);
                        }
                        if (!empty($arr[0])){
                            for ($i=0; $i<count($arr);$i++){
                                echo "play session #". ($i+1) . " took " . $arr[$i] . " moves";
                                echo "<br>";
                            }
                        }
                        else{
                            echo "No game history yet";
                        }
                        
                    ?>

                    <h3>MasterMind Stats:</h3>
                    <?php //echo substr($_SESSION['statguess'], 1, -1);
                        $arr=array();
                        if (!empty($_SESSION['statmaster'])){
                            $newstr=substr($_SESSION['statmaster'], 1, -1);
                            $arr=explode(",", $newstr);
                        }
                        
                        if (!empty($arr[0])){
                            for ($i=0; $i<count($arr);$i++){
                                if($arr[$i] >= 0){
                                    echo "play session #". ($i+1) . " took " . $arr[$i] . " moves";
                                    echo "<br>";
                                }else{
                                    echo "play session #". ($i+1) . " you losed";
                                    echo "<br>";
                                }
                            }
                        }
                        else{
                            echo "No game history yet";
                        }
                        
                    ?>

            <form action="index.php" method="post">
				<input type="submit" name="menubtn" value="menu"/>
            </form>
		</main>
	</body>
</html> 




