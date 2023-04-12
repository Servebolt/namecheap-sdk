<?php

namespace Namecheap\Domain;

use Exception;
use Namecheap\Api;
use Namecheap\Exception\NamecheapException;

/**
 * Namecheap API wrapper
 *
 * Method Domains
 * Manage Domains
 *
 * @author Saddam Hossain <saddamrhossain@gmail.com>
 *
 * @version 1
 */
class Domains extends Api
{

    protected $command = 'namecheap.domains.';

    /**
     * Returns a list of domains for the particular user..
     *
     * @param $searchTerm str|listType|opt : Possible values are ALL, EXPIRING, or EXPIRED | Default : ALL
     * @param $listType str|searchTerm|opt :Keyword to look for in the domain list
     * @param $page num|page|opt : Page to return | Default Value: 1
     * @param $pageSize num|pageSize|opt :Number of domains to be listed on a page. Minimum value is 10, and maximum value is 100. | Default Value: 20
     * @param $sortBy str|sortBy|opt : Possible values are NAME, NAME_DESC, EXPIREDATE, EXPIREDATE_DESC, CREATEDATE, CREATEDATE_DESC
     */
    public function getList($searchTerm = null, $listType = null, $page = null, $pageSize = null, $sortBy = null)
    {
        $data = [
            'ListType' => $listType,
            'SearchTerm' => $searchTerm,
            'Page' => $page,
            'PageSize' => $pageSize,
            'SortBy' => $sortBy
        ];
        return $this->get($this->command . __FUNCTION__, $data);
    }

    /**
     * Gets contact information of the requested domain.
     *
     * @param $domainName str|domainName|req : Domain to get contacts
     */
    public function getContacts($domainName)
    {
        return $this->get($this->command . __FUNCTION__, ['DomainName' => $domainName]);
    }


