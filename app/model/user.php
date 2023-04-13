<?php

class User
{
  private $id_user;
  private $name;
  private $age;
  private $music_genre;
  private $home_state;
  private $biography;
  private $telephone;
  private $email;
  private $password;
  private $profile_image;

  // Getters and Setters
  // id_user
  public function getId_User()
  {
    return $this->id_user;
  }

  public function setId_User($id_user)
  {
    $this->id_user = $id_user;
  }

  // name
  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  // age
  public function getAge()
  {
    return $this->age;
  }

  public function setAge($age)
  {
    $this->age = $age;
  }

  // music_genre
  public function getMusic_Genre()
  {
    return $this->music_genre;
  }

  public function setMusic_Genre($music_genre)
  {
    $this->music_genre = $music_genre;
  }

  // home_state
  public function getHome_State()
  {
    return $this->home_state;
  }

  public function setHome_State($home_state)
  {
    $this->home_state = $home_state;
  }

  // biography
  public function getBiography()
  {
    return $this->biography;
  }

  public function setBiography($biography)
  {
    $this->biography = $biography;
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

  // profile_image
  public function getProfile_Image()
  {
    return $this->profile_image;
  }

  public function setProfile_Image($profile_image)
  {
    $this->profile_image = $profile_image;
  }
}
