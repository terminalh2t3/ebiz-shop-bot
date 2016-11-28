<?php

namespace Api\Model;
use \Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model {

    public $table = "salesforce.productorder__c";
    public $timestamps = false;
}