<?php

namespace Richardchey\Fund;

use GuzzleHttp;
use \DOMDocument;

class Fund001238 extends FundAbstract
{
    const CODE = '001238';
    const SHORT = '博时招财一号';
    const NAME = '博时招财一号大数据保本混合型证券投资基金';

    public function getNetValue($day = null, $month = null, $year = null)
    {
        $urlFormat = 'http://www.bosera.com//jjcp/kf/symx/index.jsp?fundCode=001238&startDate=%s&endDate=%s';
        $time = mktime(0, 0, 1, $month?:date('n'), $day?:date('j'), $year?:date('Y'));
        $startDate = date('Y-m-d', $time - 86400 * 15);
        $endDate = date('Y-m-d', $time);
        $url = sprintf($urlFormat, $startDate, $endDate);
        $res = $this->getResFromUrl($url);
        $res = iconv('gbk', 'utf-8', $res);
        preg_match('/(<table[^>]*?>.*<\/table>)/is', $res, $matches);
        $doc = new DOMDocument();
        $doc->loadHTML($matches[1]);
        $netValueTds = $doc->getElementsByTagName('tr')->item(1)->getElementsByTagName('td');
        if (trim($netValueTds->item(0)->textContent) == date('Ymd', $time)) {
            return trim($netValueTds->item(1)->textContent);
        }       
    }
}
