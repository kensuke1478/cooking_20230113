<?php

/**
 * XSS対策の参照名省略
 *
 * @param string string
 * @return string
 *
 */
function h(?string $string): string
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * トークン(ハッシュ)を返す
 *
 * @return string
*/
function getToken (): string
{
    return hash('sha256', session_id());
}
