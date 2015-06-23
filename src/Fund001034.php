<?php

namespace Richardchey\Fund;

use \DOMDocument;

class Fund001034 extends FundAbstract
{
    const CODE = '001034';
    const SHORT = '华富旺财';
    const NAME = '华富旺财保本混合型证券投资基金';

    public function getNetValue($day = null, $month = null, $year = null)
    {
    	$time = mktime(0, 0, 1, $month?:date('n'), $day?:date('j'), $year?:date('Y'));
    	$url = "http://www.hffund.com/chart-web/chart/fundnettable!show?fundcode=001034&page=1-15";
        $res = $this->getResFromUrl($url);
        preg_match('/(<table[^>]*?>.*?<\/table>)/is', $res, $matches);
        $doc = new DOMDocument();
        $doc->loadHTML($matches[1]);
        $netValueTrs = $doc->getElementsByTagName('tr');
        for ($i = 1; $i < $netValueTrs->length; $i ++) {
            $netValueTds = $netValueTrs->item($i)->getElementsByTagName('td');
            if (trim($netValueTds->item(0)->textContent) == date('Y-m-d', $time)) {
                return trim($netValueTds->item(1)->textContent);
            }
        }
    }
}
