<?php
	ini_set('display_errors', 'On');
	require_once "lib/lib.php";
	require_once "model/something.php";
	require_once "model/PuzzleGame.php";
	require_once "model/MasterGame.php";
	require_once "model/GuessGame.php";
	require_once "model/PegSolitaire.php";


	session_save_path("sess");
	session_start(); 

	$dbconn = db_connect();

	$errors=array();
	$view="";
	
	
	/* QUESTIONS: 
	
	*/
	


	/* controller code */
	/* local actions, these are state transforms */
	if(!isset($_SESSION['state'])){
		$_SESSION['state']='login';
	}
	
	

	switch($_SESSION['state']){
		case "unavailable":
			$view="unavailable.php";
			
			//checks if the button in nav bar has been clicked
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				if (isset($_POST['menubtn'])) {
					$_SESSION['state']='unavailable';
					$view="unavailable.php";
					break;
				}
				if (isset($_POST['profilebtn'])) {
					$_SESSION['state']='profile';
					$view="profile.php";
					break;
				}
				if (isset($_POST['statsbtn'])) {
					//code to pull game information from database
					$query="SELECT userid, guessgame, puzzle, pegsolitaire, mastermind from gamestats where userid=$1";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user']));
					if ($fetch_row = pg_fetch_array($result, NULL, PGSQL_NUM)){
				
						$_SESSION['statguess']=$fetch_row[1];
						$_SESSION['statpuzzle']=$fetch_row[2];
						$_SESSION['statpeg']=$fetch_row[3];
						$_SESSION['statmaster']=$fetch_row[4];

					}	
					$_SESSION['state']='gamestats';
					$view="gamestats.php";
					break;
				}
				if (isset($_POST['ggbtn'])) {
					$_SESSION['state']='guessGame';
					$view="guessPlay.php";
					break;
				}
				if (isset($_POST['15puzzlebtn'])) {
					$_SESSION['state']='puzzlePlay';
					$view="PuzzlePlay.php";
					break;
				}
				if (isset($_POST['pegbtn'])) {
					$_SESSION['state']='PegSolitaire';
					$view="pegplay.php";
					break;
				}
				if (isset($_POST['mastermindbtn'])) {
					$_SESSION['state']='masterPlay';
					$view="MasterPlay.php";
					break;
				}
				if (isset($_POST['logoutbtn'])) {
					session_destroy();
					$_SESSION['state']='login';
					$view="login.php";
					break;
				}
			}	
			
		break;

		case "PegSolitaire":
			$view="pegplay.php";

			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				if (isset($_POST['logoutbtn'])) {
					session_destroy();
					$_SESSION['state']='login';
					$view="login.php";
					break;
				}
				if (isset($_POST['statsbtn'])) {
					//code to pull game information from database
					$query="SELECT userid, guessgame, puzzle, pegsolitaire, mastermind from gamestats where userid=$1";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user']));
					if ($fetch_row = pg_fetch_array($result, NULL, PGSQL_NUM)){
				
						$_SESSION['statguess']=$fetch_row[1];
						$_SESSION['statpuzzle']=$fetch_row[2];
						$_SESSION['statpeg']=$fetch_row[3];
						$_SESSION['statmaster']=$fetch_row[4];

					}	
					$_SESSION['state']='gamestats';
					$view="gamestats.php";
					break;
				}

				if (isset($_POST['menubtn'])) {
					$_SESSION['state']='unavailable';
					$view="unavailable.php";
					break;
				}

				if (isset($_POST['15puzzlebtn'])) {
					$_SESSION['state']='puzzlePlay';
					$view="PuzzlePlay.php";
					break;
				}
				if (isset($_POST['profilebtn'])) {
					$_SESSION['state']='profile';
					$view="profile.php";
					break;
				}
				if (isset($_POST['mastermindbtn'])) {
					$_SESSION['state']='masterPlay';
					$view="MasterPlay.php";
					break;
				}
				if (isset($_POST['ggbtn'])) {
					$_SESSION['state']='guessGame';
					$view="guessPlay.php";
					break;
				}
				if (isset($_POST['startagain'])) {
					$_SESSION['PegSolitaire']=new PegSolitaire();
					$_SESSION['state']='PegSolitaire';
					$view="pegplay.php";
					break;
				}
			}
			
			if (!isset($_SESSION['choice_arr'])){
				$_SESSION['choice_arr']= array();
			}
			
			//user selects a ball and the position they want to move it to
			if (count($_SESSION['choice_arr'])<2){
				$_SESSION['choice_arr'][]=$_POST['ball'];
			}
			if (count($_SESSION['choice_arr'])==2){
				if ($_SESSION['PegSolitaire']->move($_SESSION['choice_arr'][0], $_SESSION['choice_arr'][1])){
					echo "Move Made";
				}
				$_SESSION['choice_arr']=array();	
			}
			if ($_SESSION['PegSolitaire']->no_moves()){
				$fetch_row = array();
				$query="SELECT userid from gamestats where userid=$1";
				$result = pg_prepare($dbconn, "", $query);
				$result = pg_execute($dbconn, "", array($_SESSION['user']));

				if ($fetch_row = pg_fetch_array($result, NULL, PGSQL_NUM)){
					$query="UPDATE gamestats set pegsolitaire=array_append(pegsolitaire, $2) where userid=$1";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user'], $_SESSION['PegSolitaire']->num_moves));
				}
			
				else {
					$query = "INSERT into gamestats(userid, pegsolitaire) values($1, ARRAY [$2])";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user'], $_SESSION['PegSolitaire']->num_moves));
				}
			}
			break;

		case "guessGame":
			$view="guessPlay.php";

			//checks if the button in nav bar has been clicked
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				if (isset($_POST['menubtn'])) {
					$_SESSION['state']='unavailable';
					$view="unavailable.php";
					break;
				}
				if (isset($_POST['profilebtn'])) {
					$_SESSION['state']='profile';
					$view="profile.php";
					break;
				}
				if (isset($_POST['statsbtn'])) {
					//code to pull game information from database
					$query="SELECT userid, guessgame, puzzle, pegsolitaire, mastermind from gamestats where userid=$1";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user']));
					if ($fetch_row = pg_fetch_array($result, NULL, PGSQL_NUM)){
				
						$_SESSION['statguess']=$fetch_row[1];
						$_SESSION['statpuzzle']=$fetch_row[2];
						$_SESSION['statpeg']=$fetch_row[3];
						$_SESSION['statmaster']=$fetch_row[4];

					}	
					$_SESSION['state']='gamestats';
					$view="gamestats.php";
					break;
				}
				if (isset($_POST['ggbtn'])) {
					$_SESSION['state']='guessGame';
					$view="guessPlay.php";
					break;
				}
				if (isset($_POST['15puzzlebtn'])) {
					$_SESSION['state']='puzzlePlay';
					$view="PuzzlePlay.php";
					break;
				}
				if (isset($_POST['pegbtn'])) {
					$_SESSION['state']='PegSolitaire';
					$view="pegplay.php";
					break;
				}
				if (isset($_POST['mastermindbtn'])) {
					$_SESSION['state']='masterPlay';
					$view="MasterPlay.php";
					break;
				}
				if (isset($_POST['logoutbtn'])) {
					session_destroy();
					$_SESSION['state']='login';
					$view="login.php";
					break;
				}
				if (isset($_POST['restartbtn'])) {
					$_SESSION['GuessGame']=new GuessGame();
					$_SESSION['state']='guessGame';
					$view="guessPlay.php";
					break;
				}
			}

			if (empty($_POST['submitguess'])){
				$errors[]="Please enter a guess";
				break;
			}
			
			if(!is_numeric($_REQUEST["guess"]))$errors[]="Guess must be numeric.";
			if(!empty($errors))break;

			$_SESSION["GuessGame"]->makeGuess($_REQUEST['guess']);
			if($_SESSION["GuessGame"]->getState()=="correct"){
				$num_guess=$_SESSION['GuessGame']->numGuesses;

				//check if the user already has an entry in gamestats table for this game
				$fetch_row = array();
				$query="SELECT userid from gamestats where userid=$1";
				$result = pg_prepare($dbconn, "", $query);
				$result = pg_execute($dbconn, "", array($_SESSION['user']));

				if ($fetch_row = pg_fetch_array($result, NULL, PGSQL_NUM)){
					$query="UPDATE gamestats set guessgame=array_append(guessgame, $2) where userid=$1";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user'], $num_guess));
				}
				
				else {
					$query = "INSERT into gamestats(userid, guessgame) values($1, ARRAY [$2])";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user'], $num_guess));
				}
			}

			$_REQUEST['guess']="";
			
			break;


		case "profile":
			$view="profile.php";

			//checks if the button in nav bar has been clicked
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				if (isset($_POST['menubtn'])) {
					$_SESSION['state']='unavailable';
					$view="unavailable.php";
					break;
				}
				if (isset($_POST['profilebtn'])) {
					$_SESSION['state']='profile';
					$view="profile.php";
					break;
				}
				if (isset($_POST['statsbtn'])) {
					//code to pull game information from database
					$query="SELECT userid, guessgame, puzzle, pegsolitaire, mastermind from gamestats where userid=$1";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user']));
					if ($fetch_row = pg_fetch_array($result, NULL, PGSQL_NUM)){
				
						$_SESSION['statguess']=$fetch_row[1];
						$_SESSION['statpuzzle']=$fetch_row[2];
						$_SESSION['statpeg']=$fetch_row[3];
						$_SESSION['statmaster']=$fetch_row[4];

					}	
					$_SESSION['state']='gamestats';
					$view="gamestats.php";
					break;
				}
				if (isset($_POST['ggbtn'])) {
					$_SESSION['state']='guessGame';
					$view="guessPlay.php";
					break;
				}
				if (isset($_POST['15puzzlebtn'])) {
					$_SESSION['state']='puzzlePlay';
					$view="PuzzlePlay.php";
					break;
				}
				if (isset($_POST['pegbtn'])) {
					$_SESSION['state']='PegSolitaire';
					$view="pegplay.php";
					break;
				}
				if (isset($_POST['mastermindbtn'])) {
					$_SESSION['state']='masterPlay';
					$view="MasterPlay.php";
					break;
				}
				if (isset($_POST['logoutbtn'])) {
					session_destroy();
					$_SESSION['state']='login';
					$view="login.php";
					break;
				}
			}

			//code to escape ini_set errors since some values are unset
			if (!isset($_REQUEST['prof_check_student'])){
				$_REQUEST['prof_check_student']=NULL;
			}
			if (!isset($_REQUEST['prof_check_fulltime'])){
				$_REQUEST['prof_check_fulltime']=NULL;
			}
			if (!isset($_REQUEST['prof_check_parttime'])){
				$_REQUEST['prof_check_parttime']=NULL;
			}
			if (!isset($_REQUEST['prof_check_unemp'])){
				$_REQUEST['prof_check_unemp']=NULL;
			}
			if (!isset($_REQUEST['prof_gender'])){
				$_REQUEST['prof_gender']=NULL;
			}

			if (!empty($_REQUEST['prof_username']) && !empty($_REQUEST['prof_password']) && !empty($_REQUEST['prof_email'])){
				//preparing postgres query to update values
				$user=$_SESSION['user'];
				$query = "UPDATE appuser SET userid=$1, password=$2, gender=$3, color=$4, student=$5, fulltime=$6, parttime=$7, unemployed=$8,
				email=$9, phone=$10 WHERE userid=$1";	
				
				$result = pg_prepare($dbconn, "", $query);
				$result = pg_execute($dbconn, "", array($_REQUEST['prof_username'], $_REQUEST['prof_password'], 
				$_REQUEST['prof_gender'], $_REQUEST['prof_Favorite_color'], $_REQUEST['prof_check_student'], $_REQUEST['prof_check_fulltime'], 
				$_REQUEST['prof_check_parttime'], $_REQUEST['prof_check_unemp'], $_REQUEST['prof_email'], $_REQUEST['prof_phone']));
	
				$_SESSION['state']='unavailable';
				$view="unavailable.php";
			}
			break;

		case "gamestats":
			//code to pull game information from database
			$query="SELECT userid, guessgame, puzzle, pegsolitaire, mastermind from gamestats where userid=$1";
			$result = pg_prepare($dbconn, "", $query);
			$result = pg_execute($dbconn, "", array($_SESSION['user']));
			if ($fetch_row = pg_fetch_array($result, NULL, PGSQL_NUM)){
				
				$_SESSION['statguess']=$fetch_row[1];
				$_SESSION['statpuzzle']=$fetch_row[2];
				$_SESSION['statpeg']=$fetch_row[3];
				$_SESSION['statmaster']=$fetch_row[4];
				
			}	

			$view="gamestats.php";
			

			//checks if the button in nav bar has been clicked
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				if (isset($_POST['menubtn'])) {
					$_SESSION['state']='unavailable';
					$view="unavailable.php";
					break;
				}
				if (isset($_POST['profilebtn'])) {
					$_SESSION['state']='profile';
					$view="profile.php";
					break;
				}
				/*if (isset($_POST['statsbtn'])) {
					$_SESSION['state']='gamestats';
					$view="gamestats.php";
					break;
				}*/
				if (isset($_POST['ggbtn'])) {
					$_SESSION['state']='guessGame';
					$view="guessPlay.php";
					break;
				}
				if (isset($_POST['15puzzlebtn'])) {
					$_SESSION['state']='puzzlePlay';
					$view="PuzzlePlay.php";
					break;
				}
				if (isset($_POST['pegbtn'])) {
					$_SESSION['state']='PegSolitaire';
					$view="pegplay.php";
					break;
				}
				if (isset($_POST['mastermindbtn'])) {
					$_SESSION['state']='masterPlay';
					$view="MasterPlay.php";
					break;
				}
				if (isset($_POST['logoutbtn'])) {
					session_destroy();
					$_SESSION['state']='login';
					$view="login.php";
					break;
				}
			
			}
			break;

		case "register":
			$view="register.php";

			//button to go back to login
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				if (isset($_POST['loginbtn'])) {
					$_SESSION['state']='login';
					$view="login.php";
					break;
				}
			}
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}

			//backend validation 
			if (empty($_REQUEST['reg_username'])){
				$errors[]="Username Required";
			}
			if (empty($_REQUEST['reg_password'])){
				$errors[]="Password Required";
			}
			if (empty($_REQUEST['email'])){
				$errors[]="Email Required";
			} 

			//sets undeclared fields in the form to null to avoid errors from ini_set, may remove later
			if (!isset($_REQUEST['check_student'])){
				$_REQUEST['check_student']="False";
			}
			if (!isset($_REQUEST['check_fulltime'])){
				$_REQUEST['check_fulltime']="False";
			}
			if (!isset($_REQUEST['check_parttime'])){
				$_REQUEST['check_parttime']="False";
			}
			if (!isset($_REQUEST['check_unemp'])){
				$_REQUEST['check_unemp']="False";
			}
			if (!isset($_REQUEST['gender'])){
				$_REQUEST['gender']=NULL;
			}
			
			//only add to database if required areas are filled (ask arnold if need to sanitize values)
			if (!empty($_REQUEST['reg_username']) && !empty($_REQUEST['reg_password']) && !empty($_REQUEST['email'])){
				//preparing postgres query to insert new user id and pass into the appuser table
				$query = "INSERT INTO appuser(userid, password, gender, color, student, fulltime, parttime, unemployed, email, phone) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)";
				$result = pg_prepare($dbconn, "", $query);

				$result = pg_execute($dbconn, "", array($_REQUEST['reg_username'], $_REQUEST['reg_password'], 
				$_REQUEST['gender'], $_REQUEST['Favorite_color'], $_REQUEST['check_student'], $_REQUEST['check_fulltime'], 
				$_REQUEST['check_parttime'], $_REQUEST['check_unemp'], $_REQUEST['email'], $_REQUEST['phone']));


				
				$_SESSION['state']='login';
				$view="login.php";
			}
			
			break;
		
		case "login":
			// the view we display by default
			$view="login.php";
			

			//checks to see if register button has been clicked, changes the state to register
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				if (isset($_POST['registerbtn'])) {
					$_SESSION['state']='register';
					$view="register.php";
					break;
				}
			}	
			// check if submit or not
			if(empty($_REQUEST['submit']) || $_REQUEST['submit']!="login"){
				break;
			}

			// validate and set errors
			if(empty($_REQUEST['user']))$errors[]='user is required';
			if(empty($_REQUEST['password']))$errors[]='password is required';
			if(!empty($errors))break;

			// perform operation, switching state and view if necessary
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			$query = "SELECT * FROM appuser WHERE userid=$1 and password=$2;";
            $result = pg_prepare($dbconn, "", $query);

            $result = pg_execute($dbconn, "", array($_REQUEST['user'], $_REQUEST['password']));
            if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
				$_SESSION['user']=$_REQUEST['user'];
				$_SESSION['password']=$_REQUEST['password'];

				if (!isset($_SESSION['GuessGame'])){
					$_SESSION['GuessGame']=new GuessGame();
				}
				if (!isset($_SESSION['PegSolitaire'])){
					$_SESSION['PegSolitaire']=new PegSolitaire();
				}

				if (!isset($_SESSION['PuzzleGame'])){
					$_SESSION['PuzzleGame']= new PuzzleGame();
				}

				if (!isset($_SESSION['MasterGame'])){
					$_SESSION['MasterGame']= new MasterGame();
				}
				



				//attempting to retrieve user information and store it in an array fetch_row
				$query="SELECT gender, color, student, fulltime, parttime, unemployed, email, phone FROM appuser where userid=$1";
				$result= pg_prepare($dbconn, "", $query);
				$result= pg_execute($dbconn, "", array($_SESSION['user']));
				$fetch_row= pg_fetch_array($result, NULL, PGSQL_NUM);

				//storing user information in session varaibles for the user who just logged in, later used to prefill profile
				//maybe make a user class in model and instantiate it after use log's in, if have time do this instead of storing
				//in session variables
				$_SESSION['gender']=$fetch_row[0];
				$_SESSION['color']=$fetch_row[1];
				$_SESSION['check_student']=$fetch_row[2];
				$_SESSION['check_fulltime']=$fetch_row[3];
				$_SESSION['check_parttime']=$fetch_row[4];
				$_SESSION['check_unemp']=$fetch_row[5];
				$_SESSION['email']=$fetch_row[6];
				$_SESSION['phone']=$fetch_row[7];

				//code to pull game information from database
				$query="SELECT userid, guessgame, puzzle, pegsolitaire, mastermind from gamestats where userid=$1";
				$result = pg_prepare($dbconn, "", $query);
				$result = pg_execute($dbconn, "", array($_SESSION['user']));
				if ($fetch_row = pg_fetch_array($result, NULL, PGSQL_NUM)){
					
					$_SESSION['statguess']=$fetch_row[1];
					$_SESSION['statpuzzle']=$fetch_row[2];
					$_SESSION['statpeg']=$fetch_row[3];
					$_SESSION['statmaster']=$fetch_row[4];
				}	

				$_SESSION['state']='unavailable';
				$view="unavailable.php";
			} else {
				$errors[]="invalid login";
			}

			break;

		case "puzzlePlay":
			// the view we display by default
			$view="PuzzlePlay.php";


			//checks if the button in nav bar has been clicked
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				if (isset($_POST['menubtn'])) {
					$_SESSION['state']='unavailable';
					$view="unavailable.php";
					break;
				}
				if (isset($_POST['profilebtn'])) {
					$_SESSION['state']='profile';
					$view="profile.php";
					break;
				}
				if (isset($_POST['statsbtn'])) {
					//code to pull game information from database
					$query="SELECT userid, guessgame, puzzle, pegsolitaire, mastermind from gamestats where userid=$1";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user']));
					if ($fetch_row = pg_fetch_array($result, NULL, PGSQL_NUM)){
				
						$_SESSION['statguess']=$fetch_row[1];
						$_SESSION['statpuzzle']=$fetch_row[2];
						$_SESSION['statpeg']=$fetch_row[3];
						$_SESSION['statmaster']=$fetch_row[4];

					}	
					$_SESSION['state']='gamestats';
					$view="gamestats.php";
					break;
				}
				if (isset($_POST['ggbtn'])) {
					$_SESSION['state']='guessGame';
					$view="guessPlay.php";
					break;
				}
				if (isset($_POST['15puzzlebtn'])) {
					$_SESSION['state']='puzzlePlay';
					$view="PuzzlePlay.php";
					break;
				}
				if (isset($_POST['pegbtn'])) {
					$_SESSION['state']='PegSolitaire';
					$view="pegplay.php";
					break;
				}
				if (isset($_POST['mastermindbtn'])) {
					$_SESSION['state']='masterPlay';
					$view="MasterPlay.php";
					break;
				}
				if (isset($_POST['logoutbtn'])) {
					session_destroy();
					$_SESSION['state']='login';
					$view="login.php";
					break;
				}
			}


			// check if submit or not
			//if(empty($_REQUEST['square'])||$_REQUEST['square']!="move"){
			//	break;
			//}
			if(empty($_REQUEST['square'])){
				break;
			}

			// validate and set errors
			if(!empty($errors))break;

			// perform operation, switching state and view if necessary
			$_SESSION["PuzzleGame"]->makeMove($_REQUEST['square']);
			if($_SESSION["PuzzleGame"]->getState()=="menu"){
				$_SESSION['state']="unavailable";
				$view="unavailable.php";
			}

			if($_SESSION["PuzzleGame"]->getState()=="win"){
				$num_move=$_SESSION['PuzzleGame']->numMove;

				//check if the user already has an entry in gamestats table for this game
				$fetch_row = array();
				$query="SELECT userid from gamestats where userid=$1";
				$result = pg_prepare($dbconn, "", $query);
				$result = pg_execute($dbconn, "", array($_SESSION['user']));

				if ($fetch_row = pg_fetch_array($result, NULL, PGSQL_NUM)){
					$query="UPDATE gamestats set puzzle=array_append(puzzle, $2) where userid=$1";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user'], $num_move));
				}
				
				else {
					$query = "INSERT into gamestats(userid, puzzle) values($1, ARRAY [$2])";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user'], $num_move));
				}
			}

			$_REQUEST['square']="";

			break;

		case "masterPlay":
			// the view we display by default
			$view="MasterPlay.php";

			// check if submit or not
			//if(empty($_REQUEST['square'])||$_REQUEST['square']!="move"){
			//	break;
			//}

			//checks if the button in nav bar has been clicked
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				if (isset($_POST['menubtn'])) {
					$_SESSION['state']='unavailable';
					$view="unavailable.php";
					break;
				}
				if (isset($_POST['profilebtn'])) {
					$_SESSION['state']='profile';
					$view="profile.php";
					break;
				}
				if (isset($_POST['statsbtn'])) {
					//code to pull game information from database
					$query="SELECT userid, guessgame, puzzle, pegsolitaire, mastermind from gamestats where userid=$1";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user']));
					if ($fetch_row = pg_fetch_array($result, NULL, PGSQL_NUM)){
				
						$_SESSION['statguess']=$fetch_row[1];
						$_SESSION['statpuzzle']=$fetch_row[2];
						$_SESSION['statpeg']=$fetch_row[3];
						$_SESSION['statmaster']=$fetch_row[4];

					}	
					$_SESSION['state']='gamestats';
					$view="gamestats.php";
					break;
				}
				if (isset($_POST['ggbtn'])) {
					$_SESSION['state']='guessGame';
					$view="guessPlay.php";
					break;
				}
				if (isset($_POST['15puzzlebtn'])) {
					$_SESSION['state']='puzzlePlay';
					$view="PuzzlePlay.php";
					break;
				}
				if (isset($_POST['pegbtn'])) {
					$_SESSION['state']='PegSolitaire';
					$view="pegplay.php";
					break;
				}
				if (isset($_POST['mastermindbtn'])) {
					$_SESSION['state']='masterPlay';
					$view="MasterPlay.php";
					break;
				}
				if (isset($_POST['logoutbtn'])) {
					session_destroy();
					$_SESSION['state']='login';
					$view="login.php";
					break;
				}
			}

			if(empty($_REQUEST['ball'])){
				break;
			}

			// validate and set errors
			if(!empty($errors))break;

			// perform operation, switching state and view if necessary
			$_SESSION["MasterGame"]->makeChoice($_REQUEST['ball']);
			if($_SESSION["MasterGame"]->getState()=="menu"){
				$_SESSION['state']="unavailable";
				$view="unavailable.php";
			}

			if($_SESSION["MasterGame"]->getState()=="win" || $_SESSION["MasterGame"]->getState()=="lose"){
				$num_tries=$_SESSION['MasterGame']->numTries;

				//check if the user already has an entry in gamestats table for this game
				$fetch_row = array();
				$query="SELECT userid from gamestats where userid=$1";
				$result = pg_prepare($dbconn, "", $query);
				$result = pg_execute($dbconn, "", array($_SESSION['user']));

				if ($fetch_row = pg_fetch_array($result, NULL, PGSQL_NUM)){
					$query="UPDATE gamestats set mastermind=array_append(mastermind, $2) where userid=$1";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user'], $num_tries));
				}
				
				else {
					$query = "INSERT into gamestats(userid, mastermind) values($1, ARRAY [$2])";
					$result = pg_prepare($dbconn, "", $query);
					$result = pg_execute($dbconn, "", array($_SESSION['user'], $num_tries));
				}
			}

			$_REQUEST['ball']="";

			break;
	}
	require_once "view/$view";
?>
