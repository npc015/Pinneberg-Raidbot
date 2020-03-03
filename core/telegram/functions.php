<?php
/**
 * Send message.
 * @param $chat_id
 * @param array $text
 * @param $multicurl
 */
function sendMessage($chat_id, $text = [], $multicurl = false)
{
    // Create response content array.
    $reply_content = [
        'method'     => 'sendMessage',
        'chat_id'    => $chat_id,
        'parse_mode' => 'HTML',
        'text'       => $text
    ];

    if (isset($inline_keyboard)) {
        $reply_content['reply_markup'] = ['inline_keyboard' => $inline_keyboard];
    }

    // Encode data to json.
    $reply_json = json_encode($reply_content);

    // Set header to json.
    header('Content-Type: application/json');

    // Write to log.
    debug_log($reply_json, '>');

    // Send request to telegram api.
    return curl_request($reply_json, $multicurl);
}

/**
 * Send message.
 * @param $chat_id
 * @param array $text
 * @param mixed $inline_keyboard
 * @param array $merge_args
 * @param $multicurl
 */
function send_message($chat_id, $text = [], $inline_keyboard = false, $merge_args = [], $multicurl = false)
{
    // Create response content array.
    $reply_content = [
        'method'     => 'sendMessage',
        'chat_id'    => $chat_id,
        'parse_mode' => 'HTML',
        'text'       => $text
    ];

    // Write to log.
    debug_log('KEYS');
    debug_log($inline_keyboard);

    if (isset($inline_keyboard)) {
        $reply_content['reply_markup'] = ['inline_keyboard' => $inline_keyboard];
    }

    if (is_array($merge_args) && count($merge_args)) {
        $reply_content = array_merge_recursive($reply_content, $merge_args);
    }

    // Encode data to json.
    $reply_json = json_encode($reply_content);

    // Set header to json.
    header('Content-Type: application/json');

    // Write to log.
    debug_log($reply_json, '>');

    // Send request to telegram api.
    return curl_request($reply_json, $multicurl);
}

/**
 * Send location.
 * @param $chat_id
 * @param $lat
 * @param $lon
 * @param bool $inline_keyboard
 * @param $multicurl
 * @return mixed
 */
function send_location($chat_id, $lat, $lon, $inline_keyboard = false, $multicurl = false)
{
    // Create reply content array.
    $reply_content = [
        'method'    => 'sendLocation',
        'chat_id'   => $chat_id,
        'latitude'  => $lat,
        'longitude' => $lon
    ];

    // Write to log.
    debug_log('KEYS');
    debug_log($inline_keyboard);

    if (is_array($inline_keyboard)) {
        $reply_content['reply_markup'] = ['inline_keyboard' => $inline_keyboard];
    }

    // Encode data to json.
    $reply_json = json_encode($reply_content);

    // Set header to json.
    header('Content-Type: application/json');

    // Write to log.
    debug_log($reply_json, '>');

    // Send request to telegram api and return response.
    return curl_request($reply_json, $multicurl);
}

/**
 * Send venue.
 * @param $chat_id
 * @param $lat
 * @param $lon
 * @param $title
 * @param $address
 * @param bool $inline_keyboard
 * @param $multicurl
 * @return mixed
 */
function send_venue($chat_id, $lat, $lon, $title, $address, $inline_keyboard = false, $multicurl = false)
{
    // Create reply content array.
    $reply_content = [
        'method'    => 'sendVenue',
        'chat_id'   => $chat_id,
        'latitude'  => $lat,
        'longitude' => $lon,
        'title'     => $title,
        'address'   => $address
    ];

    // Write to log.
    debug_log('KEYS');
    debug_log($inline_keyboard);

    if (is_array($inline_keyboard)) {
        $reply_content['reply_markup'] = ['inline_keyboard' => $inline_keyboard];
    }

    // Encode data to json.
    $reply_json = json_encode($reply_content);

    // Set header to json.
    header('Content-Type: application/json');

    // Write to log.
    debug_log($reply_json, '>');

    // Send request to telegram api and return response.
    return curl_request($reply_json, $multicurl);
}

/**
 * Echo message.
 * @param $chat_id
 * @param $text
 */
function sendMessageEcho($chat_id, $text)
{
    // Create reply content array.
    $reply_content = [
        'method'     => 'sendMessage',
        'chat_id'    => $chat_id,
        'parse_mode' => 'HTML',
        'text'       => $text
    ];

    // Encode data to json.
    $reply_json = json_encode($reply_content);

    // Set header to json.
    header('Content-Type: application/json');

    // Write to log.
    debug_log($reply_json, '>');

    // Echo json.
    echo($reply_json);
}

