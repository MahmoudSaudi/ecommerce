<?php 
include_once __DIR__."\../database\databaseConnection.php";
include_once __DIR__."\../database\operation.php";
class Product extends databaseConnection implements operation{
    private $id;
    private $name_ar;
    private $name_en;
    private $details_ar;
    private $details_en;
    private $price;
    private $status;
    private $created_at;
    private $updated_at;
    private $subcategory_id;
    private $brand_id;

    function create(){

    }
    function update(){

    }
    function delete(){

    }
    public function read(){
        $query ="SELECT `products`.* FROM `products` 
        WHERE `products`.`status` = $this->status";
        return $this->runDQL($query);
    }

    public function readSingleProduct(){
          //     $query ="SELECT
    //     `products`.*,
    //     `subcategories`.`name_en` AS `subcategory_name_en`,
    //     `categories`.`name_en` AS `category_name_en`,
    //     `brands`.`name_en` AS `brand_name_en`
    // FROM
    //     `products`
    // Join `subcategories` ON `products`.`subcategory_id` = `subcategories`.`id`  
    // Join `categories` ON `subcategories`.`category_id` = `categories`.`id`  
    //  left join `brands` ON `products`.`brand_id` = `brands`.`id` 
    //  WHERE `products`.`id`= $this->id";
        $query = "SELECT `products_data`.* FROM `products_data` WHERE `id`= $this->id";
        return $this->runDQL($query);
    }

    public function findProduct(){
        $query ="SELECT `products`.* from `products` 
        where `products`.`status` = $this->status 
        AND `subcategory_id`= $this->subcategory_id";
        return $this->runDQL($query);

    }
    public function reviews(){
        $query = "SELECT
        COUNT(`reviews`.`product_id`) AS `reviews_count`,

        if(ROUND(AVG(`reviews`.`value`)) IS NUll,0, ROUND(AVG(`reviews`.`value`)) ) AS `reviews_avg`
    FROM
        `products`
    LEFT JOIN `reviews` ON `reviews`.`product_id` = $this->id
    WHERE  `products`.`id` =$this->id
    GROUP BY
        `products`.`id`";
        return $this->runDQL($query);

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
     * Get the value of name_ar
     */
    public function getNameAr()
    {
        return $this->name_ar;
    }

    /**
     * Set the value of name_ar
     */
    public function setNameAr($name_ar): self
    {
        $this->name_ar = $name_ar;

        return $this;
    }

    /**
     * Get the value of name_en
     */
    public function getNameEn()
    {
        return $this->name_en;
    }

    /**
     * Set the value of name_en
     */
    public function setNameEn($name_en): self
    {
        $this->name_en = $name_en;

        return $this;
    }

    /**
     * Get the value of details_ar
     */
    public function getDetailsAr()
    {
        return $this->details_ar;
    }

    /**
     * Set the value of details_ar
     */
    public function setDetailsAr($details_ar): self
    {
        $this->details_ar = $details_ar;

        return $this;
    }

    /**
     * Get the value of details_en
     */
    public function getDetailsEn()
    {
        return $this->details_en;
    }

    /**
     * Set the value of details_en
     */
    public function setDetailsEn($details_en): self
    {
        $this->details_en = $details_en;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     */
    public function setUpdatedAt($updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of subcategory_id
     */
    public function getSubcategoryId()
    {
        return $this->subcategory_id;
    }

    /**
     * Set the value of subcategory_id
     */
    public function setSubcategoryId($subcategory_id): self
    {
        $this->subcategory_id = $subcategory_id;

        return $this;
    }

    /**
     * Get the value of brand_id
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     */
    public function setBrandId($brand_id): self
    {
        $this->brand_id = $brand_id;

        return $this;
    }
}