<?php
	// Initialize
	session_start();
	set_time_limit(0);
	ini_set('max_execution_time', '-1');
	ini_set('memory_limit', '-1');
	error_reporting(-1);
	ini_set("display_errors", true);	
	// Initialize error message variable
	$login_error = "";
	// Include application libraries
	require_once('./includes/files.php');
	require_once('./includes/ini.php');
	require_once('./includes/lint.php');
	require_once('./includes/scrapper.php');
	require_once('./includes/session.php');
	require_once('./includes/template.php');
	// Load application configuration file
	$config_application = new ini;
	$config_application->open('./config/application.ini.php');
	$config_application->read();
	// Load language configuration file
	$config_language = new ini;
	$config_language->open('./config/language.ini.php');
	$config_language->read();
	// Load template management
	$config_page_template = new template;
	// Initialize actions
	$action = '';
	if (isset($_POST['action']))
		$action = $_POST['action'];
	else
		if (isset($_GET['action']))
			$action = $_GET['action'];
	if ($action=='process') {
		if (ob_get_level() == 0) ob_start();
		$PROJECT_URL = '';
		if (isset($_POST['github_project']))
			$PROJECT_URL = $_POST['github_project'];
		else
			if (isset($_GET['github_project']))
				$PROJECT_URL = $_GET['github_project'];
		if ($PROJECT_URL == '')
			echo "<script>window.location = 'index.php';</script>";
		echo $config_language->get('PROCESS', 'P000')." (".$PROJECT_URL.")...";
		ob_flush(); flush();
		echo "<b>&#10003;</b><br />";
		ob_flush(); flush();
		$filesystem = new files;
		$lint = new lint;
		echo $config_language->get('PROCESS', 'P001')."...";
		ob_flush(); flush();
		$PROJECT_ARCHIVE = $config_application->get('PATHS', 'PROJECTS')."master.zip";
		$PROJECT_DESTINATION = $config_application->get('PATHS', 'PROJECTS')."master";
		$DATA_TOTAL_LINES = 0;
		$DATA_EMPTY_LINES = 0;
		$DATA_COMMENT_LINES = 0;
		$DATA_FILES = 0;
		$DATA_NONJS_FILES = 0;
		$DATA_NEW_KEYWORD = 0;
		$DATA_WITH_KEYWORD = 0;
		$DATA_LOOPS = 0;
		$DATA_SIZE = 0;
		$DATA_NOC = 0;
		$DATA_NOM = 0;
		$DATA_PARM = 0;
		$DATA_HPL = 0;
		$DATA_CSMELLS = 0;
		$DATA_CURRENT = array();
		echo "<b>&#10003;</b><br />";
		ob_flush(); flush();
		echo $config_language->get('PROCESS', 'P002')."...";
		ob_flush(); flush();
		// Load template
		$config_page_template->open('.'.$config_application->get('PATHS', 'TEMPLATES').'process.tpl');
		$config_page_template->set('meta_css', $config_application->get('STYLE', 'RESULTS'));
		$config_page_template->set('meta_version', $config_application->get('METATAGS', 'VERSION'));
		$config_page_template->set('label_product', $config_application->get('METATAGS', 'DEPLOYMENT')."<span>".$config_application->get('METATAGS', 'PRODUCT')."</span>");
		$config_page_template->set('meta_content_style', $config_application->get('METATAGS', 'TYPE'));
		$config_page_template->set('meta_xua', $config_application->get('METATAGS', 'XUA'));	
		$config_page_template->set('meta_content_type', $config_language->get('CONFIG', 'CHARSET'));
		$config_page_template->set('meta_content_language', $config_language->get('CONFIG', 'CODE'));
		$config_page_template->set('meta_robots', $config_application->get('METATAGS', 'ROBOTS'));
		$config_page_template->set('meta_distribution', $config_application->get('METATAGS', 'DISTRIBUTION'));
		$config_page_template->set('meta_copyright', $config_application->get('METATAGS', 'COPYRIGHT'));
		$config_page_template->set('meta_author', $config_application->get('METATAGS', 'AUTHOR'));
		$config_page_template->set('meta_contact', $config_application->get('METATAGS', 'CONTACT'));
		$config_page_template->set('template_title', $config_application->get('METATAGS', 'TITLE')."@".$config_application->get('METATAGS', 'DEPLOYMENT'));
		$config_page_template->set('meta_product', $config_application->get('METATAGS', 'PRODUCT'));
		echo "<b>&#10003;</b><br />";
		ob_flush(); flush();
		echo $config_language->get('PROCESS', 'P003')."...";
		ob_flush(); flush();
		file_put_contents($PROJECT_ARCHIVE, file_get_contents($PROJECT_URL));
		if (is_dir($PROJECT_DESTINATION)) {
			$filesystem->remove_directory($PROJECT_DESTINATION);
		}
		echo "<b>&#10003;</b><br />";
		ob_flush(); flush();
		echo $config_language->get('PROCESS', 'P004')."...";
		ob_flush(); flush();
		$zipArchive = new ZipArchive();
		$result = $zipArchive->open($PROJECT_ARCHIVE);
		if ($result === TRUE) {
			$zipArchive ->extractTo($PROJECT_DESTINATION);
			$zipArchive ->close();
		}
		echo "<b>&#10003;</b><br />";
		ob_flush(); flush();
		echo $config_language->get('PROCESS', 'P005')."...";
		ob_flush(); flush();
		$file_array = array();
		$i = -1;
		$it = new RecursiveDirectoryIterator($PROJECT_DESTINATION);
		$allowed=array('js');
		foreach(new RecursiveIteratorIterator($it) as $file) {
			if(in_array(substr($file, strrpos($file, '.') + 1),$allowed)) {
				$i = $i + 1;
				$file_array[$i] = $file;
			} else {
				$DATA_NONJS_FILES = $DATA_NONJS_FILES + 1;
			}
		}
		$DATA_FILES = sizeof($file_array);
		echo "<b>&#10003;</b><br />";
		ob_flush(); flush();
		for($j=0; $j <= $i; $j = $j + 1) {
			echo $config_language->get('PROCESS', 'P006').$j." ".$config_language->get('STRING', 'OF')." ".$DATA_FILES." (".$file_array[$j].")...";
			ob_flush(); flush();
			$handle = fopen($file_array[$j], "r");
			$DATA_CURRENT[$j]['FILE_NAME'] = strval($file_array[$j]);
			$DATA_CURRENT_TOTAL_LINES = 0;
			$DATA_CURRENT_EMPTY_LINES = 0;
			$DATA_CURRENT_SIZE = 0;
			$DATA_CURRENT_COMMENT_LINES = 0;
			$DATA_CURRENT_NEW_KEYWORD = 0;
			$DATA_CURRENT_WITH_KEYWORD = 0;
			$DATA_CURRENT_LOOPS = 0;
			$DATA_CURRENT_NOC = 0;
			$DATA_CURRENT_NOM = 0;
			$DATA_CURRENT_PARM = 0;	
			$DATA_CURRENT_HPL = 0;
			$DATA_CURRENT_CSMELLS = 0;
			if ($handle) {
				$DATA_CURRENT_SIZE = filesize($file_array[$j]);
				while (($line = fgets($handle)) !== false) {
					$DATA_CURRENT_TOTAL_LINES = $DATA_CURRENT_TOTAL_LINES + 1;
					if (strlen($line) < 2) {
						$DATA_CURRENT_EMPTY_LINES = $DATA_CURRENT_EMPTY_LINES + 1;
					} else {
						if ($lint->count_comment($line)) {
							$DATA_CURRENT_COMMENT_LINES = $DATA_CURRENT_COMMENT_LINES + 1;
						} else {
							$DATA_CURRENT_NEW_KEYWORD = $DATA_CURRENT_NEW_KEYWORD + $lint->count_keyword($line, "new");
							$DATA_CURRENT_WITH_KEYWORD = $DATA_CURRENT_WITH_KEYWORD + $lint->count_keyword($line, "with");
							$DATA_CURRENT_LOOPS = $DATA_CURRENT_LOOPS + $lint->count_keyword($line, "for");
							$DATA_CURRENT_LOOPS = $DATA_CURRENT_LOOPS + $lint->count_keyword($line, "while");
							$DATA_CURRENT_LOOPS = $DATA_CURRENT_LOOPS + $lint->count_keyword($line, "do");
							$DATA_CURRENT_NOC = $DATA_CURRENT_NOC + $lint->count_keyword($line, "class");
							$DATA_CURRENT_PARM = $DATA_CURRENT_PARM + $lint->count_parameters($line, "function");
							$DATA_CURRENT_NOM = $DATA_CURRENT_NOM + $lint->count_keyword($line, "={");
							$DATA_CURRENT_HPL = $DATA_CURRENT_HPL + $lint->count_halstead_opeators($line);
							$DATA_CURRENT_CSMELLS = $DATA_CURRENT_CSMELLS + $lint->count_smells($line);
						}
					}
				}
				fclose($handle);		
				$DATA_TOTAL_LINES  = $DATA_TOTAL_LINES + $DATA_CURRENT_TOTAL_LINES;
				$DATA_CURRENT[$j]['TOTAL_LINES'] = $DATA_CURRENT_TOTAL_LINES;
				$DATA_EMPTY_LINES = $DATA_EMPTY_LINES + $DATA_CURRENT_EMPTY_LINES;
				$DATA_CURRENT[$j]['EMPTY_LINES'] = $DATA_CURRENT_EMPTY_LINES;
				$DATA_SIZE = $DATA_SIZE + $DATA_CURRENT_SIZE;
				$DATA_CURRENT[$j]['SIZE'] = $DATA_CURRENT_SIZE;
				$DATA_COMMENT_LINES = $DATA_COMMENT_LINES + $DATA_CURRENT_COMMENT_LINES;
				$DATA_CURRENT[$j]['COMMENT_LINES'] = $DATA_CURRENT_COMMENT_LINES;
				$DATA_NEW_KEYWORD = $DATA_NEW_KEYWORD + $DATA_CURRENT_NEW_KEYWORD;
				$DATA_CURRENT[$j]['NEW_KEYWORD'] = $DATA_CURRENT_NEW_KEYWORD;
				$DATA_WITH_KEYWORD = $DATA_WITH_KEYWORD + $DATA_CURRENT_WITH_KEYWORD;
				$DATA_CURRENT[$j]['WITH_KEYWORD'] = $DATA_CURRENT_WITH_KEYWORD;
				$DATA_LOOPS = $DATA_LOOPS + $DATA_CURRENT_LOOPS;
				$DATA_CURRENT[$j]['LOOPS'] = $DATA_CURRENT_LOOPS;
				$DATA_NOC = $DATA_NOC + $DATA_CURRENT_NOC;
				$DATA_CURRENT[$j]['NOC'] = $DATA_CURRENT_NOC;
				$DATA_NOM = $DATA_NOM + $DATA_CURRENT_NOM;
				$DATA_CURRENT[$j]['NOM'] = $DATA_CURRENT_NOM;
				$DATA_PARM = $DATA_PARM + $DATA_CURRENT_PARM;
				$DATA_CURRENT[$j]['PARM'] = $DATA_CURRENT_PARM;		
				$DATA_HPL = ($DATA_HPL + $DATA_CURRENT_HPL)/$DATA_FILES;
				$DATA_CURRENT[$j]['HPL'] = $DATA_CURRENT_HPL;
				$DATA_CSMELLS = $DATA_CSMELLS + $DATA_CURRENT_CSMELLS;
				$DATA_CURRENT[$j]['CSMELLS'] = $DATA_CURRENT_CSMELLS;
			}
			echo "<b>&#10003;</b><br />";
			ob_flush(); flush();
		}
		echo $config_language->get('PROCESS', 'P007')."...";
		ob_flush(); flush();
		$DATA_HPL = $DATA_HPL + 1;
		$DATA_DEBT = 0;
		//Technical Debt Index =2.8209+0.3999×HPL-0.0004*FILES+0.0007×NEW-0.0007×NOM-0.0001×SWITH-0.0003×CSMEL+0.0001×SLOOPS-0.1294×PARM-〖2∙10〗^(-8)×SIZE-6∙10^(-4)  ×NOC
		$DATA_DEBT = $DATA_DEBT+2.8209;
		$DATA_DEBT = $DATA_DEBT+0.39999*$DATA_HPL;
		$DATA_DEBT = $DATA_DEBT-0.0004*$DATA_FILES;
		$DATA_DEBT = $DATA_DEBT+0.0007*$DATA_NEW_KEYWORD;
		$DATA_DEBT = $DATA_DEBT-0.0007*$DATA_NOM;
		$DATA_DEBT = $DATA_DEBT-0.0001*$DATA_WITH_KEYWORD;
		$DATA_DEBT = $DATA_DEBT-0.0003*$DATA_CSMELLS;
		$DATA_DEBT = $DATA_DEBT+0.0001*$DATA_LOOPS;
		$DATA_DEBT = $DATA_DEBT-0.1294*$DATA_PARM;
		$DATA_DEBT = $DATA_DEBT-0.00000002*$DATA_SIZE;
		$DATA_DEBT = $DATA_DEBT-0.0006*$DATA_NOC;
		echo "<b>&#10003;</b><br />";
		ob_flush(); flush();
		ob_end_flush();
		$config_page_template->set('label_project', $config_language->get('STRING', 'PROJECT'));
		$config_page_template->set('label_project_data', $PROJECT_URL);
		$config_page_template->set('label_empty_lines', $config_language->get('STRING', 'LINES_EMPTY'));
		$config_page_template->set('label_empty_lines_data', number_format($DATA_EMPTY_LINES));
		$config_page_template->set('label_comment_lines', $config_language->get('STRING', 'LINES_COMMENT'));
		$config_page_template->set('label_comment_lines_data', number_format($DATA_COMMENT_LINES));
		$config_page_template->set('label_total_lines', $config_language->get('STRING', 'LINES_TOTAL'));
		$config_page_template->set('label_total_lines_data', number_format($DATA_TOTAL_LINES));
		$config_page_template->set('label_files', $config_language->get('STRING', 'FILES'));
		$config_page_template->set('label_files_data', number_format($DATA_FILES));
		$config_page_template->set('label_jsfiles', $config_language->get('STRING', 'FILES_JS'));
		$config_page_template->set('label_jsfiles_data', number_format($DATA_NONJS_FILES));
		$config_page_template->set('label_new', $config_language->get('STRING', 'NEW'));
		$config_page_template->set('label_new_data', number_format($DATA_NEW_KEYWORD));
		$config_page_template->set('label_with', $config_language->get('STRING', 'WITH'));
		$config_page_template->set('label_with_data', number_format($DATA_WITH_KEYWORD));
		$config_page_template->set('label_loops', $config_language->get('STRING', 'LOOPS'));
		$config_page_template->set('label_loops_data', number_format($DATA_LOOPS));
		$config_page_template->set('label_size', $config_language->get('STRING', 'SIZE'));
		$config_page_template->set('label_size_data', number_format($DATA_SIZE));
		$config_page_template->set('label_noc', $config_language->get('STRING', 'NOC'));
		$config_page_template->set('label_noc_data', number_format($DATA_NOC));
		$config_page_template->set('label_nom', $config_language->get('STRING', 'NOM'));
		$config_page_template->set('label_nom_data', number_format($DATA_NOM));
		$config_page_template->set('label_parm', $config_language->get('STRING', 'PARAMETERS'));
		$config_page_template->set('label_parm_data', number_format($DATA_PARM));
		$config_page_template->set('label_hpl', $config_language->get('STRING', 'HPL'));
		$config_page_template->set('label_hpl_data', number_format($DATA_HPL, 6, '.', ''));
		$config_page_template->set('label_csmel', $config_language->get('STRING', 'CODE_SMELLS'));
		$config_page_template->set('label_csmel_data', number_format($DATA_CSMELLS));
		$config_page_template->set('label_td', $config_language->get('STRING', 'TD'));
		$config_page_template->set('label_td_data', number_format($DATA_DEBT, 6, '.', ''));
		$config_page_template->set('label_return', $config_language->get('STRING', 'RETURN'));
		$output_result = "";
		for($j=0; $j < sizeof($DATA_CURRENT); $j = $j + 1) {
			$DATA_CURRENT_DEBT = 2.8209+0.39999*$DATA_CURRENT[$j]['HPL']-0.0004*$DATA_FILES+0.0007*$DATA_CURRENT[$j]['NEW_KEYWORD']-0.0007*$DATA_CURRENT[$j]['NOM']-0.0001*$DATA_CURRENT[$j]['WITH_KEYWORD']-0.0003*$DATA_CURRENT[$j]['CSMELLS']+0.0001*$DATA_CURRENT[$j]['LOOPS']-0.1294*$DATA_CURRENT[$j]['PARM']-0.00000002*$DATA_CURRENT[$j]['SIZE']-0.0006*$DATA_CURRENT[$j]['NOC'];
			$output_result = $output_result."<tr><td width='30px'>".$DATA_CURRENT[$j]['FILE_NAME']."</td><td>".number_format($DATA_CURRENT[$j]['TOTAL_LINES'])."</td><td>".number_format($DATA_CURRENT[$j]['EMPTY_LINES'])."</td><td>".number_format($DATA_CURRENT[$j]['SIZE'])."</td><td>".number_format($DATA_CURRENT[$j]['COMMENT_LINES'])."</td><td>".number_format($DATA_CURRENT[$j]['NEW_KEYWORD'])."</td><td>".number_format($DATA_CURRENT[$j]['WITH_KEYWORD'])."</td><td>".number_format($DATA_CURRENT[$j]['LOOPS'])."</td><td>".number_format($DATA_CURRENT[$j]['NOC'])."</td><td>".number_format($DATA_CURRENT[$j]['NOM'])."</td><td>".number_format($DATA_CURRENT[$j]['PARM'])."</td><td>".number_format($DATA_CURRENT[$j]['HPL'], 6, '.', '')."</td><td>".number_format($DATA_CURRENT[$j]['CSMELLS'])."</td><td>".number_format($DATA_CURRENT_DEBT, 6, '.', '')."</td></tr>";
		}
		$config_page_template->set('results_per_file', $output_result);
	} else if ($action=='help') {
		$config_page_template->open('.'.$config_application->get('PATHS', 'TEMPLATES').'help.tpl');
		$config_page_template->set('meta_css', $config_application->get('STYLE', 'CSS'));
		$config_page_template->set('meta_version', $config_application->get('METATAGS', 'VERSION'));
		$config_page_template->set('label_product', $config_application->get('METATAGS', 'DEPLOYMENT')."<span>".$config_application->get('METATAGS', 'PRODUCT')."</span>");
		$config_page_template->set('meta_content_style', $config_application->get('METATAGS', 'TYPE'));
		$config_page_template->set('meta_xua', $config_application->get('METATAGS', 'XUA'));	
		$config_page_template->set('meta_content_type', $config_language->get('CONFIG', 'CHARSET'));
		$config_page_template->set('meta_content_language', $config_language->get('CONFIG', 'CODE'));
		$config_page_template->set('meta_robots', $config_application->get('METATAGS', 'ROBOTS'));
		$config_page_template->set('meta_distribution', $config_application->get('METATAGS', 'DISTRIBUTION'));
		$config_page_template->set('meta_copyright', $config_application->get('METATAGS', 'COPYRIGHT'));
		$config_page_template->set('meta_author', $config_application->get('METATAGS', 'AUTHOR'));
		$config_page_template->set('meta_contact', $config_application->get('METATAGS', 'CONTACT'));
		$config_page_template->set('template_title', $config_application->get('METATAGS', 'TITLE')."@".$config_application->get('METATAGS', 'DEPLOYMENT'));
		$config_page_template->set('meta_product', $config_application->get('METATAGS', 'PRODUCT'));
		$config_page_template->set('label_version', $config_application->get('METATAGS', 'TITLE')."<br>v.".$config_application->get('METATAGS', 'VERSION'));
		$config_page_template->set('label_start', $config_language->get('STRING', 'START_PROCESS'));
		$config_page_template->set('label_help', $config_language->get('STRING', 'HELP'));
		$config_page_template->set('label_github_project', $config_language->get('STRING', 'GITHUB_PROJECT'));
		$config_page_template->set('label_return', $config_language->get('STRING', 'RETURN'));
		$config_page_template->set('label_help', $config_language->get('STRING', 'HELP'));
		$config_page_template->set('label_help_data', $config_language->get('STRING', 'HELP_INFO'));
	} else {
		// Initialize templates
		$config_page_template->open('.'.$config_application->get('PATHS', 'TEMPLATES').'start.tpl');
		$config_page_template->set('meta_css', $config_application->get('STYLE', 'CSS'));
		$config_page_template->set('meta_version', $config_application->get('METATAGS', 'VERSION'));
		$config_page_template->set('label_product', $config_application->get('METATAGS', 'DEPLOYMENT')."<span>".$config_application->get('METATAGS', 'PRODUCT')."</span>");
		$config_page_template->set('meta_content_style', $config_application->get('METATAGS', 'TYPE'));
		$config_page_template->set('meta_xua', $config_application->get('METATAGS', 'XUA'));	
		$config_page_template->set('meta_content_type', $config_language->get('CONFIG', 'CHARSET'));
		$config_page_template->set('meta_content_language', $config_language->get('CONFIG', 'CODE'));
		$config_page_template->set('meta_robots', $config_application->get('METATAGS', 'ROBOTS'));
		$config_page_template->set('meta_distribution', $config_application->get('METATAGS', 'DISTRIBUTION'));
		$config_page_template->set('meta_copyright', $config_application->get('METATAGS', 'COPYRIGHT'));
		$config_page_template->set('meta_author', $config_application->get('METATAGS', 'AUTHOR'));
		$config_page_template->set('meta_contact', $config_application->get('METATAGS', 'CONTACT'));
		$config_page_template->set('template_title', $config_application->get('METATAGS', 'TITLE')."@".$config_application->get('METATAGS', 'DEPLOYMENT'));
		$config_page_template->set('meta_product', $config_application->get('METATAGS', 'PRODUCT'));
		$config_page_template->set('label_version', $config_application->get('METATAGS', 'TITLE')."<br>v.".$config_application->get('METATAGS', 'VERSION'));
		$config_page_template->set('label_start', $config_language->get('STRING', 'START_PROCESS'));
		$config_page_template->set('label_help', $config_language->get('STRING', 'HELP'));
		$config_page_template->set('label_github_project', $config_language->get('STRING', 'GITHUB_PROJECT'));
	}
	echo $config_page_template->get();
?>
