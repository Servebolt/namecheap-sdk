<?php
namespace Namecheap\Users;

use Namecheap\Api;
use Namecheap\Exception\NamecheapException;
/**
 * Namecheap API wrapper
 *
 * Method UsersAddress
 * Manage Users address
 *
 * @author Saddam Hossain <saddamrhossain@gmail.com>
 *
 * @version 1
 */
class UsersAddress extends Api {

	protected $command = 'namecheap.users.address.';

	/**
	 * Creates a new address for the user
	 *
	 * str|AddressName|req 	: Address name to create
	 * str|EmailAddress|req 	: Email address of the user
	 * str|FirstName|req 	: First name of the user
	 * str|LastName|req 		: Last name of the user
	 * str|Address1|req 		: StreetAddress1 of the user
	 * str|City|req 			: City of the user
	 * str|StateProvince|req : State/Province of the user
	 * str|StateProvinceChoice|req : State/Province choice of the user
	 * str|Zip|req 			: Zip/Postal code of the user
	 * str|Country|req 		: Two letter country code of the user
	 * str|Phone|req 		: Phone number in the format +NNN.NNNNNNNNNN
	 *
	 * num|DefaultYN|opt 	: Possible values are 0 and 1.If the value of this parameter is set to 1, the address is set as default address for the user.
	 * str|JobTitle|opt 		: Job designation of the user
	 * str|Organization|opt 	: Organization of the user
	 * str|Address2|opt 		: StreetAddress2 of the user
	 * str|PhoneExt|opt 		: PhoneExt of the user
	 * str|Fax|opt 			: Fax number in the format +NNN.NNNNNNNNNN
	 * @param $param array
	 */
	public function create(array $param) {
		$requiredParams = ['AddressName', 'EmailAddress', 'FirstName', 'LastName', 'Address1', 'City', 'StateProvince', 'StateProvinceChoice', 'Zip', 'Country', 'Phone'];

		$data = [
			'AddressName' 	=> !empty($param['addressName']) ? $param['addressName'] : null,
			'EmailAddress' 	=> !empty($param['emailAddress']) ? $param['emailAddress'] : null,
			'FirstName' 	=> !empty($param['firstName']) ? $param['firstName'] : null,
			'LastName' 		=> !empty($param['lastName']) ? $param['lastName'] : null,
			'Address1' 		=> !empty($param['address1']) ? $param['address1'] : null,
			'City' 			=> !empty($param['city']) ? $param['city'] : null,
			'StateProvince' => !empty($param['stateProvince']) ? $param['stateProvince'] : null,
			'StateProvinceChoice'=> !empty($param['stateProvinceChoice']) ? $param['stateProvinceChoice'] : null,
			'Zip' 			=> !empty($param['zip']) ? $param['zip'] : null,
			'Country' 		=> !empty($param['country']) ? $param['country'] : null,
			'Phone' 		=> !empty($param['phone']) ? $param['phone'] : null,

			'DefaultYN' 	=> !empty($param['defaultYN']) ? $param['defaultYN'] : null,
			'JobTitle' 		=> !empty($param['jobTitle']) ? $param['jobTitle'] : null,
			'Organization' 	=> !empty($param['organization']) ? $param['organization'] : null,
			'Address2' 		=> !empty($param['address2']) ? $param['address2'] : null,
			'PhoneExt' 		=> !empty($param['phoneExt']) ? $param['phoneExt'] : null,
			'Fax' 			=> !empty($param['fax']) ? $param['fax'] : null,
		];

		$reqFields = $this->checkRequiredFields($data, $requiredParams);
		if (count($reqFields)) {
			$flist = implode(', ', $reqFields);
			throw new \Exception($flist . " : these fields are required!", 2010324);
		}

		return $this->get($this->command.__FUNCTION__, $data);
	}

	/**
	 * Deletes the particular address for the user.
	 *
	 * @param $addressId num|AddressId|req : The unique AddressID to delete
	 */
	public function delete($addressId) {
		return $this->get($this->command.__FUNCTION__, ['AddressID' => $addressId]);
	}

