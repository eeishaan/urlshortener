<?php

if(isset($_GET['shorturl']))
{
	$shorturl=$_GET['shorturl'];
	$newURL="http://localhost/purple/show.php?shorturl=".$shorturl;
header('Location: '.$newURL);
//	http_redirect("show.php", array("shorturl" => $shorturl), true, HTTP_REDIRECT_PERM);
}

?>
 <script src="jquery.js"></script>
 <script src="script2.js"></script>

<center>
	<link href='http://fonts.googleapis.com/css?family=Wire+One' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Marvel' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="style.css">
<center><h1 style="margin-top:0px;color:#191919;top:0px;font-family: 'Marvel', sans-serif;font-size:54px;background-color:rgba(255,255,255,0.9)"><div style="margin-top:0px;background-color:rgba(0, 139, 204, 0.490196);width:100%;height:4px"></div>URL shortener<sub style="font-size:20px">Beta</sub><div style="margin-top:0px;background-color:rgba(0, 139, 204, 0.490196);width:100%;height:4px"></div></h1></center>
<h1 id="enter"> ENTER YOUR uRL</h1>
<form name="input" action="convert.php" method="get">
<input type="text" name="longurl" required style="border-radius:10%;text-align:center;border-style:none;width:100%;border:2px solid cyan;font-size: 40px;"><br>
<input type="submit" value="Submit">
<input type="submit" value="View Stat">

</form>
</center>














