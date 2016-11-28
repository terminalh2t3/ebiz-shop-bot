<?php

$bot = require_once __DIR__ . '/../bootstrap/bot.php';

$bot->subscription->create([
    'content'       => 'Your message content',
    'to_channel'    => 1,
    'unique_id'     => 'a-unique-id',
    'send_limit'    => 1
])->send();

// Done. Print message to the browser
dd('Notification sent!');