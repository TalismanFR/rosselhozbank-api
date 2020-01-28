<?php


namespace talismanfr\rosselhozbank\dto;


class RegionBranch
{
    /** @var int */
    private $id;

    /** @var string */
    private $branchName;
    /** @var string */
    private $regionName;

    /**
     * RegionBranch constructor.
     * @param int $id
     * @param string $branchName
     * @param string $regionName
     */
    public function __construct(int $id, string $branchName, string $regionName)
    {
        $this->id = $id;
        $this->branchName = $branchName;
        $this->regionName = $regionName;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBranchName(): string
    {
        return $this->branchName;
    }

    /**
     * @return string
     */
    public function getRegionName(): string
    {
        return $this->regionName;
    }



}