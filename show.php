<?php
require_once __DIR__ . '/db_connect.php';
    $db = new DB_CONNECT();
	if(isset($_GET['shorturl']))
	{
		$shorturl=$_GET['shorturl'];
		$result=mysql_query("SELECT * FROM url WHERE shorturl = '$shorturl'");
		if(mysql_num_rows($result)!=0)
		{
			$row= mysql_fetch_array($result);

			$longurl = $row['longurl'];
			$result=mysql_query("update url set counter=counter+1 where shorturl='$shorturl'");
			echo "<center> <h1 style='font-family:Agency FB'>Redirecting...</h1></center>";
			header("Refresh: 1; URL=".$longurl);
		}

		else
		{
			echo "<script type='text/javascript'>alert('No such shorturl exists in database');</script>";
			header("Refresh: 1; URL=http://localhost/purple/");
		}

	}
	




?>