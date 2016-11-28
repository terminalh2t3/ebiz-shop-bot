<?php

namespace Api\Model;
use \Illuminate\Database\Eloquent\Model;

class Promotion extends Model {

    public $table = "salesforce.promotion__c";
    public $timestamps = false;
}