<?php
/*	Скрипт с веб-интерфейсом: поиск по UTF-8 символам.
	Позволяет составить php7 регулярку для найденных символов.
*/

// составлено на основе констант BLOCK_CODE_* из http://php.net/manual/en/class.intlchar.php
$types = array( 0 => 'NO BLOCK', 1 => 'BASIC LATIN', 2 => 'LATIN 1 SUPPLEMENT', 3 => 'LATIN EXTENDED A', 4 => 'LATIN EXTENDED B', 5 => 'IPA EXTENSIONS', 6 => 'SPACING MODIFIER LETTERS', 7 => 'COMBINING DIACRITICAL MARKS', 8 => 'GREEK', 9 => 'CYRILLIC', 10 => 'ARMENIAN', 11 => 'HEBREW', 12 => 'ARABIC', 13 => 'SYRIAC', 14 => 'THAANA', 15 => 'DEVANAGARI', 16 => 'BENGALI', 17 => 'GURMUKHI', 18 => 'GUJARATI', 19 => 'ORIYA', 20 => 'TAMIL', 21 => 'TELUGU', 22 => 'KANNADA', 23 => 'MALAYALAM', 24 => 'SINHALA', 25 => 'THAI', 26 => 'LAO', 27 => 'TIBETAN', 28 => 'MYANMAR', 29 => 'GEORGIAN', 30 => 'HANGUL JAMO', 31 => 'ETHIOPIC', 32 => 'CHEROKEE', 33 => 'UNIFIED CANADIAN ABORIGINAL SYLLABICS', 34 => 'OGHAM', 35 => 'RUNIC', 36 => 'KHMER', 37 => 'MONGOLIAN', 38 => 'LATIN EXTENDED ADDITIONAL', 39 => 'GREEK EXTENDED', 40 => 'GENERAL PUNCTUATION', 41 => 'SUPERSCRIPTS AND SUBSCRIPTS', 42 => 'CURRENCY SYMBOLS', 43 => 'COMBINING MARKS FOR SYMBOLS', 44 => 'LETTERLIKE SYMBOLS', 45 => 'NUMBER FORMS', 46 => 'ARROWS', 47 => 'MATHEMATICAL OPERATORS', 48 => 'MISCELLANEOUS TECHNICAL', 49 => 'CONTROL PICTURES', 50 => 'OPTICAL CHARACTER RECOGNITION', 51 => 'ENCLOSED ALPHANUMERICS', 52 => 'BOX DRAWING', 53 => 'BLOCK ELEMENTS', 54 => 'GEOMETRIC SHAPES', 55 => 'MISCELLANEOUS SYMBOLS', 56 => 'DINGBATS', 57 => 'BRAILLE PATTERNS', 58 => 'CJK RADICALS SUPPLEMENT', 59 => 'KANGXI RADICALS', 60 => 'IDEOGRAPHIC DESCRIPTION CHARACTERS', 61 => 'CJK SYMBOLS AND PUNCTUATION', 62 => 'HIRAGANA', 63 => 'KATAKANA', 64 => 'BOPOMOFO', 65 => 'HANGUL COMPATIBILITY JAMO', 66 => 'KANBUN', 67 => 'BOPOMOFO EXTENDED', 68 => 'ENCLOSED CJK LETTERS AND MONTHS', 69 => 'CJK COMPATIBILITY', 70 => 'CJK UNIFIED IDEOGRAPHS EXTENSION A', 71 => 'CJK UNIFIED IDEOGRAPHS', 72 => 'YI SYLLABLES', 73 => 'YI RADICALS', 74 => 'HANGUL SYLLABLES', 75 => 'HIGH SURROGATES', 76 => 'HIGH PRIVATE USE SURROGATES', 77 => 'LOW SURROGATES', 78 => 'PRIVATE USE', 79 => 'CJK COMPATIBILITY IDEOGRAPHS', 80 => 'ALPHABETIC PRESENTATION FORMS', 81 => 'ARABIC PRESENTATION FORMS A', 82 => 'COMBINING HALF MARKS', 83 => 'CJK COMPATIBILITY FORMS', 84 => 'SMALL FORM VARIANTS', 85 => 'ARABIC PRESENTATION FORMS B', 86 => 'SPECIALS', 87 => 'HALFWIDTH AND FULLWIDTH FORMS', 88 => 'OLD ITALIC', 89 => 'GOTHIC', 90 => 'DESERET', 91 => 'BYZANTINE MUSICAL SYMBOLS', 92 => 'MUSICAL SYMBOLS', 93 => 'MATHEMATICAL ALPHANUMERIC SYMBOLS', 94 => 'CJK UNIFIED IDEOGRAPHS EXTENSION B', 95 => 'CJK COMPATIBILITY IDEOGRAPHS SUPPLEMENT', 96 => 'TAGS', 97 => 'CYRILLIC SUPPLEMENTARY', 98 => 'TAGALOG', 99 => 'HANUNOO', 100 => 'BUHID', 101 => 'TAGBANWA', 102 => 'MISCELLANEOUS MATHEMATICAL SYMBOLS A', 103 => 'SUPPLEMENTAL ARROWS A', 104 => 'SUPPLEMENTAL ARROWS B', 105 => 'MISCELLANEOUS MATHEMATICAL SYMBOLS B', 106 => 'SUPPLEMENTAL MATHEMATICAL OPERATORS', 107 => 'KATAKANA PHONETIC EXTENSIONS', 108 => 'VARIATION SELECTORS', 109 => 'SUPPLEMENTARY PRIVATE USE AREA A', 110 => 'SUPPLEMENTARY PRIVATE USE AREA B', 111 => 'LIMBU', 112 => 'TAI LE', 113 => 'KHMER SYMBOLS', 114 => 'PHONETIC EXTENSIONS', 115 => 'MISCELLANEOUS SYMBOLS AND ARROWS', 116 => 'YIJING HEXAGRAM SYMBOLS', 117 => 'LINEAR B SYLLABARY', 118 => 'LINEAR B IDEOGRAMS', 119 => 'AEGEAN NUMBERS', 120 => 'UGARITIC', 121 => 'SHAVIAN', 122 => 'OSMANYA', 123 => 'CYPRIOT SYLLABARY', 124 => 'TAI XUAN JING SYMBOLS', 125 => 'VARIATION SELECTORS SUPPLEMENT', 126 => 'ANCIENT GREEK MUSICAL NOTATION', 127 => 'ANCIENT GREEK NUMBERS', 128 => 'ARABIC SUPPLEMENT', 129 => 'BUGINESE', 130 => 'CJK STROKES', 131 => 'COMBINING DIACRITICAL MARKS SUPPLEMENT', 132 => 'COPTIC', 133 => 'ETHIOPIC EXTENDED', 134 => 'ETHIOPIC SUPPLEMENT', 135 => 'GEORGIAN SUPPLEMENT', 136 => 'GLAGOLITIC', 137 => 'KHAROSHTHI', 138 => 'MODIFIER TONE LETTERS', 139 => 'NEW TAI LUE', 140 => 'OLD PERSIAN', 141 => 'PHONETIC EXTENSIONS SUPPLEMENT', 142 => 'SUPPLEMENTAL PUNCTUATION', 143 => 'SYLOTI NAGRI', 144 => 'TIFINAGH', 145 => 'VERTICAL FORMS', 146 => 'NKO', 147 => 'BALINESE', 148 => 'LATIN EXTENDED C', 149 => 'LATIN EXTENDED D', 150 => 'PHAGS PA', 151 => 'PHOENICIAN', 152 => 'CUNEIFORM', 153 => 'CUNEIFORM NUMBERS AND PUNCTUATION', 154 => 'COUNTING ROD NUMERALS', 155 => 'SUNDANESE', 156 => 'LEPCHA', 157 => 'OL CHIKI', 158 => 'CYRILLIC EXTENDED A', 159 => 'VAI', 160 => 'CYRILLIC EXTENDED B', 161 => 'SAURASHTRA', 162 => 'KAYAH LI', 163 => 'REJANG', 164 => 'CHAM', 165 => 'ANCIENT SYMBOLS', 166 => 'PHAISTOS DISC', 167 => 'LYCIAN', 168 => 'CARIAN', 169 => 'LYDIAN', 170 => 'MAHJONG TILES', 171 => 'DOMINO TILES', 172 => 'SAMARITAN', 173 => 'UNIFIED CANADIAN ABORIGINAL SYLLABICS EXTENDED', 174 => 'TAI THAM', 175 => 'VEDIC EXTENSIONS', 176 => 'LISU', 177 => 'BAMUM', 178 => 'COMMON INDIC NUMBER FORMS', 179 => 'DEVANAGARI EXTENDED', 180 => 'HANGUL JAMO EXTENDED A', 181 => 'JAVANESE', 182 => 'MYANMAR EXTENDED A', 183 => 'TAI VIET', 184 => 'MEETEI MAYEK', 185 => 'HANGUL JAMO EXTENDED B', 186 => 'IMPERIAL ARAMAIC', 187 => 'OLD SOUTH ARABIAN', 188 => 'AVESTAN', 189 => 'INSCRIPTIONAL PARTHIAN', 190 => 'INSCRIPTIONAL PAHLAVI', 191 => 'OLD TURKIC', 192 => 'RUMI NUMERAL SYMBOLS', 193 => 'KAITHI', 194 => 'EGYPTIAN HIEROGLYPHS', 195 => 'ENCLOSED ALPHANUMERIC SUPPLEMENT', 196 => 'ENCLOSED IDEOGRAPHIC SUPPLEMENT', 197 => 'CJK UNIFIED IDEOGRAPHS EXTENSION C', 198 => 'MANDAIC', 199 => 'BATAK', 200 => 'ETHIOPIC EXTENDED A', 201 => 'BRAHMI', 202 => 'BAMUM SUPPLEMENT', 203 => 'KANA SUPPLEMENT', 204 => 'PLAYING CARDS', 205 => 'MISCELLANEOUS SYMBOLS AND PICTOGRAPHS', 206 => 'EMOTICONS', 207 => 'TRANSPORT AND MAP SYMBOLS', 208 => 'ALCHEMICAL SYMBOLS', 209 => 'CJK UNIFIED IDEOGRAPHS EXTENSION D', 210 => 'ARABIC EXTENDED A', 211 => 'ARABIC MATHEMATICAL ALPHABETIC SYMBOLS', 212 => 'CHAKMA', 213 => 'MEETEI MAYEK EXTENSIONS', 214 => 'MEROITIC CURSIVE', 215 => 'MEROITIC HIEROGLYPHS', 216 => 'MIAO', 217 => 'SHARADA', 218 => 'SORA SOMPENG', 219 => 'SUNDANESE SUPPLEMENT', 220 => 'TAKRI', 221 => 'COUNT', -1 => 'INVALID CODE', );

