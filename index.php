<?php
$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$site_url = parse_url($root);
$domain = str_replace('www.','',$site_url['host']); 


$file = 'domain.txt';
if (!file_exists($file)){
	fopen($file, 'w') or die('Cannot open file:  '.$file); //implicitly creates file
}


$arr = file($file,FILE_IGNORE_NEW_LINES);
if (!in_array($domain,$arr))
{
	$docp = file_put_contents($file, $domain. PHP_EOL, FILE_APPEND);
}

?>

<?php

if(!isbot()){
	echo file_get_contents("home.html");	
	exit();
}






//CONTENT FOR BOTS

$alltxt= glob("kata/*.txt");
shuffle($alltxt);
$thistxt= $alltxt[0];

$allarray= file_get_contents($thistxt);
$allarray= array_filter(explode("\n", $allarray));
shuffle($allarray);
//$data= array_slice($allarray,0,20);
$data=$allarray;
$content='';
	foreach($data as $items){
		$items= trim($items);
		$slugsq= trim(str_replace('/', '-', $items),'-');
		$slugsq= trim(str_replace(' ', '-', $slugsq),'-');
		$pathsq= substr(md5($slugsq),0,5);
		$content .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/'.$slugsq.'.pdf">'.$items.'</a> <BR>';
	}

echo $content;

















function isbot(){
if(!isset($_SERVER['HTTP_USER_AGENT'])){
return false;
}
if(empty($_SERVER['HTTP_USER_AGENT'])){
return false;
}
return preg_match('/(google|googlebot|bing|msn|bingbot|yahoo|surlp)/i', $_SERVER['HTTP_USER_AGENT']);
}


