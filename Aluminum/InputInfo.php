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
<style>
.error {color: #FF0000;}
</style>
<script type="text/javascript">
function showLoader() {  
    //显示加载器.for jQuery Mobile 1.2.0  
    $.mobile.loading('show', {  
        text: '加载中...', //加载器中显示的文字  
        textVisible: true, //是否显示文字  
        theme: 'a',        //加载器主题样式a-e  
        textonly: false,   //是否只显示文字  
        html: ""           //要显示的html内容，如图片等  
    });  
}  
  
//隐藏加载器.for jQuery Mobile 1.2.0  
function hideLoader()  
{  
    //隐藏加载器  
    $.mobile.loading('hide');  
}  

$(document).ready(function() {  
	$("#submit").click(function(){  
		cache: false,  
		
		showLoader();
		
		$.ajax({  
			type: "POST",  
			url: "InputAction.php",  
			data: $('#infoInput').serialize(),  
			success:function(data){
				hideLoader();
				var obj = eval('(' + data + ')');
				if (obj.result == "") {
					$("#resultinfo").html("保存成功!");
					
					$("#compamyInfo").html(obj.company);
					$("#goodsInfo").html(obj.goods);
					$("#dateInfo").html(obj.date);
					
					if (obj.gender == 1) {
						$("#nameInfo").html(obj.person + " 先生");
					} else {
						$("#nameInfo").html(obj.person + " 女士");
					}
					
					$("#telephoneInfo").html(obj.telephone);
					$("#emailInfo").html(obj.email);
					$("#websiteInfo").html(obj.website);
					$("#detailInfo").html(obj.detail);
					$("#inputArea").css("display","none");
					$("#resultArea").css("display","block");
		
				} else {
					$("#resultinfo").html(obj.result);
				}
				
				$("#popupDialog").popup("open");
			}  
		});  
	});  
});  
</script>  
</head>
<body>
<?php
// 定义变量并设置为空值
$companyErr = $goodsErr = $dateErr = $nameErr = $genderErr = $telErr = $emailErr = $websiteErr = $detailErr = "";
$company = $goods = $date = $name = $gender = $tel = $email = $website = $detail = "";

/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["company"])) {
     $companyErr = "单位是必填的";
   } else {
     $company = test_input($_POST["company"]);
   }
  
   if (empty($_POST["goods"])) {
     $goodsErr = "商品是必填的";
   } else {
     $goods = test_input($_POST["goods"]);
   }
   if (empty($_POST["name"])) {
     $nameErr = "姓名是必填的";
   } else {
     $name = test_input($_POST["name"]);
   }
   if (empty($_POST["date"])) {
     $dateErr = "姓名是必填的";
   } else {
     $date = test_input($_POST["date"]);
   }
      
   if (empty($_POST["gender"])) {
     $genderErr = "性别是必选的";
   } else {
     $gender = test_input($_POST["gender"]);
   }
   
   if (empty($_POST["tel"])) {
     $telErr = "电话是必填的";
   } else {
     $tel = test_input($_POST["tel"]);
   }
   
   if (!empty($_POST["email"])) {
     $email = test_input($_POST["email"]);
     // 检查电子邮件地址语法是否有效
     if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
       $emailErr = "无效的 email 格式"; 
     }
   }
     
   if (empty($_POST["website"])) {
     $website = "";
   } else {
     $website = test_input($_POST["website"]);
     // 检查 URL 地址语法是否有效（正则表达式也允许 URL 中的斜杠）
     if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
       $websiteErr = "无效的 URL"; 
     }
   }

	$mysqli = mysqli_init();
	$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时间
	$mysqli->real_connect('127.0.0.1', 'root', 'bytecity', 'alu');
	
	
	if (mysqli_connect_errno($mysqli)) { 
		echo "连接 MySQL 失败: " . mysqli_connect_error(); 
	} 
	mysqli_query($mysqli,'set names utf8');

	$sql="INSERT INTO buy_info (company, goods, date, person, gender, telephone, email, website, detail) VALUES
			('$company','$goods','$date','$name','$gender','$tel','$email','$website','$detail')";
	echo $sql;
	$mysqli->query($sql);

	//$rst->free();
	$mysqli->close();
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
*/
?>
<!-- Start of first page: #one -->
<div data-role="page" id="one">

	<div data-role="header">
		<h1>信息发布</h1>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		<div id="inputArea">
			<p><span class="error">* 必需的字段</span></p>
		
			<form id="infoInput" action="javascript:void(0)" > 	
				<label for="company">求购单位<span class="error">*</span>: <span class="error"><?php echo $companyErr;?></span></label>
				<input data-clear-btn="true" name="company" id="company" value="" type="text">
				<label for="goods">求购商品<span class="error">*</span>: <span class="error"><?php echo $goodsErr;?></span></label>
				<input data-clear-btn="true" name="goods" id="goods" value="" type="text">
				<label for="date">截止日期<span class="error">*</span>: <span class="error"><?php echo $dateErr;?></span></label>
				<input name="date" id="date" data-inline="false" data-role="date" type="text">
				
				
				<label for="name">联系人员<span class="error">*</span>: <span class="error"><?php echo $nameErr;?></span></label>
				<input name="name" id="name" value="" type="text">
				<fieldset data-role="controlgroup" data-type="horizontal">
					<input name="gender" id="radio-choice-h-2a" value="1" checked="checked" type="radio">
					<label for="radio-choice-h-2a">先生</label>
					<input name="gender" id="radio-choice-h-2b" value="0" type="radio">
					<label for="radio-choice-h-2b">女士</label>
				</fieldset>
				<label for="telephone">联系电话<span class="error">*</span>: <span class="error"><?php echo $telErr;?></span></label>
				<input data-clear-btn="true" name="telephone" id="telephone" value="" type="tel">
				<label for="email">联系邮箱:</label>
				<input data-clear-btn="true" name="email" id="email" value="" type="email">
				<label for="website">公司主页:</label>
				<input data-clear-btn="true" name="website" id="website" value="" type="url">
				
				<label for="detail">详细信息:</label>
				<textarea rows="4" name="detail" id="detail" value=""></textarea>
				
				<p><button id="submit" type="submit" class="ui-btn ui-shadow ui-corner-all">发布</button></p>
			</form>
		</div>
		<div id="resultArea" style="display:none">
			<label>求购单位<span class="error">*</span>:<span id="companyInfo"></span></label><br/>
			<label>求购商品<span class="error">*</span>:<span id="goodsInfo"></span></label><br/>
			<label>截止日期<span class="error">*</span>:<span id="dateInfo"></span></label><br/>
			<label>联系人员<span class="error">*</span>:<span id="nameInfo"></span></label><br/>
			<label>联系电话<span class="error">*</span>:<span id="telephoneInfo"></span></label><br/>
			<label>联系邮箱 :<span id="emailInfo"></span></label><br/>
			<label>公司主页 :<span id="websiteInfo"></span></label><br/>
			<label>详细信息 :<span id="detailInfo"></span></label><br/>
		</div>
		
		<div data-role="popup" id="popupDialog" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
    		<div data-role="header" data-theme="a">
    			<h1>提示信息</h1>
    		</div>
    		<div role="main" class="ui-content">
    			<p id="resultinfo">This action cannot be undone.</p>
       		 	<a href="#" class="ui-btn ui-corner-all ui-btn-b" data-rel="back">确定</a>
    		</div>
		</div>
	</div><!-- /content -->
</div><!-- /page one -->

</body>

</html>