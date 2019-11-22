<?php 
require_once "libs/phpQuery.php";
require_once "conn.php";
require_once "autorize.php";

function freebie(){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36');
	curl_setopt($ch, CURLOPT_URL, "https://lolzteam.net/threads/167064/");
	curl_setopt($ch, CURLOPT_COOKIE, "G_ENABLED_IDPS=google; xf_id=;");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, realpath('cook.txt'));
	curl_setopt($ch, CURLOPT_COOKIEFILE, realpath('cook.txt'));
	//curl_setopt($ch, CURLOPT_COOKIE, "psession=924069258e907242ccd009c37cbcd132;max-age=604800;");
	//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	$resul = curl_exec($ch);
	if($resul == false){
		echo "Ну ты и долбаеб Саня " . curl_error($ch);
		return false;
	}else{
		$thID = str_replace('/', '', str_replace('https://lolzteam.net/threads/', '', 'https://lolzteam.net/threads/167064/'));

		$getInfo = phpQuery::newDocument($resul);
		$token = $getInfo->find('input[name=_xfToken]')->attr('value');

		// echo $lastPage = $getInfo->find('.PageNav')->attr('data-last');
		// for ($i = 1; $i <= $lastPage; $i++) {
		// 	if($i > 1){
		// 		$pp = "page-$i";
		// 	}

		// 	$ch = curl_init();
		// 	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36');
		// 	curl_setopt($ch, CURLOPT_URL, "https://lolzteam.net/threads/167064/$pp");
		// 	curl_setopt($ch, CURLOPT_COOKIE, "G_ENABLED_IDPS=google; xf_id=;");
		// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 	curl_setopt($ch, CURLOPT_COOKIEJAR, realpath('cook.txt'));
		// 	curl_setopt($ch, CURLOPT_COOKIEFILE, realpath('cook.txt'));
		// 	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		// 	$resul = curl_exec($ch);
		// 	$getInfo = phpQuery::newDocument($resul);
		// 	$messageList = $getInfo->find('#messageList li');

		// 	foreach ($messageList as $message) {
		// 		$userMess = pq($message);
		// 		echo $userName = $userMess->attr('data-author');
		// 		$checkUser = R::find('fblist','WHERE user = ? AND th_id = ?',[$userName,$thID]);
		// 		if(empty($checkUser)){
		// 			$addToList = R::dispense('fblist');
		// 			$addToList->user = $userName;
		// 			$addToList->th_id = $thID;
		// 			R::store($addToList);
		// 			array_push($usersList,$userName);
		// 		}

		// 	}
		// }
		
		// 		
		
			//foreach ($usersList as $user) {
				$file = file('gifts.txt');
				$gift = $file[0];
				$modFile = fopen('gifts.txt', 'w');

				$line--;
				for ($i = 0; $i < sizeof($file); $i++) {
					if($i == $line){
					unset($file[$i]);
					}
				}
				fputs($modFile,implode("", $file));
				fclose($modFile);

				$answer = $gift . "<br/> Следующий ключик через час =]";//"[USERS=$user]$gift[/USERS]" . "<br/>";
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36');
				curl_setopt($ch, CURLOPT_URL, "https://lolzteam.net/threads/167064/add-reply");
				curl_setopt($ch, CURLOPT_COOKIE, "G_ENABLED_IDPS=google; xf_id=826b97c0d90250d5cd3bc875b5e76c30;");
				curl_setopt($ch, CURLOPT_POSTFIELDS, ['message_html' => $answer,'_xfRelativeResolver' => 'https://lolzteam.net/threads/167064/','_xfToken' => $token]);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				//curl_setopt($ch, CURLOPT_COOKIE, "psession=924069258e907242ccd009c37cbcd132;max-age=604800;");
				curl_setopt($ch, CURLOPT_COOKIEJAR, realpath('cook.txt'));
				curl_setopt($ch, CURLOPT_COOKIEFILE, realpath('cook.txt'));
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

				$resul = curl_exec($ch);
			//}




		// 	break;
			
		// }
		
		

	}
}
freebie();
 ?>
