<?php

namespace Builov\Commentator;

class ParagraphRemover
{
    public static function process(string $text): string
    {
        $text = preg_replace('/<\/p>(\s|\n|\r|\f|\t|\v)*<p>/umi', '<br><br>', trim($text));
        $text = str_replace(['<p>', '</p>'], '', $text);
        return $text;
    }
}