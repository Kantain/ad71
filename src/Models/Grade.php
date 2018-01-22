<?php

namespace pw\Models;

class Grade
{
	protected $B;
	protected $B_J;
	protected $J;
	protected $J_O;
	protected $O;
	protected $O_V;
	protected $V;
	protected $V_Bl;
	protected $Bl;
	protected $M;
	protected $N_1;
	protected $N_2;
	protected $N_3;
	protected $N_4;
	protected $N_5;
	protected $N_6;
	protected $N_7;
	protected $N_8;
	protected $N_9;
	protected $N_10;

	public function __construct($_B, $_B_J, $_J, $_J_O, $_O, $_O_V, $_V, $_V_Bl, $_M, $_N_1, $_N_2, $_N_3, $_N_4, $_N_5, $_N_6, $_N_7, $_N_8, $_N_9, $_N_10)
	{
		$this->B=$_B;
		$this->B_J=$_B_J;
		$this->J=$_J;
		$this->J_O=$_J_O;
		$this->O=$_O;
		$this->O_V=$_O_V;
		$this->V=$_V;
		$this->V_Bl=$_V_Bl;
		$this->M=$_M;
		$this->N_1=$_N_1;
		$this->N_2=$_N_2;
		$this->N_3=$_N_3;
		$this->N_4=$_N_4;
		$this->N_5=$_N_5;
		$this->N_6=$_N_6;		
		$this->N_7=$_N_7;	
		$this->N_8=$_N_8;	
		$this->N_9=$_N_9;	
		$this->N_10=$_N_10;	
	}
}
?>