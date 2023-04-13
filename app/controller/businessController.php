<?php
session_start();

require_once __DIR__ . "/../config/connection.php";
require_once __DIR__ . "/../model/business.php";
require_once __DIR__ . "/../dao/businessDAO.php";

// Utils
require_once __DIR__ . "/../dao/utils/utilsDAO.php";

$business = new Business();
$businessDAO = new BusinessDAO();
$utilsDAO = new UtilsDAO();

$data = filter_input_array(INPUT_POST);

if (isset($_POST["signup_business"])) {
  $business->setCorporate_Name($data["corporate_name"]);
  $business->setType_Business($data["type_business"]);
  $business->setZip_Code($data["zip_code"]);
  $business->setAddress($data["address"]);
  $business->setNumber($data["number"]);
  $business->setDistrict($data["district"]);
  $business->setCity($data["city"]);
  $business->setBusiness_State($data["business_state"]);
  $business->setTelephone(
    $data["country_code"] . $data["state_code"] . $data["telephone"]
  );
  $business->setEmail($data["email"]);
  $business->setPassword(password_hash($data["password"], PASSWORD_DEFAULT));

  if ($businessDAO->signup_business($business)) {
    header("Location: /bsing/app/view/pages/signin");
  }
}
