<?php

namespace dto;

use talismanfr\rosselhozbank\dto\RegionBranch;
use talismanfr\rosselhozbank\dto\Request;
use PHPUnit\Framework\TestCase;
use talismanfr\rosselhozbank\shared\InnValue;
use talismanfr\rosselhozbank\shared\PhoneValue;

class RequestTest extends TestCase
{
    public function testSimpleCreate()
    {
        $request=Request::simpleCreate(12345678,new InnValue('701771570807'),'ООО РОГА И КОПЫТА',
            'Петров Владислав Юсупович',new PhoneValue('+79675319122'),null,
            new RegionBranch(1674,'Санкт-Петербургский филиал','Санкт-Петербург'),
            'comment');

        $this->assertNotNull($request);

        return $request;
    }

    /**
     * @param $request Request
     * @depends testSimpleCreate
     */
    public function testToArray($request)
    {
        $arr=$request->toArray();

        $this->assertIsArray($arr);
    }


}
