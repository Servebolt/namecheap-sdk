<?php

namespace Namecheap\Ssl;

use Namecheap\Api;
use Namecheap\Exception\NamecheapException;

/**
 * Namecheap API wrapper
 *
 * Method Ssl
 * Manage Ssl
 *
 * @author Saddam Hossain <saddamrhossain@gmail.com>
 *
 * @version 1
 */
class Ssl extends Api
{

    protected $command = 'namecheap.ssl.';

    /**
     * Creates a new SSL certificate.
     * @param $years num|Years|req : Number of years SSL will be issued for Allowed values: 1,2
     * @param $type str|Type|req : SSL product name. See "Possible values for Type parameter" below this list.
     * @param $sANStoADD num|SANStoADD|opt : Defines number of add-on domains to be purchased in addition to the default number of domains included into a multi-domain certificate.
     * @param $promotionCode str|PromotionCode|opt : Promotional (coupon) code for the certificate
     *
     * ### Possible values for Type parameter:
     * PositiveSSL, EssentialSSL, InstantSSL, InstantSSL Pro, PremiumSSL, EV SSL, PositiveSSL Wildcard, EssentialSSL Wildcard, PremiumSSL Wildcard, PositiveSSL Multi Domain, Multi Domain SSL, Unified Communications, EV Multi Domain SSL.
     */
    public function create($years, $type, $sANStoADD = null, $promotionCode = null)
    {
        $data = [
            'Years' => $years,
            'Type' => $type,
            'SANStoADD' => $sANStoADD,
            'PromotionCode' => $promotionCode,
        ];

        return $this->get($this->command . __FUNCTION__, $data);
    }

    /**
     * Returns a list of SSL certificates for the particular user.
     *
     * @param $listTypestr |ListType|opt : Possible values are ALL,Processing,EmailSent,TechnicalProblem,InProgress, Completed,Deactivated,Active,Cancelled,NewPurchase, NewRenewal. Default Value: All
     * @param $searchTerm str|SearchTerm|opt : Keyword to look for on the SSL list
     * @param $page num|Page|opt : Page to return Default Value: 1
     * @param $pageSize num|PageSize|opt : Total number of SSL certificates to display in a page. Minimum value is 10 and maximum value is 100. Default Value: 20
     * @param $sortBy str|SortBy|opt : Possible values are PURCHASEDATE, PURCHASEDATE_DESC, SSLTYPE, SSLTYPE_DESC, EXPIREDATETIME, EXPIREDATETIME_DESC,Host_Name, Host_Name_DESC.
     */
    public function getList($listType = null, $searchTerm = null, $page = null, $pageSize = null, $sortBy = null)
    {
        $data = [
            'ListType' => $listType,
            'SearchTerm' => $searchTerm,
            'Page' => $page,
            'PageSize' => $pageSize,
            'SortBy' => $sortBy,
        ];
        return $this->get($this->command . __FUNCTION__, $data);
    }

    /**
     * Parsers the CSR
     *
     * @param $csr str|csr|req              :    Certificate Signing Request
     * @param $certificateType str|CertificateType|req : Type of SSL Certificate
     * Possible values for CertificateType parameter:
     * InstantSSL, PositiveSSL, PositiveSSL Wildcard, EssentialSSL, EssentialSSL Wildcard, InstantSSL Pro, PremiumSSL Wildcard, EV SSL, EV Multi Domain SSL, Multi Domain SSL, PositiveSSL Multi Domain, Unified Communications.
     */
    public function parseCSR($csr, $certificateType = null)
    {
        $data = [
            'csr' => $csr,
            'CertificateType' => $certificateType
        ];
        return $this->post($this->command . __FUNCTION__, $data);
    }

    /**
     * Gets approver email list for the requested certificate.
     *
     * @param $domainName str|DomainName|req        : Domain name to get the list
     * @param $certificateType str|CertificateType|req    : Type of SSL certificate
     */
    public function getApproverEmailList($domainName, $certificateType)
    {
        $data = [
            'DomainName' => $domainName,
            'CertificateType' => $certificateType
        ];
        return $this->post($this->command . __FUNCTION__, $data);
    }

