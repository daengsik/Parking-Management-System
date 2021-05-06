<?php
	$host = 'localhost';
	$user = 'root';
	$pass = 'root';
	$DB = 'Parking_Manager';

	$con = mysqli_connect($host, $user, $pass, $DB); //DB연결

	if(mysqli_connect_errno())
		die('Connect Error: '.mysqli_connect_error()); //DB연결 실패시 오류출력

	$sql = 'SELECT COUNT(*) FROM parking'; //레코드 수 출력
	$temp = mysqli_query($con, $sql);
	$max = mysqli_fetch_array($temp)[0];

 	$sql = 'SELECT * FROM parking'; //레코드 출력
	$result = mysqli_query($con, $sql);
	$i = 0;
	while($park_arr = mysqli_fetch_assoc($result)){
		$No[$i] = $park_arr['No']; //No 레코드 배열
		$park_sector[$i] = $park_arr['sector']; //sector 레코드 배열
		$park_stat[$i] = $park_arr['stat']; //stat 레코드 베열
		$i++;
	}
	$jNo = json_encode($No, JSON_NUMERIC_CHECK); //자바스크립트로 배열 보내기 json 형식
	$jsector = json_encode($park_sector); 
	$jstat = json_encode($park_stat, JSON_NUMERIC_CHECK);
	header('Refresh:2;');
?>

<!DOCTYPE html>

<style type="text/css">
    table {
        border: 2px solid #000;
        border-collapse: collapse;
        height: 300px;
    }

    td {
        width: 100px;
    }

    .main_ {
        border: 1px solid #000;
        height: 515px;
    }

    .main {
        width: 100%;
        text-align: center;
    }

    .first {
        float: left;
        box-sizing: border-box;
    }

    .second {
        display: inline-block;
        box-sizing: border-box;
    }

    .third {
        float: right;
        box-sizing: border-box;
    }

    .down {
        width: 100%;
    }

    .arrow {
        float: left;

    }

    .office {
        text-align: center;
        line-height: 100px;
        float: right;
        border: 2px solid #000F;
        background-color: #c3c4c7;
        width: 150px;
        height: 100px;
    }

    .red {
        /* float: left; */
        margin-right: 10px;
        width: 35px;
        height: 35px;
        background-color: red;
    }

    .blue {
        /* float: left; */
        margin-right: 10px;
        width: 35px;
        height: 35px;
        background-color: blue;
    }
</style>

<html>

<head>
    <title>html text basic page</title>
</head>

<body>
    <h1>주차현황</h1>
    <h2></h2>
    <div class="main_">
        <div class="main">
            <div class="first">
                <table border="2" width="150px">
                    <tr>
                        <td id="A1">
                        </td>
                    </tr>
                    <tr>
                        <td id="A2">
                        </td>
                    </tr>
                    <tr>
                        <td id="A3">
                        </td>
                    </tr>
                    <tr>
                        <td id="A4">
                        </td>
                    </tr>
                    <tr>
                        <td id="A5">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="second">
                <table border="2" width="300px">
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="third">
                <table border="2" width="150px">
                    <tr>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="down">
            <div class="arrow">
                <img src="arrow1.png" width="130px" height="100px">
            </div>
            <div class="office">
                관리실
            </div>
        </div>
    </div>
    <div width="150px">
        <br>
        <div class="red" align="left">

        </div>
        <div>
            주차불가
        </div>
        <div class="blue" align="left">

        </div>
        <div>
            주차가능
        </div>
    </div>
	<script>
	function A(){
		var No = <?=$jNo ?>; 
		var sector = <?=$jsector ?>;
		var stat = <?=$jstat ?>;
		//json 받기
		var len = No.length; //No배열 길이
		for(var i=0; i<=len-1; i++){ //len길이만큼 반복
			if(stat[i] == 1)
				document.getElementById(sector[i]+No[i]).style.backgroundColor = 'red'; //주차중
			else
				document.getElementById(sector[i]+No[i]).style.backgroundColor = 'green'; //빈자리
		}
	}
	A();
	</script>
</body>

</html>
