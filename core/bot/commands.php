<?php
// Init command.
$command = NULL;
  
// Check message text for a leading slash.
if (substr($update['message']['text'], 0, 1) == '/') {
	  $userid = $update['message']['from']['id'];
	  my_query("UPDATE users SET warteaufname = NULL WHERE user_id = {$userid}");
    // Get command name.
    if(defined('BOT_NAME')) {
        $com = strtolower(str_replace('/', '', str_replace(BOT_NAME, '', explode(' ', $update['message']['text'])[0])));
        $altcom = strtolower(str_replace('/' . basename(ROOT_PATH), '', str_replace(BOT_NAME, '', explode(' ', $update['message']['text'])[0])));
    } else {
        debug_log('BOT_NAME is missing! Please define it!', '!');
        $com = 'start';
        $altcom = 'start';
    }

    // Set command paths.
    $command = ROOT_PATH . '/commands/' . basename($com) . '.php';
    $altcommand = ROOT_PATH . '/commands/' . basename($altcom) . '.php';
    $core_command = CORE_COMMANDS_PATH . '/' . basename($com) . '.php';
    $core_altcommand = CORE_COMMANDS_PATH . '/' . basename($altcom) . '.php';
    $startcommand = ROOT_PATH . '/commands/start.php';

    // Write to log.
    debug_log(CORE_PATH,'Core path');
    debug_log('Command-File: ' . $command);
    debug_log('Alternative Command-File: ' . $altcommand);
    debug_log('Core Command-File: ' . $core_command);
    debug_log('Core Alternative Command-File: ' . $core_altcommand);
    debug_log('Start Command-File: ' . $startcommand);

    // Check if command file exits.
    if (is_file($command)) {
        // Dynamically include command file and exit.
        include_once($command);
    } else if (is_file($altcommand)) {
        // Dynamically include command file and exit.
        include_once($altcommand);
    } else if (is_file($core_command)) {
        // Dynamically include command file and exit.
        include_once($core_command);
    } else if (is_file($core_altcommand)) {
        // Dynamically include command file and exit.
        include_once($core_altcommand);
    } else if ($com == basename(ROOT_PATH)) {
        // Include start file and exit.
        include_once($startcommand);
    } else {
        sendMessage($update['message']['chat']['id'], '<b>' . getTranslation('not_supported') . '</b>');
    }
}

else if($update['message']['chat']['type'] == 'private')
{
	$userid = $update['message']['from']['id'];
	$rs = my_query("SELECT user_id FROM users WHERE user_id = {$userid} AND warteaufname > NOW()");
	$answer = $rs->fetch_assoc();
	if($answer['user_id'] == $userid)
	{
		$returnValue = preg_match('/^[A-Za-z0-9]{0,15}$/', $update['message']['text']);
		if($returnValue)
		{
			sendMessage($userid, 'Danke. Ich nenne dich ab sofort: <b>'.$update['message']['text'].'</b>'.CR.CR.'Wenn du dich nochmal umbenennen willst oder dein Level oder Team anpassen willst, schreib mir einfach: /trainer'.CR.CR.'Wenn du einen Raid anlegen möchtest, dann schreib mir /start');
			$neuername = $update['message']['text'];
			my_query("UPDATE users SET warteaufname = NULL, ingame = '{$neuername}' WHERE user_id = {$userid}");
		}
		else
		{
			sendMessage($userid, 'Deine Eingabe war kein gültiger Trainername. Bitte probiere es nochmal');
			// nur zum Stalken und Amüsieren falls jemand mit dem Bot redet :D
			sendMessage(MAINTAINER_ID, $update['message']['from']['first_name'].' '.$update['message']['from']['last_name'].': Falsche Namenseingabe: '.CR.$update['message']['text']);
			my_query("UPDATE users SET warteaufname = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE user_id = {$userid}");
		}
	}
}