/**
 * Answer callback query.
 * @param $query_id
 * @param $text
 */
function answerCallbackQuery($query_id, $text, $multicurl = false)
{
    // Create response array.
    $response = [
        'method'            => 'answerCallbackQuery',
        'callback_query_id' => $query_id,
        'text'              => $text
    ];

    // Encode response to json format.
    $json_response = json_encode($response);

    // Set header to json.
    header('Content-Type: application/json');

    // Write to log.
    debug_log($json_response, '>');

    // Send request to telegram api.
    return curl_request($json_response, $multicurl);
}

/**
 * Answer inline query.
 * @param $query_id
 * @param $contents
 */
function answerInlineQuery($query_id, $contents)
{
    // Init empty result array.
    $results = [];

    // For each content.
    foreach($contents as $key => $row) {
        $text = $contents[$key]['text'];
        $title = $contents[$key]['title'];
        $desc = $contents[$key]['desc'];
        $inline_keyboard = $contents[$key]['keyboard'];

        // Create input message content array.
        $input_message_content = [
            'parse_mode'                => 'HTML',
            'message_text'              => $text,
            'disable_web_page_preview'  => true
        ];

        // Fill results array.
        $results[] = [
            'type'                  => 'article',
            'id'                    => $query_id . $key,
            'title'                 => $title,
            'description'           => $desc,
            'input_message_content' => $input_message_content,
            'reply_markup'          => [
                'inline_keyboard' => $inline_keyboard
            ]
        ];
    }

    // Create reply content array.
    $reply_content = [
        'method'          => 'answerInlineQuery',
        'inline_query_id' => $query_id,
        'is_personal'     => true,
        'cache_time'      => 10,
        'results'         => $results
    ];

    // Encode to json 
    $reply_json = json_encode($reply_content);

    // Send request to telegram api.
    return curl_request($reply_json);
}

/**
 * Edit message.
 * @param $update
 * @param $message
 * @param $keys
 * @param bool $merge_args
 * @param $multicurl
 */
function edit_message($update, $message, $keys, $merge_args = false, $multicurl = false)
{
    if (isset($update['callback_query']['inline_message_id'])) {
        $json_response = editMessageText($update['callback_query']['inline_message_id'], $message, $keys, NULL, $merge_args, $multicurl);
    } else {
        $json_response = editMessageText($update['callback_query']['message']['message_id'], $message, $keys, $update['callback_query']['message']['chat']['id'], $merge_args, $multicurl);
    }
    return $json_response;
}

/**
 * Edit message text.
 * @param $id_val
 * @param $text_val
 * @param $markup_val
 * @param null $chat_id
 * @param mixed $merge_args
 * @param $multicurl
 */
function editMessageText($id_val, $text_val, $markup_val, $chat_id = NULL, $merge_args = false, $multicurl = false)
{
    // Create response array.
    $response = [
        'method'        => 'editMessageText',
        'text'          => $text_val,
        'parse_mode'    => 'HTML',
        'reply_markup'  => [
            'inline_keyboard' => $markup_val
        ]
    ];

    if ($markup_val == false) {
        unset($response['reply_markup']);
        $response['remove_keyboard'] = true;
    }

    // Valid chat id.
    if ($chat_id != null) {
        $response['chat_id']    = $chat_id;
        $response['message_id'] = $id_val;
    } else {
        $response['inline_message_id'] = $id_val;
    }

    // Write to log.
    //debug_log($merge_args, 'K');
    //debug_log($response, 'K');

    if (is_array($merge_args) && count($merge_args)) {
        $response = array_merge_recursive($response, $merge_args);
    }

    // Write to log.
    //debug_log($response, 'K');

    // Encode response to json format.
    $json_response = json_encode($response);

    // Write to log.
    debug_log($response, '<-');

    // Send request to telegram api.
    return curl_request($json_response, $multicurl);
}

/**
 * Edit message reply markup.
 * @param $id_val
 * @param $markup_val
 * @param $chat_id
 * @param $multicurl
 */
function editMessageReplyMarkup($id_val, $markup_val, $chat_id, $multicurl = false)
{
    // Create response array.
    $response = [
        'method' => 'editMessageReplyMarkup',
        'reply_markup' => [
            'inline_keyboard' => $markup_val
        ]
    ];

    // Valid chat id.
    if ($chat_id != null) {
        $response['chat_id'] = $chat_id;
        $response['message_id'] = $id_val;

    } else {
        $response['inline_message_id'] = $id_val;
    }

    // Encode response to json format.
    $json_response = json_encode($response);

    // Write to log.
    debug_log($response, '->');

    // Send request to telegram api.
    return curl_request($json_response, $multicurl);
}

