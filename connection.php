<?php
    session_start();
	$conn=mysqli_connect('localhost','knrbljxy','O:Zi9jD32uA.m2','knrbljxy_project');
	if(!$conn)
	{
		echo "Unable to connect";
	}
    
    function validate($data)
		{
			$data=trim($data);
			$data=stripslashes($data);
			$data=htmlspecialchars($data);
			return $data;
		}	
?>