    /**
     * Registers a new domain name.
     *
     * @param $domainInfo array
     * @param $contactInfo array
     * str|domainName|Req : Domain name to register
     * num|years|Req : Number of years to register Default Value: 2
     *
     * str|registrantFirstName|Req : First name of the Registrant user
     * str|registrantLastName|Req : Second name of the Registrant user
     * str|registrantAddress1|Req : Address1 of the Registrant user
     * str|registrantCity|Req : City of the Registrant user
     * str|registrantStateProvince|Req : State/Province of the Registrant user
     * str|registrantPostalCode|Req : PostalCode of the Registrant user
     * str|registrantCountry|Req : Country of the Registrant user
     * str|registrantPhone|Req : Phone number in the format +NNN.NNNNNNNNNN
     * str|registrantEmailAddress|Req : Email address of the Registrant user
     *
     * str|registrantOrganizationName|Opt : Organization of the Registrant user
     * str|registrantJobTitle|Opt : Job title of the Registrant user
     * str|registrantAddress2|Opt : Address2 of the Registrant user
     * str|registrantStateProvinceChoice|Opt : StateProvinceChoice of the Registrant user
     * str|registrantPhoneExt|Opt : PhoneExt of the Registrant user
     * str|registrantFax|Opt : Fax number in the format +NNN.NNNNNNNNNN
     *
     * str|techFirstName|Req : First name of the tech user
     * str|techLastName|Req : Second name of the tech user
     * str|techAddress1|Req : Address1 of the tech user
     * str|techCity|Req : City of the tech user
     * str|techStateProvince|Req : State/Province of the tech user
     * str|techPostalCode|Req : PostalCode of the tech user
     * str|techCountry|Req : Country of the tech user
     * str|techPhone|Req : Phone number in the format +NNN.NNNNNNNNNN
     * str|techEmailAddress|Req : Email address of the tech user
     *
     * str|techOrganizationName|Opt : Organization of the tech user
     * str|techJobTitle|Opt : Job title of the tech user
     * str|techAddress2|Opt : Address2 of the tech user
     * str|techStateProvinceChoice|Opt : StateProvinceChoice of the tech user
     * str|techPhoneExt|Opt : PhoneExt of the tech user
     * str|techFax|Opt : Fax number in the format +NNN.NNNNNNNNNN
     *
     * str|adminFirstName|Req : First name of the admin user
     * str|adminLastName|Req : Second name of the admin user
     * str|adminAddress1|Req : Address1 of the admin user
     * str|adminCity|Req : City of the admin user
     * str|adminStateProvince|Req : State/Province of the admin user
     * str|adminPostalCode|Req : PostalCode of the admin user
     * str|adminCountry|Req : Country of the admin user
     * str|adminPhone|Req : Phone number in the format +NNN.NNNNNNNNNN
     * str|adminEmailAddress|Req : Email address of the admin user
     *
     * str|adminOrganizationName|Opt : Organization of the admin user
     * str|adminJobTitle|Opt : Job title of the admin user
     * str|adminAddress2|Opt : Address2 of the admin user
     * str|adminStateProvinceChoice|Opt : StateProvinceChoice of the admin user
     * str|adminPhoneExt|Opt : PhoneExt of the admin user
     * str|adminFax|Opt : Fax number in the format +NNN.NNNNNNNNNN
     *
     * str|auxBillingFirstName|Req : First name of the auxBilling user
     * str|auxBillingLastName|Req : Second name of the auxBilling user
     * str|auxBillingAddress1|Req : Address1 of the auxBilling user
     * str|auxBillingCity|Req : City of the auxBilling user
     * str|auxBillingStateProvince|Req : State/Province of the auxBilling user
     * str|auxBillingPostalCode|Req : PostalCode of the auxBilling user
     * str|auxBillingCountry|Req : Country of the auxBilling user
     * str|auxBillingPhone|Req : Phone number in the format +NNN.NNNNNNNNNN
     * str|auxBillingEmailAddress|Req : Email address of the auxBilling user
     *
     * str|auxBillingOrganizationName|Opt : Organization of the auxBilling user
     * str|auxBillingJobTitle|Opt : Job title of the auxBilling user
     * str|auxBillingAddress2|Opt : Address2 of the auxBilling user
     * str|auxBillingStateProvinceChoice|Opt : StateProvinceChoice of the auxBilling user
     * str|auxBillingPhoneExt|Opt : PhoneExt of the auxBilling user
     * str|auxBillingFax|Opt : Fax number in the format +NNN.NNNNNNNNNN
     *
     * str|billingFirstName|Opt : First name of the billing user
     * str|billingLastName|Opt : Second name of the billing user
     * str|billingAddress1|Opt : Address1 of the billing user
     * str|billingCity|Opt : City of the billing user
     * str|billingStateProvince|Opt : State/Province of the billing user
     * str|billingPostalCode|Opt : PostalCode of the billing user
     * str|billingCountry|Opt : Country of the billing user
     * str|billingPhone|Opt : Phone number in the format +NNN.NNNNNNNNNN
     * str|billingEmailAddress|Opt : Email address of the billing user
     * str|billingAddress2|Opt : Address2 of the billing user
     * str|billingStateProvinceChoice|Opt : StateProvinceChoice of the billing user
     * str|billingPhoneExt|Opt : PhoneExt of the billing user
     * str|billingFax|Opt : Fax number in the format +NNN.NNNNNNNNNN
     *
     * str|idnCode|Opt : Code of Internationalized Domain Name (please refer to the note below)
     * str|nameservers|Opt : Comma-separated list of custom nameservers to be associated with the domain name
     * str|addFreeWhoisguard|Opt : Adds free WhoisGuard for the domain Default Value: no
     * str|wGEnabled|Opt : Enables free WhoisGuard for the domain Default Value: no
     * bool|isPremiumDomain|Opt : Indication if the domain name is premium
     * Currency|premiumPrice|Opt : Registration price for the premium domain
     * Currency|eapFee|Opt : Purchase fee for the premium domain during Early Access Program (EAP)*
     */
    public function create(array $domainInfo, array $contactInfo)
    {
        $data = $this->parseDomainData($domainInfo, $contactInfo);
        return $this->post($this->command . __FUNCTION__, $data);
    }

