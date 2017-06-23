
		<?php
	# object oriented
	$from = new DateTime('1996-12-27');
	$to   = new DateTime('today');
	echo $from->diff($to)->y, "\n";

	# procedural
	//echo date_diff(date_create('1970-02-01'), date_create('today'))->y, "\n";
	?>

  
		<!-- <?php
		  //date in mm/dd/yyyy format; or it can be in other formats as well
		  $birthDate = "10/27/1996";
		  //explode the date to get month, day and year
		  $birthDate = explode("/", $birthDate);
		  //get age from date or birthdate
		  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
		    ? ((date("Y") - $birthDate[2]) - 1)
		    : (date("Y") - $birthDate[2]));
		  echo "Age is:" . $age;
		?> -->
