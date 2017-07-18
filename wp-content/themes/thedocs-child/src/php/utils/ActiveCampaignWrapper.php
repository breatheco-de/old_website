<?php

require_once("activecampaign/includes/ActiveCampaign.class.php");

class ActiveCampaignWrapper{
	const ACTIVECAMPAIGN_URL = 'https://4geeks.api-us1.com';
	const ACTIVECAMPAIGN_API_KEY = '30f9f6fe16d0c589445290af8c87fd7658500c700eda21ad8a232103d0037486c57e7a7d';

	const LIST_HOT_LEADS = 1;

	var $ac = null;

	function __construct() {
		$this->ac = new ActiveCampaign(self::ACTIVECAMPAIGN_URL, self::ACTIVECAMPAIGN_API_KEY);
		if (!(int)$this->ac->credentials_test()) throw new Exception("Access denied: Invalid credentials (URL and/or API key)", 1);
	}

	/*
	 * ADD OR EDIT CONTACT FROM/TO LIST.
	 */
	function addUserToList($wpUser,$listId)
	{
		$contact = array(
			"email"              => $wpUser->user_email,
			"first_name"         => $wpUser->first_name,
			"last_name"          => $wpUser->last_name,
			"p[{$list_id}]"      => $listId,//ActiveCampaignWrapper::LIST_HOT_LEADS,
			"status[{$list_id}]" => 1 // "Active" status
		);
		$contact_sync = $this->ac->api("contact/sync", $contact);
	}
	
}