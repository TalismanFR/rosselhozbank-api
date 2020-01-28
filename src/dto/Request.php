<?php


namespace talismanfr\rosselhozbank\dto;


use phpDocumentor\Reflection\Types\Array_;
use talismanfr\rosselhozbank\shared\InnValue;
use talismanfr\rosselhozbank\shared\IpValue;
use talismanfr\rosselhozbank\shared\PhoneValue;
use talismanfr\rosselhozbank\shared\UrlValue;

class Request
{
    private const DEFAULT_FORM_ID = 52;

    private const DEFAULT_FORM_CODE = 'REQUEST_CALL_FORM_SB_RKO';

    private const DEFAULT_REKLAMA = 'rshb';

    private const DEFAULT_REQUEST = 'resrv';

    private const DEFAULT_SECRET = 'resrv';

    private const DEFAULT_URAL = 'http://www.rshb.ru/promo/smb/rko-partner/';

    private const DEFAULT_CHECK = 'Банковский счет (расчетный)';

    private const DEFAULT_CHECK_NUM = 1;

    private const DEFAULT_CURRENCY_NUM = 810;

    private const DEFAULT_SERVICE_TYPES = ['Расчетно-кассовое обслуживание'];

    /** @var integer */
    private $formId;
    /** @var string */
    private $form_code;
    /** @var string */
    private $reklama;
    /** @var string */
    private $secret;
    /** @var string|null */
    private $cid;
    /** @var IpValue */
    private $ipaddr;
    /** @var UrlValue */
    private $url;
    /** @var array */
    private $utms;
    /** @var integer */
    private $partnerId;
    /** @var InnValue */
    private $inn;
    /** @var string */
    private $companyName;
    /** @var string */
    private $clientfName;
    /** @var string */
    private $clientlName;
    /** @var PhoneValue */
    private $phone;
    /** @var string */
    private $email;
    /** @var string|null */
    private $comment;
    /** @var string */
    private $check;
    /** @var integer */
    private $checknum;
    /** @var integer */
    private $currencynum;
    /** @var integer */
    private $currencynumnew;
    /** @var string|null */
    private $youare;
    /** @var string */
    private $name;
    /** @var array */
    private $service_types;
    /** @var RegionBranch */
    private $regionBranch;
    /** @var string */
    private $partnerName;
    /** @var boolean */
    private $agreement;

    /**
     * Request constructor.
     * @param int $formId
     * @param string $form_code
     * @param string $reklama
     * @param string $secret
     * @param string|null $cid
     * @param IpValue $ipaddr
     * @param UrlValue $url
     * @param array $utms
     * @param int $partnerId
     * @param InnValue $inn
     * @param string $companyName
     * @param string $clientfName
     * @param string $clientlName
     * @param PhoneValue $phone
     * @param string $email
     * @param string|null $comment
     * @param string $check
     * @param int $checknum
     * @param int $currencynum
     * @param int $currencynumnew
     * @param string|null $youare
     * @param string $name
     * @param array $service_types
     * @param RegionBranch $regionBranch
     * @param string $partnerName
     * @param bool $agreement
     */
    public function __construct(int $formId, string $form_code, string $reklama, string $secret, ?string $cid,
                                IpValue $ipaddr, UrlValue $url, array $utms, int $partnerId, InnValue $inn,
                                string $companyName, string $clientfName, string $clientlName, PhoneValue $phone,
                                ?string $email, ?string $comment, string $check, int $checknum, int $currencynum,
                                int $currencynumnew, ?string $youare, string $name, array $service_types,
                                RegionBranch $regionBranch, string $partnerName, bool $agreement)
    {
        $this->formId = $formId;
        $this->form_code = $form_code;
        $this->reklama = $reklama;
        $this->secret = $secret;
        $this->cid = $cid;
        $this->ipaddr = $ipaddr;
        $this->url = $url;
        $this->utms = $utms;
        $this->partnerId = $partnerId;
        $this->inn = $inn;
        $this->companyName = $companyName;
        $this->clientfName = $clientfName;
        $this->clientlName = $clientlName;
        $this->phone = $phone;
        $this->email = $email;
        $this->comment = $comment;
        $this->check = $check;
        $this->checknum = $checknum;
        $this->currencynum = $currencynum;
        $this->currencynumnew = $currencynumnew;
        $this->youare = $youare;
        $this->name = $name;
        $this->service_types = $service_types;
        $this->regionBranch = $regionBranch;
        $this->partnerName = $partnerName;
        $this->agreement = $agreement;
    }

