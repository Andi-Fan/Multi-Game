<?php
/*
Made by Yuhao Jiang, Andi Fan
*/
class MasterGame {
	public $numTries = 0;
	public $board = array();
	public $picture = array();
	public $state = "start";
	public $secretSolution = array();
	public $solutionPicture = array();
	public $history = array();
	public $error = "";
	//public $test = "untest";


	public function __construct() {
		$this->restoration_board();
		//$this->state = "running"; 

    }
	
	public function makeChoice($ball){
		$this->state = "gaming";

		if ($ball == "check"){
			$round = $this->numTries;
			//$current_balls = $this->board[$round];
			if (!in_array(-1, $this->board[$round])){
				$this->numTries ++;
				if(implode(" ", $this->board[$round]) == implode(" ", $this->secretSolution)){
					$this->checkBalls($round);
					$this->state = "win";
					$this->history[] = $this->numTries;

				}else if($this->numTries == 10){
					$this->checkBalls($round);
					$this->state = "lose";
					$this->numTries = -1;
					$this->history[] = $this->numTries;
				}else{
					$this->checkBalls($round);
					[$this->picture[$this->numTries][0], $this->picture[$this->numTries + 1][0]] = [$this->picture[$this->numTries + 1][0], $this->picture[$this->numTries][0]];
				}
			} else {
				$this->state = "error";
				$this->error = "Please fill in the 4 position before check";

			}
			

		} else if ($ball == "delete"){
			$this->board[$this->numTries] = [-1, -1, -1, -1];
			$this->picture[$this->numTries + 1] = ["images/current_try.png", 
												"images/undefined.png", "images/undefined.png","images/undefined.png", "images/undefined.png",
												"images/uncheck.png", "images/uncheck.png","images/uncheck.png", "images/uncheck.png"];
			

		} else if ($ball == "restart"){
			$this->restoration_board();

		} else if ($ball == "menu"){
			$this->restoration_board();
			$this->state = "menu";

		} else {
			$round = $this->numTries;
			$current_balls = $this->board[$round];

			if(in_array(-1 , $current_balls)){
				$fill_in_index = array_search(-1, $current_balls);
				$this->board[$round][$fill_in_index] = $ball;
				if($ball == 1){
					$this->picture[$round + 1][$fill_in_index + 1] = "images/blue.png";
				}else if($ball == 2){
					$this->picture[$round + 1][$fill_in_index + 1] = "images/green.png";
				}else if($ball == 3){
					$this->picture[$round + 1][$fill_in_index + 1] = "images/orange.png";
				}else if($ball == 4){
					$this->picture[$round + 1][$fill_in_index + 1] = "images/purple.png";
				}else if($ball == 5){
					$this->picture[$round + 1][$fill_in_index + 1] = "images/red.png";
				}else{
					$this->picture[$round + 1][$fill_in_index + 1] = "images/yellow.png";
				}
			} else {
				$this->state = "error";
				$this->error = "The 4 position has been filled in. Please check them.";
			}

		} 
	}

	public function shuffle_both(){
		$c = count($this->board);
		$temp = array();
		for ($i=0; $i<$c; $i++) {
  			$temp[$i] = array($this->board[$i], $this->picture[$i]);
		}
		shuffle($temp);
		for ($i=0; $i<$c; $i++) {
  			$this->board[$i] = $temp[$i][0];
  			$this->picture[$i] = $temp[$i][1];
		}
		$this->numMove = 0;
	}