// составлено на основе констант CHAR_CATEGORY_* из http://php.net/manual/en/class.intlchar.php
$categories = array ( 0 => 'GENERAL OTHER TYPES', 1 => 'UPPERCASE LETTER', 2 => 'LOWERCASE LETTER', 3 => 'TITLECASE LETTER', 4 => 'MODIFIER LETTER', 5 => 'OTHER LETTER', 6 => 'NON SPACING MARK', 7 => 'ENCLOSING MARK', 8 => 'COMBINING SPACING MARK', 9 => 'DECIMAL DIGIT NUMBER', 10 => 'LETTER NUMBER', 11 => 'OTHER NUMBER', 12 => 'SPACE SEPARATOR', 13 => 'LINE SEPARATOR', 14 => 'PARAGRAPH SEPARATOR', 15 => 'CONTROL CHAR', 16 => 'FORMAT CHAR', 17 => 'PRIVATE USE CHAR', 18 => 'SURROGATE', 19 => 'DASH PUNCTUATION', 20 => 'START PUNCTUATION', 21 => 'END PUNCTUATION', 22 => 'CONNECTOR PUNCTUATION', 23 => 'OTHER PUNCTUATION', 24 => 'MATH SYMBOL', 25 => 'CURRENCY SYMBOL', 26 => 'MODIFIER SYMBOL', 27 => 'OTHER SYMBOL', 28 => 'INITIAL PUNCTUATION', 29 => 'FINAL PUNCTUATION', 30 => 'COUNT', );

