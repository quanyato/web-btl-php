<?php
class customer {
    private $id;
    private $first_name;
    private $last_name;
    private $birthday;
    private $email;
    private $phone;
    private $address;

    public function __construct($id, $first_name, $last_name, $birthday, $email, $phone, $address) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->birthday = $birthday;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
    }

    public function getId() {
        return $this->id;
    }
    public function getFirstName() {
        return $this->first_name;
    }
    public function getLastName() {
        return $this->last_name;
    }
    public function getFullName() {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function getBirthday() {
        return $this->birthday;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPhone() {
        return $this->phone;
    }
    public function getAddress() {
        return $this->address;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }
    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }
    public function setBirthday($birthday) {
        $this->birthday = $birthday;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setPhone($phone) {
        $this->phone = $phone;
    }
    public function setAddress($address) {
        $this->address = $address;
    }
}