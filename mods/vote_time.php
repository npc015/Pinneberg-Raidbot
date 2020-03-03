<?php
// Write to log.
debug_log('vote_time()');

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

// Get the arg.
$arg = $data['arg'];

// Raid anytime?
if($arg == 0) {
    // Raid anytime.
    $attend_time = '0000-00-00 00:00:00';
} else {
    // Normal raid time - convert data arg to UTC time.
    $dt = new DateTime();
    $dt_attend = $dt->createFromFormat('YmdHis', $arg, new DateTimeZone('UTC'));
    $attend_time = $dt_attend->format('Y-m-d H:i:s');
}

// User has voted before.
if (!empty($answer)) {
    // Update attendance.
	//______________________________________
	// Custom: trigger alarm
	alarm($data['id'],$update['callback_query']['from']['id'],'aend_teil', $data['arg']);
    my_query(
        "
        UPDATE    attendance
        SET       attend_time = '{$attend_time}',
                  cancel = 0,
                  arrived = 0,
                  raid_done = 0,
                  late = 0
          WHERE   raid_id = {$data['id']}
            AND   user_id = {$update['callback_query']['from']['id']}
        "
    );

// User has not voted before.
} else {
    // Create attendance.
	//______________________________________
	// Custom: trigger alarm
	alarm($data['id'],$update['callback_query']['from']['id'],'neu_teil', $data['arg']);
    my_query(
        "
        INSERT INTO   attendance
        SET           raid_id = {$data['id']},
                      user_id = {$update['callback_query']['from']['id']},
                      attend_time = '{$attend_time}'
        "
    );
}

// Send vote response.
send_response_vote($update, $data);

exit();