/**
 * Edit message keyboard.
 * @param $id_val
 * @param $markup_val
 * @param $chat_id
 * @param $multicurl
 */
function edit_message_keyboard($id_val, $markup_val, $chat_id, $multicurl = false)
{
    // Create response array.
    $response = [
        'method' => 'editMessageReplyMarkup',
        'reply_markup' => [
            'inline_keyboard' => $markup_val
        ]
    ];

    // Valid chat id.
    if ($chat_id != null) {
        $response['chat_id'] = $chat_id;
        $response['message_id'] = $id_val;

    } else {
        $response['inline_message_id'] = $id_val;
    }

    // Encode response to json format.
    $json_response = json_encode($response);

    // Write to log.
    debug_log($response, '->');

    // Send request to telegram api.
    return curl_request($json_reponse, $multicurl);
}

/**
 * Delete message
 * @param $chat_id
 * @param $message_id
 * @param $multicurl
 */
function delete_message($chat_id, $message_id, $multicurl = false)
{
    // Create response content array.
    $reply_content = [
        'method'     => 'deleteMessage',
        'chat_id'    => $chat_id,
        'message_id' => $message_id,
        'parse_mode' => 'HTML',
    ];

    // Encode data to json.
    $reply_json = json_encode($reply_content);

    // Set header to json.
    header('Content-Type: application/json');

    // Write to log.
    debug_log($reply_json, '>');

    // Send request to telegram api.
    return curl_request($reply_json, $multicurl);
}

/**
 * GetChat
 * @param $chat_id
 * @param $multicurl
 */
function get_chat($chat_id, $multicurl = false)
{
    // Create response content array.
    $reply_content = [
        'method'     => 'getChat',
        'chat_id'    => $chat_id,
        'parse_mode' => 'HTML',
    ];

    // Encode data to json.
    $reply_json = json_encode($reply_content);

    // Set header to json.
    header('Content-Type: application/json');

    // Write to log.
    debug_log($reply_json, '>');

    // Send request to telegram api.
    return curl_request($reply_json, $multicurl);
}

/**
 * GetChatAdministrators
 * @param $chat_id
 * @param $multicurl
 */
function get_admins($chat_id, $multicurl = false)
{
    // Create response content array.
    $reply_content = [
        'method'     => 'getChatAdministrators',
        'chat_id'    => $chat_id,
        'parse_mode' => 'HTML',
    ];

    // Encode data to json.
    $reply_json = json_encode($reply_content);

    // Set header to json.
    header('Content-Type: application/json');

    // Write to log.
    debug_log($reply_json, '>');

    // Send request to telegram api.
    return curl_request($reply_json, $multicurl);
}

/**
 * GetChatMember
 * @param $chat_id
 * @param $user_id
 * @param $multicurl
 */
function get_chatmember($chat_id, $user_id, $multicurl = false)
{
    // Create response content array.
    $reply_content = [
        'method'     => 'getChatMember',
        'chat_id'    => $chat_id,
        'user_id'    => $user_id,
        'parse_mode' => 'HTML',
    ];

    // Encode data to json.
    $reply_json = json_encode($reply_content);

    // Set header to json.
    header('Content-Type: application/json');

    // Write to log.
    debug_log($reply_json, '>');

    // Send request to telegram api.
    return curl_request($reply_json, $multicurl);
}

/**
 * Send photo.
 * @param $chat_id
 * @param $photo_url
 * @param array $text
 * @param mixed $inline_keyboard
 * @param array $merge_args
 * @param array $multicurl
 */
function send_photo($chat_id, $photo_url ,$text = array(), $inline_keyboard = false, $merge_args = [], $multicurl = false)
{
    // Create response content array.
    $reply_content = [
        'method'     => 'sendPhoto',
        'chat_id'    => $chat_id,
        'photo'      => $photo_url,
        'parse_mode' => 'HTML',
        'caption'       => $text
    ];
    
    // Write to log.
    debug_log('KEYS');
    debug_log($inline_keyboard);
    
    if (isset($inline_keyboard)) {
        $reply_content['reply_markup'] = ['inline_keyboard' => $inline_keyboard];
    }
    
    if (is_array($merge_args) && count($merge_args)) {
        $reply_content = array_merge_recursive($reply_content, $merge_args);
    }
    
    // Encode data to json.
    $reply_json = json_encode($reply_content);
    
    // Set header to json.
    header('Content-Type: application/json');
    
    // Write to log.
    debug_log($reply_json, '>');
    
    // Send request to telegram api.
    return curl_request($reply_json, $multicurl);
}

