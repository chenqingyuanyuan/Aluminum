<?php
// 定义变量并设置为空值
$companyErr = $goodsErr = $dateErr = $nameErr = $genderErr = $telErr = $emailErr = $websiteErr = $detailErr = "";
$company = $goods = $date = $name = $gender = $telephone = $email = $website = $detail = "";
$errorinfo = $warninfo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (empty($_POST["company"])) {
		$errorinfo = $errorinfo."单位,";
	} else {
		$company = test_input($_POST["company"]);
	}
	
	if (empty($_POST["goods"])) {
		$errorinfo = $errorinfo."商品,";
	} else {
		$goods = test_input($_POST["goods"]);
	}
	if (empty($_POST["name"])) {
		$errorinfo = $errorinfo."联系人员,";
	} else {
		$name = test_input($_POST["name"]);
	}
	if (empty($_POST["date"])) {
		$errorinfo = $errorinfo."截止日期,";
	} else {
		$date = test_input($_POST["date"]);
	}
      
	if (empty($_POST["gender"])) {
		$errorinfo = $errorinfo."性别,";
	} else {
		$gender = test_input($_POST["gender"]);
	}
   
	if (empty($_POST["telephone"])) {
		$errorinfo = $errorinfo."联系电话,";
	} else {
		$telephone = test_input($_POST["telephone"]);
	}
   
	if (!empty($_POST["email"])) {
		$email = test_input($_POST["email"]);
		// 检查电子邮件地址语法是否有效
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
			$warninfo = $warninfo."无效的email格式,"; 
		}
	}
 
	if (empty($_POST["website"])) {
		$website = "";
	} else {
		$website = test_input($_POST["website"]);
		// 检查 URL 地址语法是否有效（正则表达式也允许 URL 中的斜杠）
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
			$warninfo = $warninfo."无效的URL,"; 
		}
	}
	
	if ($errorinfo == "" && $warninfo == "") {
		$mysqli = mysqli_init();
		$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时间
		$mysqli->real_connect('127.0.0.1', 'root', 'root', 'alu');
	
		if (mysqli_connect_errno($mysqli)) { 
			echo "连接 MySQL 失败: ".mysqli_connect_error(); 
		} 
		mysqli_query($mysqli,'set names utf8');

		$sql="INSERT INTO buy_info (company, goods, date, person, gender, telephone, email, website, detail) VALUES
				('$company','$goods','$date','$name','$gender','$telephone','$email','$website','$detail')";
		//echo $sql;
		$mysqli->query($sql);
		//$rst->free();
		$mysqli->close();
		
		$arr = array('result'=>"",'company'=>$company,'goods'=>$goods,'date'=>$date,'person'=>$name,
				'gender'=>$gender,'telephone'=>$telephone,'email'=>$email,'website'=>$website,'detail'=>$detail);

		echo json_encode($arr);
		//echo "";
	} else {
		$returnstr = "";
		if ($errorinfo != "") {
			$returnstr = substr($errorinfo, 0, -1)."为必填项";
		}
		if ($warninfo != "") {
			$returnstr = substr($warninfo, 0, -1);
		}
	
		$arr = array ('result'=>$returnstr);
		echo json_encode($arr);
	}
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
