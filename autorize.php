<?php
require_once "conn.php";
//curl_setopt($cc, CURLOPT_COOKIE, "psession=924069258e907242ccd009c37cbcd132;max-age=604800;");
function Auth() {
	$cc = curl_init();
	curl_setopt($cc, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36');
	//curl_setopt($cc,CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($cc,CURLOPT_URL,'https://lolzteam.net/login/login');
	curl_setopt($cc, CURLOPT_COOKIE, "G_ENABLED_IDPS=google; xf_id=;");
	curl_setopt($cc, CURLOPT_POSTFIELDS, ['login' => '','password' => '','stop_brute_pls' => 1,'cookie_check' => 1,'_xfToken','redirect' => 'https://lolzteam.net/']);
	curl_setopt($cc, CURLOPT_COOKIEJAR, realpath('cook.txt'));
	curl_setopt($cc, CURLOPT_COOKIEFILE, realpath('cook.txt'));
	
	//curl_setopt($cc, CURLOPT_FOLLOWLOCATION, 1);
	$res = curl_exec($cc);
	if($res == false){
		echo "Хммм..." . curl_error($cc);
		return false;
	}else{
		return getTwoStep();
		
	}
}
Auth();

function getTwoStep() {
	$ch = curl_init();
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36');
	curl_setopt($ch, CURLOPT_URL, 'https://lolzteam.net/login/two-step');
	curl_setopt($ch, CURLOPT_COOKIE, "G_ENABLED_IDPS=google; xf_id=;");
	curl_setopt($ch, CURLOPT_POSTFIELDS, ['code' => '144766','trust' => '1','save' => 'Подтвердить','provider' => 'totp','_xfConfirm' => '1','_xfToken','remember' => '0','redirect' => 'https://lolzteam.net/']);
	curl_setopt($ch, CURLOPT_COOKIEJAR, realpath('cook.txt'));
	curl_setopt($ch, CURLOPT_COOKIEFILE, realpath('cook.txt'));
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($ch);
	if($result == false){
		echo "Ну ты и долбаеб Саня " . curl_error($ch);
		return false;
	}else{
		echo "gg";
		return $result;
		//return getGlobal('https://lolzteam.net');
	}
}

// function getGlobal($url) {
// 	$ch = curl_init();
// 	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36');
// 	curl_setopt($ch, CURLOPT_URL, $url);
// 	curl_setopt($ch, CURLOPT_COOKIE, "G_ENABLED_IDPS=google; xf_id=;");
// 	curl_setopt($ch, CURLOPT_COOKIEJAR, realpath('cook.txt'));
// 	curl_setopt($ch, CURLOPT_COOKIEFILE, realpath('cook.txt'));
// 	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 	//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// 	$resul = curl_exec($ch);

// 	//curl_close($ch);
// 	if($resul == false){
// 		echo "Ну ты и долбаеб Саня " . curl_error($ch);
// 		return false;
// 	}else{
// 		echo "gg";
// 		//return infoParse($resul); //Парс Основной инфы
// 		//return getBaseFile()
// 		//return getBasesThemesLinks($resul); //Парс Тем с базами с первой страницы
			
// 	}
// }



 ?>