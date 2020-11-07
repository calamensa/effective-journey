<?php
/**
 * Telegram Bot example.
 * @author Gabriele Grillo <gabry.grillo@alice.it>
 * https://github.com/Eleirbag89/TelegramBotPHP
 * https://t.me/howCreateBot
 */

include("Telegram.php");
date_default_timezone_set("asia/tehran");

// Set the bot TOKEN
$bot_id = '1402306859:AAG4KU_gtlZsP_pXeX7qOcZ8wSnGKio1ukQ';

// Instances the class
$telegram = new Telegram($bot_id);

//$result = $telegram->getData();

// Take text and chat_id from the message
$text 			 	 = $telegram->Text();
$caption			 = $telegram->Caption();	
$chat_id 		 	 = $telegram->ChatID();
$username 		 	 = $telegram->Username(); 
$name 		  	 	 = $telegram->FirstName();
$family 		 	 = $telegram->LastName();
$message_id 	  	 = $telegram->MessageID();
$reply_to_message_id = $telegram->ReplyToMessageID();
$user_id 			 = $telegram->UserID();
$replyUserId	     = $telegram->ReplyToMessageFromUserID();
$msgType		  	 = $telegram->getUpdateType();

//$content = ['chat_id' => $chat_id, 'text' => $msgType.' '.$text];
//$telegram->sendMessage($content);

$start_time = '00:00';
$end_time   = '06:00';

$current_time = date('H:i');

if($current_time >= $start_time && $current_time <= $end_time){
	$content = ['chat_id' => $chat_id, 'message_id' => $message_id];
	$telegram->deleteMessage($content);
}

//$data = $telegram->getData();
//$content = array('chat_id' => $chat_id, 'text' => json_encode($data, JSON_PRETTY_PRINT));
//$telegram->sendMessage($content);

if($msgType == 'new_chat_member'){
	$content = ['chat_id' => $chat_id, 'text' => 'خوش آمدید کاربر'];
	$telegram->sendMessage($content);
}


if($msgType == 'reply'){
	
	if($text == 'ban'){
		$content = ['chat_id' => $chat_id, 'user_id' => $replyUserId];
		$telegram->restrictChatMember($content);
		
		$content = ['chat_id' => $chat_id, 'text' => 'یوزر محدود شد!'];
		$telegram->sendMessage($content);
	}
	elseif($text == 'kick'){
		$content = ['chat_id' => $chat_id, 'user_id' => $replyUserId];
		$telegram->kickChatMember($content);
		
		$content = ['chat_id' => $chat_id, 'text' => 'یوزر اخراج شد!'];
		$telegram->sendMessage($content);
	}
	elseif($text == 'pin'){
		$content = ['chat_id' => $chat_id, 'message_id' => $reply_to_message_id];
		$telegram->pinChatMessage($content);
	}	
	
}

if($text == 'unpin'){
	$content = ['chat_id' => $chat_id];
	$telegram->unpinChatMessage($content);
	
	$content = ['chat_id' => $chat_id, 'text' => 'محتوا آنپین شد!'];
	$telegram->sendMessage($content);
}

if(
	$msgType == 'photo' ||
	$msgType == 'video' || 
	$msgType == 'animation' || 
	$msgType == 'document' && 
	!empty($caption)
){
	$text = $telegram->Caption();
}

if($msgType == 'message' || $msgType == 'photo' || $msgType == 'video' || $msgType == 'animation' || $msgType == 'document'){
	
	$pattern = "/((((http|https|ftp|ftps)\:\/\/)|www\.)?[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,4}(\/\S*)?)/i";
	if(preg_match($pattern, $text)){

		$content = ['chat_id' => $chat_id, 'message_id' => $message_id];
		$telegram->deleteMessage($content);

	}
}


if($msgType == 'message' || $msgType == 'photo' || $msgType == 'video' || $msgType == 'animation' || $msgType == 'document'){
	
	$pattern = "/(?<!\w)@\w+/";
	if(preg_match($pattern, $text)){

		$content = ['chat_id' => $chat_id, 'message_id' => $message_id];
		$telegram->deleteMessage($content);

	}	
	
}

if($msgType == 'sticker'){
	$content = ['chat_id' => $chat_id, 'message_id' => $message_id];
	$telegram->deleteMessage($content);
}

elseif($msgType == 'voice'){
	$content = ['chat_id' => $chat_id, 'message_id' => $message_id];
	$telegram->deleteMessage($content);
}

elseif($msgType == 'audio'){
	$content = ['chat_id' => $chat_id, 'message_id' => $message_id];
	$telegram->deleteMessage($content);
}

elseif($msgType == 'photo'){
	$content = ['chat_id' => $chat_id, 'message_id' => $message_id];
	$telegram->deleteMessage($content);
}

elseif($msgType == 'video'){
	$content = ['chat_id' => $chat_id, 'message_id' => $message_id];
	$telegram->deleteMessage($content);
}

elseif($msgType == 'location'){
	$content = ['chat_id' => $chat_id, 'message_id' => $message_id];
	$telegram->deleteMessage($content);
}

elseif($msgType == 'forwarded'){
	$content = ['chat_id' => $chat_id, 'message_id' => $message_id];
	$telegram->deleteMessage($content);
}
