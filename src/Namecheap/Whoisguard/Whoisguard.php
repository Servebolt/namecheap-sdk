<?php

namespace Namecheap\Whoisguard;

use Namecheap\Api;
use Namecheap\Exception\NamecheapException;

/**
 * Namecheap API wrapper
 *
 * Method whoisguard
 * Manage whoisguard
 *
 * @author Saddam Hossain <saddamrhossain@gmail.com>
 *
 * @version 1
 */
class Whoisguard extends Api
{

    protected $command = 'namecheap.whoisguard.';

    /**
     * Changes WhoisGuard email address
     *
     * @param $whoisguardID num|WhoisguardID|req :The unique WhoisGuardID that you wish to change
     */
    public function changeemailaddress($whoisguardID)
    {
        return $this->get($this->command . __FUNCTION__, ['WhoisguardID' => $whoisguardID]);
    }

    /**
     * Enables WhoisGuard privacy protection.
     * @param $whoisguardID num|WhoisguardID|req        : The unique WhoisGuardID which you get
     * @param $forwardedToEmail str|ForwardedToEmail|req    : The email address to which WhoisGuard emails are to be forwarded
     */
    public function enable($whoisguardID, $forwardedToEmail)
    {
        return $this->get($this->command . __FUNCTION__, ['WhoisguardID' => $whoisguardID, 'ForwardedToEmail' => $forwardedToEmail]);
    }

    /**
     * Disables WhoisGuard privacy protection.
     * @param $whoisguardID num|WhoisguardID|req : The unique WhoisGuardID which has to be disabled.
     */
    public function disable($whoisguardID)
    {
        return $this->get($this->command . __FUNCTION__, ['WhoisguardID' => $whoisguardID]);
    }

    /**
     * Unallots WhoisGuard privacy protection.
     * @param $whoisguardID num|WhoisguardID|req : The unique WhoisGuardID that has to be unalloted.
     */
    public function unallot($whoisguardID)
    {
        return $this->get($this->command . __FUNCTION__, ['WhoisguardID' => $whoisguardID]);
    }

    /**
     * Discards whoisguard.
     * @param $whoisguardID num|WhoisguardID|req : The WhoisGuardID you wish to discard
     */
    public function discard($whoisguardID)
    {
        return $this->get($this->command . __FUNCTION__, ['WhoisguardID' => $whoisguardID]);
    }

    /**
     * Allots WhoisGuard
     * @param $whoisguardId num|WhoisguardId|req    : The unique WhoisGuardID
     * @param $domainName str|DomainName|req    : Domain that you wish to allot WhoisGuard to
     * @param $forwardedToEmail str|ForwardedToEmail|opt : The email to which you wish to forward your WhoisGuard emails
     * @param $enableWG str|EnableWG|opt        : Possible Values: True and False Default Value:False
     */
    public function allot($whoisguardId, $domainName, $forwardedToEmail = null, $enableWG = null)
    {

        $data = [
            'WhoisguardId' => $whoisguardId,
            'DomainName' => $domainName,
            'ForwardedToEmail' => $forwardedToEmail,
            'EnableWG' => $enableWG,
        ];

        return $this->get($this->command . __FUNCTION__, $data);
    }

    /**
     * Gets the list of WhoisGuard privacy protection.
     * @param $listType num|ListType|opt : Possible values are ALL, ALLOTED, FREE, DISCARD. Default Value: ALL
     * @param $page num|Page|opt : Page to return Default Value: 1
     * @param $pageSize num|PageSize|opt : Number of WhoisGuard to be listed on a page. Minimum value: 2; Maximum value: 100
     */
    public function getList($listType = null, $page = null, $pageSize = null)
    {
        $data = [
            'ListType' => $listType,
            'Page' => $page,
            'PageSize' => $pageSize,
        ];

        return $this->get($this->command . __FUNCTION__, $data);
    }

    /**
     * Renews WhoisGuard privacy protection.
     * @param $whoisguardID |WhoisguardID|req : WhoisGuardID to renew
     * @param $years num|Years|req : Number of years to renew Default Value: 1
     * @param $promotionCode num|PromotionCode|opt : Promotional (coupon) code for renewing the WhoisGuard
     */
    public function renew($whoisguardID, $years = 1, $promotionCode = null)
    {
        $data = [
            'WhoisguardID' => $whoisguardID,
            'Years' => $years,
            'PromotionCode' => $promotionCode,
        ];
        return $this->get($this->command . __FUNCTION__, $data);
    }

}

