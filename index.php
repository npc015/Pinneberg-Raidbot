<?php
// Parent dir.
$parent = __DIR__;

// Include requirements and perfom initial steps
include_once(__DIR__ . '/core/bot/requirements.php');

// Start logging.
debug_log("RAID-BOT '" . BOT_ID . "'");

// Check API Key and get input from telegram
include_once(CORE_BOT_PATH . '/apikey.php');

// We maybe receive a webhook so far...
$webhook = false;
foreach ($update as $raid) {

    if (isset($raid['type']) && $raid['type'] == 'raid') {

        $webhook = true;
        break;
    }
}

if ($webhook === false) {

    // DDOS protection
    include_once(CORE_BOT_PATH . '/ddos.php');
}

// Get language
include_once(CORE_BOT_PATH . '/userlanguage.php');

// Database connection
include_once(CORE_BOT_PATH . '/db.php');

// Run cleanup if requested
include_once(CORE_BOT_PATH . '/cleanup_run.php');

if ($webhook === true) {

    // Create raid(s) and exit.
    include_once(ROOT_PATH . '/commands/raid_from_webhook.php');
    $dbh = null;
    exit();
}

// Update the user
update_user($update);

if(isset($update['message']['new_chat_member']) AND $update['message']['chat']['id'] == '-1001294336545')
{
 sendMessage(-1001294336545, "Willkommen <b>".$update['message']['new_chat_member']['first_name']."</b> in der Pinneberger Talkgruppe. ".CR." ".CR."Unter https://raidbot.piraidgruppe.de/dokumentation/infos.pdf findest du alle wichtigen Informationen (Anleitungen, Links, Regeln und Datenschutz). Bitte verwende dieses Dokument als erste Anlaufstelle.

Ansonsten stehen dir bei Fragen, Anregungen und Kritik gerne @HenningW2019 als Admin und @Serafinius als Moderator zur Verfügung.

Bei technischen Problemen oder benötigter Hilfe gerne eine Private Nachricht an @npc015 oder @florian_bu senden.

Wir wünschen dir viel Spaß und Erfolg und stehen dir bei Fragen gerne zur Verfügung.");
}

// Callback query received.
if (isset($update['callback_query'])) {
    // Logic to get the module
    include_once(CORE_BOT_PATH . '/modules.php');

// Inline query received.
} else if (isset($update['inline_query'])) {
    // List quests and exit.
    raid_list($update);
    $dbh = null;
    exit();

// Location received.
} else if (isset($update['message']['location']) && $update['message']['chat']['type'] == 'private') {
    // Create raid and exit.
    include_once(ROOT_PATH . '/mods/raid_by_location.php');
    $dbh = null;
    exit();

// Cleanup collection from channel/supergroup messages.
} else if ((isset($update['channel_post']) && $update['channel_post']['chat']['type'] == "channel") || (isset($update['message']) && $update['message']['chat']['type'] == "supergroup")) {
    // Collect cleanup information
    include_once(CORE_BOT_PATH . '/cleanup_collect.php');

// Message is required to check for commands.
} else if (isset($update['message']) && ($update['message']['chat']['type'] == 'private' || $update['message']['chat']['type'] == 'channel')) {
    // Portal message?
    if(isset($update['message']['entities']['1']['type']) && $update['message']['entities']['1']['type'] == 'text_link' && strpos($update['message']['entities']['1']['url'], 'https://intel.ingress.com/intel?ll=') === 0) {
        // Import portal.
        include_once(ROOT_PATH . '/mods/importal.php');
    } else {
        // Logic to get the command
        include_once(CORE_BOT_PATH . '/commands.php');
    }
}

$dbh = null;
?>
