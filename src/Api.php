<?php


namespace talismanfr\rosselhozbank;


use talismanfr\rosselhozbank\dto\Request;
use talismanfr\rosselhozbank\shared\CurlResponse;
use talismanfr\rosselhozbank\shared\InnValue;

class Api
{
    /** @var string */
    private $urlRequest;
    /** @var string */
    private $urlCheckInn;

    /**
     * Api constructor.
     * @param string $urlRequest
     * @param string $urlCheckInn
     */
    public function __construct(string $urlRequest = 'https://www.rshb.ru/ajax/request/form.php',
                                string $urlCheckInn = 'https://www.rshb.ru/ajax/inncheck/inncheck.php')
    {
        $this->urlRequest = $urlRequest;
        $this->urlCheckInn = $urlCheckInn;
    }


    /**
     * @param Request $request
     * @return CurlResponse
     */
    public function sendRequest(Request $request): CurlResponse
    {
        return $this->send($this->urlRequest, http_build_query($request->toArray()));
    }

    public function innCheck(InnValue $inn): CurlResponse
    {
        return $this->send($this->urlCheckInn,http_build_query(['companyinn'=>$inn->getInn()]));
    }

    private function send($url, string $data = null, string $method = 'POST'): CurlResponse
    {
        $curl = curl_init();

        if(!$curl){
            throw new \Exception('Curl not initialize');
        }

        try {
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_VERBOSE => false,
                CURLOPT_HTTPHEADER => [
                    "X-Requested-With: XMLHttpRequest",
                    "Content-Type: application/x-www-form-urlencoded",
                    "Accept: application/json",
                ],
            ]);

            if (strtoupper($method) != 'GET' && $data !== null) {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }

            $response = curl_exec($curl);

            $headers_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $res = new CurlResponse(curl_getinfo($curl, CURLINFO_HTTP_CODE),
                mb_substr($response, 0, $headers_size, 'utf-8'),
                mb_substr($response, $headers_size, null, 'utf-8'));
        } finally {
            curl_close($curl);
        }

        return $res;
    }
}