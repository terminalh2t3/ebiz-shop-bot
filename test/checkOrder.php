<?php
/**
 * Created by PhpStorm.
 * User: vu
 * Date: 11/27/16
 * Time: 8:50 PM
 */

$bot = require_once __DIR__ . '/../bootstrap/bot.php';
use Api\Business\ProductOrderBusiness;
$order = ProductOrderBusiness::getProductOrderByNumber('201611380');
var_dump($order);