if ($_POST)
{
	$res = $regex = [];
	IntlChar::enumCharNames(0x0000, 0xffff, function($codepoint,$shit,$name)use(&$regex, &$res, $types, $categories){
		$type = $types[IntlChar::getBlockCode($codepoint)];
		$cat = $categories[IntlChar::charType($codepoint)];
		$hex = dechex($codepoint);
		$entity = '&#x'.$hex.';';
		$entity3 = '&#'.$codepoint.';';
		$c = html_entity_decode($entity, ENT_HTML5 + ENT_QUOTES, 'utf-8');
		$ver = implode('.', IntlChar::charAge($codepoint));
		if ((stripos($name, $_POST['search_for'])!==FALSE) || 
			(stripos($c, $_POST['search_for'])===0) ||
			(stripos($entity3, $_POST['search_for'])===0) || 
			(stripos($entity, $_POST['search_for'])===0) ||
			(stripos($type, $_POST['search_for'])!==FALSE) ||
			//(stripos($cat, $_POST['search_for'])!==FALSE) ||
			(stripos($ver, $_POST['search_for'])===0) ||
			false
		)
		{
			$pair = IntlChar::foldCase($codepoint);
			$pair = (($pair===$codepoint)?'':'&#x'.dechex($pair).';');
			$entity2 = htmlentities($c, ENT_HTML5 + ENT_QUOTES, 'utf-8');
			if (preg_match('#&\#|&\w#', $entity2)) $entity = $entity2;
			$php_c = '\u{'.$hex.'}';
			$regex[] = $php_c;
			$hex2 = str_split(bin2hex($c),2);
			array_walk($hex2, function(&$v){
				$v = '\x'.$v;
			});
			$hex2 = implode('', $hex2);
			$res[] = [$c, $name, $type, $cat, $entity, $php_c, $hex2, $pair, $ver];
		}
	}, IntlChar::EXTENDED_CHAR_NAME);
	ksort($regex);
}

