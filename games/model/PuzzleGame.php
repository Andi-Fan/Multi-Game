<?php
/*
Made by Yuhao Jiang
*/
class PuzzleGame {
	public $board = array();
	public $numMove = 0;
	public $state = "start";
	public $picture = array();
	public $history = array();
	//public $test = "untest";


	public function __construct() {
		$this->restoration_board();
		//$this->state = "running"; 

    }
	
	public function makeMove($square){
		$this->state = "gaming";

		if ($square == "shuffle"){
			$this->shuffle_both();
			//$this->test = "shuffleshuffleshuffleshuffleshuffle";

		} else if ($square == "restoration"){
			$this->restoration_board();
			//$this->test = "restorationrestorationrestorationrestoration";

		} else if ($square == "restart"){
			$this->restoration_board();
			//$this->test = "restartrestartrestartrestartrestart";
		} else if ($square == "menu"){
			$this->restoration_board();
			$this->state = "menu";

		} else if ($this->isEmpty(intval($square))) {

			$j = array_search(15, $this->board);

			[$this->picture[$square], $this->picture[$j]] = [$this->picture[$j], $this->picture[$square]];
			[$this->board[$square], $this->board[$j]] = [$this->board[$j], $this->board[$square]];

			$this->numMove++;

			if($this->board == array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15)){
				$this->state = "win";
				$this->history[]="$this->numMove";
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
		$this->board = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
		$this->picture = array("images/1.png", "images/2.png", "images/3.png", "images/4.png",
							"images/5.png", "images/6.png", "images/7.png", "images/8.png",
							"images/9.png", "images/10.png", "images/11.png", "images/12.png",
							"images/13.png", "images/14.png", "images/15.png", "images/empty.png");
		/*
		$this->picture = array("http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/01.jpg", 
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/02.jpg", 
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/03.jpg", 
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/04.jpg",
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/05.jpg", 
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/06.jpg",
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/07.jpg", 
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/08.jpg",
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/09.jpg", 
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/10.jpg",
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/11.jpg", 
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/12.jpg",
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/13.jpg", 
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/14.jpg",
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/15.jpg", 
							"http://www.cs.toronto.edu/~arnold/309/20s/lectures/javascript/15puzzle/empty.jpg");
		*/

		$this->numMove = 0;
		$this->state = "gaming";
	}

	public function getState(){
		return $this->state;
	}

	public function getPicture(){
		return $this->picture;
	}

	public function getNumMove(){
		return $this->numMove;
	}

	//public function getTest(){
	//	echo $this->test;
	//}

	public function isEmpty($i){
		if ($i==0){
			if ($this->board[$i+1] == 15 || $this->board[$i+4] == 15){
				return true;
			} else{
				return false;
			}
		} else if ($i==3){
			if ($this->board[$i-1] == 15 || $this->board[$i+4] == 15){
				return true;
			} else{
				return false;
			}
		} else if ($i==12){
			if ($this->board[$i+1] == 15 || $this->board[$i-4] == 15){
				return true;
			} else{
				return false;
			}
		} else if ($i==15){
			if ($this->board[$i-1] == 15 || $this->board[$i-4] == 15){
				return true;
			} else{
				return false;
			}
		} else if ($i==1 || $i==2) {
			if ($this->board[$i-1] == 15 || $this->board[$i+1] == 15 || $this->board[$i+4] == 15){
				return true;
			} else{
				return false;
			}
		} else if ($i==4 || $i==8) {
			if ($this->board[$i+1] == 15 || $this->board[$i-4] == 15 || $this->board[$i+4] == 15){
				return true;
			} else{
				return false;
			}
		} else if ($i==7 || $i==11) {
			if ($this->board[$i-1] == 15 || $this->board[$i-4] == 15 || $this->board[$i+4] == 15){
				return true;
			} else{
				return false;
			}
		} else if ($i==13 || $i==14) {
			if ($this->board[$i-1] == 15 || $this->board[$i+1] == 15 || $this->board[$i-4] == 15){
				return true;
			} else{
				return false;
			}
		} else {
			if ($this->board[$i-1] == 15 || $this->board[$i+1] == 15 || $this->board[$i-4] == 15 || $this->board[$i+4] == 15){
				return true;
			} else{
				return false;
			}
		}
	}

}
?>
