<?php


namespace talismanfr\rosselhozbank\stores\contracts;


use talismanfr\rosselhozbank\dto\RegionBranch;

interface RegionBranchStore
{
    /**
     * @return RegionBranch[]
     */
    public function findAll():?array ;

    /**
     * @param string $region
     * @return RegionBranch|null
     */
    public function findByRegion(string $region):?RegionBranch;

    public function findById(int  $id):?RegionBranch;
}