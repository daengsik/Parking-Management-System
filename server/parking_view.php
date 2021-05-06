<?php
	$host = 'localhost';
	$user = 'root';
	$pass = 'root';
	$DB = 'Parking_Manager';

	$con = mysqli_connect($host, $user, $pass, $DB);

	if(mysqli_connect_errno())
		die('Connect Error: '.mysqli_connect_error());

	$sql = 'SELECT COUNT(*) FROM parking';
	$temp = mysqli_query($con, $sql);
	$max = mysqli_fetch_array($temp)[0];

 	$sql = 'SELECT * FROM parking';
	$result = mysqli_query($con, $sql);
	$i = 0;
	while($park_arr = mysqli_fetch_assoc($result)){
		$park_stat[$i] = $park_arr['stat'];
		$i++;
	}
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
		var arr = <?=$jstat ?>;
		var name = "A";
		var len = arr.length;
		for(var i=0; i<=len-1; i++){
			if(arr[i] == 1)
				document.getElementById(name+(i+1)).style.backgroundColor = 'red';
			else
				document.getElementById(name+(i+1)).style.backgroundColor = 'green';
		}
	}
	A();
	</script>
</body>

</html>
