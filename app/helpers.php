<?php

use \Michelf\MarkdownExtra;

if ( ! function_exists('md')) {
    function md($str)
    {
        return MarkdownExtra::defaultTransform($str);
    }
}
