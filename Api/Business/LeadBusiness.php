<?php
namespace Api\Business;

use Api\Model\Lead;

class LeadBusiness extends Business {

    /**
     * Get Lead By FacebookId
     * @param $facebookId
     * @return Lead
     */
    public static function getLeadByFacebookId($facebookId){
        new static;

        $lead = Lead::where('facebookid__c',$facebookId)->first();
        if ($lead)
            return $lead->toArray();
        else
            return null;
    }

    /**
     * create new lead
     * @param $lead
     * @return array
     */
    public static function createLead($lead) {
        new static;

        $newLead = new Lead();
        $newLead->firstname     = $lead['firstname'];
        $newLead->lastname      = $lead['lastname'];
        $newLead->facebookid__c = $lead['facebookid__c'];
        $newLead->phone         = $lead['phone'];
        $newLead->email         = $lead['email'];
        $newLead->company       = "Company";
        $newLead->street        = $lead['street'];
        $newLead->status        = "Open";
        $newLead->save();

        return $newLead->toArray();
    }

    /**
     * Update Lead by new Lead information
     * @param $facebookId
     * @param $lead
     * @return mixed
     */
    public static function updateLead($facebookId, $lead){
        new static;

        $updateLead = Lead::where('facebookid__c',$facebookId)->first();

        if ($updateLead) {
            $updateLead->firstname     = $lead['firstname'];
            $updateLead->lastname      = $lead['lastname'];
            $updateLead->phone         = $lead['phone'];
            $updateLead->email         = $lead['email'];
            $updateLead->company       = "MyCompany";
            $updateLead->street        = $lead['street'];
            $updateLead->save();
        }
        else
            return false;

        return $updateLead->toArray();
    }
}