    /**
     * Returns a list of tlds available in namecheap
     */
    public function getTldList()
    {
        return $this->get($this->command . __FUNCTION__);
    }

    /**
     * Sets contact information for the domain.
     *
     * @param $domainInfo array
     * @param $contactInfo array
     * str|registrantFirstName|Req : First name of the Registrant user
     * str|registrantLastName|Req : Second name of the Registrant user
     * str|registrantAddress1|Req : Address1 of the Registrant user
     * str|registrantCity|Req : City of the Registrant user
     * str|registrantStateProvince|Req : State/Province of the Registrant user
     * str|registrantPostalCode|Req : PostalCode of the Registrant user
     * str|registrantCountry|Req : Country of the Registrant user
     * str|registrantPhone|Req : Phone number in the format +NNN.NNNNNNNNNN
     * str|registrantEmailAddress|Req : Email address of the Registrant user
     *
     * str|registrantOrganizationName|Opt : Organization of the Registrant user
     * str|registrantJobTitle|Opt : Job title of the Registrant user
     * str|registrantAddress2|Opt : Address2 of the Registrant user
     * str|registrantStateProvinceChoice|Opt : StateProvinceChoice of the Registrant user
     * str|registrantPhoneExt|Opt : PhoneExt of the Registrant user
     * str|registrantFax|Opt : Fax number in the format +NNN.NNNNNNNNNN
     *
     * str|techFirstName|Req : First name of the tech user
     * str|techLastName|Req : Second name of the tech user
     * str|techAddress1|Req : Address1 of the tech user
     * str|techCity|Req : City of the tech user
     * str|techStateProvince|Req : State/Province of the tech user
     * str|techPostalCode|Req : PostalCode of the tech user
     * str|techCountry|Req : Country of the tech user
     * str|techPhone|Req : Phone number in the format +NNN.NNNNNNNNNN
     * str|techEmailAddress|Req : Email address of the tech user
     *
     * str|techOrganizationName|Opt : Organization of the tech user
     * str|techJobTitle|Opt : Job title of the tech user
     * str|techAddress2|Opt : Address2 of the tech user
     * str|techStateProvinceChoice|Opt : StateProvinceChoice of the tech user
     * str|techPhoneExt|Opt : PhoneExt of the tech user
     * str|techFax|Opt : Fax number in the format +NNN.NNNNNNNNNN
     *
     * str|adminFirstName|Req : First name of the admin user
     * str|adminLastName|Req : Second name of the admin user
     * str|adminAddress1|Req : Address1 of the admin user
     * str|adminCity|Req : City of the admin user
     * str|adminStateProvince|Req : State/Province of the admin user
     * str|adminPostalCode|Req : PostalCode of the admin user
     * str|adminCountry|Req : Country of the admin user
     * str|adminPhone|Req : Phone number in the format +NNN.NNNNNNNNNN
     * str|adminEmailAddress|Req : Email address of the admin user
     *
     * str|adminOrganizationName|Opt : Organization of the admin user
     * str|adminJobTitle|Opt : Job title of the admin user
     * str|adminAddress2|Opt : Address2 of the admin user
     * str|adminStateProvinceChoice|Opt : StateProvinceChoice of the admin user
     * str|adminPhoneExt|Opt : PhoneExt of the admin user
     * str|adminFax|Opt : Fax number in the format +NNN.NNNNNNNNNN
     *
     * str|auxBillingFirstName|Req : First name of the auxBilling user
     * str|auxBillingLastName|Req : Second name of the auxBilling user
     * str|auxBillingAddress1|Req : Address1 of the auxBilling user
     * str|auxBillingCity|Req : City of the auxBilling user
     * str|auxBillingStateProvince|Req : State/Province of the auxBilling user
     * str|auxBillingPostalCode|Req : PostalCode of the auxBilling user
     * str|auxBillingCountry|Req : Country of the auxBilling user
     * str|auxBillingPhone|Req : Phone number in the format +NNN.NNNNNNNNNN
     * str|auxBillingEmailAddress|Req : Email address of the auxBilling user
     *
     * str|auxBillingOrganizationName|Opt : Organization of the auxBilling user
     * str|auxBillingJobTitle|Opt : Job title of the auxBilling user
     * str|auxBillingAddress2|Opt : Address2 of the auxBilling user
     * str|auxBillingStateProvinceChoice|Opt : StateProvinceChoice of the auxBilling user
     * str|auxBillingPhoneExt|Opt : PhoneExt of the auxBilling user
     * str|auxBillingFax|Opt : Fax number in the format +NNN.NNNNNNNNNN
     * @throws Exception
     */
    public function setContacts(array $domainInfo, array $contactInfo)
    {
        $data = $this->parseContactInfo($contactInfo);
        return $this->post($this->command . __FUNCTION__, array_merge($domainInfo, $data));
    }

