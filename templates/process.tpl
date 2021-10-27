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
		<div class='login'>
			<table>
				<tr><td>[@label_project]</td><td>: [@label_project_data]</td></tr>
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr><td>[@label_files]</td><td>: [@label_files_data]</td></tr>
				<tr><td>[@label_jsfiles]</td><td>: [@label_jsfiles_data]</td></tr>
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr><td>[@label_comment_lines]</td><td>: [@label_comment_lines_data]</td></tr>
				<tr><td>[@label_empty_lines]</td><td>: [@label_empty_lines_data]</td></tr>
				<tr><td>[@label_total_lines]</td><td>: [@label_total_lines_data]</td></tr>
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr><td>[@label_new]</td><td>: [@label_new_data]</td></tr>
				<tr><td>[@label_with]</td><td>: [@label_with_data]</td></tr>
				<tr><td>[@label_loops]</td><td>: [@label_loops_data]</td></tr>
				<tr><td>[@label_size]</td><td>: [@label_size_data]</td></tr>
				<tr><td>[@label_noc]</td><td>: [@label_noc_data]</td></tr>
				<tr><td>[@label_nom]</td><td>: [@label_nom_data]</td></tr>
				<tr><td>[@label_parm]</td><td>: [@label_parm_data]</td></tr>
				<tr><td>[@label_hpl]</td><td>: [@label_hpl_data]</td></tr>
				<tr><td>[@label_csmel]</td><td>: [@label_csmel_data]</td></tr>
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr><td>[@label_td]</td><td>: [@label_td_data]</td></tr>
			</table>
			<form method='post' action='index.php'>
				<input type='submit' value='[@label_return]'>
			</form>
			<br />
			<table>
				<table><thead><td>[@label_files]</td><td>[@label_total_lines]</td><td>[@label_empty_lines]</td><td>[@label_size]</td><td>[@label_comment_lines]</td><td>[@label_new]</td><td>[@label_with]</td><td>[@label_loops]</td><td>[@label_noc]</td><td>[@label_nom]</td><td>[@label_parm]</td><td>[@label_hpl]</td><td>[@label_csmel]</td><td>[@label_td]</td></thead>
				[@results_per_file]
			</table>
			<form method='post' action='index.php'>
				<input type='submit' value='[@label_return]'>
			</form>
		</div>
	</body>
</html>