/**
 * Send request to telegram api - single or multi?.
 * @param $json
 * @param $multicurl
 * @return mixed
 */
function curl_request($json, $multicurl = false)
{
    // Proxy server?
    defined('CURL_USEPROXY') or define('CURL_USEPROXY', false);
    defined('CURL_PROXYSERVER') or define('CURL_PROXYSERVER', '');

    // Bridge mode?
    defined('BRIDGE_MODE') or define('BRIDGE_MODE', false);

    // Send request to telegram api.
    if($multicurl == true) {
        return $json;
    } else {
        return curl_json_request($json);
    }
}

/**
 * Send request to telegram api.
 * @param $json
 * @return mixed
 */
function curl_json_request($json)
{
    // Bridge mode?
    if(defined('BRIDGE_MODE') && BRIDGE_MODE == true) {
        // Add bot folder name to callback data
        debug_log('Adding bot folder name "' . basename(ROOT_PATH) . '" to callback data');
        $search = '"callback_data":"';
        $replace = $search . basename(ROOT_PATH) . ':';
        $json = str_replace($search,$replace,$json);
    }

    $URL = 'https://api.telegram.org/bot' . API_KEY . '/';
    $curl = curl_init($URL);

    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	
    // Use Proxyserver for curl if configured
    if (CURL_USEPROXY == true && !empty(CURL_PROXYSERVER)) {
    	curl_setopt($curl, CURLOPT_PROXY, CURL_PROXYSERVER);
    }

    // Write to log.
    debug_log($json, '->');

    // Execute curl request.
    $json_response = curl_exec($curl);

    // Close connection.
    curl_close($curl);

    // Process response from telegram api.
    $response = curl_json_response($json_response, $json);

    // Return response.
    return $response;
}

/**
 * Send multi request to telegram api.
 * @param $json
 * @return mixed
 */
function curl_json_multi_request($json)
{
    // Set URL.
    $URL = 'https://api.telegram.org/bot' . API_KEY . '/';

    // Curl handles.
    $curly = array();

    // Curl response.
    $response = array();
 
    // Init multi handle.
    $mh = curl_multi_init();
 
    // Loop through json array, create curl handles and add them to the multi-handle.
    foreach ($json as $id => $data) {
        // Init.
        $curly[$id] = curl_init();
 
        // Curl options.
        curl_setopt($curly[$id], CURLOPT_URL, $URL);
        curl_setopt($curly[$id], CURLOPT_HEADER, false);
        curl_setopt($curly[$id], CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curly[$id], CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curly[$id], CURLOPT_TIMEOUT, 10);
    
        // Use Proxyserver for curl if configured.
        if(defined('CURL_USEPROXY') && defined('CURL_PROXYSERVER') && CURL_USEPROXY == true) {
            curl_setopt($curl, CURLOPT_PROXY, CURL_PROXYSERVER);
        }

        // Bridge mode?
        if(defined('BRIDGE_MODE') && BRIDGE_MODE == true) {
            // Add bot folder name to callback data
            debug_log('Adding bot folder name "' . basename(ROOT_PATH) . '" to callback data');
            $search = '"callback_data":"';
            $replace = $search . basename(ROOT_PATH) . ':';
            $data = str_replace($search,$replace,$data);
        }

        // Curl post. 
        curl_setopt($curly[$id], CURLOPT_POST,       true);
        curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $data);

        // Add multi handle.
        curl_multi_add_handle($mh, $curly[$id]);

        // Write to log.
        debug_log($data, '->');
    }

    // Execute the handles.
    $running = null;
    do {
        curl_multi_select($mh);
        curl_multi_exec($mh, $running);
    } while($running > 0);
 
    // Get content and remove handles.
    foreach($curly as $id => $content) {
        $response[$id] = curl_multi_getcontent($content);
        curl_multi_remove_handle($mh, $content);
    }
 
    // Close connection. 
    curl_multi_close($mh);
 
    // Process response from telegram api.
    foreach($response as $id => $json_response) {
        // Bot specific funtion to process response from telegram api.
        if (function_exists('curl_json_response')) {
            $response[$id] = curl_json_response($json_response, $response[$id]);
        } else {
            debug_log('No function found to process response from Telegram API!', 'ERROR:');
            debug_log('Add a function named "curl_json_response" to process them!', 'ERROR:');
            debug_log('Arguments of that function need to be the response $json_response and the send data $json.', 'ERROR:');
            debug_log('For example: function curl_json_response($json_response, $json)', 'ERROR:');
        }

        // Write to log.
        debug_log($json_response, '<-');
    }

    // Return response.
    return $response;
}
