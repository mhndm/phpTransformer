<?php
// get words from programs containers
//$data = strip_tags($ProgCont). (SiteKeywords);

/***** alt text from img *******/
$theALTtext ='';
$img = array();
preg_match_all('/<img[^>]+>/i',$ProgCont, $result);
foreach( $result[0] as $img_tag) {
    preg_match_all('/(alt)=("[^"]*")/i',$img_tag, $I);
    preg_match_all("/(alt)=('[^']*')/i",$img_tag, $J);
    if(isset($I[2][0])) {
        if($I[2][0]!=null) {
            $theALTtext .= $I[2][0].' ';
        }
    }
    if(isset($J[2][0])) {
        if($J[2][0]!=null) {
            $theALTtext .= $J[2][0].' ';
        }
    }

}
$theALTtext = str_replace('"',' ',$theALTtext );
$theALTtext = str_replace("'",' ',$theALTtext );
/***** end alt text from img *******/

$data = $ProgCont.' '.$theALTtext;

//$data = html_entity_decode($data );

$search = array("'<script[^>]*?>.*?</script>'si",	// strip out javascript
        "'<[\/\!]*?[^<>]*?>'si",			// strip out html tags
        "'([\r\n])[\s]+'",					// strip out white space
        "'&(quot|#34|#034|#x22);'i",		// replace html entities
        "'&(amp|#38|#038|#x26);'i",			// added hexadecimal values
        "'&(lt|#60|#060|#x3c);'i",
        "'&(gt|#62|#062|#x3e);'i",
        "'&(nbsp|#160|#xa0);'i",
        "'&(iexcl|#161);'i",
        "'&(cent|#162);'i",
        "'&(pound|#163);'i",
        "'&(copy|#169);'i",
        "'&(reg|#174);'i",
        "'&(deg|#176);'i",
        "'&(#39|#039|#x27);'",
        "'&(euro|#8364);'i",				// europe
        "'&a(uml|UML);'",					// german
        "'&o(uml|UML);'",
        "'&u(uml|UML);'",
        "'&A(uml|UML);'",
        "'&O(uml|UML);'",
        "'&U(uml|UML);'",
        "'&szlig;'i",
);
$replace = array(	"",
        "",
        "\\1",
        "\"",
        "&",
        "<",
        ">",
        " ",
        chr(161),
        chr(162),
        chr(163),
        chr(169),
        chr(174),
        chr(176),
        chr(39),
        chr(128),
        "�",
        "�",
        "�",
        "�",
        "�",
        "�",
        "�",
);

$dataDescription = $ProgCont;
$dataDescription = preg_replace($search,$replace,$dataDescription);
$MetaDescription = mb_substr($theALTtext,0,100,"utf8");

$MetaDescription .= mb_substr($dataDescription,0,(200-(strlen($MetaDescription))),"utf8");
$MetaDescription = str_replace('"','',$MetaDescription );
$MetaDescription = str_replace("'",'',$MetaDescription );
$MetaDescription = str_replace("	",'',$MetaDescription );
$MetaDescription = str_replace("\n",' ',$MetaDescription );
$MetaDescription = str_replace("\t",' ',$MetaDescription );
$MetaDescription = str_replace("\r",' ',$MetaDescription );
$MetaDescription = str_replace("\0",' ',$MetaDescription );
$MetaDescription = str_replace("\x0B",' ',$MetaDescription );
$MetaDescription = str_replace("\x0B",' ',$MetaDescription );
$MetaDescription = str_replace("&gt;",' ',$MetaDescription );
$MetaDescription = str_replace(">",' ',$MetaDescription );
$MetaDescription = str_replace("&lt;",' ',$MetaDescription );
$MetaDescription = str_replace("<",' ',$MetaDescription );
//$MetaDescription = str_replace("/",'%2E',$MetaDescription );
$MetaDescription = str_replace("\\",' ',$MetaDescription );
$MetaDescription = str_replace("=",' ',$MetaDescription );
$MetaDescription = str_replace("@",' (at) ',$MetaDescription );
//remove duplicate words

$MetaDescription = explode(" ", $MetaDescription);
$MetaDescription = array_unique($MetaDescription);
$MetaDescription = implode(" ", $MetaDescription);


//this the actual application.
include('includes/class.autokeyword.php');
$params['content'] = $data; //page content
//set the length of keywords you like
$params['min_word_length'] = 3;  //minimum length of single words
$params['min_word_occur'] = 2;  //minimum occur of single words
$params['min_2words_length'] = 3;  //minimum length of words for 2 word phrases
$params['min_2words_phrase_length'] = 10; //minimum length of 2 word phrases
$params['min_2words_phrase_occur'] = 2; //minimum occur of 2 words phrase
$params['min_3words_length'] = 3;  //minimum length of words for 3 word phrases
$params['min_3words_phrase_length'] = 10; //minimum length of 3 word phrases
$params['min_3words_phrase_occur'] = 2; //minimum occur of 3 words phrase
$keyword = new autokeyword($params, "utf-8");
$SeoKeywords = $keyword->parse_words();

?>