Namecheap SDK for APIs
=======================

<a href="https://packagist.org/packages/rubensrocha/namecheap-sdk"><img src="https://poser.pugx.org/rubensrocha/namecheap-sdk/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/rubensrocha/namecheap-sdk"><img src="https://poser.pugx.org/rubensrocha/namecheap-sdk/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/rubensrocha/namecheap-sdk"><img src="https://poser.pugx.org/rubensrocha/namecheap-sdk/license.svg" alt="License"></a>

Namecheap SDK is a PHP lib that makes it easy to manage Namecheap APIs.

## Installing

The recommended way to install Namecheap-sdk is through
[Composer](http://getcomposer.org).

```bash
composer require rubensrocha/namecheap-sdk
```

## API Methods Examples:

### Create a connection to the Namecheap API which you can then pass into other services, e.g. domains, later on
```php
#getDoaminList.php
require_once "vendor/autoload.php";

$apiUser = $userName = 'ncusername';
$apiKey = '****************************';
$clientIp = '198.168.0.123';
// Return type can be: xml (default), array, json
$returnType = 'json';


$client = new Namecheap\Api($apiUser, $apiKey, $userName, $clientIp, $returnType);
$client->setCurlOption(CURLOPT_SSL_VERIFYPEER, false); // For local development env (if needed)

$ncDomains = new  Namecheap\Domain\Domains($client);
$ncDomains->enableSandbox(); // Enable sandbox mode for the current instance

$domainList = $ncDomains->getList();

print_r($domainList);


```

```php
$contactsInfo = $ncDomains->getContacts($domainName);
$result = $ncDomains->create($dataArr);
```

#### domains
```php
$ncDomains = new  Namecheap\Domain\Domains($apiUser, $apiKey, $userName, $clientIp, 'json');
$domainList = $ncDomains->getList();
$contactsInfo = $ncDomains->getContacts($domainName);
$result = $ncDomains->create($dataArr);
```

#### domains.dns
```php
$ncDomainsDns = new  Namecheap\Domain\DomainsDns($apiUser, $apiKey, $userName, $clientIp);
$list = $ncDomainsDns->getList('domain', 'com');
$default = $ncDomainsDns->setDefault('domain', 'com');
```

#### domains.ns
```php
$ncDomainsNs = new  Namecheap\Domain\DomainsNs($apiUser, $apiKey, $userName, $clientIp);
$list = $ncDomainsNs->create('domain', 'com', 'ns1.domain.com', '192.165.15.103');
```

#### domains.transfer
```php
$ncDomainsTrns = new  Namecheap\Domain\DomainsTransfer($apiUser, $apiKey, $userName, $clientIp);
$getStatus = $ncDomainsTrns->getStatus($transferID);
```
#### ssl
```php
$ncSsl = new  Namecheap\Ssl\Ssl($apiUser, $apiKey, $userName, $clientIp);
$result = $ncSsl->create($Years, $Type, $SANStoADD, $PromotionCode);
```

#### users
```php
$ncUsers = new  Namecheap\Users\Users($apiUser, $apiKey, $userName, $clientIp);
$pricing = $ncUsers->getPricing('DOMAIN');
$userBal = $ncUsers->getBalances();
# Change password
$result = $ncUsers->changePassword($oldPassword, $newPassword);
# Reset pass
$result = $ncUsers->changePassword($resetCode, $newPassword, true);
```

#### users.address
```php
$ncUsersAddr = new  Namecheap\Users\UsersAddress($apiUser, $apiKey, $userName, $clientIp);
$getStatus = $ncUsersAddr->getInfo($AddressId);
```

#### whoisguard
```php
$ncWhoisguard = new  Namecheap\Whoisguard\Whoisguard($apiUser, $apiKey, $userName, $clientIp);
$result = $ncWhoisguard->getInfo($WhoisguardID, $ForwardedToEmail);
```

## Help and docs


## Version Guidance

| Version | Status     | Packagist           | Namespace    | Repo                | Docs                | PSR-7 | PHP Version |
|---------|------------|---------------------|--------------|---------------------|---------------------|-------|-------------|
| 1.x     | ---        | `rubensrocha/namecheap-sdk`     | `Namecheap`     | - | - | No    | >= 5.6    |
