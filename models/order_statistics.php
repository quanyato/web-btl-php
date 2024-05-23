<?php
class order_statistics {
    private $id;
    private $customer_fullname;
    private $timestamp;
    private $status;
    private $total_quantity;
    private $total_price;

    public function __construct($id, $customer_fullname, $timestamp, $status, $total_quantity, $total_price) {
        $this->id = $id;
        $this->customer_fullname = $customer_fullname;
        $this->timestamp = $timestamp;
        $this->status = $status;
        $this->total_quantity = $total_quantity;
        $this->total_price = $total_price;
    }

    public function getId() {
        return $this->id;
    }
    public function getCustomerFullname() {
        return $this->customer_fullname;
    }
    public function getTimestamp() {
        return $this->timestamp;
    }
    public function getStatus() {
        return $this->status;
    }
    public function getTotalQuantity() {
        return $this->total_quantity;
    }
    public function getTotalPrice() {
        return $this->total_price;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setCustomerFullname($customer_fullname) {
        $this->customer_fullname = $customer_fullname;
    }
    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    public function setStatus($status) {
        $this->status = $status;
    }
    public function setTotalQuantity($total_quantity) {
        $this->total_quantity = $total_quantity;
    }
    public function setTotalPrice($total_price) {
        $this->total_price = $total_price;
    }
}