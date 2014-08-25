 <?php
  class tokenize
  {
	public $str= array();
	public $i=0,$j;
	
    public function tokenize($st) 
	{ 
		$this->str=strtok($st,'.#-, ');
		//$this->i=count($this->str);
		//var_dump($this->str);
	}
	public function nextToken()
	{
		if($tok = strtok('.#-, '))
		{
			//var_dump($tok);
			
			return $tok;
		}
		else
		{
			return false;
		}
	}
  }
?>