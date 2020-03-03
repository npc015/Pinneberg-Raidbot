<?php
// Write to log.
debug_log('trainer_edit_level()');

// For debug.
//debug_log($update);
//debug_log($data);

// Set the level.
$level = $data['arg'];

// Set the user_id
$user_id = $update['callback_query']['from']['id'];

if ($update['callback_query']['message']['chat']['type'] == 'private') {
    // Update the user.
    my_query(
        "
        UPDATE	  users 
        SET       level = {$level}
                  WHERE   user_id = {$user_id}
        "
    );

    // Build message string.
    $msg = '';
    $msg .= '<b>' . "Level gespeichert!" . '</b>' . CR . CR;
    $msg .= get_user($user_id);

    // Build callback message string.
    $callback_response = "Level gespeichert!";

    // Answer callback.
    answerCallbackQuery($update['callback_query']['id'], $callback_response);

    // Create the keys.
    $keys = [];

    // Edit message.
    edit_message($update, $msg, $keys, false);
}

exit();
