<?php

use App\repositories\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:ProductsRepository::class)]
#[ORM\Table(name:"products")]
class Product {
    #[ORM\Id,ORM\Column(type:"integer"),ORM\GeneratedValue(strategy:"IDENTITY")]
    private int $id;

    #[ORM\Column(type:Types::STRING,length:150,unique:true)]
    private string $product_name;

    #[ORM\Column(type:Types::STRING,length:150)]
    private string $description;

    #[ORM\Column(type:Types::STRING,length:150)]
    private int $price;
    
    #[ORM\Column(type:Types::INTEGER,length:10)]
    private int $stock_quantity;

    #[ORM\OneToMany(targetEntity:Order::class,mappedBy:"product")]
    private $orders;

    #[ORM\ManyToMany(targetEntity:Category::class,inversedBy:"products",cascade:["persist","remove"])]
    private $categories;

    #[ORM\OneToMany(targetEntity:Image::class,mappedBy:"product",cascade:["remove","persist"])]
    private  $images;

    #[ORM\ManyToMany(targetEntity:Color::class,mappedBy:"products")]
    private $colors;


    #[ORM\Column(type:Types::DECIMAL,precision:2,scale:1)]
    private float $discountPrecentage = 1.0;

    #[ORM\Column(type:Types::INTEGER)]
    private $likes = 0;

    function __construct(){
        $this->categories = new ArrayCollection;    
        $this->images = new ArrayCollection;   
        $this->colors = new ArrayCollection;
    }

    function addColor(Color $color) {
        $this->colors->add($color);
        $color->addProduct($this);
    }

    function addImage(Image $image){
        $this->images->add($image);
        $image->setProduct($this);
    }

    function addCategory(Category $category){
        $this->categories->add($category);
    }

    function addOrder(Order $order) {
        $this->orders->add($order);
        $order->setProduct($this);
    }



    /**
     * Get the value of product_name
     */
    public function getProductName(): string
    {
        return $this->product_name;
    }

    /**
     * Set the value of product_name
     */
    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice(): int
    {
        $subtractedPrice = $this->price * $this->discountPrecentage;
        return $this->price - $subtractedPrice;
    }

    /**
     * Set the value of price
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of stock_quantity
     */
    public function getStockQuantity(): int
    {
        return $this->stock_quantity;
    }

    /**
     * Set the value of stock_quantity
     */
    public function setStockQuantity(int $stock_quantity): self
    {
        $this->stock_quantity = $stock_quantity;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of discountPrecentage
     */
    public function getDiscountPrecentage(): float
    {
        return $this->discountPrecentage;
    }

    /**
     * Set the value of discountPrecentage
     */
    public function setDiscountPrecentage(float $discountPrecentage): self
    {
        $this->discountPrecentage = $discountPrecentage;

        return $this;
    }
}