    /**
     * Activates a purchased and non-activated SSL certificate by collecting and validating certificate request data and submitting it to Comodo.
     *
     * num|CertificateID|req : Unique identifier of SSL certificate to be activated
     * str|CSR|req : Certificate Signing Request (CSR)
     * str|AdminEmailAddress|req : Email address to send signed SSL certificate file to
     * str|WebServerType|opt : Server software where SSL will be installed. Defines SSL certificate file format (PEM or PKCS7). Allowed values: apacheopenssl, apachessl, apacheraven, apachessleay, apache2, apacheapachessl, tomcat, cpanel, ipswitch, plesk, weblogic, website, webstar, nginx, iis, iis4, iis5, c2net, ibmhttp, iplanet, domino, dominogo4625, dominogo4626, netscape, zeusv3, cobaltseries, ensim, hsphere, other
     *
     * ## Command can be run on purchased and non-activated SSLs in "Newpurchase" or "Newrenewal" status. Use getInfo and getList APIs to collect SSL status.
     * ## Only supported products can be activated. See create API to learn supported products.
     * ## Sandbox limitation: Activation process works for all certificates. However, an actual test certificate will not be returned for OV and EV certificates.
     */
    public function activate(int $CertificateID, string $CSR, ?string $AdminEmailAddress = null, ?string $WebServerType = null, ?string $UniqueValue = null)
    {
        return $this->get($this->command . __FUNCTION__, compact('CertificateID', 'CSR', 'AdminEmailAddress', 'WebServerType', 'UniqueValue'));
    }

    /**
     * Resends the approver email.
     * @param $certificateID str|CertificateID|req : The unique certificate ID that you get after calling ssl.create command
     */
    public function resendApproverEmail($certificateID)
    {
        return $this->get($this->command . __FUNCTION__, ['CertificateID' => $certificateID]);
    }

    /**
     * Retrieves information about the requested SSL certificate
     *
     * @param $certificateID num|CertificateID|req    : Unique ID of the SSL certificate
     * @param $returncertificate str|Returncertificate|opt : A flag for returning certificate in response
     * @param $returntype str|Returntype|opt        : Type of returned certificate. Parameter takes “Individual” (for X.509 format) or “PKCS7” values.
     */
    public function getInfo($certificateID, $returncertificate = null, $returntype = null)
    {
        $data = [
            'CertificateID' => $certificateID,
            'Returncertificate' => $returncertificate,
            'Returntype' => $returntype,
        ];
        return $this->get($this->command . __FUNCTION__, $data);
    }

    /**
     * Renews an SSL certificate.
     *
     * @param $certificateIDstr |CertificateID|req : Unique ID of the SSL certificate you wish to renew
     * @param $years str|Years|req : Number of years renewal SSL will be issued for Allowed values: 1,2
     * @param $sSLType str|SSLType|req : SSL product name. See "Possible values for SSLType parameter" below this table.
     * @param $promotionCode str|PromotionCode|opt : Promotional (coupon) code for the certificate
     */
    public function renew($certificateID, $years, $sSLType, $promotionCode = null)
    {
        $data = [
            'CertificateID' => $certificateID,
            'Years' => $years,
            'SSLType' => $sSLType,
            'PromotionCode' => $promotionCode,
        ];

        return $this->post($this->command . __FUNCTION__, $data);
    }

    /**
     * Initiates creation of a new certificate version of an active SSL certificate by collecting and validating new certificate request data and submitting it to Comodo.
     */
    public function reissue()
    {
        return false;
    }

    /**
     * Resends the fulfilment email containing the certificate.
     * @param $certificateID str|CertificateID|req : The unique certificate ID that you get after calling ssl.create command
     */
    public function resendfulfillmentemail($certificateID)
    {
        return $this->get($this->command . __FUNCTION__, ['CertificateID' => $certificateID]);
    }

    /**
     * Purchases more add-on domains for already purchased certificate.
     *
     * @param $certificateID num|CertificateID|req : ID of the certificate for which you wish to purchase more add-on domains
     * @param $numberOfSANSToAdd num|NumberOfSANSToAdd|req : Number of add-on domains to be ordered
     */
    public function purchasemoresans($certificateID, $numberOfSANSToAdd)
    {
        return $this->get($this->command . __FUNCTION__, ['CertificateID' => $certificateID, 'NumberOfSANSToAdd' => $numberOfSANSToAdd]);
    }

    /**
     * @Important This function is currently supported for Comodo certificates only.
     * Revokes a re-issued SSL certificate.
     *
     * @param $certificateID num|CertificateID|req    : ID of the certificate for you wish to revoke Default Value: 1
     * @param $certificateType str|CertificateType|req    : Type of SSL Certificate
     * Possible values for Type parameter:
     * InstantSSL, PositiveSSL, PositiveSSL Wildcard, EssentialSSL, EssentialSSL Wildcard, InstantSSL Pro, PremiumSSL Wildcard, EV SSL, EV Multi Domain SSL, Multi Domain SSL, PositiveSSL Multi Domain, Unified Communications.
     */
    public function revokecertificate($certificateID, $certificateType)
    {
        return $this->get($this->command . __FUNCTION__, ['CertificateID' => $certificateID, 'CertificateType' => $certificateType]);
    }

    /**
     * Sets new domain control validation (DCV) method for a certificate or serves as 'retry' mechanism
     */
    public function editDCVMethod()
    {
        return false;
    }

}

