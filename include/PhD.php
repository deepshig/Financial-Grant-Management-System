<?php
	require_once 'InstitutePeople.php';


	class Faculty extends InstitutePeople
	{
		function __construct($roll)
		{
			InstitutePeople : InstitutePeople($roll, 700000, 20000, 100000, 35000);
		}

		function __destruct()
		{

		}

	}
?>