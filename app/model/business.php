<?php

class Business
{
  private $id_business;
  private $corporate_name;
  private $type_business;
  private $zip_code;
  private $address;
  private $number;
  private $district;
  private $city;
  private $business_state;
  private $telephone;
  private $email;
  private $password;

  // Getters and Setters
  // id_business
  public function getId_Business()
  {
    return $this->id_business;
  }

  public function setId_Business($id_business)
  {
    $this->id_business = $id_business;
  }

  // corporate_name
  public function getCorporate_Name()
  {
    return $this->corporate_name;
  }

  public function setCorporate_Name($corporate_name)
  {
    $this->corporate_name = $corporate_name;
  }

  // type_business
  public function getType_Business()
  {
    return $this->type_business;
  }

  public function setType_Business($type_business)
  {
    $this->type_business = $type_business;
  }

  // zip_code
  public function getZip_Code()
  {
    return $this->zip_code;
  }

  public function setZip_Code($zip_code)
  {
    $this->zip_code = $zip_code;
  }

  // address
  public function getAddress()
  {
    return $this->address;
  }

  public function setAddress($address)
  {
    $this->address = $address;
  }

  // number
  public function getNumber()
  {
    return $this->number;
  }

  public function setNumber($number)
  {
    $this->number = $number;
  }

  // district
  public function getDistrict()
  {
    return $this->district;
  }

  public function setDistrict($district)
  {
    $this->district = $district;
  }

  // city
  public function getCity()
  {
    return $this->city;
  }

  public function setCity($city)
  {
    $this->city = $city;
  }

  // business_state
  public function getBusiness_State()
  {
    return $this->business_state;
  }

  public function setBusiness_State($business_state)
  {
    $this->business_state = $business_state;
  }

  // telephone
  public function getTelephone()
  {
    return $this->telephone;
  }

  public function setTelephone($telephone)
  {
    $this->telephone = $telephone;
  }

  // email
  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  // password
  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }
}
