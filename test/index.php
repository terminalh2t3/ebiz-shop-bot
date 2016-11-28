<?php
$bot = require_once __DIR__ . '/../bootstrap/bot.php';
use Api\Business\LeadBusiness;
$lead['firstname'] = "Hoàng";
$lead['lastname']  = "Nguyễn";
$lead['facebook_id'] = "100";
$lead['phone'] = "0909620069";
$lead['email'] = "sallyminiv1@gmail.com";
$lead['street'] = "Cù Chính Lan";
$lead = LeadBusiness::createLead($lead);
var_dump($lead);


