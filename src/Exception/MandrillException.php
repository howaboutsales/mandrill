<?php

namespace Shareworks\Component\Mandrill\Exception;

class MandrillException extends \RuntimeException
{
    public static function createFromError($error, $code = 500)
    {
        return new self($error, $code);
    }
}
