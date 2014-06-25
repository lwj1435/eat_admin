<?php 


$cookie_jar = dirname(__FILE__)."/cookies.txt";
//$cookie_jar = tempnam(dirname(__FILE__),'JSESSIONID');     

print_r($cookie_jar);

$ch = curl_init();  
$hostname ="http://w456.hg0088.com/app/member/login.php";  


$header[] = 'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
$header[] = 'Accept-Encoding:gzip, deflate';
$header[] = 'Accept-Language:zh-cn,zh;q=0.8,en-us;q=0.5,en;q=0.3';
$header[] = 'Connection:keep-alive';
$header[] = 'Host:w456.hg0088.com';
$header[] = 'Referer:http://w456.hg0088.com/app/member/';
$header[] = 'User-Agent:Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0';


$fields = "uid=&langx=zh-cn&mac=&ver=&JE=true&username=okoK811&passwd=admin123456"; 

curl_setopt($ch, CURLOPT_URL, $hostname);  
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);  
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0");
curl_setopt($ch, CURLOPT_POST, 1);   
curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
curl_setopt($ch, CURLOPT_AUTOREFERER,true); 

$filecontent = curl_exec($ch);  

curl_close($ch); 

print_r(json_encode($filecontent));


print_r("22")

?>