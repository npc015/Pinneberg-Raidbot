<?php
// Write to log.
debug_log('trainer_level()');

// For debug.
//debug_log($update);
//debug_log($data);

if ($update['callback_query']['message']['chat']['type'] == 'private') {
	
	// Init empty keys array
    $keys = [];
	
	$keys = [
    [
        [
            'text'          => "1",
            'callback_data' => 'level:trainer_edit_level:1'
        ],
        [
            'text'          => "2",
            'callback_data' => 'level:trainer_edit_level:2'
        ],
        [
            'text'          => "3",
            'callback_data' => 'level:trainer_edit_level:3'
        ],
		[
            'text'          => "4",
            'callback_data' => 'level:trainer_edit_level:4'
        ],
		[
            'text'          => "5",
            'callback_data' => 'level:trainer_edit_level:5'
        ],
	],
	[
        [
            'text'          => "6",
            'callback_data' => 'level:trainer_edit_level:6'
        ],
        [
            'text'          => "7",
            'callback_data' => 'level:trainer_edit_level:7'
        ],
		[
            'text'          => "8",
            'callback_data' => 'level:trainer_edit_level:8'
        ],
		[
            'text'          => "9",
            'callback_data' => 'level:trainer_edit_level:9'
        ],
		[
            'text'          => "10",
            'callback_data' => 'level:trainer_edit_level:10'
        ],
	],
	[
		[
            'text'          => "11",
            'callback_data' => 'level:trainer_edit_level:11'
        ],
		[
            'text'          => "12",
            'callback_data' => 'level:trainer_edit_level:12'
        ],
		[
            'text'          => "13",
            'callback_data' => 'level:trainer_edit_level:13'
        ],
		[
            'text'          => "14",
            'callback_data' => 'level:trainer_edit_level:14'
        ],
		[
            'text'          => "15",
            'callback_data' => 'level:trainer_edit_level:15'
        ],
	],
	[
		[
            'text'          => "16",
            'callback_data' => 'level:trainer_edit_level:16'
        ],
		[
            'text'          => "17",
            'callback_data' => 'level:trainer_edit_level:17'
        ],
		[
            'text'          => "18",
            'callback_data' => 'level:trainer_edit_level:18'
        ],
		[
            'text'          => "19",
            'callback_data' => 'level:trainer_edit_level:19'
        ],
		[
            'text'          => "20",
            'callback_data' => 'level:trainer_edit_level:20'
        ],
	],
	[
		[
            'text'          => "21",
            'callback_data' => 'level:trainer_edit_level:21'
        ],
		[
            'text'          => "22",
            'callback_data' => 'level:trainer_edit_level:22'
        ],
		[
            'text'          => "23",
            'callback_data' => 'level:trainer_edit_level:23'
        ],
		[
            'text'          => "24",
            'callback_data' => 'level:trainer_edit_level:24'
        ],
		[
            'text'          => "25",
            'callback_data' => 'level:trainer_edit_level:25'
        ],	
	],
	[
		[
            'text'          => "26",
            'callback_data' => 'level:trainer_edit_level:26'
        ],
		[
            'text'          => "27",
            'callback_data' => 'level:trainer_edit_level:27'
        ],
		[
            'text'          => "28",
            'callback_data' => 'level:trainer_edit_level:28'
        ],
		[
            'text'          => "29",
            'callback_data' => 'level:trainer_edit_level:29'
        ],
		[
            'text'          => "30",
            'callback_data' => 'level:trainer_edit_level:30'
        ],
	],
	[	
		[
            'text'          => "31",
            'callback_data' => 'level:trainer_edit_level:31'
        ],
		[
            'text'          => "32",
            'callback_data' => 'level:trainer_edit_level:32'
        ],
		[
            'text'          => "33",
            'callback_data' => 'level:trainer_edit_level:33'
        ],
		[
            'text'          => "34",
            'callback_data' => 'level:trainer_edit_level:34'
        ],
		[
            'text'          => "35",
            'callback_data' => 'level:trainer_edit_level:35'
        ],
	],
	[
		[
            'text'          => "36",
            'callback_data' => 'level:trainer_edit_level:36'
        ],
		[
            'text'          => "37",
            'callback_data' => 'level:trainer_edit_level:37'
        ],
		[
            'text'          => "38",
            'callback_data' => 'level:trainer_edit_level:38'
        ],
		[
            'text'          => "39",
            'callback_data' => 'level:trainer_edit_level:39'
        ],
		[
            'text'          => "40",
            'callback_data' => 'level:trainer_edit_level:40'
        ],
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
	$msg = "Bitte wähle dein Level aus:";

    // Build callback message string.
    $callback_response = "Daten werden aktualisiert.";

    // Answer callback.
    answerCallbackQuery($update['callback_query']['id'], $callback_response);

    // Edit message.
    edit_message($update, $msg, $keys, false);
}

exit();
