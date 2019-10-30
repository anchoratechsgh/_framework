<!DOCTYPE html>
<html lang="en">
<head>
<title>Connection Down</title>
<style type="text/css">
::selection {
	background-color: #E13300;
	color: white;
}
::moz-selection {
background-color: #E13300;
color: white;
}
::webkit-selection {
background-color: #E13300;
color: white;
}
body {
	background-color: #eee;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}
a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}
h1{
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}
code{
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}
#container {
	margin: 0px auto;
	border: 1px solid #D0D0D0;
	border-radius:3px;
	text-align:center;
	width:45%;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
	background: #fff;
	margin-top: 10%;
}
p {
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
<div id="container">
  <?php
		echo '<h1>Connection Down</h1>';
		echo '<p><span> Sorry connection is currently down.<br />' . "\r\n";
		echo 'Please try again later.</span> <br/>' . "\r\n";
		echo ERROR == TRUE?'<x style="color:red;">'.Session::get('err').'</x></p>':'';
		Session::del('err');
  ?>
</div>
</body>
</html>
