<?php

namespace Richardchey\Fund;

use GuzzleHttp;

abstract class FundAbstract
{
    const CODE = 'null';
    const SHORT = 'null';
    const NAME = 'null';
    protected static $HEADERS = [
    	'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    	'User-Agent' => 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36'
    ];

    abstract public function getNetValue();

    protected function getResFromUrl($url)
    {
    	$client = new GuzzleHttp\Client(['headers'=>self::$HEADERS]);
        $res = $client->get($url);
        return trim($res->getBody());
    }
}
