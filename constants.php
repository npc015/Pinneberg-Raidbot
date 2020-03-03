<?php
// Icons.
defined('TEAM_B') 		or define('TEAM_B',        iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F499)));
defined('TEAM_R') 		or define('TEAM_R',        iconv('UCS-4LE', 'UTF-8', pack('V', 0x2764)));
defined('TEAM_Y') 		or define('TEAM_Y',        iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F49B)));
defined('TEAM_CANCEL') 		or define('TEAM_CANCEL',   iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F494)));
defined('TEAM_DONE') 		or define('TEAM_DONE',     iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4AA)));
defined('TEAM_UNKNOWN')		or define('TEAM_UNKNOWN',  iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F680)));
defined('EMOJI_REFRESH')	or define('EMOJI_REFRESH', iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F504)));
defined('EMOJI_HERE') 		or define('EMOJI_HERE',    iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4CD)));
defined('EMOJI_LATE') 		or define('EMOJI_LATE',    iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F40C)));
defined('EMOJI_GROUP') 		or define('EMOJI_GROUP',   iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F465)));
defined('EMOJI_STAR') 		or define('EMOJI_STAR',    iconv('UCS-4LE', 'UTF-8', pack('V', 0x2B50)));
defined('EMOJI_INVITE') 	or define('EMOJI_INVITE',  iconv('UCS-4LE', 'UTF-8', pack('V', 0x2709)));
defined('EMOJI_INFO')		or define('EMOJI_INFO',    iconv('UCS-4LE', 'UTF-8', pack('V', 0x2139)));
defined('EMOJI_EGG')		or define('EMOJI_EGG',     iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F95A)));
defined('EMOJI_CLOCK')		or define('EMOJI_CLOCK',   iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F551)));

// Weather Icons.
defined('EMOJI_W_SUNNY') 		or define('EMOJI_W_SUNNY',            iconv('UCS-4LE', 'UTF-8', pack('V', 0x2600)));
defined('EMOJI_W_CLEAR') 		or define('EMOJI_W_CLEAR',            iconv('UCS-4LE', 'UTF-8', pack('V', 0x2728)));
defined('EMOJI_W_RAIN') 		or define('EMOJI_W_RAIN',             iconv('UCS-4LE', 'UTF-8', pack('V', 0x2614)));
defined('EMOJI_W_PARTLY_CLOUDY') 	or define('EMOJI_W_PARTLY_CLOUDY',    iconv('UCS-4LE', 'UTF-8', pack('V', 0x26C5)));
defined('EMOJI_W_CLOUDY') 		or define('EMOJI_W_CLOUDY',           iconv('UCS-4LE', 'UTF-8', pack('V', 0x2601)));
defined('EMOJI_W_WINDY') 		or define('EMOJI_W_WINDY',            iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F32A)));
defined('EMOJI_W_SNOW') 		or define('EMOJI_W_SNOW',             iconv('UCS-4LE', 'UTF-8', pack('V', 0x26C4)));
defined('EMOJI_W_FOG') 			or define('EMOJI_W_FOG',              iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F32B)));

// Weather.
$weather = array(
    '1' => EMOJI_W_SUNNY,
    '2' => EMOJI_W_CLEAR,
    '3' => EMOJI_W_RAIN,
    '4' => EMOJI_W_PARTLY_CLOUDY,
    '5' => EMOJI_W_CLOUDY,
    '6' => EMOJI_W_WINDY,
    '7' => EMOJI_W_SNOW,
    '8' => EMOJI_W_FOG
);

// Teams.
$teams = array(
    'mystic'    => TEAM_B,
    'valor'     => TEAM_R,
    'instinct'  => TEAM_Y,
    'unknown'   => TEAM_UNKNOWN,
    'cancel'    => TEAM_CANCEL
);

// Raid eggs.
$eggs = array(
    '9995',  // Level 5
    '9994',  // Level 4
    '9993',  // Level 3
    '9992',  // Level 2
    '9991'   // Level 1
);

//______________________________________
// Custom: Emoji for Alarm
define('EMOJI_ALARM1',  	       iconv('UCS-4LE', 'UTF-8', pack('V', 0x1f50a)));