    /**
     * Checks the availability of domains.
     * @param $domain str or Array|domain|req : The list of domains or a single domain name
     */
    public function check($domain)
    {
        if (is_array($domain)) {
            $domainString = implode(',', $domain);
            $data['DomainList'] = $domainString;
        } else if (is_string($domain)) {
            $data['DomainList'] = $domain;
        }

        return $this->get($this->command . __FUNCTION__, $data);
    }

    /**
     * Reactivates an expired domain.
     *
     * @param $domainName str|domainName|req : Domain name to reactivate
     * @param $promotionCode str|PromotionCode|opt : Promotional (coupon) code for reactivating the domain
     * @param $yearsToAdd num|yearsToAdd|opt : Number of years after expiry
     * @param $isPremiumDomain bool|isPremiumDomain|opt : Indication if the domain name is premium
     * @param $premiumPrice num|premiumPrice|opt : Reactivation price for the premium domain
     */
    public function reactivate($domainName, $promotionCode = null, $yearsToAdd = null, $isPremiumDomain = null, $premiumPrice = null)
    {
        $data = [
            'DomainName' => $domainName,
            'PromotionCode' => $promotionCode,
            'YearsToAdd' => $yearsToAdd,
            'IsPremiumDomain' => $isPremiumDomain,
            'PremiumPrice' => $premiumPrice,
        ];
        return $this->get($this->command . __FUNCTION__, $data);
    }

    /**
     * Renew an expired domain.
     *
     * @param $domainName str|domainName|req : Domain name to reactivate
     * @param $years num|years|req : Number of years to renew
     * @param $promotionCode str|promotionCode    |opt : Promotional (coupon) code for renewing the domain
     * @param $isPremiumDomain bool|isPremiumDomain|opt : Indication if the domain name is premium
     * @param $premiumPrice num|premiumPrice|opt : Reactivation price for the premium domain
     */
    public function renew($domainName, $years, $promotionCode = null, $isPremiumDomain = null, $premiumPrice = null)
    {
        $data = [
            'DomainName' => $domainName,
            'Years' => $years,
            'PromotionCode' => $promotionCode,
            'IsPremiumDomain' => $isPremiumDomain,
            'PremiumPrice' => $premiumPrice,
        ];
        return $this->get($this->command . __FUNCTION__, $data);
    }

    /**
     * Gets the RegistrarLock status of the requested domain.
     *
     * @param $domainName str|DomainName|req : Domain name to get status for
     */
    public function getRegistrarLock($domainName)
    {
        $data = ['DomainName' => $domainName];
        return $this->get($this->command . __FUNCTION__, $data);
    }

    /**
     * Sets the RegistrarLock status for a domain.
     *
     * @param $domainName str|DomainName|req : Domain name to get status for
     * @param $lockAction str|LockAction|opt : Possible values: LOCK, UNLOCK. | Default Value: LOCK.
     */
    public function setRegistrarLock($domainName, $lockAction = null)
    {
        $data = [
            'DomainName' => $domainName,
            'LockAction' => $lockAction,
        ];
        return $this->get($this->command . __FUNCTION__, $data);
    }

