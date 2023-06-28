<?php
require("../connect.php");

$statname 	= htmlspecialchars($_POST["statname"]);

//echo $racename;

//zjistit zda už je to v db
$dotaz 	= "SELECT * FROM stats WHERE statname = '$statname'";
$result = mysqli_query($conn,$dotaz);

//pokud to najde vysledek, nezpristupni zapis
if (mysqli_num_rows($result) > 0) 
	{
		
		$rowcount = mysqli_num_rows($result);
		echo "jmeno statu je jiz v databazi";
		header("Location:../generator.php?vysledek=neuspech");
	}
	else{
		
		echo "pridavam do databaze";
		
		$addstat = "INSERT INTO `stats` (statname) 
					VALUES ('$statname')";	
		
			if (!mysqli_query($conn, $addstat))
			{
			echo "Chyba: ".mysqli_error();
			}
		header("Location:../generator.php?vysledek=uspech");
}



?>