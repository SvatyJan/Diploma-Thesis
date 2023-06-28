<?php
require("../connect.php");

$racename 	= htmlspecialchars($_POST["racename"]);

//echo $racename;

//zjistit zda už je to v db
$dotaz 	= "SELECT * FROM race WHERE racename = '$racename'";
$result = mysqli_query($conn,$dotaz);

//pokud to najde vysledek, nezpristupni zapis
if (mysqli_num_rows($result) > 0) 
	{
		
		$rowcount = mysqli_num_rows($result);
		echo "jmeno rasy je jiz v databazi";
		header("Location:../generator.php?vysledek=neuspech");
	}
	else{
		
		echo "pridavam do databaze";
		
		$addrace = "INSERT INTO `race` (racename) 
					VALUES ('$racename')";	
		
			if (!mysqli_query($conn, $addrace))
			{
			echo "Chyba: ".mysqli_error();
			}
		header("Location:../generator.php?vysledek=uspech");
}



?>