    /**
     * Returns information about the requested domain.
     * @param $domainName str|domainName|req : Domain name for which domain information needs to be requested
     * @param $hostName str|hostName|opt : Hosted domain name for which domain information needs to be requested
     */
    public function getInfo($domainName, $hostName = null)
    {
        $data = [
            'DomainName' => $domainName,
            'HostName' => $hostName,
        ];
        return $this->get($this->command . __FUNCTION__, $data);
    }


    /**
     * Helper methods
     *
     * @param $dd array domain details
     * @param $cd array contact details
     * @throws Exception
     */
    private function parseDomainData($dd, $cd)
    {
        //Extended attributes : not used
        $domainInfo = [
            #Req
            'DomainName' => !empty($dd['domainName']) ? $dd['domainName'] : null,
            'Years' => !empty($dd['years']) ? $dd['years'] : null,
            #Opt
            'PromotionCode' => !empty($dd['promotionCode']) ? $dd['promotionCode'] : null,
        ];

        $billing = [
            #opt
            'BillingFirstName' => !empty($cd['billingFirstName']) ? $cd['billingFirstName'] : null,
            'BillingLastName' => !empty($cd['billingLastName']) ? $cd['billingLastName'] : null,
            'BillingAddress1' => !empty($cd['billingAddress1']) ? $cd['billingAddress1'] : null,
            'BillingAddress2' => !empty($cd['billingAddress2']) ? $cd['billingAddress2'] : null,
            'BillingCity' => !empty($cd['billingCity']) ? $cd['billingCity'] : null,
            'BillingStateProvince' => !empty($cd['billingStateProvince']) ? $cd['billingStateProvince'] : null,
            'BillingStateProvinceChoice' => !empty($cd['billingStateProvinceChoice']) ? $cd['billingStateProvinceChoice'] : null,
            'BillingPostalCode' => !empty($cd['billingPostalCode']) ? $cd['billingPostalCode'] : null,
            'BillingCountry' => !empty($cd['billingCountry']) ? $cd['billingCountry'] : null,
            'BillingPhone' => !empty($cd['billingPhone']) ? $cd['billingPhone'] : null,
            'BillingPhoneExt' => !empty($cd['billingPhoneExt']) ? $cd['billingPhoneExt'] : null,
            'BillingFax' => !empty($cd['billingFax']) ? $cd['billingFax'] : null,
            'BillingEmailAddress' => !empty($cd['billingEmailAddress']) ? $cd['billingEmailAddress'] : null,

        ];

        $extra = [
            #Req

            #opt
            'IdnCode' => !empty($dd['idnCode']) ? $dd['idnCode'] : null,
            'Nameservers' => !empty($dd['nameservers']) ? $dd['nameservers'] : null,
            'AddFreeWhoisguard' => !empty($dd['addFreeWhoisguard']) ? $dd['addFreeWhoisguard'] : null,
            'WGEnabled' => !empty($dd['wGEnabled']) ? $dd['wGEnabled'] : null,
            'IsPremiumDomain' => !empty($dd['isPremiumDomain']) ? $dd['isPremiumDomain'] : null,
            'PremiumPrice' => !empty($dd['premiumPrice']) ? $dd['premiumPrice'] : null,
            'EapFee' => !empty($dd['eapFee']) ? $dd['eapFee'] : null,
        ];

        return array_merge($domainInfo, $this->parseContactInfo($cd), $billing, $extra);
    }

