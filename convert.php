<link href='http://fonts.googleapis.com/css?family=Marvel' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="style.css">
<?php

require_once __DIR__ . '/db_connect.php';
date_default_timezone_set('Asia/Calcutta'); 
    // connecting to db
    $db = new DB_CONNECT();

if(isset($_GET["longurl"]))
{


	$longurl = $_GET["longurl"];
	if(!(stristr($longurl, 'localhost/purple') === FALSE) )
	{
		$str= substr($longurl, -1);
		$str= substr($longurl, -1);
	
		$str=substr($longurl, -8);
		$str=substr($str,0,7);
		
		
    	 if(alreadyThere($str,1))
		{
			display_url($str,1);
	    
		}
		
  	}
	else{
		if(urlValid($longurl))
	{	
		if(alreadyThere($longurl,0))
		{
			display_url($longurl,0);
	    
		}
		else
		{
			$shorturl=convertUrl();
			
			$success=insertUrl($shorturl,$longurl);
			$shorturl="localhost/purple/".$shorturl;

			if($success==1)
			{
				
				echo "<body  style='background-color: rgba(181,255,218,0.3); font-family: Marvel, sans-serif;'><center><h1>Short URl for $longurl</h1><div><h1>is</h1> <h1  style='margin-top:0px;font-size:90px'>$shorturl</h1></div> </center></body>";
			}
			else
				echo "<center><h1 style='font-family: Marvel, sans-serif'>Unable to process request</h1></center>";
		}

	
	}
	else
	{	echo "<script>alert('Please enter a valid and full URL. Example: http://www.google.com')</script>";
    	header("Refresh: 0; URL=index.php");
    }
}
	exit(0);

	

}

function urlValid($longurl)
{
	
	if (filter_var($longurl, FILTER_VALIDATE_URL) === FALSE) 
	{
    	echo "<script>alert('Please enter a valid and full URL. Example: http://www.google.com')</script>";
    	header("Refresh: 0; URL=index.php");
	}


	$ch = curl_init($longurl);

	curl_setopt($ch, CURLOPT_NOBODY, true);
	curl_exec($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
 	if($response!=404 && $response!=0)
 		return 1;
 	else
 		return 0;
    
}

function alreadyThere($longurl,$flag)
{
	if($flag==0)
		$result=mysql_query("SELECT * FROM url where longurl = '$longurl'");
	else
		$result=mysql_query("SELECT * FROM url where shorturl = '$longurl'");

	if(mysql_num_rows($result)!=0)
		return 1;
	else 
		return 0;
}
function display_url($longurl,$flag){
	if($flag==0)
		$result= mysql_query("SELECT * FROM url WHERE longurl = '$longurl'");
	else
		$result= mysql_query("SELECT * FROM url WHERE shorturl = '$longurl'");

	$row= mysql_fetch_array($result);
	$shorturl = $row['shorturl'];
	$longurl=$row['longurl'];
	$date=$row['date_created'];
	$count=$row['counter'];
	$baseUrl="localhost/purple/";
	$shorturl=$baseUrl.$shorturl;
	echo "<body  style='background-color: rgba(52,170,220,0.3); font-family: Marvel, sans-serif;'><center><h1>Long URL : $longurl</h1><div><h1>ShortUrl</h1> <h1  style='margin-top:0px;font-size:90px'>$shorturl</h1></div> <h1>Date = $date</h1> <h1>No.of hits =$count</h1></center></body>";
}
	
function insertUrl($shorturl, $longurl){
	$date = date('d/m/Y');
	
	$result= mysql_query("INSERT INTO url(shorturl,longurl,date_created) values('$shorturl' ,'$longurl','$date')");
	if($result)
		return 1;
	else
		return 0;
}

function convertUrl()
{
	$chars="0123456789abcdefghijklmnopqrstuvwxvzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//$alreadyPresent=0;
	$shorturl="";
	for($i=0;$i<7;$i=$i+1){
			$short=rand(0,61);
			$shorty=substr($chars,intval($short),1);
			$shorturl=$shorturl.$shorty;

		}
	$result=mysql_query("SELECT * FROM url WHERE shorturl = '$shorturl'");
	if (mysql_num_rows($result)==0)
	{
		return $shorturl;
	}
	else
	{
		return convertUrl();
	}
	

}


?>
