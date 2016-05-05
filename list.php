<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML lang=en>
<HEAD>
	<TITLE>NENU_ACM校赛报名系统</TITLE>
	<META charset=utf-8>
	<META content=IE=edge http-equiv=X-UA-Compatible>
	<META name=viewport content="width=device-width, initial-scale=1">
	<META name=description content="">
	<META name=author content="">
	<LINK rel="shortcut icon" href="./image/favicon.ico"><!-- Bootstrap core CSS -->
	<LINK rel=stylesheet href="css/bootstrap.min.css"><!-- Custom styles for this template -->
	<LINK rel=stylesheet href="css/cover.css">
	<!--[if lt IE 9]>
	<SCRIPT src="js/ie8-responsive-file-warning.js"></SCRIPT>
	<![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
	<SCRIPT src="js/html5shiv.js"></SCRIPT>
	<SCRIPT src="js/respond.min.js"></SCRIPT>
	<![endif]-->
	<META name=GENERATOR content="MSHTML 8.00.7600.17267">
</HEAD>
<BODY>
	<DIV class=site-wrapper>
	<DIV class=site-wrapper-inner>
	<DIV class=cover-container>
	<DIV class="masthead clearfix">
	<DIV class=inner>
	<H3 class=masthead-brand>
    	<a href="index.html"><img src="image/icpc_logo.png" /></a>
    </H3>
    <H2><b>审核通过名单（实时更新）</b></H2>
    </DIV>
    </DIV>
	<DIV class="inner cover" align="center">
		<table class="table table-striped" style="width:800px">
        	<thead>  
				<tr>
					<th>序号</th>
            		<th>姓名</th>
            		<th>昵称</th>
                    <th>性别</th>
                    <th>学院</th>
                    <th>专业</th>
                    <th>年级</th>
                    <th>打星</th>
            	</tr>
            </thead>
            <?php
			
			include("connect.inc.php");
			
            echo "<tbody>";
            
			$con = mysql_connect($mysql_address, $mysql_username, $mysql_password);
			if(!$con){
  				die('Error! Could not connect: ' . mysql_error());
  			}
			mysql_query('set names UTF8;');
			mysql_select_db($mysql_dbname, $con);
			
			$sql = "SELECT name,nickname,sex,school,major,grade,star FROM record WHERE checked = 1";
			$result = mysql_query($sql, $con);
			$cnt = 1;
			while($row = mysql_fetch_array($result)){
				//row[0]:name row[1]:nickname row[2]:sex row[3]:school row[4]:major row[5]:grade row[6]:star
				echo "<tr>";
					echo "<td>$cnt</td>"; $cnt += 1;
					echo "<td>$row[0]</td>";
					echo "<td>$row[1]</td>";
					echo "<td>$row[2]</td>";
					echo "<td>$row[3]</td>";
					echo "<td>$row[4]</td>";
					echo "<td>$row[5]</td>";
					if($row[6] == 1) echo "<td>*</td>";
					else echo "<td></td>";
				echo "</tr>";
			}
            echo "</tbody>";
			?>
          </table>
    </DIV>
	<DIV class=mastfoot>
	<DIV class=inner>
		<P>Cover template for <span style="color:#E0EEE0">Bootstrap</span>. Powered by <span style="color:#E0EEE0">@lyminghao</span>.</P>
    </DIV>
    </DIV>
    </DIV>
    </DIV>
    </DIV>
	<SCRIPT src="js/jquery.min.js"></SCRIPT>
	<SCRIPT src="js/bootstrap.min.js"></SCRIPT>
	<SCRIPT src="js/docs.min.js"></SCRIPT>
</BODY>
</HTML>