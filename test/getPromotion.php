<?php
$bot = require_once __DIR__ . '/../bootstrap/bot.php';

Use Api\Business\PromotionBusiness;
$promotion = PromotionBusiness::getCurrentPromotions();
var_dump($promotion);