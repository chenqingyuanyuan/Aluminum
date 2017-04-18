<?php ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Page Title</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv=Content-Type content="text/html;charset=utf-8">
<link rel="stylesheet" href="./statics/jquery.mobile-1.4.5.css" />
<link rel="stylesheet" href="./statics/jquery.mobile.datepicker.theme.css" />
<link rel="stylesheet" href="./statics/jquery.mobile.datepicker.css" />
<script src="./statics/jquery.min.js"></script>
<script src="./statics/jquery.mobile-1.4.5.js"></script>
<script src="./statics/external/jquery-ui/datepicker.js"></script>
<script src="./statics/jquery.mobile.datepicker.js"></script>

</head>
<body>

<!-- Start of first page: #one -->
<div data-role="page" id="one">

	<div data-role="header">
		<h1>信息查询</h1>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 	
		<div class="ui-field-contain">
	         <label for="goods">商品名称:</label>
	         <input data-clear-btn="true" name="goods" id="goods" value="" type="text">
	    </div>
		<p><button type="submit" class="ui-btn ui-shadow ui-corner-all">查询</button></p>
		</form>
		<ul data-role="listview" data-inset="true" data-divider-theme="a">
   			<li data-role="list-divider">查询结果</li>
			<?php
				function test_input($data) {
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					
					$goods = "";
					
					if (!empty($_POST["goods"])) {
						$goods = test_input($_POST["goods"]);
					}
					
					$mysqli = mysqli_init();
					$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时间
					$mysqli->real_connect('127.0.0.1', 'root', 'bytecity', 'alu');
					if (mysqli_connect_errno($mysqli)) { 
						echo "连接 MySQL 失败: " . mysqli_connect_error(); 
					} 
					mysqli_query($mysqli,'set names utf8');
					$sql = "SELECT * FROM buy_info WHERE goods like '%$goods%'";
					//echo $sql;
					$result=$mysqli->query($sql);
					
					if ($result) {    
						if ($result->num_rows>0) {    
							while ($rows = $result->fetch_array()) {    
								echo "<li><a href='./DetailInfo.php?id=".$rows["id"]."'>".$rows["company"]." 求购 ".$rows["goods"]."</a></li>";
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
		</ul>
	</div><!-- /content -->

</div><!-- /page one -->

</body>

</html>