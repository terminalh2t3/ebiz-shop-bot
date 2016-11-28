<?php

namespace Api\Model;
use \Illuminate\Database\Eloquent\Model;

class Category extends Model {

    public $table = "salesforce.category__c";
    public $timestamps = false;
}