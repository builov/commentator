<?php

namespace Builov\Commentator;

class Processor
{
    /**
     * @param string $file_text
     * @param string $file_comments
     * @param array $params
     * @return void
     */
    public function addComments(string $file_text, string $file_comments, array $params): void
    {
        /**
         * @var  $pattern_link - шаблон ссылки на комментарий, должен содержать номер комментария
         * получение массива ссылок из основного текста
         * [0] - полный текст ссылки
         * [1] - номер комментария (число)
         * $links - подстроки, кот. нужно заменить на комментарий, содержат номер комментария
         */
        $text = file_get_contents($file_text);
//        $pattern_link = '|\[(\d+)\]|Uu';
//        preg_match_all($pattern_link, $text, $links, PREG_PATTERN_ORDER);

        /**
         * @var  $pattern_comments - шаблон комментария, содержит его номер
         * получение массива комментариев
         * [0] - полный текст комментария
         * [1] - подстроки, кот. нужно удалить
         * [2] - номер комментария (число)
         * $comments - массив комментариев
         * $comments_array - массив очищенных комментариев с ключом, номером комментария
         */
//        $pattern_comments = '|^.+(<a name="_edn\d+" title="">\[(\d+)\]<\/a>).+$|Uum';
        preg_match_all($params['pattern_comment'], file_get_contents($file_comments),$comments,PREG_PATTERN_ORDER);

        /**
         * замена текста ссылки на текст коментария
         */
//        $link_pattern = "[\d+]";
        foreach ($comments[0] as $key => $comment) {
            $comment = str_replace($comments[1][$key], '', $comment);
            $link = str_replace('\d+', $comments[2][$key], $params['pattern_link']);
            $text = str_replace($link, '[fn]' . $comment . '[/fn]', $text);
//            echo $comment . PHP_EOL;
//            echo $link . PHP_EOL;
        }

        echo $text;

//        file_put_contents('./result.txt', $text);
    }
}