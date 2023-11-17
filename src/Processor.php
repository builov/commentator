<?php

namespace Builov\Commentator;

class Processor
{
    /**
     * @var array $params
     * ожидаются параметры:
     * 'file_path_text'
     * 'file_path_comments'
     * 'pattern_link'
     * 'pattern_comment'
     * 'number_placeholder'
     */
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * @return void
     */
    public function addComments(): void
    {
        $text = file_get_contents($this->params['file_path_text']);

        /**
         * 'pattern_comment' - шаблон комментария, содержит его номер
         * @var $comments - массив комментариев:
         * [0] - полный текст комментария
         * [1] - подстроки, кот. нужно удалить
         * [2] - номер комментария (число)
         * [3] - подстроки, кот. нужно удалить
         */
        preg_match_all($this->params['pattern_comment'], file_get_contents($this->params['file_path_comments']),$comments,PREG_PATTERN_ORDER);

//        print_r($comments); exit;

        echo 'комментариев: ' . count($comments[0]) . PHP_EOL;
//        exit;

        /**
         * замена текста ссылки на текст коментария
         * @var  $link - ссылка на комментарий, должна содержать его номер
         */
        $links = 0;
        foreach ($comments[0] as $key => $comment) {
            /** получение очищенного текста комментария */
            if (array_key_exists('3', $comments)) {
                $comment = str_replace([$comments[1][$key], $comments[3][$key]], '', $comment);
            } else {
                $comment = str_replace($comments[1][$key], '', $comment);
            }

            $comment = ParagraphRemover::process($comment);

            /** получение ссылки на текущий комментарий с соотв. номером */
            $link = str_replace($this->params['number_placeholder'], $comments[2][$key], $this->params['pattern_link']);

//            echo $link . PHP_EOL;

            /** если такое есть в тексте */
            if (strpos($text, $link)) {
                $links++;
            }

            /** замена ссылки на комментарий */
            $text = str_replace($link, '[fn]' . $comment . '[/fn]', $text);

//            /** замена ссылки на комментарий внутри комментария */
//            $text = str_replace($link, $comments[2][$key] . ': ' . $comment, $text);

//            echo $comment . PHP_EOL;
//            echo $link . PHP_EOL;
        }

        echo 'замен: ' . $links . PHP_EOL;

//        echo $text;

        file_put_contents('./result.txt', $text);
    }
}