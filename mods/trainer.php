<?php
// Write to log.
debug_log('trainer()');

// For debug.
//debug_log($update);
//debug_log($data);

if ($update['callback_query']['message']['chat']['type'] == 'private') {
	
	// Init empty keys array
    $keys = [];
	
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
/*
        [
            'text'          => "Alles",
            'callback_data' => '0:trainer_all:alles'
        ], */
		[
            'text'          => "Abbrechen",
            'callback_data' => '0:exit:0'
        ],
	]
];

// Set message.
$msg = "Bitte wähle aus, welche Daten deines Nutzers du ändern möchtest:";

  // Build callback message string.
    $callback_response = "Daten werden aktualisiert.";

    // Answer callback.
    answerCallbackQuery($update['callback_query']['id'], $callback_response);

    // Edit message.
    edit_message($update, $msg, $keys, false);
}


