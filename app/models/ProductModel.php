<?php
class ProductModel
{
    private $id;
    private $name;
    private $description;
    private $basePrice;
    private $categoryId;
    private $variantName;
    private $variantPrice;
    private $imageURL;
    private $stockQuantity;
    private $salesCount;

    // Getter và Setter cho các thuộc tính

    public function getSalesCount()
    {
        return $this->salesCount;
    }
    public function setSalesCount($salesCount)
    {
        $this->salesCount = $salesCount;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getBasePrice()
    {
        return $this->basePrice;
    }
    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getVariantName()
    {
        return $this->variantName;
    }
    public function setVariantName($variantName)
    {
        $this->variantName = $variantName;
    }

    public function getVariantPrice()
    {
        return $this->variantPrice;
    }
    public function setVariantPrice($variantPrice)
    {
        $this->variantPrice = $variantPrice;
    }

    public function getImageURL()
    {
        return $this->imageURL;
    }
    public function setImageURL($imageURL)
    {
        $this->imageURL = $imageURL;
    }

    public function getStockQuantity()
    {
        return $this->stockQuantity;
    }
    public function setStockQuantity($stockQuantity)
    {
        $this->stockQuantity = $stockQuantity;
    }
}
?>