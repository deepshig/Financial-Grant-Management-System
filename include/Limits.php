<?php
	class Limits
	{
		var $Resources;
		var	$TravelAllowance;
		var	$Medical;
		var	$Others;

		function __construct($res, $ta, $med, $oth)
		{
			$this->Resources = $res;
			$this->TravelAllowance = $ta;
			$this->Medical = $med;
			$this->Others = $oth;
		}

		function __destruct()
		{

		}

		public function Edit()
		{

		}

		public function Show()
		{
			
		}
	}
?>