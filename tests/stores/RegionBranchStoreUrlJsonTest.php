<?php

namespace stores;

use talismanfr\rosselhozbank\stores\RegionBranchStoreUrlJson;
use PHPUnit\Framework\TestCase;

class RegionBranchStoreUrlJsonTest extends TestCase
{

    /**
     * @depends testFindById
     */
    public function testFindByRegion(RegionBranchStoreUrlJson $store)
    {
        $regionBranch=$store->findByRegion('Кемеровская область');
        $this->assertNotNull($regionBranch);

        $this->assertEquals($regionBranch->getRegionName(),'Кемеровская область');
    }

    /**
     * @depends testFindAll
     */
    public function testFindById(RegionBranchStoreUrlJson $store)
    {
        $region=$store->findById(1624);
        $this->assertNotNull($region);

        $this->assertEquals($region->getId(),'1624');

        return $store;
    }

    /**
     * @depends testStore
     *
     */
    public function testFindAll(RegionBranchStoreUrlJson $store)
    {
        $all=$store->findAll();
        $this->assertIsArray($all);
        return $store;
    }

    public function testStore()
    {
        $store=new RegionBranchStoreUrlJson(null);
        $this->assertNotNull($store);

        return $store;
    }
}
