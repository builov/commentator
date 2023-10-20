<?php

namespace Builov\Commentator;

class RegexPattern
{
    public string $value;

    public function __construct(string $body, ?string $modifiers = null) {  //В регулярных выражениях служебными считаются следующие символы: . \ + * ? [ ^ ] $ ( ) { } = ! < > | : - #       //символ / не является служебным.       //$body = preg_quote($body, '/');

        $this->value = ($modifiers) ? "/$body/$modifiers" : "/$body/";
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}