<?php

namespace Namecheap\Ssl;

use Namecheap\Api;

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
    protected string $command = 'namecheap.ssl.';

    /**
     * Creates a new SSL certificate.
     * @param int $Years Number of years SSL will be issued for Allowed values: 1,2
     * @param string $Type SSL product name. See "Possible values for Type parameter" below this list.
     * @param int|null $SANStoADD Defines number of add-on domains to be purchased in addition to the default number of domains included into a multi-domain certificate.
     * @param string|null $PromotionCode Promotional (coupon) code for the certificate
     *
     * Possible values for Type parameter:
     * PositiveSSL, EssentialSSL, InstantSSL, InstantSSL Pro, PremiumSSL, EV SSL, PositiveSSL Wildcard, EssentialSSL Wildcard, PremiumSSL Wildcard, PositiveSSL Multi Domain, Multi Domain SSL, Unified Communications, EV Multi Domain SSL.
     * @return bool|mixed|string
     * @throws \Exception
     */
    public function create(int $Years, string $Type, ?int $SANStoADD = null, ?string $PromotionCode = null)
    {
        return $this->get($this->command . __FUNCTION__, compact(
            'Years',
            'Type',
            'SANStoADD',
            'PromotionCode',
        ));
    }

    /**
     * Returns a list of SSL certificates for the particular user.
     *
     * @param string|null $ListType
     * @param string|null $SearchTerm Keyword to look for on the SSL list
     * @param int|null $Page Page to return Default Value: 1
     * @param int|null $PageSize Total number of SSL certificates to display in a page. Minimum value is 10 and maximum value is 100. Default Value: 20
     * @param int|null $SortBy Possible values are PURCHASEDATE, PURCHASEDATE_DESC, SSLTYPE, SSLTYPE_DESC, EXPIREDATETIME, EXPIREDATETIME_DESC,Host_Name, Host_Name_DESC.
     * @return bool|mixed|string
     * @throws \Exception
     */
    public function getList(?string $ListType = null, ?string $SearchTerm = null, ?int $Page = null, ?int $PageSize = null, ?int $SortBy = null)
    {
        return $this->get($this->command . __FUNCTION__, compact(
            'ListType',
            'SearchTerm',
            'Page',
            'PageSize',
            'SortBy',
        ));
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
     * @param $domainName : Domain name to get the list
     * @param $certificateType : Type of SSL certificate
     * @return bool|mixed|string
     * @throws \Exception
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
     * Activates a purchased and non-activated SSL certificate by collecting and validating certificate request data and submitting it to Comodo
     *
     * Command can be run on purchased and non-activated SSLs in "Newpurchase" or "Newrenewal" status. Use getInfo and getList APIs to collect SSL status.
     * Only supported products can be activated. See create API to learn supported products.
     * Sandbox limitation: Activation process works for all certificates. However, an actual test certificate will not be returned for OV and EV certificates.
     *
     * @param int $CertificateID
     * @param string $CSR
     * @param string|null $AdminEmailAddress
     * @param string|null $WebServerType
     * @param string|null $UniqueValue
     * @return bool|mixed|string
     * @throws \Exception
     */
    public function activate(
        int     $CertificateID,
        string  $CSR,
        ?string $AdminFirstName = null,
        ?string $AdminLastName = null,
        ?string $AdminJobTitle = null,
        ?string $AdminAddress = null,
        ?string $AdminCity = null,
        ?string $AdminStateProvince = null,
        ?string $AdminPostalCode = null,
        ?string $AdminCountry = null,
        ?string $AdminPhone = null,
        ?string $AdminEmailAddress = null,
        ?string $ApproverEmail = null,
        ?bool   $HTTPDCValidation = null,
        ?bool   $DNSDCValidation = null,
        ?string $WebServerType = null,
        ?string $UniqueValue = null
    )
    {
        return $this->get($this->command . __FUNCTION__, compact(
            'CertificateID',
            'CSR',
            'AdminFirstName',
            'AdminLastName',
            'AdminJobTitle',
            'AdminAddress',
            'AdminCity',
            'AdminStateProvince',
            'AdminPostalCode',
            'AdminCountry',
            'AdminPhone',
            'AdminEmailAddress',
            'ApproverEmail',
            'HTTPDCValidation',
            'DNSDCValidation',
            'WebServerType',
            'UniqueValue'
        ));
    }

    /**
     * Resends the approver email.
     * @param string $CertificateID
     * @return bool|mixed|string
     * @throws \Exception
     */
    public function resendApproverEmail(string $CertificateID)
    {
        return $this->get($this->command . __FUNCTION__, ['CertificateID' => $CertificateID]);
    }

    /**
     * Retrieves information about the requested SSL certificate
     *
     * @param int $CertificateID Unique ID of the SSL certificate
     * @param string|null $Returncertificate A flag for returning certificate in response
     * @param string|null $Returntype Type of returned certificate. Parameter takes “Individual” (for X.509 format) or “PKCS7” values.
     * @return bool|mixed|string
     * @throws \Exception
     */
    public function getInfo(int $CertificateID, ?string $Returncertificate = null, ?string $Returntype = null)
    {
        return $this->get($this->command . __FUNCTION__, compact(
            'CertificateID',
            'Returncertificate',
            'Returntype',
        ));
    }

    /**
     * Renews an SSL certificate.
     *
     * @param int $CertificateID Unique ID of the SSL certificate you wish to renew
     * @param int $Years Number of years renewal SSL will be issued for Allowed values: 1,2
     * @param string $SSLType SSL product name. See "Possible values for SSLType parameter" below this table.
     * @param string|null $PromotionCode str|PromotionCode|opt : Promotional (coupon) code for the certificate
     * @return bool|mixed|string
     * @throws \Exception
     */
    public function renew(int $CertificateID, int $Years, string $SSLType, ?string $PromotionCode = null)
    {
        return $this->post($this->command . __FUNCTION__, compact(
            'CertificateID',
            'Years',
            'SSLType',
            'PromotionCode',
        ));
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

