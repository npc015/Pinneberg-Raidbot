<?php
// Write to log.
debug_log('vote_status()');

// For debug.
//debug_log($update);
//debug_log($data);

// Check if the user has voted for this raid before.
$rs = my_query(
    "
    SELECT    user_id
    FROM      attendance
      WHERE   raid_id = {$data['id']}
        AND   user_id = {$update['callback_query']['from']['id']}
    "
);

// Get the answer.
$answer = $rs->fetch_assoc();

// Write to log.
debug_log($answer);

//______________________________________
// Custom: Change query
// Make sure user has voted before.
if (!empty($answer)) {
    // Get status to update
    $status = $data['arg'];
	alarm($data['id'],$update['callback_query']['from']['id'],'status',$status);

// Update attendance.
	// Wenn es um den Alarm geht
	if($status == 'alarm')
	{
		// Erhöhe den alarm-Wert um 1
		my_query(
		"
		UPDATE    attendance
		SET       alarm = alarm+1		  
		  WHERE   raid_id = {$data['id']}
			AND   user_id = {$update['callback_query']['from']['id']}
		"
	
		);
		
		// Arenennamen abfragen
		$request = my_query("SELECT * FROM raids as r left join gyms as g on r.gym_id = g.id WHERE r.id = {$data['id']}");
		$answer_quests = $request->fetch_assoc();
		$gymname = $answer_quests['gym_name'];
		
		// Den neuen Wert abfragen
		$rs = my_query(
		"
		SELECT    alarm
		FROM      attendance
		  WHERE   raid_id = {$data['id']}
			AND   user_id = {$update['callback_query']['from']['id']}
		"
		);

		$answer = $rs->fetch_assoc();
		// Wenn der Wert gerade ist...
		if($answer['alarm'] % 2 == 0)
		{
			sendmessage($update['callback_query']['from']['id'], "Ich werde dir <b>keine weiteren Infos</b> zum Raid an der Arena <b>".$gymname."</b> geben.");
		}
		else
		{
			// Wenn er ungerade ist
			sendmessage($update['callback_query']['from']['id'], "Ich werde dich jetzt über <b>alle Änderungen</b> zum Raid an der Arena <b>".$gymname." informieren</b>.");
		}
	}
	else
	{
		// Bei allen anderen Status-Änderungen das normale Update
		my_query(
			"
			UPDATE    attendance
			SET       arrived = 0,
					  raid_done = 0,
					  cancel = 0,
					  late = 0,
					  $status = 1
			  WHERE   raid_id = {$data['id']}
				AND   user_id = {$update['callback_query']['from']['id']}
			"
		);
	}

    // Send vote response.
    send_response_vote($update, $data);
} else {
    // Send vote time first.
    send_vote_time_first($update);
}

exit();
