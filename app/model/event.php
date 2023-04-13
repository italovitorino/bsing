<?php

class Event
{
  private $id_event;
  private $id_user;
  private $id_business;
  private $date;
  private $status;

  //Getters and Setter

  // id_event
  public function getId_Event()
  {
    return $this->id_event;
  }

  public function setId_Event($id_event)
  {
    $this->id_event = $id_event;
  }

  // id_user
  public function getId_User()
  {
    return $this->id_user;
  }

  public function setId_User($id_user)
  {
    $this->id_user = $id_user;
  }

  // id_business
  public function getId_Business()
  {
    return $this->id_business;
  }

  public function setId_Business($id_business)
  {
    $this->id_business = $id_business;
  }

  // date
  public function getDate()
  {
    return $this->date;
  }

  public function setDate($date)
  {
    $this->date = $date;
  }

  // status
  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }
}