	public function restoration_board(){
		/*
		$this->board = array([1, 2, 3, 4, 5, 6], 
							[-1, -1, -1, -1, -1, -1, -1, -1, -1], 
							[-1, -1, -1, -1, -1, -1, -1, -1, -1],
							[-1, -1, -1, -1, -1, -1, -1, -1, -1],
							[-1, -1, -1, -1, -1, -1, -1, -1, -1],
							[-1, -1, -1, -1, -1, -1, -1, -1, -1],
							[-1, -1, -1, -1, -1, -1, -1, -1, -1],
							[-1, -1, -1, -1, -1, -1, -1, -1, -1],
							[-1, -1, -1, -1, -1, -1, -1, -1, -1],
							[-1, -1, -1, -1, -1, -1, -1, -1, -1],
							[-1, -1, -1, -1, -1, -1, -1, -1, -1],);
		*/
		$this->board = array([-1, -1, -1, -1], 
							[-1, -1, -1, -1],
							[-1, -1, -1, -1],
							[-1, -1, -1, -1],
							[-1, -1, -1, -1],
							[-1, -1, -1, -1],
							[-1, -1, -1, -1],
							[-1, -1, -1, -1],
							[-1, -1, -1, -1],
							[-1, -1, -1, -1]);
		$this->picture = array(["images/blue.png", "images/green.png", "images/orange.png", "images/purple.png", "images/red.png", "images/yellow.png"],
							["images/current_try.png", 
							"images/undefined.png", "images/undefined.png","images/undefined.png", "images/undefined.png",
							"images/uncheck.png", "images/uncheck.png","images/uncheck.png", "images/uncheck.png"], 
							["images/not_current.png", 
							"images/undefined.png", "images/undefined.png","images/undefined.png", "images/undefined.png",
							"images/uncheck.png", "images/uncheck.png","images/uncheck.png", "images/uncheck.png"], 
							["images/not_current.png", 
							"images/undefined.png", "images/undefined.png","images/undefined.png", "images/undefined.png",
							"images/uncheck.png", "images/uncheck.png","images/uncheck.png", "images/uncheck.png"], 
							["images/not_current.png", 
							"images/undefined.png", "images/undefined.png","images/undefined.png", "images/undefined.png",
							"images/uncheck.png", "images/uncheck.png","images/uncheck.png", "images/uncheck.png"], 
							["images/not_current.png", 
							"images/undefined.png", "images/undefined.png","images/undefined.png", "images/undefined.png",
							"images/uncheck.png", "images/uncheck.png","images/uncheck.png", "images/uncheck.png"], 
							["images/not_current.png", 
							"images/undefined.png", "images/undefined.png","images/undefined.png", "images/undefined.png",
							"images/uncheck.png", "images/uncheck.png","images/uncheck.png", "images/uncheck.png"], 
							["images/not_current.png", 
							"images/undefined.png", "images/undefined.png","images/undefined.png", "images/undefined.png",
							"images/uncheck.png", "images/uncheck.png","images/uncheck.png", "images/uncheck.png"], 
							["images/not_current.png", 
							"images/undefined.png", "images/undefined.png","images/undefined.png", "images/undefined.png",
							"images/uncheck.png", "images/uncheck.png","images/uncheck.png", "images/uncheck.png"], 
							["images/not_current.png", 
							"images/undefined.png", "images/undefined.png","images/undefined.png", "images/undefined.png",
							"images/uncheck.png", "images/uncheck.png","images/uncheck.png", "images/uncheck.png"], 
							["images/not_current.png", 
							"images/undefined.png", "images/undefined.png","images/undefined.png", "images/undefined.png",
							"images/uncheck.png", "images/uncheck.png","images/uncheck.png", "images/uncheck.png"]);
		
		$this->secretSolution = array(rand(1,6), rand(1,6), rand(1,6), rand(1,6));
		$this->numTries = 0;
		$this->state = "gaming";
		$this->solutionPicture = array();
		foreach ($this->secretSolution as $k=>$v){
			if($v == 1){
				$this->solutionPicture[] = "images/blue.png";
			}else if($v == 2){
				$this->solutionPicture[] = "images/green.png";
			}else if($v == 3){
				$this->solutionPicture[] = "images/orange.png";
			}else if($v == 4){
				$this->solutionPicture[] = "images/purple.png";
			}else if($v == 5){
				$this->solutionPicture[] = "images/red.png";
			}else{
				$this->solutionPicture[] = "images/yellow.png";
			}
		}
	}

	public function getState(){
		return $this->state;
	}

	public function getError(){
		return $this->error;
	}

	public function getPicture(){
		return $this->picture;
	}

	public function getNumTries(){
		return $this->numTries;
	}

	public function getSecretSolution(){
		return $this->secretSolution;
	}

	public function getSolutionPicture(){
		return $this->solutionPicture;
	}

	//public function getTest(){
	//	echo $this->test;
	//}
	public function checkBalls($round){
		$current = $this->board[$round];
		$solution = $this->secretSolution;
		$correct_num = count(array_intersect_assoc($current, $solution));

		//$exist_num = count(array_intersect($current, $solution)) - $correct_num;
		$c_count=array_count_values($current);
		$s_count=array_count_values($solution);
		foreach ($c_count as $k=>$v){
			if(array_key_exists($k, $s_count)){
				$m = min($c_count[$k], $s_count[$k]);
				[$c_count[$k],$s_count[$k]] = [$c_count[$k] - $m, $s_count[$k] - $m];
			}
		}
		$total_diff_num_sum = array_sum($c_count) + array_sum($s_count);
		$exist_num = (4 - ($total_diff_num_sum / 2)) - $correct_num;

		$i = 5;
		$c = 5+$correct_num;
		$e = $c + $exist_num;
		for ($i = 5; $i < $c; $i++) {
    		$this->picture[$round+1][$i] = "images/correct.png";
		}
		for ($i = $c; $i < $e; $i++) {
    		$this->picture[$round+1][$i] = "images/exist.png";
		}
	}


}
?>
