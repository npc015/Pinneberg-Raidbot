<?php
// Write to log.
debug_log('START()');

// For debug.
//debug_log($update);
//debug_log($data);

// Check access.
bot_access_check($update, 'create');

//if (isset($update['message']['from'])) {
//  $msg = $update['message']['from'];
//}
//
//if (isset($update['callback_query']['from'])) {
//  $msg = $update['callback_query']['from'];
//}

//if (isset($update['inline_query']['from'])) {
//  $msg = $update['inline_query']['from'];
//}
//if (!empty($msg['id'])) {
//  $userid = $msg['id'];
  
// Custom: Ask User
$userid = $update['message']['from']['id'];
$rs = my_query( "SELECT ingame, team, level FROM users WHERE user_id = {$userid}");
$answer = $rs->fetch_assoc();

if($answer['ingame'] == '')
{
	sendMessage($userid, 'Hallo Trainer. Wir kennen uns noch gar nicht. Kannst du mir bitte deinen Trainernamen nennen?');
	my_query("UPDATE users SET warteaufname = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE user_id = {$userid}");
	die();
}

// Get gym by name.
// Trim away everything before "/start "
$searchterm = $update['message']['text'];
$searchterm = substr($searchterm, 7);

// Get the keys by gym name search.
$keys = '';
if(!empty($searchterm)) {
    $keys = raid_get_gyms_list_keys($searchterm);
} 

// Get the keys if nothing was returned. 
if(!$keys) {
    $keys = raid_edit_gyms_first_letter_keys();
}

// No keys found.
if (!$keys) {
    // Create the keys.
    $keys = [
        [
            [
                'text'          => getTranslation('not_supported'),
                'callback_data' => '0:exit:0'
            ]
        ]
    ];
}

// Set message.
$msg = '<b>' . getTranslation('select_gym_first_letter') . '</b>' . (RAID_VIA_LOCATION == true ? (CR2 . CR .  getTranslation('send_location')) : '');

// Send message.
send_message($update['message']['chat']['id'], $msg, $keys, ['reply_markup' => ['selective' => true, 'one_time_keyboard' => true]]);

?>
