<?php
	$host = 'localhost';
	$user = 'root';
	$pass = 'root';
	$DB = 'Parking_Manager';

	$No = $_GET["No"];
	$stat = $_GET["stat"];
	$con = mysqli_connect($host, $user, $pass, $DB);
	$sql = "SELECT * FROM parking WHERE No=$No";
	function get_client_ip() {
    		$ipaddress = '';
    		if (getenv('HTTP_CLIENT_IP'))
        		$ipaddress = getenv('HTTP_CLIENT_IP');
    		else if(getenv('HTTP_X_FORWARDED_FOR'))
        		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    		else if(getenv('HTTP_X_FORWARDED'))
        		$ipaddress = getenv('HTTP_X_FORWARDED');
    		else if(getenv('HTTP_FORWARDED_FOR'))
        		$ipaddress = getenv('HTTP_FORWARDED_FOR');
    		else if(getenv('HTTP_FORWARDED'))
        		$ipaddress = getenv('HTTP_FORWARDED');
   	 	else if(getenv('REMOTE_ADDR'))
        		$ipaddress = getenv('REMOTE_ADDR');
    		else
        		$ipaddress = 'UNKNOWN';
    		return $ipaddress;
	}
	$addr = ['192.168.0.33'];
	if(mysqli_fetch_row(mysqli_query($con, $sql))){
		if($stat == 1){
			$sql = "UPDATE parking SET stat=$stat, Stime=curtime() WHERE No=$No";
			mysqli_query($con, $sql);
			mysqli_query($con, "commit;");
		}
		else{
			$sql = "UPDATE parking SET stat=$stat, Etime=curtime() WHERE No=$No";
			mysqli_query($con, $sql);
			mysqli_query($con, "commit;");
		}
	}
	else{
		$sql = "INSERT INTO parking(No, stat, Stime) VALUES($No, $stat, 'curtime()')";
		mysqli_query($con, $sql);
		mysqli_query($con, "commit;");
	}
?>
