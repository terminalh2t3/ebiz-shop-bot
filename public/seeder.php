<?php
/* @var $bot \GigaAI\MessengerBot */
$bot = require_once __DIR__ . '/../bootstrap/bot.php';

/*
|--------------------------------------------------------------------------
| Your Messenger bot first node
|--------------------------------------------------------------------------
|
| Let's try say hi to her when setup completed and then edit this message.
|
*/

$bot->answer('^(hi|hello|fine|begin|menu)', [
	'Hello [first_name]! I could help you with the following items',
    'quick_replies' => [
        [
            'content_type' => 'text',
            'title' => 'Products',
            'payload' => 'USER_TAPPED_PRODUCT'
        ],
        [
            'content_type' => 'text',
            'title' => 'About Ebiz',
            'payload' => 'USER_TAPPED_ABOUT'
        ]
    ]
]);

/*
|--------------------------------------------------------------------------
| Handling the quick replies
|--------------------------------------------------------------------------
|
| When user tap quick replies, it sends a text message to you, so just handle it like normal text message.
| For detail: https://giga.ai/docs/standalone/quick-replies
|
*/

// Products
$bot->answer('payload:USER_TAPPED_PRODUCT', function($bot) {
    //Check the category list
    $hCategories = \Api\Business\CategoryBusiness::getAllCategories();
    if(count($hCategories) == 0){
        return 'Sorry, I could not get any information from Ebiz Shop for now. Please check it back later. Sorry about this :(';
    }
    $mix = [];
    $mix[] = 'We have some kind of product lines for you.';
    $categories = [];

    /* @var $hCategory \Api\Model\Category */
    foreach ($hCategories as $hCategory){
        $aCategory = [
            "title"     => $hCategory['name'],
            "image_url" => $hCategory['imageurl__c'],
            "subtitle"  => $hCategory['description__c'],
            "buttons"   => [
                [
                    "type"    => "postback",
                    "payload" => "cat_" . $hCategory['id'],
                    "title"   => "Detail"
                ]
            ]
        ];
        $categories[] = $aCategory;
    }
    $mix[] = $categories;
    return $mix;
});

/*
|--------------------------------------------------------------------------
| Handling the post back
|--------------------------------------------------------------------------
| Handle product postback
|
*/
$bot->answer('payload:cat_%', function($bot, $lead_id, $input){
    //Get category product
    $payload = $bot->received->entry[0]->messaging[0]->postback->payload;
    $categoryId = explode('_', $payload)[1];
    $hProducts = \Api\Business\CategoryBusiness::getProducts($categoryId);

    if(count($hProducts) == 0) {
        return 'Sorry, there is no product in this category at the moment.';
    }
    $mix = [];
    $mix[] = 'Check some products here, hope you interested in somethings';
    $products = [];

    /* @var $aProduct \Api\Model\Product */
    foreach ($hProducts as $hProduct){
        $aProduct = [
            "title"     => $hProduct['name'],
            "image_url" => $hProduct['imageurl__c'],
            "subtitle"  => substr($hProduct['description'], 0, 50) . '...',
            "buttons"   => [
                [
                    "type"    => "postback",
                    "payload" => 'cap_' . $hProduct['id'],
                    "title"   => "Order"
                ]
            ]
        ];
        $products[] = $aProduct;
    }
    $mix[] = $products;
    return $mix;
});

/*
|--------------------------------------------------------------------------
| Handling the post back
|--------------------------------------------------------------------------
| Handle Order postback
|
*/

$bot->answer('payload:cap_%', function($bot, $lead_id, $input){
    //Get product id
    $payload = $bot->received->entry[0]->messaging[0]->postback->payload;
    $productId = explode('_', $payload)[1];
    //Save temp data
    $result = DataBot::setData($lead_id, 'productId', $productId);

    return 'Please tell me your email.';
})->then(function($bot, $lead_id, $input){
    if(!filter_var($input, FILTER_VALIDATE_EMAIL)){
        $bot->keep('It does not look like an valid email, could you confirm?');
        return;
    }

    $userProfile = \GigaAI\Http\Request::getUserProfile($lead_id);

    $lead['firstname'] = $userProfile['first_name'];
    $lead['lastname'] = $userProfile['last_name'];
    $lead['email'] = $input;
    $lead['facebookid__c'] = $lead_id;

    //Register lead
    $hLead = \Api\Business\LeadBusiness::getLeadByFacebookId($lead_id);
    if ($hLead != null){
        //Update
        \Api\Business\LeadBusiness::updateLead($lead_id, $lead);
    } else{
        \Api\Business\LeadBusiness::createLead($lead);
    }


    return 'Please tell me your address.';
})->then(function($bot, $lead_id, $input){
    //Get product Id
    $productId = DataBot::getData($lead_id, 'productId');

    $hLead = \Api\Business\LeadBusiness::getLeadByFacebookId($lead_id);
    $hLead['street'] = $input;

    //Update
    \Api\Business\LeadBusiness::updateLead($lead_id, $hLead);

    //Create order
    $orderId = \Api\Business\ProductOrderBusiness::createOrder($lead_id, $productId);

    $bot->say('Thank you for your order. Your order code is ' . $orderId .
        '. You can check your receipt anytime by typing \'Receipt\' any time.');
});

$bot->answer('Receipt', 'Please let me know your order id')->then(function($bot, $lead_id, $input){
    $receipt = \Api\Business\ProductOrderBusiness::getProductOrderByNumber($input);

    $userProfile = \GigaAI\Http\Request::getUserProfile($lead_id);
    if($receipt == null)
        return 'It seem not a valid order id, could you check and enter again?';

    $product = \Api\Business\ProductBusiness::getProductById($receipt['productid__c']);
    $promotion = \Api\Business\PromotionBusiness::getPromotionByPromotionCode($receipt['promotion__c']);
    $discountPercent = 0;
    if($promotion){
        $discountPercent = $promotion['discount__c'];
    }
    $discountAmount = $product['price__c'] * $discountPercent / 100;
    $totalCost = $product['price__c'] - $discountAmount;

    $mix =
        [
            "recipient_name"    => $userProfile['first_name'] . ' ' . $userProfile['last_name'],
            "order_number"      => $receipt['ordernumber__c'],
            "currency"          => "USD",
            "payment_method"    => "COD",
            "elements" => [
                [
                    "title"         => $product['name'],
                    "subtitle"      => substr($product['description'], 50) . ' ...',
                    "quantity"      => 1,
                    "price"         => $product['price__c'],
                    "currency"      => "USD",
                    "image_url"     => $product['imageurl__c']
                ]
            ],
            "summary" => [
                "subtotal"          => $product['price__c'],
                "shipping_cost"     => 0,
                "total_tax"         => 0,
                "total_cost"        => $totalCost
            ],
            "adjustments" => [
                [
                    'name'          => 'Promotion Discount ' . $discountPercent . '%',
                    'amount'        => $discountAmount
                ]
            ]
        ];
    return $mix;
});

// About Ebiz
$bot->answer('payload:USER_TAPPED_ABOUT',
	'Elite Business Solutions (E-Biz) has been operating with the vision of provide ease for enterprise digitization in Asean countries. Check our website for more detail: http://ebiz.solutions'
);

// Default answer
$bot->answer('default:', 'Sorry I\'m not understand. You can type \'Begin\' or \'Hello\' to start a new conversation.');

// Print some message to the browser when done
dd('Nodes seeded!');