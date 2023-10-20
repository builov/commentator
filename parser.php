<?php

require 'vendor/autoload.php';

use Builov\Commentator\Processor;
use Builov\Commentator\RegexPattern;

$number_placeholder = '\d+';

/**
 *  Паттерн ссылки на комментарий
 *  строка для использования в str_replace()
 *  где $number_placeholder это плейсхолдер для замены на число
 */
//$pattern_link = "[$number_placeholder]";
//$pattern_link = "<sup><a name=\"r$number_placeholder\"></a><a href=\"#n$number_placeholder\" title=\"\">[$number_placeholder]</a></sup>"; //coollib
//$pattern_link = "<sup><a name=r$number_placeholder><a href=\"#n_$number_placeholder\" title=\"\">[$number_placeholder]</sup></A>"; //coollib
$pattern_link = "<sup>[$number_placeholder]</sup>";

//<h3>40</h3>
//
//
//      <p>Легендарный тибетский царь, герой многочисленных сказаний, образующих особый цикл.</p>

/**
 *  PCRE-совместимый паттерн комментария. Должен описывать:
 *  [0]. полный текст комментария
 *  [1]. подстроку, которую нужно удалить (подмаска 1)
 *  [2]. номер комментария (число) (подмаска 2)
 *  необязательно:
 *  [3]. подстроку, которую нужно удалить (подмаска 3)
 */
//$pattern_comment = new RegexPattern('^.*(<a name="_edn\d+" title="">\[(\d+)\]<\/a>).+$', 'Uumi'); //для комм. разделенных переводом строки
//$pattern_comment = new RegexPattern('(<h3>(\d+)<\/h3>[\n|\r]+).+([\n|\r]+.+)', 'umi'); //coollib
//$pattern_comment = new RegexPattern('(<a name="n_\d+"><\/a>\s*[\n|\r]+.+[\n|\r]+\s*(\d+)\s*[\n|\r]+\s*<\/h3>\s*[\n|\r]+\s*)[\s|\S]+(<small>\(<a href=#r\d+>обратно<\/a>\)<\/small>)', 'Uumi'); //coollib
$pattern_comment = new RegexPattern('(<h3>(\d+)<\/h3>\s*[\n|\r]+[\n|\r]+\s*)<p>.+<\/p>', 'Uumi');

$params = [
    'file_path_text' => 'text.txt',
    'file_path_comments' => 'comments.txt',
    'pattern_link' => $pattern_link,
    'pattern_comment' => $pattern_comment,
    'number_placeholder' => $number_placeholder
];

$processor = new Processor($params);
$processor->addComments();