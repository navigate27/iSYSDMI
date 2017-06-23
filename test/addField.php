
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Flot Examples: Basic Usage</title>
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->
  <script src="jquery-2.1.4.min.js"></script>
	<script>
	$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
	</script>

</head>
<body>



	<form action='addField.php' method='post'>
		<input type="text" pattern="(?![9]{10})[0-9]{10}" required>
		<div class="input_fields_wrap">
			<button class="add_field_button">Add More Fields</button>
				<div><input type="text" name="mytext[]"></div>

		</div>

		<input type='submit'>
		</form>

	<?php

	// $how_hear = count($_POST['mytext']) ? $_POST['mytext'] : array();
	//
	// echo count($how_hear) ? implode(', ',$how_hear) : 'Nothing';

	if(!empty($_POST['mytext'])){
		$temp_num = 0;

		foreach($_POST['mytext'] as $report_id){
			//  echo "$report_id, ";
			$temp_num = $report_id+$temp_num;
		}

		echo $temp_num;


	}

		// if(isset($_POST["mytext"])){
		//
		//     $capture_field_vals ="";
		//     foreach($_POST["mytext"] as $key => $text_field){
		//         $capture_field_vals .= $text_field .", ";
		//     }
		// 		echo $capture_field_vals;
		// }

		// if($_POST){
    // $subject = implode(",", $_POST["mytext"]);
    // echo $text;
	?>
</body>
</html>
