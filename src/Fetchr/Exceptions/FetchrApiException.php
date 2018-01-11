<?php


namespace Zubair\Fetchr\Exceptions;

use Exception;

class FetchrApiException extends Exception
{

    /**
     * ShopifyApiException constructor.
     * @param $message
     * @param int code
     */
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}