<?php
class product {
    private $id;
    private $name;
    private $price;
    private $img;
    private $size;
    private $total_sold;
    private $total_quantity;
    private $quantity_by_size;

    public function __construct($id, $name, $price, $img, $total_sold) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->img = $img;
        $this->total_sold = $total_sold;
        $this->total_quantity = 0;
    }

    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getImg() {
        return $this->img;
    }
    public function getSize() {
        return $this->size;
    }
    public function getTotalSold() {
        return $this->total_sold;
    }
    public function getTotalQuantity() {
        return $this->total_quantity;
    }
    public function getQuantityBySize() {
        return $this->quantity_by_size;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setPrice($price) {
        $this->price = $price;
    }
    public function setImg($img) {
        $this->img = $img;
    }
    public function setSize($size) {
        $this->size = $size;
    }
    public function setTotalSold($total_sold) {
        $this->total_sold = $total_sold;
    }
    public function setTotalQuantity($total_quantity) {
        $this->total_quantity = $total_quantity;
    }
    public function setQuantityBySize($size, $quantity) {
        $this->quantity_by_size[$size] = $quantity;
    }
}