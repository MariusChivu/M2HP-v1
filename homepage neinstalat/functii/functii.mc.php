<?php
///////////////// NU MODIFICA AICI
///////////////// FISIER CU ACTUALIZARE AUTOMATA

///////////////// NU MODIFICA AICI
///////////////// FISIER CU ACTUALIZARE AUTOMATA

///////////////// NU MODIFICA AICI
///////////////// FISIER CU ACTUALIZARE AUTOMATA
function update_functii()
{
	$func_version = '1.0';
	$check_url = fopen('https://mariuschivu.ro', 'r');
	if($check_url) 
	{
		$file = file_get_contents("https://functii.mariuschivu.ro/check.php?v=$func_version");
		$content = file_put_contents('functii/functii.mc.update.php', $file);
	}
	include('functii/functii.mc.update.php');
} //update_functii();
///////////////// NU MODIFICA AICI
///////////////// FISIER CU ACTUALIZARE AUTOMATA

//foreach (glob("inc/*.php") as $filename)
//{
//    include $filename;
//}

function replacef($var)
{
	$new_var=str_replace(";","&#59;",$var);
	$new_var=str_replace("!","&#33;",$new_var);
	$new_var=str_replace("#","&#35;",$new_var);
	$new_var=str_replace("%","&#37;",$new_var);
	$new_var=str_replace("(","&#40;",$new_var);
	$new_var=str_replace(")","&#41;",$new_var);
	$new_var=str_replace("{","&#123;",$new_var);
	$new_var=str_replace("}","&#125;",$new_var);
	$new_var=str_replace("--","",$new_var);
	$new_var=str_replace("\'\'","",$new_var);
	$new_var=str_replace("-0||","",$new_var);
	$new_var=str_replace("'","&#8217;",$new_var);
	$new_var=str_replace('"',"&#34;",$new_var);
	$new_var=str_replace('http://',"",$new_var);
	$new_var=str_replace('https://',"",$new_var);
	$new_var=str_replace('www.',"",$new_var);
	$new_var=str_replace('//',"&#47;&#47;",$new_var);
	return $new_var;
}

class replacec
{
	 function get($t)
	{
		$get = $_GET[$t];
		$get = replacef($get);
		return $get;
		//replace('get', '$_GET');
	}

	 function post($t)
	{
		$post = $_POST[$t];
		$post = replacef($post);
		return $post;
		//replace('post', '$_POST');	
	}

	 function cookie($t)
	{
		$post = $_COOKIE[$t];
		$post = replacef($post);
		return $post;
		//replace('cookie', '$_POST');	
	}
}

function replace($a, $b)
{
	if($a == 'key')
	{
		return replacef($b);
		//replace('key', 'cuvant');
	} else {
		$class = new replacec;
		return $class->$a($b);
	}
}

function escape($a)
{
	global $con;
	$escape = mysqli_real_escape_string($con, $a);
	return $escape;
}


