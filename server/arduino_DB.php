<?php
	$host = 'localhost';
	$user = 'root';
	$pass = 'root';
	$DB = 'Parking_Manager';
	
	$sector = $_GET["sector"];
	$No = $_GET["No"];
	$stat = $_GET["stat"];
	//GET 파라미터 저장
	$con = mysqli_connect($host, $user, $pass, $DB);
	//DB연결
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
	} //클라이언트 IP
	$addr = ['192.168.0.33'];
	if(mysqli_fetch_row(mysqli_query($con, $sql)) && get_client_ip() == $addr[0]){ //레코드 개수and IP검사
		if($stat == 1){ //stat이 1일때
			$sql = "UPDATE parking SET sector=$sector, stat=$stat, Stime=curtime() WHERE No=$No";
			mysqli_query($con, $sql); //쿼리실행
			mysqli_query($con, "commit;");
		}
		else{
			$sql = "UPDATE parking SET sector=$sector, stat=$stat, Etime=curtime() WHERE No=$No";
			mysqli_query($con, $sql);
			mysqli_query($con, "commit;");
		}
	}
	else if(get_client_ip() == $addr[0]){
		$sql = "INSERT INTO parking(sector, No, stat, Stime) VALUES($sector, $No, $stat, curtime())";
		mysqli_query($con, $sql); //쿼리실행
		mysqli_query($con, "commit;");
	}
?>
