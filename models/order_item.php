<?php
class order_item {
    private $id;
    private $order_id;
    private $sku;
    private $img;
    private $name;
    private $size;
    private $price;
    private $quantity;

    public function __construct($id, $img, $name, $size, $price, $quantity) {
        $this->id = $id;
        $this->img = $img;
        $this->name = $name;
        $this->size = $size;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getId() {
        return $this->id;
    }
    public function getOrderId() {
        return $this->order_id;
    }
    public function getSku() {
        return $this->sku;
    }
    public function getImg() {
        return $this->img;
    }
    public function getName() {
        return $this->name;
    }
    public function getSize() {
        return $this->size;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getQuantity() {
        return $this->quantity;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setOrderId($order_id) {
        $this->order_id = $order_id;
    }
    public function setImg($img) {
        $this->img = $img;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setSize($size) {
        $this->size = $size;
    }
    public function setPrice($price) {
        $this->price = $price;
    }
    public function setSku($sku) {
        $this->sku = $sku;
    }
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
}