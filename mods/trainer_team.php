<?php
// Write to log.
debug_log('trainer_team()');

// For debug.
//debug_log($update);
//debug_log($data);

// Set the id.
$user_id = $data['arg'];

if ($update['callback_query']['message']['chat']['type'] == 'private') {
	
	// Init empty keys array
    $keys = [];
	
	$keys = [
    [
        [
            'text'          => "Blau",
            'callback_data' => 'team:trainer_edit_team:mystic'
        ],
        [
            'text'          => "Rot",
            'callback_data' => 'team:trainer_edit_team:valor'
        ],
        [
            'text'          => "Gelb",
            'callback_data' => 'team:trainer_edit_team:instinct'
        ]
	],
	[
		[
            'text'          => "Zurück",
            'callback_data' => '0:trainer:0'
        ],
		[
            'text'          => "Abbrechen",
            'callback_data' => '0:exit:0'
        ]
	]
];

    // Build message string.
	$msg = "Bitte wähle dein Team aus:";

    // Build callback message string.
    $callback_response = "Daten werden aktualisiert.";

    // Answer callback.
    answerCallbackQuery($update['callback_query']['id'], $callback_response);

    // Edit message.
    edit_message($update, $msg, $keys, false);
}

exit();
