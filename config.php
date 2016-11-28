<?php

return array(
	/*
	 |------------------------------------------------------------------------
	 | Page Access Token
	 |------------------------------------------------------------------------
	 |
	 | Please provide your page access token for Giga.
	 |
	 */

	'page_access_token' =>  'EAAUMIYZBFcu8BAGhg9K7Hvdvl0IXpTgZCVfS8fraHAy3XIi5HBZC2321UpF6diAdxCU7w7z3VDF8KkTQI9PE9RradZCExhluxwHdnHdrRZA5qYJJWoUKQpWF3FlFhCQxCsZBzaZAAzIaWzWRLZBcIHxZAAcdWtYPeo7ydppAE8PybjgZDZD',

	/*
	 |------------------------------------------------------------------------
	 | Page ID
	 |------------------------------------------------------------------------
	 |
	 | Please provide your page id for Giga.
	 |
	 */

	'page_id' => '346716535694607',

	/*
	 |------------------------------------------------------------------------
	 | Cache path
	 |------------------------------------------------------------------------
	 |
	 | Please provide your cache directory for Giga. The cache directory should
	 | be read-writable.
	 |
	 */

	'cache_path' => __DIR__ . '/cache/',

	/*
	 |------------------------------------------------------------------------
	 | Storage Driver
	 |------------------------------------------------------------------------
	 |
	 | Currently, only accepts `mysql`
	 |
	 */

	'storage_driver' => 'pgsql',

    /*
	 |------------------------------------------------------------------------
	 | MySQL Connection Configuration
	 |------------------------------------------------------------------------
	 |
	 | If storage driver is `mysql`, set connection here
	 |
	 */

    'mysql' => [
        'host'      => 'us-cdbr-iron-east-04.cleardb.net',
        'database'  => 'heroku_aed1426a52073c7',
        'username'  => 'be0b9822497322',
        'password'  => 'ce9a1361',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ],
//    'mysql' => [
//        'host'      => '127.0.0.1',
//        'database'  => 'd1',
//        'username'  => 'root',
//        'password'  => '',
//        'charset'   => 'utf8',
//        'collation' => 'utf8_unicode_ci',
//        'prefix'    => '',
//    ],

    'pgsql' => [
        'host'      => 'ec2-54-235-65-139.compute-1.amazonaws.com',
        'database'  => 'ddfrinp75cbc35',
        'username'  => 'tmtnzwsrccaajs',
        'password'  => 'GJP_KivfI-m4BylpD0ed1ZHXlg',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ],

    /*
     |------------------------------------------------------------------------
     | App ID
     |------------------------------------------------------------------------
     |
     | Please provide your Facebook App ID
     |
     */

	'app_id' => '1420713164894959',

	/*
	 |------------------------------------------------------------------------
	 | Auto stop feature
	 |------------------------------------------------------------------------
	 |
	 | Auto stop bot when Page's administrators response. Page's administrators
	 | can turn bot back again by sending empty message.
	 |
	 */

	'auto_stop' => false,

	/*
	 |------------------------------------------------------------------------
	 | Cache offset
	 |------------------------------------------------------------------------
	 |
	 | By default, bot automatically collects people info and store it
	 | to database. This setting helps you set cache offset (in minutes)
	 | for that info.
	 |
	 | Default: 10080 minutes
	 |
	 */

	'cache_offset' => 10080,


	/*
	 |------------------------------------------------------------------------
	 | Greeting Text
	 |------------------------------------------------------------------------
	 |
	 | The Greeting Text is only rendered the first time the user interacts
	 | with a the Page on Messenger. You can set it here.
	 |
	 | @see https://developers.facebook.com/docs/messenger-platform/thread-settings/greeting-text
	 |
	 */

	'greeting_text' => 'Welcome to Ebiz Store! Say \'Hi\' to begin the conversation.',

	/*
	 |------------------------------------------------------------------------
	 | Get Started Button
	 |------------------------------------------------------------------------
	 |
	 | The Get Started button is only rendered the first time the user interacts
	 | with a the Page on Messenger. You can set it here.
	 |
	 | Note that you'll only need to enter button payload, in string.
	 | To response people when they click Get Started Button. Simply use:
	 |
	 | $bot->answer('payload:GIGA_GET_STARTED_PAYLOAD', 'Your message');
	 |
	 | @see https://developers.facebook.com/docs/messenger-platform/thread-settings/get-started-button
	 |
	 */

	'get_started_button_payload' => 'GIGA_GET_STARTED_PAYLOAD',

	/*
	 |------------------------------------------------------------------------
	 | Persistent Menu.
	 |------------------------------------------------------------------------
	 |
	 | The Persistent Menu is a menu that is always available to the user.
	 | This menu should contain top-level actions that users can enact at any point.
	 | Having a persistent menu easily communicates the basic capabilities of
	 | your bot for first-time and returning users.
	 |
	 | The menu can be invoked by a user, by tapping on the 3-caret icon on the left of the composer.
	 |
	 | Please enter array of buttons for this value.
	 |
	 | @see https://developers.facebook.com/docs/messenger-platform/thread-settings/persistent-menu
	 |
	 */

    'persistent_menu' => [
        [
            "type" => "web_url",
            "title" => "View Website",
            "url" => "http://petersapparel.parseapp.com/"
        ]
    ]
);