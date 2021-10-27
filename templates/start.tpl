<!DOCTYPE html>
<html>
	<head>
		<title>[@template_title]</title>
		<meta name='product'					content='[@meta_product]' />
		<meta name='version'					content='[@meta_version]' />
		<meta name='copyright'					content='[@meta_copyright]' />
		<meta name='author'						content='[@meta_author]' />
		<meta name='contact'					content='[@meta_contact]' />
		<meta name='distribution'				content='[@meta_distribution]' />
		<meta name='robots'						content='[@meta_robots]' />
		<meta http-equiv='Content-Type'			content='[@meta_content_type]'/>
		<meta http-equiv='content-language'		content='[@meta_content_language]' />
		<meta http-equiv='content-style-type'	content='[@meta_content_style]' />
		<meta http-equiv='X-UA-Compatible'		content='[@meta_xua]'/>
		<link rel='stylesheet' type='text/css' href='[@meta_css]' media='all' />
	</head>
	<body>
		<div class='body'></div>
		<div class='grad'></div>
		<div class='header'>
			<div>[@label_product]</div>
		</div>
		<div class='footer'>[@label_version]</div>
		<div class='login'>
			<form method='post' action='index.php'>
				<input type='hidden' name='action' value='process'>
				<input type='text' placeholder='[@label_github_project]' name='github_project'><br>
				<input type='submit' value='[@label_start]'>
			</form>
			<form method='post' action='index.php'>
				<input type='hidden' name='action' value='help'>
				<input type='submit' value='[@label_help]'>
			</form>
			<center>
				<br />
				<br />
				<br />
				Developed with &#x2764; on
				<br />
				<br />
				<img src='images/html5.png' title='HTML 5'>&nbsp;
				<img src='images/js.png' title='JavaScript'>&nbsp;
				<img src='images/php.png' title='PHP'>&nbsp;
				<img src='images/mysql.png' title='MySQL'>&nbsp;
				<img src='images/css3.png' title='CSS 3'>
				<br />
				<br />
				Source code and contact information at
				<br />
				<br />
				<a href='https://github.com/zozas'><img src='images/github.png' title='Github'></a>
			</center>
		</div>
	</body>
</html>