    /**
     * @param $d array domain
     * @throws Exception
     */
    private function parseContactInfo($d)
    {

        $requiredFields = [
            'FirstName', 'LastName', 'Address1', 'City', 'StateProvince', 'PostalCode', 'Country', 'Phone', 'EmailAddress',
        ];

        $requiredRegistrant = array_map(function ($f) {
            return 'Registrant' . $f;
        }, $requiredFields);
        $requiredTech = array_map(function ($f) {
            return 'Tech' . $f;
        }, $requiredFields);
        $requiredAdmin = array_map(function ($f) {
            return 'Admin' . $f;
        }, $requiredFields);
        $requiredAuxBilling = array_map(function ($f) {
            return 'AuxBilling' . $f;
        }, $requiredFields);

        $registrant = [
            'RegistrantFirstName' => !empty($d['registrantFirstName']) ? $d['registrantFirstName'] : null,
            'RegistrantLastName' => !empty($d['registrantLastName']) ? $d['registrantLastName'] : null,
            'RegistrantAddress1' => !empty($d['registrantAddress1']) ? $d['registrantAddress1'] : null,
            'RegistrantCity' => !empty($d['registrantCity']) ? $d['registrantCity'] : null,
            'RegistrantStateProvince' => !empty($d['registrantStateProvince']) ? $d['registrantStateProvince'] : null,
            'RegistrantPostalCode' => !empty($d['registrantPostalCode']) ? $d['registrantPostalCode'] : null,
            'RegistrantCountry' => !empty($d['registrantCountry']) ? $d['registrantCountry'] : null,
            'RegistrantPhone' => !empty($d['registrantPhone']) ? $d['registrantPhone'] : null,
            'RegistrantEmailAddress' => !empty($d['registrantEmailAddress']) ? $d['registrantEmailAddress'] : null,
            #opt
            'RegistrantOrganizationName' => !empty($d['RegistrantOrganizationName']) ? $d['RegistrantOrganizationName'] : null,
            'RegistrantJobTitle' => !empty($d['registrantJobTitle']) ? $d['registrantJobTitle'] : null,
            'RegistrantAddress2' => !empty($d['registrantAddress2']) ? $d['registrantAddress2'] : null,
            'RegistrantStateProvinceChoice' => !empty($d['registrantStateProvinceChoice']) ? $d['registrantStateProvinceChoice'] : null,
            'RegistrantPhoneExt' => !empty($d['registrantPhoneExt']) ? $d['registrantPhoneExt'] : null,
            'RegistrantFax' => !empty($d['registrantFax']) ? $d['registrantFax'] : null,
        ];

        $tech = [
            #Req
            'TechFirstName' => !empty($d['techFirstName']) ? $d['techFirstName'] : null,
            'TechLastName' => !empty($d['techLastName']) ? $d['techLastName'] : null,
            'TechAddress1' => !empty($d['techAddress1']) ? $d['techAddress1'] : null,
            'TechCity' => !empty($d['techCity']) ? $d['techCity'] : null,
            'TechStateProvince' => !empty($d['techStateProvince']) ? $d['techStateProvince'] : null,
            'TechPostalCode' => !empty($d['techPostalCode']) ? $d['techPostalCode'] : null,
            'TechCountry' => !empty($d['techCountry']) ? $d['techCountry'] : null,
            'TechPhone' => !empty($d['techPhone']) ? $d['techPhone'] : null,
            'TechEmailAddress' => !empty($d['techEmailAddress']) ? $d['techEmailAddress'] : null,

            #opt
            'TechOrganizationName' => !empty($d['techOrganizationName']) ? $d['techOrganizationName'] : null,
            'TechJobTitle' => !empty($d['techJobTitle']) ? $d['techJobTitle'] : null,
            'TechAddress2' => !empty($d['techAddress2']) ? $d['techAddress2'] : null,
            'TechStateProvinceChoice' => !empty($d['techStateProvinceChoice']) ? $d['techStateProvinceChoice'] : null,
            'TechPhoneExt' => !empty($d['techPhoneExt']) ? $d['techPhoneExt'] : null,
            'TechFax' => !empty($d['techFax']) ? $d['techFax'] : null,
        ];

        $admin = [
            #Req
            'AdminFirstName' => !empty($d['adminFirstName']) ? $d['adminFirstName'] : null,
            'AdminLastName' => !empty($d['adminLastName']) ? $d['adminLastName'] : null,
            'AdminAddress1' => !empty($d['adminAddress1']) ? $d['adminAddress1'] : null,
            'AdminCity' => !empty($d['adminCity']) ? $d['adminCity'] : null,
            'AdminStateProvince' => !empty($d['adminStateProvince']) ? $d['adminStateProvince'] : null,
            'AdminPostalCode' => !empty($d['adminPostalCode']) ? $d['adminPostalCode'] : null,
            'AdminCountry' => !empty($d['adminCountry']) ? $d['adminCountry'] : null,
            'AdminPhone' => !empty($d['adminPhone']) ? $d['adminPhone'] : null,
            'AdminEmailAddress' => !empty($d['adminEmailAddress']) ? $d['adminEmailAddress'] : null,

            #opt
            'AdminOrganizationName' => !empty($d['adminOrganizationName']) ? $d['adminOrganizationName'] : null,
            'AdminJobTitle' => !empty($d['adminJobTitle']) ? $d['adminJobTitle'] : null,
            'AdminAddress2' => !empty($d['adminAddress2']) ? $d['adminAddress2'] : null,
            'AdminStateProvinceChoice' => !empty($d['adminStateProvinceChoice']) ? $d['adminStateProvinceChoice'] : null,
            'AdminPhoneExt' => !empty($d['adminPhoneExt']) ? $d['adminPhoneExt'] : null,
            'AdminFax' => !empty($d['adminFax']) ? $d['adminFax'] : null,
        ];

        $auxBilling = [
            #Req
            'AuxBillingFirstName' => !empty($d['auxBillingFirstName']) ? $d['auxBillingFirstName'] : null,
            'AuxBillingLastName' => !empty($d['auxBillingLastName']) ? $d['auxBillingLastName'] : null,
            'AuxBillingAddress1' => !empty($d['auxBillingAddress1']) ? $d['auxBillingAddress1'] : null,
            'AuxBillingCity' => !empty($d['auxBillingCity']) ? $d['auxBillingCity'] : null,
            'AuxBillingStateProvince' => !empty($d['auxBillingStateProvince']) ? $d['auxBillingStateProvince'] : null,
            'AuxBillingPostalCode' => !empty($d['auxBillingPostalCode']) ? $d['auxBillingPostalCode'] : null,
            'AuxBillingCountry' => !empty($d['auxBillingCountry']) ? $d['auxBillingCountry'] : null,
            'AuxBillingPhone' => !empty($d['auxBillingPhone']) ? $d['auxBillingPhone'] : null,
            'AuxBillingEmailAddress' => !empty($d['auxBillingEmailAddress']) ? $d['auxBillingEmailAddress'] : null,

            #opt
            'AuxBillingOrganizationName' => !empty($d['auxBillingOrganizationName']) ? $d['auxBillingOrganizationName'] : null,
            'AuxBillingJobTitle' => !empty($d['auxBillingJobTitle']) ? $d['auxBillingJobTitle'] : null,
            'AuxBillingAddress2' => !empty($d['auxBillingAddress2']) ? $d['auxBillingAddress2'] : null,
            'AuxBillingStateProvinceChoice' => !empty($d['auxBillingStateProvinceChoice']) ? $d['auxBillingStateProvinceChoice'] : null,
            'AuxBillingPhoneExt' => !empty($d['auxBillingPhoneExt']) ? $d['auxBillingPhoneExt'] : null,
            'AuxBillingFax' => !empty($d['auxBillingFax']) ? $d['auxBillingFax'] : null,
        ];

        # Validation fields
        $reqFields = $this->checkRequiredFields($registrant, $requiredRegistrant);
        if (count($reqFields)) {
            $flist = implode(', ', $reqFields);
            throw new Exception($flist . " : these fields are required!", 2010324);
        } else {
            // validate / replaced values with $registrant array for tech, admin, auxBilling
            $reqFields = $this->checkRequiredFields($tech, $requiredTech);
            foreach ($reqFields as $k) $tech[$k] = $registrant['Registrant' . substr($k, strlen('Tech'))];

            $reqFields = $this->checkRequiredFields($admin, $requiredAdmin);
            foreach ($reqFields as $k) $admin[$k] = $registrant['Registrant' . substr($k, strlen('Admin'))];

            $reqFields = $this->checkRequiredFields($auxBilling, $requiredAuxBilling);
            foreach ($reqFields as $k) $auxBilling[$k] = $registrant['Registrant' . substr($k, strlen('AuxBilling'))];
        }

        return array_merge($registrant, $tech, $admin, $auxBilling);
    }
}

