<?php

require 'vendor/autoload.php';

use Builov\Commentator\Processor;
use Builov\Commentator\RegexPattern;

$pattern_link = '[\d+]';
$pattern_comment = new RegexPattern('^.+(<a name="_edn\d+" title="">\[(\d+)\]<\/a>).+$', 'Uum');

$params = [
    'file_path_text' => 'text.txt',
    'file_path_comments' => 'comments.txt',
    'pattern_link' => $pattern_link,
    'pattern_comment' => $pattern_comment
];

$processor = new Processor();
$processor->addComments('text.txt', 'comments.txt', $params);