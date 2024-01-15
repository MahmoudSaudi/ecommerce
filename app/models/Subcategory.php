<?php 
include_once __DIR__."\../database\databaseConnection.php";
include_once __DIR__."\../database\operation.php";

class Subcategory extends databaseConnection implements operation{

    private $id;
    private $name_en;
    private $name_ar;
    private $photo;
    private $status;
    private $created_at;
    private $updated_at;
    private $category_id;










    public function create(){

    }
    public function update(){

    }
    public function delete(){

    }
    public function read(){
        $query = "SELECT `subcategories`.`id`,`subcategories`.`name_en`
        FROM `subcategories` 
        WHERE `subcategories`.`category_id` = $this->category_id AND `subcategories`.`status` = $this->status";
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
     * Get the value of photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     */
    public function setPhoto($photo): self
    {
        $this->photo = $photo;

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
     * Get the value of category_id
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     */
    public function setCategoryId($category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }
}