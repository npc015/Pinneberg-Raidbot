<?php
// Write to log.
debug_log('trainer_name()');

// For debug.
//debug_log($update);
//debug_log($data);

// Set the level.
$name = $data['arg'];

// Set the user_id
$user_id = $update['callback_query']['from']['id'];

if ($update['callback_query']['message']['chat']['type'] == 'private') {
    // Update the user.
    my_query("UPDATE users SET warteaufname = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE user_id = {$user_id}");

    // Build message string.
    $msg = '';
    $msg .= '<b>' . "Bitte nenne mir deinen neuen Namen:" . '</b>' . CR . CR;
    //$msg .= get_user($user_id);

    // Build callback message string.
    $callback_response = "";

    // Answer callback.
    answerCallbackQuery($update['callback_query']['id'], $callback_response);

    // Edit message.
    edit_message($update, $msg, false);
}

exit();
