<?php
// Write to log.
debug_log('TRAINER()');

// For debug.
//debug_log($update);
//debug_log($data);

// Init empty keys array.
$keys = [];

// Create keys array.
$keys = [
    [
        [
            'text'          => "Name",
            'callback_data' => '0:trainer_name:name'
        ],
	    [
            'text'          => "Level",
            'callback_data' => '0:trainer_level:level'
        ],
	    [
            'text'          => "Team",
            'callback_data' => '0:trainer_team:team'
        ],
		[
            'text'          => "Abbrechen",
            'callback_data' => '0:exit:0'
        ]
	]
];

// Set message.
$msg = "Bitte wähle aus, welche Daten deines Nutzers du ändern möchtest:";

// Send message.
send_message($update['message']['chat']['id'], $msg, $keys, ['reply_markup' => ['selective' => true, 'one_time_keyboard' => true]]);

?>
