<?php

require 'vendor/autoload.php';

use Builov\Commentator\Processor;
use Builov\Commentator\RegexPattern;

$number_placeholder = '\d+';

/**
 *  Паттерн ссылки на комментарий, представляет собой
 *  строку для использования в str_replace()
 *  где $number_placeholder это плейсхолдер для замены на число
 */
//$pattern_link = "[$number_placeholder]";
//$pattern_link = "<sup><a name=\"r$number_placeholder\"></a><a href=\"#n$number_placeholder\" title=\"\">[$number_placeholder]</a></sup>"; //coollib
//$pattern_link = "<sup><a name=r$number_placeholder><a href=\"#n_$number_placeholder\" title=\"\">[$number_placeholder]</sup></A>";     //coollib
//$pattern_link = "<sup>[$number_placeholder]</sup>";
//$pattern_link = "<a l:href=\"#n_$number_placeholder\" type=\"note\">[$number_placeholder]</a>"; //royallib
//$pattern_link = "<a l:href=\"#n_$number_placeholder\">$number_placeholder</a>";
$pattern_link = '<a  href="#c_' . $number_placeholder . '" rel="nofollow noopener noreferrer"><SUP>{' . $number_placeholder . '}</SUP></A>';


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
//$pattern_comment = new RegexPattern('(<h3>(\d+)<\/h3>\s*[\n|\r]+[\n|\r]+\s*)<p>.+<\/p>', 'Uumi');
//$pattern_comment = new RegexPattern('(<section id="n_\d+"><title><p>(\d+)<\/p><\/title>)<p>.+(<\/p><\/section>)', 'Uumi'); //royallib
//$pattern_comment = new RegexPattern('(<title>[\n|\r]+\s*<p>(\d+)<\/p>[\n|\r]+\s*<\/title>[\n|\r]+\s*)[\s|\S]+([\n|\r]+\s*<\/section>)', 'Uumi'); //royallib
$pattern_comment = new RegexPattern('(<h3 class=\'book\'>[\n|\r]+\s*(\d+)[\n|\r]+\s*<\/h3>[\n|\r]+\s*)[\s|\S]+([\n|\r]+\s*<small>)', 'Uumi');

$params = [
    'file_path_text' => 'text.txt',
    'file_path_comments' => 'comments.txt',
    'pattern_link' => $pattern_link,
    'pattern_comment' => $pattern_comment,
    'number_placeholder' => $number_placeholder
];

$processor = new Processor($params);
$processor->addComments();