	/**
	 * Gets information for the requested addressID.
	 *
	 * @param $addressId num|AddressId|req : The unique AddressID
	 */
	public function getInfo($addressId) {
		return $this->get($this->command.__FUNCTION__, ['AddressID' => $addressId]);
	}

	/**
	 * Gets a list of addressIDs and addressnames associated with the user account.
	 */
	public function getList() {
		return $this->get($this->command.__FUNCTION__);
	}

	/**
	 * Sets default address for the user.
	 *
	 * @param $addressId num|AddressId|req : The unique addressID to set default
	 */
	public function setDefault($addressId) {
		return $this->get($this->command.__FUNCTION__, ['AddressID' => $addressId]);
	}

	/**
	 * Updates the particular address of the user
	 *
	 * @param $param array
	 * num|AddressId|req 		: The unique address ID to update
	 * str|AddressName|req 		: The AddressName to update
	 * str|EmailAddress|req 		: Email address of the user
	 * str|FirstName|req 		: First name of the user
	 * str|LastName|req 			: Last name of the user
	 * str|Address1|req 			: StreetAddress1 of the user
	 * str|City|req 				: City of the user
	 * str|StateProvince|req 	: State/Province of the user
	 * str|StateProvinceChoice|req : State/Province choice of the user
	 * str|Zip|req 				: Zip/Postal code of the user
	 * str|Country|req 			: Two letter country code of the user
	 * str|Phone|req 			: Phone number in the format +NNN.NNNNNNNNNN
	 *
	 * num|DefaultYN|req 	: Possible values are 0 and 1. If the value of this parameter is set to 1, the updated address is also set as default address for the user.	 
	 * str|JobTitle|req 		: Job designation of the user
	 * str|Organization|req 	: Organization of the user
	 * str|Address2|req 		: StreetAddress2 of the user
	 * str|PhoneExt|req 		: PhoneExt of the user
	 * str|Fax|req 			: Fax number in the format +NNN.NNNNNNNNNN
	 */
	public function update(array $param) {
		$requiredParams = ['AddressId', 'AddressName', 'EmailAddress', 'FirstName', 'LastName', 'Address1', 'City', 'StateProvince', 'StateProvinceChoice', 'Zip', 'Country', 'Phone'];

		$data = [
			'AddressId' 		=> !empty($param['addressId']) ? $param['addressId'] : null,
			'AddressName' 		=> !empty($param['addressName']) ? $param['addressName'] : null,
			'EmailAddress' 		=> !empty($param['emailAddress']) ? $param['emailAddress'] : null,
			'FirstName' 		=> !empty($param['firstName']) ? $param['firstName'] : null,
			'LastName' 			=> !empty($param['lastName']) ? $param['lastName'] : null,
			'Address1' 			=> !empty($param['address1']) ? $param['address1'] : null,
			'City' 				=> !empty($param['city']) ? $param['city'] : null,
			'StateProvince' 	=> !empty($param['stateProvince']) ? $param['stateProvince'] : null,
			'StateProvinceChoice'=> !empty($param['stateProvinceChoice']) ? $param['stateProvinceChoice'] : null,
			'Zip' 				=> !empty($param['zip']) ? $param['zip'] : null,
			'Country' 			=> !empty($param['country']) ? $param['country'] : null,
			'Phone' 			=> !empty($param['phone']) ? $param['phone'] : null,

			'DefaultYN' 		=> !empty($param['defaultYN']) ? $param['defaultYN'] : null,
			'JobTitle' 			=> !empty($param['jobTitle']) ? $param['jobTitle'] : null,
			'Organization' 		=> !empty($param['organization']) ? $param['organization'] : null,
			'Address2' 			=> !empty($param['address2']) ? $param['address2'] : null,
			'PhoneExt' 			=> !empty($param['phoneExt']) ? $param['phoneExt'] : null,
			'Fax' 				=> !empty($param['fax']) ? $param['fax'] : null,
		];

		$reqFields = $this->checkRequiredFields($data, $requiredParams);
		if (count($reqFields)) {
			$flist = implode(', ', $reqFields);
			throw new \Exception($flist . " : these fields are required!", 2010324);
		}

		return $this->get($this->command.__FUNCTION__, $data);	
	}

}

?>