<?php


use talismanfr\rosselhozbank\Api;
use PHPUnit\Framework\TestCase;
use talismanfr\rosselhozbank\dto\RegionBranch;
use talismanfr\rosselhozbank\dto\Request;
use talismanfr\rosselhozbank\shared\InnValue;
use talismanfr\rosselhozbank\shared\PhoneValue;

class ApiTest extends TestCase
{
    /**
     * @depends testSimpleCreate
     */
    public function testSendRequest($request)
    {
        $api=new Api();

        $response=$api->sendRequest($request);

        $this->assertNotNull($response);
        $this->assertEquals($response->getCode(),200);

        return $api;
    }

    /**
     * @depends testSendRequest
     */
    public function testInnCheck(Api $api)
    {
        $inn=new InnValue('253716541797');
        $response=$api->innCheck($inn);

        $this->assertNotNull($response);
        $this->assertEquals($response->getCode(),200);

        $this->assertNotEmpty($response->getBody());
        $this->assertTrue(in_array($response->getBody(),['"ok"',"wrong"]));
    }




    public function testSimpleCreate()
    {
        $request=Request::simpleCreate(12345678,new InnValue('701771570807'),'ООО РОГА И КОПЫТА',
            'Петров Владислав Юсупович',new PhoneValue('+79675319122'),null,
            new RegionBranch(1674,'Санкт-Петербургский филиал','Санкт-Петербург'),
            'comment');

        $this->assertNotNull($request);

        return $request;
    }
}