    public static function simpleCreate(int $partnerId,string $partnerName, InnValue $innValue, string $companyName, string $clientFio,
                                        PhoneValue $phoneValue, ?string $email, RegionBranch $regionBranch,?string $comment): self
    {
        $fio=explode(' ',$clientFio);
        $clientfName=isset($fio[0])?$fio[0]:'';
        $clientlName=isset($fio[1])?$fio[1]:'';
        return new self(
            self::DEFAULT_FORM_ID,
            self::DEFAULT_FORM_CODE,
            self::DEFAULT_REKLAMA,
            self::DEFAULT_SECRET,
            null,
            new IpValue('127.0.0.1'),
            new UrlValue(self::DEFAULT_URAL),
            [],
            $partnerId,
            $innValue,
            $companyName,
            $clientfName,
            $clientlName,
            $phoneValue,
            $email,
            $comment,
            self::DEFAULT_CHECK,
            self::DEFAULT_CHECK_NUM,
            self::DEFAULT_CURRENCY_NUM,
            self::DEFAULT_CURRENCY_NUM,
            null,
            $clientFio,
            self::DEFAULT_SERVICE_TYPES,
            $regionBranch,
            $partnerName,
            true
        );
    }

    /**
     * @return int
     */
    public function getFormId(): int
    {
        return $this->formId;
    }

    /**
     * @return string
     */
    public function getFormCode(): string
    {
        return $this->form_code;
    }

    /**
     * @return string
     */
    public function getReklama(): string
    {
        return $this->reklama;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @return string|null
     */
    public function getCid(): ?string
    {
        return $this->cid;
    }

    /**
     * @return IpValue
     */
    public function getIpaddr(): IpValue
    {
        return $this->ipaddr;
    }

    /**
     * @return UrlValue
     */
    public function getUrl(): UrlValue
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getUtms(): array
    {
        return $this->utms;
    }

    /**
     * @return int
     */
    public function getPartnerId(): int
    {
        return $this->partnerId;
    }

    /**
     * @return InnValue
     */
    public function getInn(): InnValue
    {
        return $this->inn;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @return string
     */
    public function getClientfName(): string
    {
        return $this->clientfName;
    }

    /**
     * @return string
     */
    public function getClientlName(): string
    {
        return $this->clientlName;
    }

    /**
     * @return PhoneValue
     */
    public function getPhone(): PhoneValue
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function getCheck(): string
    {
        return $this->check;
    }

    /**
     * @return int
     */
    public function getChecknum(): int
    {
        return $this->checknum;
    }

    /**
     * @return int
     */
    public function getCurrencynum(): int
    {
        return $this->currencynum;
    }

    /**
     * @return int
     */
    public function getCurrencynumnew(): int
    {
        return $this->currencynumnew;
    }

    /**
     * @return string|null
     */
    public function getYouare(): ?string
    {
        return $this->youare;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getServiceTypes(): array
    {
        return $this->service_types;
    }

    /**
     * @return RegionBranch
     */
    public function getRegionBranch(): RegionBranch
    {
        return $this->regionBranch;
    }

    /**
     * @return string
     */
    public function getPartnerName(): string
    {
        return $this->partnerName;
    }

    /**
     * @return bool
     */
    public function isAgreement(): bool
    {
        return $this->agreement;
    }

    public function toArray(): array
    {
        //todo utms
        return [
            'request' => [
                'form_id' => $this->getFormId(),
                'form_code' => $this->getFormCode(),
                'reklama' => $this->getReklama(),
                'cid' => $this->getCid(),
                'ipaddr' => $this->getIpaddr()->__toString(),
                'url' => $this->getUrl()->__toString(),
                'partner_id' => $this->getPartnerId(),
                'inn' => $this->getInn()->getInn(),
                'company_name' => $this->getCompanyName(),
                'client_lname' => $this->getClientlName(),
                'client_fname' => $this->getClientfName(),
                'phone' => $this->getPhone()->getPhone(),
                'email' => $this->getEmail(),
                'comments' => $this->getComment(),
                'filialcode' => $this->getRegionBranch()->getBranchName(),
                'check' => $this->getCheck(),
                'checknum' => $this->getChecknum(),
                'currencynum' => $this->getCurrencynum(),
                'currencynumnew' => $this->getCurrencynumnew(),
                'youare' => $this->getYouare(),
                'name' => $this->getName(),
                'service_type' => $this->getServiceTypes(),
                'region' => $this->getRegionBranch()->getId(),
                'partner_name' => $this->getPartnerName(),
                'agreement' => $this->isAgreement()
            ],
            'region-req' => $this->getRegionBranch()->getRegionName(),
            'secret' => $this->getSecret(),
        ];
    }

}