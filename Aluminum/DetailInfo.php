<?php ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Page Title</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv=Content-Type content="text/html;charset=utf-8">
<link rel="stylesheet" href="./statics/jquery.mobile-1.4.5.css" />
<script src="./statics/jquery.min.js"></script>
<script src="./statics/jquery.mobile-1.4.5.js"></script>
</head>
<body>
<!-- Start of first page: #one -->
<div data-role="page" id="one">

	<div data-role="header">
		<h1>详细信息</h1>
	</div><!-- /header -->
	<div role="main" class="ui-content">
<?php
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
// 定义变量并设置为空值
$id = "";
if (!empty($_GET["id"])) {
     
	$id = test_input($_GET["id"]);
	$mysqli = mysqli_init();
	$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时间
	$mysqli->real_connect('127.0.0.1', 'root', 'bytecity', 'alu');
	if (mysqli_connect_errno($mysqli)) { 
		echo "连接 MySQL 失败: " . mysqli_connect_error(); 
	} 
	mysqli_query($mysqli,'set names utf8');
	$sql = "SELECT * FROM buy_info WHERE id = '$id'";
	//echo $sql;
	$result=$mysqli->query($sql);
	
	if ($result) {    
		if ($result->num_rows>0) {    
			while ($rows = $result->fetch_array()) {
				
				echo 	"<label>求购单位:</label><label>".$rows["company"]."</label>".
						"<label>求购商品:</label><label>".$rows["goods"]."</label>".
						"<label>截止日期:</label><label>".$rows["date"]."</label>".
						"<label>联系人员:</label><label>".$rows["person"]."</label>".
						"<label>联系电话:</label><label>".$rows["telephone"]."</label>";
				if (!empty($rows["email"])) {
					echo	"<label>联系邮箱:</label><label>".$rows["email"]."</label>";
				}
				if (!empty($rows["website"])) {
					echo	"<label>公司主页:</label><label>".$rows["website"]."</label>";
				}
				if (!empty($rows["detail"])) {
					echo	"<label>详细信息:</label><label>".$rows["detail"]."</label>";
				}	
			}//end while()    
		}else{    
			//echo "<BR>查询结果为空！";       
		}//end if()    
		$result->close();
	}else{    
		//echo "<BR>查询失败！";     
	}
	
	$mysqli->close();
}
?>
	</div><!-- /content -->
</div><!-- /page one -->
</body>
</html>