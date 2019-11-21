<?php 
require_once "conn.php";
require_once "libs/phpQuery.php";
require_once "autorize.php";
//curl_setopt($ch, CURLOPT_COOKIE, "psession=924069258e907242ccd009c37cbcd132;max-age=604800;");
function getLinksToLastThemes($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36');
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_COOKIE, "G_ENABLED_IDPS=google; xf_id=;");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, realpath('cook.txt'));
		curl_setopt($ch, CURLOPT_COOKIEFILE, realpath('cook.txt'));

		$resul = curl_exec($ch);
		if($resul == false){
			echo "Ну ты и долбаеб Саня " . curl_error($ch);
			return false;
		}else{
			$links = phpQuery::newDocument($resul);
			$threads = $links->find('.title a');
			foreach ($threads as $thread) {
				$links = pq($thread);
				$allThreads[] = $links->attr('href');
			}
			foreach ($allThreads as $link) {
				$addLink = R::dispense('contests');
				$addLink->link = $link;
				R::store($addLink);
			}
			return autoContest();
	}
}
getLinksToLastThemes('https://lolzteam.net/forums/contests/');

function autoContest() {
	$tLinks = R::getAll('SELECT * FROM contests');
	foreach ($tLinks as $link) {
		sleep(2);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36');
		curl_setopt($ch, CURLOPT_URL, "https://lolzteam.net/".$link['link']);
		curl_setopt($ch, CURLOPT_COOKIE, "G_ENABLED_IDPS=google; xf_id=;");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, realpath('cook.txt'));
		curl_setopt($ch, CURLOPT_COOKIEFILE, realpath('cook.txt'));
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		$gResult = curl_exec($ch);
		if($gResult == false){
			echo "Ну ты и долбаеб Саня " . curl_error($ch);
			return false;
		}else{
			 $baseFiles = phpQuery::newDocument($gResult);
			 $article = $baseFiles->find('.contestThreadBlock a')->eq(0);
			 $contestLink = "https://lolzteam.net/".$article->attr('href');
			 print_r($contestLink);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36');
			curl_setopt($ch, CURLOPT_URL, $contestLink);
			curl_setopt($ch, CURLOPT_COOKIE, "G_ENABLED_IDPS=google; xf_id=;");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_COOKIEJAR, realpath('cook.txt'));
			curl_setopt($ch, CURLOPT_COOKIEFILE, realpath('cook.txt'));
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

			$rResult = curl_exec($ch);
		}
	}
	//return R::exec('TRUNCATE TABLE contests');
}

 ?>