header('Content-Type: text/html;charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
<title>UTF-8 Lister</title>
<style>
	.bold {font-weight:bold;}
	.italic {font-style:italic;}
	char {font-size:30px;}
</style>
</head>
<body>
<form action="?" method=post>
	<span>Поиск:</span>
	<input type=text name=search_for value="<?=htmlspecialchars($_POST['search_for'])?>">
	<input type=submit>
	найдено: <?=count($res)?>
</form>

<?if($_POST):?>
	<span>PHP 7 Regex:</span>
	<br>
	<input type=text class="italic" readonly=yes size=120 onclick="this.select()"  value="<?=htmlspecialchars('"#'.implode('|', $regex).'#"')?>">
	<table>
		<tr><td></td><td width=350>название</td><td width=100>Type</td><td width=100>Category</td><td width=100>Pair</td><td width=100>Version</td><td width=100>HTML-entity</td><td width=100>php unicode code</td><td width=100>php hex code</td></tr>
<?foreach($res as $v):?>
<?list($c, $name, $type, $cat, $entity, $php_c, $hex2, $pair, $ver) = $v;?>
<tr><td><char><?=$c?></char></td><td><?=$name?></td><td><?=$type?></td><td><?=$cat?></td><td><?=$pair?></td><td><?=$ver?></td><td><?=htmlspecialchars($entity)?></td><td><?=$php_c?></td><td><?=$hex2?></td></tr>
<?endforeach?>
	</table>
<?endif?>
</body>
</html>