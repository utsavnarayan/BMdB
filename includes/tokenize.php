<?php
	class tokenize
	{
		public $str= array();
		public $i=0,$j;
		public function tokenize($st) 
		{
			$this->str=strtok($st,' ');
			$this->i=0;
		}
		public function nextToken()
		{
			if($this->i==0)
			{
				$this->i=1;
				return $this->str;
			}
			else if($tok = strtok(' '))
			{
				return $tok;
			}
			else
			{
				return false;
			}
		}
	}
	class tokenize_all
	{
		public $str= array();
		public $tok, $iter, $count = 0, $slength, $start, $point;
		public function tokenize_all($st) 
		{
			$tok = strtok($st,' ');
			do{
				array_push($this->str, $tok);
				$this->count++;
			}while($tok = strtok(' '));
			
			$this->slength = $this->count;
			$this->start = 0;
			$this->point = 0;
		}
		public function next_tokenize_all()
		{
			$stop=array("a","able","about","across","after","all","almost","also","am","among","an","and","any","are","as","at","be","because","been","but","by","can","cannot","could","dear","did","do","does","either","else","ever","every","for","from","get","got","had","has","have","he","her","hers","him","his","how","however","i","if","in","into","is","it","its","just","least","let","like","likely","may","me","might","most","must","my","neither","no","nor","not","of","off","often","on","only","or","other","our","own","rather","said","say","says","she","should","since","so","some","than","that","the","their","them","then","there","these","they","this","tis","to","too","twas","us","wants","was","we","were","what","when","where","which","while","who","whom","why","will","with","would","yet","you","your","1","2","3","4","5","6","7","8","9","0");
			$current = '';
			if(($this->point + $this->slength) > $this->count){
				$this->break_tokenize_all();
				return false;
			}
			if($this->slength == 0){
				return "#end";
			}
			while($this->point < ($this->start + $this->slength) && $this->point < $this->count){
				$current = $current." ".$this->str[$this->point];
				$this->point++;
			}
			$this->start++;
			$this->point=$this->start;
			if(!array_search($current, $stop))
				return $current;
			else
				return false;
		}
		public function break_tokenize_all()
		{
			$this->slength = $this->slength - 1;
			$this->start = 0;
			$this->point = $this->start;
		}
		public function delete_tokenize_all()
		{
			array_splice($this->str,($this->point-1),$this->slength);
			$this->start--;
			$this->point = $this->start;
			$this->count = $this->count - $this->slength;
		}
	}
?>