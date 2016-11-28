<?php

namespace Api\Model;
use \Illuminate\Database\Eloquent\Model;

class Lead extends Model {

    public $table = "salesforce.lead";
    public $timestamps = false;
    protected $fillable = [
        'name', 'firstname' , 'lastname', 'title', 'facebookid__c', 'description', 'phone',
        'email' , 'status', 'city', 'country', 'postalcode', 'website', 'company', 'photourl'
    ];
}