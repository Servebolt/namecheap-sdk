<?php 

namespace Namecheap\Domain;

use Namecheap\Api;
use Namecheap\Exception\NamecheapException;
/**
 * Namecheap API wrapper
 *
 * Method DomainsNs
 * Manage Domains Name server
 *
 * @author Saddam Hossain <saddamrhossain@gmail.com>
 *
 * @version 1
 */
class DomainsNs extends Api {

	protected $command = 'namecheap.domains.ns.';

	/**
	 * Creates a new nameserver.
	 *
	 * @param $sld str|SLD|req : SLD of the DomainName
	 * @param $tld str|TLD|req : TLD of the DomainName
	 * @param $ns str|Nameserver|req : Nameserver to create
	 * @param $ip str|IP|req : Nameserver IP address
	 */
	public function create($sld, $tld, $ns, $ip) {
		$data = ['SLD' => $sld, 'TLD' => $tld, 'Nameserver' => $ns, 'IP' => $ip];
		return $this->get($this->command.__FUNCTION__, $data);
	}

	/**
	 * Deletes a nameserver associated with the requested domain.
	 * 
	 * @param $sld str|SLD|req : SLD of the DomainName
	 * @param $tld str|TLD|req : TLD of the DomainName
	 * @param $ns str|Nameserver|req : Nameserver to create
	 */
	public function delete($sld, $tld, $ns) {
		$data = ['SLD' => $sld, 'TLD' => $tld, 'Nameserver' => $ns];
		return $this->get($this->command.__FUNCTION__, $data);
	}

	/**
	 * Retrieves information about a registered nameserver.
	 * 
	 * @param $sld str|SLD|req : SLD of the DomainName
	 * @param $tld str|TLD|req : TLD of the DomainName
	 * @param $ns str|Nameserver|req : Nameserver to create
	 */
	public function getInfo($sld, $tld, $ns) {
		$data = ['SLD' => $sld, 'TLD' => $tld, 'Nameserver' => $ns];
		return $this->get($this->command.__FUNCTION__, $data);
	}

	/**
	 * Updates the IP address of a registered nameserver.
	 * 
	 * @param $sld str|SLD|req : SLD of the DomainName
	 * @param $tld str|TLD|req : TLD of the DomainName
	 * @param $ns str|Nameserver|req : Nameserver to create
	 * @param $oldIp str|OldIP|Req : Existing IP address
	 * @param $ip str|IP|Req : New IP address
	 */
	public function update($sld, $tld, $ns, $oldIp, $ip) {
		$data = ['SLD' => $sld, 'TLD' => $tld, 'Nameserver' => $ns, 'OldIP' => $oldIp, 'IP' => $ip];
		return $this->get($this->command.__FUNCTION__, $data);
	}

}

?>
