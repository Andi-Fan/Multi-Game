<?php
/*
made by Andi Fan
*/
class PegSolitaire {
    public $board = array(array(0,1,1,1,1), array(1,1,1,1,1), array(1,1,1,1,1), array(1,1,1,1,1), array(1,1,1,1,1));
    public $pic_arr = array(array(), array(), array(), array(), array());
    public $displaypic= array();
    public $history = array();
    public $num_moves=0;
    public $ball1_arr= array();
    public $ball2_arr= array();
    public $ball_remain=0;
  
    

	public function __construct() {
        	$this->new_board();
    }

    public function new_board(){
        $this->board=array(array(0,1,1,1,1), array(1,1,1,1,1), array(1,1,1,1,1), array(1,1,1,1,1), array(1,1,1,1,1));
        $this->pic_arr=array(array("images/undefined.png", "images/red.png", "images/red.png", "images/red.png","images/red.png"), 
        array("images/red.png", "images/red.png", "images/red.png", "images/red.png", "images/red.png"), 
        array("images/red.png","images/red.png","images/red.png", "images/red.png", "images/red.png"),
        array("images/red.png","images/red.png","images/red.png", "images/red.png", "images/red.png"),
        array("images/red.png","images/red.png","images/red.png", "images/red.png", "images/red.png"));
    }


    public function find_index_ball($ball){
        $row=intdiv($ball, 5);
        $column=$ball%5;
        return [$row, $column];
    }

    public function move($ball1, $ball2){
        $ball1_arr= $this->find_index_ball($ball1);
        $ball2_arr= $this->find_index_ball($ball2);
        if ($this->valid_move($ball1_arr, $ball2_arr)){
            $middle = array();
            $middle[]=abs(($ball1_arr[0]+$ball2_arr[0])/2);
            $middle[]=abs(($ball1_arr[1]+$ball2_arr[1])/2);

            $this->board[$ball2_arr[0]][$ball2_arr[1]]=$this->board[$ball1_arr[0]][$ball1_arr[1]];
            $this->board[$ball1_arr[0]][$ball1_arr[1]] = 0;
            $this->board[$middle[0]][$middle[1]] = 0;

            $this->pic_arr[$ball2_arr[0]][$ball2_arr[1]]="images/red.png";
            $this->pic_arr[$ball1_arr[0]][$ball1_arr[1]] = "images/undefined.png";
            $this->pic_arr[$middle[0]][$middle[1]] = "images/undefined.png";
            
            
            //$this->copy_image();

            $this->num_moves++;
        }
    }

    public function valid_move($ball1, $ball2){
        $middle = array();
        $middle[]=abs(($ball1[0]+$ball2[0])/2);
        $middle[]=abs(($ball1[1]+$ball2[1])/2);

        if (!$this->is_empty($ball2[0], $ball2[1])){
            return false;
        }
        else {
            if ($ball1[0]==$ball2[0]){
                if ($ball1[1]+2==$ball2[1] && $this->board[$middle[0]][$middle[1]]==1){
                    return true;
                }
                else if ($ball1[1]-2==$ball2[1] && $this->board[$middle[0]][$middle[1]]==1){
                    return true;
                }
            }

            else if ($ball1[1]==$ball2[1]){
                if ($ball1[0]+2==$ball2[0] && $this->board[$middle[0]][$middle[1]]==1){
                    return true;
                }
                else if ($ball1[0]-2==$ball2[0] && $this->board[$middle[0]][$middle[1]]==1){
                    return true;
                }
            }
            return false;
        }
    }

    public function copy_image(){
        $this->displaypic=array();
        for ($i=0; $i < 5; $i++){
            for($j=0; $j<5; $j++){
                $this->displaypic[]=$this->pic_arr[$i][$j];
            }
        }
    }

    public function is_empty($row, $height){
        if ($this->board[$row][$height]==0){
            return true;
        }
        return false;
    }

    public function get_image(){
        $this->copy_image();
        return $this->displaypic;
    }

    public function no_moves(){
        for ($h=0; $h<5; $h++){
            for ($w=0; $w<5; $w++){
                //if button present to jump over
                if ($this->board[$h][$w]==1){
                    if ($h > 0 && $h<4){
                        if ($this->board[$h-1][$w]==1 && $this->board[$h+1][$w]==0) {
                            return false;
                        }
                        if ($this->board[$h+1][$w]==1 && $this->board[$h-1][$w]==0) {
                            return false;
                        }
                    }
                    if ($w > 0 && $w < 4){
                        if ($this->board[$h][$w-1]==1 && $this->board[$h][$w+1]==0){
                            return false;
                        }
                        if ($this->board[$h][$w+1]==1 && $this->board[$h][$w-1]==0){
                            return false;
                        }
                    }
                }
            }
        }
        return true;
    }

    public function count_balls(){
        for ($h=0; $h<5; $h++){
            for ($w=0; $w<5; $w++){
                if ($this->board[$h][$w]==1){
                    $this->ball_remain++;
                }
            }
        }        
    }


}
?>