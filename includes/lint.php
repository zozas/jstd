<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

class lint {
	public function test_line_for_indentation($line, $max_indentation_level) {
		$char_posit = 0;
		while(substr( $line, $char_posit, 1 ) == "\t")
			$char_posit++;
		if($char_posit > $max_indentation_level)
			return false;
		return true;
	}
	public function test_line_for_function_definition($line, $max_num_parameters) {
		if(substr($line, 0, 9) == "function ") {
			if(substr_count( $line, ',' ) >= $max_num_parameters)
				return false;
		}
		return true;
	}
	public function count_smells($line) {
		$csmells = 0;			
		$MAX_INDENTATION_LEVEL = 3;
		$MAX_FUNCTION_LINE_COUNT = 72;
		$MAX_NUM_PARAMETERS = 4;
		if((strlen($line) > $MAX_FUNCTION_LINE_COUNT) && (substr(trim($line), -1) == '.')) {
			// Too long lines
			$csmells = $csmells + 1;
		}						
		$result = $this->test_line_for_indentation($line, $MAX_INDENTATION_LEVEL);
		if(! $result) {
			// Too much nesting
			$csmells = $csmells + 1;
		}
		$result = $this->test_line_for_function_definition($line, $MAX_NUM_PARAMETERS);
		if(! $result) {
			// Too many parameters
			$csmells = $csmells + 1;
		}
		return $csmells;
	}
	public function count_keyword($line, $keyword) {
		$counter = 0;
		if (str_contains(strtolower(preg_replace('/\s+/', '', $line)), $keyword)) {
			$counter = $counter + 1;
		}
		return $counter;
	}
	public function count_parameters($line, $keyword) {
		if (str_contains(strtolower(preg_replace('/\s+/', '', $line)), $keyword)) {
			if ($this->count_keyword($keyword, '(') > 0) {
				if ($this->count_keyword($keyword, '()') == 0) {
					
					$function_token = explode('(', $keyword);
					$function_token = explode(')', $function_token[1]);
					return sizeof(explode(',', $function_token[0]));
					
				} else { return 0; }
			} else { return 0; }
		} else { return 0; }
	}
	public function count_halstead_opeators($line) {
		//$reserved_keyword = array('$','abstract','arguments','await','boolean','break','byte','case','catch','char','class','const','continue','debugger','default','delete','do','double','else','enum','eval','export','extends','false','final','finally','float','for','function','goto','if','implements','import','in','instanceof','int','interface','let','long','native','new','null','package','private','protected','public','return','short','static','super','switch','synchronized','this','throw','throws','transient','true','try','typeof','var','void','volatile','while','with','yield','bstract','boolean','byte','char','double','final','float','goto','int','long','native','short','synchronized','throws','transient','volatile','array','Date','eval','function','hasOwnProperty','Infinity','isFinite','isNaN','isPrototypeOf','length','Math','NaN','name','Number','Object','prototype','String','toString','undefined','valueOf','etClass','java','JavaArray','javaClass','JavaObject','JavaPackage','alert','all','anchor','anchors','area','assign','blur','button','checkbox','clearInterval','clearTimeout','clientInformation','close','closed','confirm','constructor','crypto','decodeURI','decodeURIComponent','defaultStatus','document','element','elements','embed','embeds','encodeURI','encodeURIComponent','escape','event','fileUpload','focus','form','forms','frame','innerHeight','innerWidth','layer','layers','link','location','mimeTypes','navigate','navigator','frames','frameRate','hidden','history','image','images','offscreenBuffering','open','opener','option','outerHeight','outerWidth','packages','pageXOffset','pageYOffset','parent','parseFloat','parseInt','password','pkcs11','plugin','prompt','propertyIsEnum','radio','reset','screenX','screenY','scroll','secure','select','self','setInterval','setTimeout','status','submit','taint','text','textarea','top','unescape','untaint','window','onblur','onclick','onerror','onfocus','onkeydown','onkeypress','onkeyup','onmouseover','onload','onmouseup','onmousedown','onsubmit');
		//$reserved_operators = array('+','-','*','//','%','++','--','=','+=','-=','*=','//=','%=','==','===','!=','!==','>','<','>=','<=','?','&&','||','!','&','|','~','^','<<','>>','typeof','delete','in','instanceof','void');
		//$reserved_operands = array('class','function','new','const','$','_');
		$reserved_keyword = array('$','abstract','arguments','await','boolean','break','byte','case','catch','char','class','const','continue','debugger','default','delete','do','double','else','enum','eval','export','extends','false','final','finally','float','for','function','goto','if','implements','import','in','instanceof','int','interface','let','long','native','new','null','package','private','protected','public','return','short','static','super','switch','synchronized','this','throw','throws','transient','true','try','typeof','var','void','volatile','while','with','yield','bstract','boolean','byte','char','double','final','float','goto','int','long','native','short','synchronized','throws','transient','volatile','array','Date','eval','function','hasOwnProperty','Infinity','isFinite','isNaN','isPrototypeOf','length','Math','NaN','name','Number','Object','prototype','String','toString','undefined','valueOf','etClass','java','JavaArray','javaClass','JavaObject','JavaPackage','alert','all','anchor','anchors','area','assign','blur','button','checkbox','clearInterval','clearTimeout','clientInformation','close','closed','confirm','constructor','crypto','decodeURI','decodeURIComponent','defaultStatus','document','element','elements','embed','embeds','encodeURI','encodeURIComponent','escape','event','fileUpload','focus','form','forms','frame','innerHeight','innerWidth','layer','layers','link','location','mimeTypes','navigate','navigator','frames','frameRate','hidden','history','image','images','offscreenBuffering','open','opener','option','outerHeight','outerWidth','packages','pageXOffset','pageYOffset','parent','parseFloat','parseInt','password','pkcs11','plugin','prompt','propertyIsEnum','radio','reset','screenX','screenY','scroll','secure','select','self','setInterval','setTimeout','status','submit','taint','text','textarea','top','unescape','untaint','window','onblur','onclick','onerror','onfocus','onkeydown','onkeypress','onkeyup','onmouseover','onload','onmouseup','onmousedown','onsubmit','+','-','*','%','=','>','<','?','&','!','&','|','~','^','typeof','delete','in','instanceof','void','class','function','new','const','_');
		$used = array();
		$used_count = 0;
		$HALSTEAD_DISTINCT_N = 0;
		$HALSTEAD_TOTAL = 0;			
		for($i = 0; $i < sizeof($reserved_keyword); $i++) {
			if (stripos($line, $reserved_keyword[$i]) !== false) {
				$HALSTEAD_TOTAL = $HALSTEAD_TOTAL + 1;
				if (!in_array($reserved_keyword[$i], $used)) {
					$used_count = $used_count + 1;
					$used[$used_count] = $reserved_keyword[$i];
				}
			}
		}
		if ($used_count == 0) $used_count = 1;
		$HALSTEAD_DISTINCT_N = $used_count;
		return $HALSTEAD_TOTAL*log($HALSTEAD_DISTINCT_N ,2);
	}
	function count_comment($line) {
		$line = trim($line);
		$first_two_chars = substr($line, 0, 2);
		$last_two_chars = substr($line, -2);
		return $first_two_chars == '//' || substr($line, 0, 1) == '#' || ($first_two_chars == '/*' && $last_two_chars == '*/');
	}
}

?>
