<?php
	require_once 'InstitutePeople.php';


	class Faculty extends InstitutePeople
	{
		function __construct($roll)
		{
			InstitutePeople : InstitutePeople($roll, 500000, 10000, 100000, 10000);
		}

		function __destruct()
		{

		}

	}
?>