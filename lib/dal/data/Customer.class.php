<?php
	class Customer
	{
		var $customerId;
		var $customerName;
		var $customerTelephone;
		var $customerEmail;
		var $customerExtension;
		var $customerUsername;
        var $customerPassword;
        var $customerImage;
		var $customerNotes;
		var $roomId;
		
		public function cloneCustomer($new_customer)
		{
			$this->customerId = $new_customer->customerId;
			$this->customerName = $new_customer->customerName;
			$this->customerUsername = $new_customer->customerUsername;
			$this->customerPassword = $new_customer->customerPassword;
			$this->customerNotes = $new_customer->customerNotes;
			$this->LevelId = $new_customer->LevelId;
		}
	}
?>