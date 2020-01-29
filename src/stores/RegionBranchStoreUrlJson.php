<?php


namespace talismanfr\rosselhozbank\stores;


use talismanfr\rosselhozbank\dto\RegionBranch;
use talismanfr\rosselhozbank\shared\UrlValue;
use talismanfr\rosselhozbank\stores\contracts\RegionBranchStore;

class RegionBranchStoreUrlJson implements RegionBranchStore
{


    private $url;

    /** @var RegionBranch[]|null */
    private $all=null;

    /**
     * RegionBranchStoreUrlJson constructor.
     * @param $url
     */
    public function __construct(?UrlValue $url=null)
    {
        $this->url = $url;
        if(empty($this->url)){
            $this->url=new UrlValue('https://www.rshb.ru/promo/smb/rko-partner/js/region.json');
        }
    }


    /**
     * @inheritDoc
     * @return RegionBranch[]
     */
    public function findAll(): array
    {
        if($this->all){
            return $this->all;
        }


        $resource=file_get_contents($this->url->__toString());
        if(empty($resource)){
            return [];
        }

        try{
            $resource=json_decode($resource,true);
            if(!$resource){
                return [];
            }
        }catch (\Exception $e){
            return [];
        }
        foreach ($resource as $item){
            $this->all[]=new RegionBranch(
                (int)$item['id'],
                $item['origName'],
                $item['newName']
            );
        }
        return $this->all;
    }

    /**
     * @inheritDoc
     */
    public function findByRegion(string $region): ?RegionBranch
    {
        foreach ($this->findAll() as $regionBranch){
            if($regionBranch->getRegionName()==$region){
                return $regionBranch;
            }
        }

        return null;
    }

    public function findById(int $id): ?RegionBranch
    {
        foreach ($this->findAll() as $regionBranch){
            if($regionBranch->getId()==$id){
                return $regionBranch;
            }
        }

        return null;
    }
}