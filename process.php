<?php
	include("connect.inc.php");
	echo "<meta charset=utf-8>";
	
	$name 	  = $_POST['name'];
	$nickname = $_POST['nickname'];
	$sex 	  = $_POST['sex'];
	$number   = $_POST['number'];
	$school   = $_POST['school'];
	$major 	  = $_POST['major'];
	$grade 	  = $_POST['grade'];
	$phone 	  = $_POST['phone'];
	$email 	  = $_POST['email'];
	
	function safetyDo($var){
		$var = htmlspecialchars($var);
		$var = addslashes($var);
		return $var;
	}
	
	/* avoid SQL injection and XSS */
	$name 	  = safetyDo($name);
	$nickname = safetyDo($nickname);
	$sex 	  = safetyDo($sex);
	$number   = safetyDo($number);
	$school   = safetyDo($school);
	$major 	  = safetyDo($major);
	$grade 	  = safetyDo($grade);
	$phone 	  = safetyDo($phone);
	$email 	  = safetyDo($email);
	
	/* check name */
	if(strlen($name) == 0){
		echo "<script>alert('姓名错误，请重新提交！');history.go(-1);</script>";
		die();
	}
	if(strlen($name) >= 20){
		echo "<script>alert('姓名超长，须小于20字符！');history.go(-1);</script>";
		die();
	}
	
	/* check nickname */
	if(strlen($nickname) == 0){
		echo "<script>alert('昵称错误，请重新提交！');history.go(-1);</script>";
		die();
	}
	if(strlen($nickname) >= 20){
		echo "<script>alert('昵称超长，须小于20字符！');history.go(-1);</script>";
		die();
	}
	
	/* check sex */
	if($sex != "男" && $sex != "女"){
		echo "<script>alert('性别错误，请重新提交！');history.go(-1);</script>";
		die();
	}
	
	/* check number */
	if(!preg_match("/^\d{10}$/", $number)){
		echo "<script>alert('学号错误，请重新提交！');history.go(-1)</script>";
		die();
	}
	
	/* check school */
	$schoolArray=array("计算机科学与信息技术学院","信息与软件工程学院","数学与统计学院","物理学院","化学学院","长春理工大学","其它院系");
	$flag_school = false;
	foreach($schoolArray as $tmp){
		if($school == $tmp) $flag_school = true;
	}
	if($flag_school == false){
		echo "<script>alert('学院错误，请重新提交！');history.go(-1);</script>";
		die();
	}
	
	/* check major */
	$majorArray=array("计算机科学与技术","软件工程","教育技术学","图书馆学","数学与应用数学","统计学","物理学","电气工程及其自动化","电子信息科学与技术","化学","网络工程","其它专业");
	$flag_major = false;
	foreach($majorArray as $tmp){
		if($major == $tmp) $flag_major = true;
	}
	if($flag_major == false){
		echo "<script>alert('专业错误，请重新提交！');history.go(-1);</script>";
		die();
	}
	
	/* check grade */
	$gradeArray=array("本科2012级","本科2013级","本科2014级","本科2015级","研究生2013级","研究生2014级","研究生2015级","其它年级");
	$flag_grade = false;
	foreach($gradeArray as $tmp){
		if($grade == $tmp) $flag_grade = true;
	}
	if($flag_grade == false){
		echo "<script>alert('年级错误，请重新提交！');history.go(-1);</script>";
		die();
	}
	
	/* check phone */
	if(!preg_match("/^(13|15|18)\d{9}$/", $phone)){
		echo "<script>alert('手机错误，请重新提交！');history.go(-1);</script>";
		die();
	}
	
	/* check email */
	if(!preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/", $email)){
		echo "<script>alert('邮箱错误，请重新提交！');history.go(-1);</script>";
		die();
	}
	
	/* insert into db */
	$con = mysql_connect($mysql_address, $mysql_username, $mysql_password);
	if(!$con){
  		echo "<script>alert('数据库遇到了错误！');history.go(-1);</script>";
		die();
  	}
	mysql_query("set names utf8");
	mysql_select_db($mysql_dbname, $con);
	
	$sql = "insert into record (name,nickname,sex,number,school,major,grade,phone,email,star,checked) values ('$name','$nickname','$sex','$number','$school','$major','$grade','$phone','$email',0,0)";
	if(!mysql_query($sql, $con)){
  		echo "<script>alert('数据库遇到了错误！');history.go(-1);</script>";
		die();
  	}
	echo "<script>alert('提交成功！审核结果将在24小时内通过邮件告知您，请注意查收^_^');</script>";
	echo "<script language=\"javascript\">location.href='index.html'</script>";
	mysql_close($con);
?>
