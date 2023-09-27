<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity()]
class DiscountCode {
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type:Types::DECIMAL,precision:11,scale:2)]
    private float $amount;

    #[ORM\Column(type:Types::STRING)]
    private string $code;

    #[ORM\Column(type:Types::BOOLEAN)]
    private bool $valid;

    #[ORM\OneToMany(targetEntity:OrderGroup::class,mappedBy:"discountCode")]
    private $orderGroups;

    function __construct() {
        $this->orderGroups = new ArrayCollection();
    }

    function addOrderGroup(OrderGroup $orderGroup){
        $this->orderGroups->add($orderGroup);
        $orderGroup->setDiscountCode($this);
    }



    /**
     * Get the value of code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set the value of code
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of amount
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of valid
     */
    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * Set the value of valid
     */
    public function setValid(bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }
}