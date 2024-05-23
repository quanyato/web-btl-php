<?php
class order_item {
    private $id;
    private $order_id;
    private $sku;
    private $quantity;

    public function __construct($id, $order_id, $sku, $quantity) {
        $this->id = $id;
        $this->order_id = $order_id;
        $this->sku = $sku;
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
    public function getQuantity() {
        return $this->quantity;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setOrderId($order_id) {
        $this->order_id = $order_id;
    }
    public function setSku($sku) {
        $this->sku = $sku;
    }
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
}