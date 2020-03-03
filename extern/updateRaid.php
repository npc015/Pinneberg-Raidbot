<?php




//TODO:Get post parameters and send to db.
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is coming from a form
    $raid_id = explode(" ", $_POST["raid_id"]);
    $start_time = $_POST["start_time"];
    $duration = $_POST["duration"];

    //TODO: Check if params are filled!
    if(count($raid_id) > 0 && $start_time != "" && $duration != ""){

        //Get DB connection
        require("dbconnect.php");

$time = explode("T", $start_time)[1];
$origHour = explode(":", $time)[0];
$hours = ((int) $origHour) + $duration;


        $end_time = str_replace("T".$origHour, "T".$hours, $start_time);    //Etwas unsauber, aber erfüllt den Zweck :D


		foreach ($raid_id as $id){
		$sql = "UPDATE raids SET start_time='".$start_time."', end_time='".$end_time."' WHERE id=$id";
		$result = $conn->query($sql);

if($conn->affected_rows > 0){
echo "Raid " . $id. " erfolgreich geupdatet!<br/>";
}
else { echo "Update des Raids " . $id. " ist fehlgeschlagen!<br/>"; 
}
}

$conn->close();
    }else{
        echo "Parameters are missing. Dont update.";
    }
} 
else {

    if (date('N') == 3 ) {
        $current = time();
        $raidhour = strtotime('today, 17:00');
			if ($current < $raidhour) 
			$nextWednesday = $raidhour;
			else
			$nextWednesday = strtotime('next wednesday, 17:00');
			}
			else { 
			$nextWednesday = strtotime('next wednesday, 17:00');
			}

    $nextEvent = date("Y-m-d\TH:i:s", $nextWednesday);

    $form = "<form action='updateRaid.php' method='post'>
                <div class='row'>
                    <div class='labels'>
                        <label for='raid_id'>Raid-ID</label>
                    </div>
                    <div class='inputs'>
                        <input type='text' name='raid_id' required/>    
                    </div>
                </div>
                
                <div class='row'>
                    <div class='labels'>
                        <label for='start_time'>Startzeit</label>
                    </div>
                    <div class='inputs'>
                        <input type='datetime-local' name='start_time' value='". $nextEvent ."' required/>    
                    </div>
                </div>
                
                <div class='row'>
                    <div class='labels'>
                        <label for='duration'>Dauer</label>
                    </div>
                    <div class='inputs'>  

     <select name='duration'>

  <option value='0.75'>45 Minuten</option>

  <option value='1' selected>1 Stunde</option>

  <option value='1.5'>90 Minuten</option>

  <option value='3'>3 Stunden</option>

</select>              <!--            
                          <ul style=\"list-style-type:none\"> 
                               <li>
                                <label>
                                    <input type='radio' name='duration' value='0.75'>
                                   45 min
                                </label>

                                <label>
                                    <input type='radio' name='duration' value='1' checked>
                                    1 Stunde
                                </label>
                                <label>
                                    <input type='radio' name='duration' value='3'>
                                    3 Stunden
                                </label>
                            </li>       
                        </ul>  -->

                    </div>
                </div>
                <input type=\"submit\" />    
        
            </form>";


    ?>
    <html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="form.css">
        <title>Update Raid</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    </head>
    <body>
    <?php echo $form; ?>
    </body>

    </html>

<?php


}
?>