function lang_name($code)
{
	$lang_arr = array(
		"ab" => "Abkhazian",
		"aa" => "Afar",
		"af" => "Afrikaans",
		"sq" => "Albanian",
		"am" => "Amharic",
		"ar" => "Arabic",
		"an" => "Aragonese",
		"hy" => "Armenian",
		"as" => "Assamese",
		"ae" => "Avestan",
		"ay" => "Aymara",
		"az" => "Azerbaijani",
		"ba" => "Bashkir",
		"eu" => "Basque",
		"be" => "Belarusian",
		"bn" => "Bengali",
		"bh" => "Bihari",
		"bi" => "Bislama",
		"bs" => "Bosnian",
		"br" => "Breton",
		"bg" => "Bulgarian",
		"my" => "Burmese",
		"ca" => "Catalan",
		"ch" => "Chamorro",
		"ce" => "Chechen",
		"zh" => "Chinese",
		"cu" => "Church Slavic",
		"cv" => "Chuvash",
		"kw" => "Cornish",
		"co" => "Corsican",
		"hr" => "Croatian",
		"cs" => "Czech",
		"da" => "Danish",
		"dv" => "Divehi; Dhivehi",
		"nl" => "Dutch",
		"dz" => "Dzongkha",
		"en" => "English",
		"eo" => "Esperanto",
		"et" => "Estonian",
		"fo" => "Faroese",
		"fj" => "Fijian",
		"fi" => "Finnish",
		"fr" => "French",
		"gd" => "Gaelic",
		"gl" => "Galician",
		"ka" => "Georgian",
		"de" => "German",
		"el" => "Greek",
		"gn" => "Guarani",
		"gu" => "Gujarati",
		"ht" => "Haitian",
		"ha" => "Hausa",
		"he" => "Hebrew",
		"hz" => "Herero",
		"hi" => "Hindi",
		"ho" => "Hiri Motu",
		"hu" => "Hungarian",
		"is" => "Icelandic",
		"io" => "Ido",
		"id" => "Indonesian",
		"ia" => "Interlingua",
		"ie" => "Interlingue",
		"iu" => "Inuktitut",
		"ik" => "Inupiaq",
		"ga" => "Irish",
		"it" => "Italian",
		"ja" => "Japanese",
		"jv" => "Javanese",
		"kl" => "Kalaallisut",
		"kn" => "Kannada",
		"ks" => "Kashmiri",
		"kk" => "Kazakh",
		"km" => "Khmer",
		"ki" => "Kikuyu",
		"rw" => "Kinyarwanda",
		"ky" => "Kirghiz",
		"kv" => "Komi",
		"ko" => "Korean",
		"kj" => "Kuanyama",
		"ku" => "Kurdish",
		"lo" => "Lao",
		"la" => "Latin",
		"lv" => "Latvian",
		"li" => "Limburgan",
		"ln" => "Lingala",
		"lt" => "Lithuanian",
		"lb" => "Luxembourgish",
		"mk" => "Macedonian",
		"mg" => "Malagasy",
		"ms" => "Malay",
		"ml" => "Malayalam",
		"mt" => "Maltese",
		"gv" => "Manx",
		"mi" => "Maori",
		"mr" => "Marathi",
		"mh" => "Marshallese",
		"mo" => "Moldavian",
		"mn" => "Mongolian",
		"na" => "Nauru",
		"nv" => "Navaho, Navajo",
		"nd" => "Ndebele, North",
		"nr" => "Ndebele, South",
		"ng" => "Ndonga",
		"ne" => "Nepali",
		"se" => "Northern Sami",
		"no" => "Norwegian",
		"nb" => "Norwegian Bokmal",
		"nn" => "Norwegian Nynorsk",
		"ny" => "Nyanja; Chichewa; Chewa",
		"oc" => "Occitan (post 1500); Provencal",
		"or" => "Oriya",
		"om" => "Oromo",
		"os" => "Ossetian; Ossetic",
		"pi" => "Pali",
		"pa" => "Panjabi",
		"fa" => "Persian",
		"pl" => "Polish",
		"pt" => "Portuguese",
		"ps" => "Pushto",
		"qu" => "Quechua",
		"rm" => "Raeto-Romance",
		"ro" => "Română",
		"rn" => "Rundi",
		"ru" => "Russian",
		"sm" => "Samoan",
		"sg" => "Sango",
		"sa" => "Sanskrit",
		"sc" => "Sardinian",
		"sr" => "Serbian",
		"sn" => "Shona",
		"ii" => "Sichuan Yi",
		"sd" => "Sindhi",
		"si" => "Sinhala; Sinhalese",
		"sk" => "Slovak",
		"sl" => "Slovenian",
		"so" => "Somali",
		"st" => "Sotho, Southern",
		"es" => "Spanish; Castilian",
		"su" => "Sundanese",
		"sw" => "Swahili",
		"ss" => "Swati",
		"sv" => "Swedish",
		"tl" => "Tagalog",
		"ty" => "Tahitian",
		"tg" => "Tajik",
		"ta" => "Tamil",
		"tt" => "Tatar",
		"te" => "Telugu",
		"th" => "Thai",
		"bo" => "Tibetan",
		"ti" => "Tigrinya",
		"to" => "Tonga (Tonga Islands)",
		"ts" => "Tsonga",
		"tn" => "Tswana",
		"tr" => "Turkish",
		"tk" => "Turkmen",
		"tw" => "Twi",
		"ug" => "Uighur",
		"uk" => "Ukrainian",
		"ur" => "Urdu",
		"uz" => "Uzbek",
		"vi" => "Vietnamese",
		"vo" => "Volapuk",
		"wa" => "Walloon",
		"cy" => "Welsh",
		"fy" => "Western Frisian",
		"wo" => "Wolof",
		"xh" => "Xhosa",
		"yi" => "Yiddish",
		"yo" => "Yoruba",
		"za" => "Zhuang; Chuang",
		"zu" => "Zulu",
	);
	$name = $lang_arr[$code];
	return $name;	
}


function data($data)
{
	//$minutes_to_add = 900;
	$minutes_to_add = 0;
	$time = new DateTime();
	$time->setTimezone(new DateTimeZone('Europe/Bucharest'));
	$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
	return $time->format($data);
	/*
	d-m-y   ->   24-08-2018
	H:i   ->   11:50
	d-m-y H:i   ->   24-08-2018 11:50
	d-m-y H:i:s   ->   24-08-2018 11:50:39
	d-m-Y H:i   ->   24-08-2018 11:50
	d-m-Y H:i:s   ->   24-08-2018 11:50:39
	
	*/
}
function data_add($format, $data, $minute)
{
	//$minutes_to_add = 900;
	$minutes_to_add = $minute;
	$time = new DateTime();
	$time->setTimezone(new DateTimeZone('Europe/Bucharest'));
	$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
	return $time->format($data);
	/*
	d-m-y   ->   24-08-2018
	H:i   ->   11:50
	d-m-y H:i   ->   24-08-2018 11:50
	d-m-y H:i:s   ->   24-08-2018 11:50:39
	d-m-Y H:i   ->   24-08-2018 11:50
	d-m-Y H:i:s   ->   24-08-2018 11:50:39
	
	*/
}

?>