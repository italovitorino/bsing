<?php
session_start();

// Conection
require_once __DIR__ . "/../../config/connection.php";

// User
require_once __DIR__ . "/../../model/user.php";

// Business
require_once __DIR__ . "/../../model/business.php";

// Utils
require_once __DIR__ . "/../../dao/utils/utilsDAO.php";

$user = new User();
$business = new Business();
$utilsDAO = new UtilsDAO();

$data = filter_input_array(INPUT_POST);

if (isset($_POST["signin"])) {
  if ($data["type_user"] === "user") {
    $user->setEmail($data["email"]);
    $user->setPassword($data["password"]);

    if ($utilsDAO->signin($user, "user")) {
      header("Location: /bsing/app/view/pages/Home/User/");
    } else {
      $_SESSION['erro_login'] = "<p style='color: red; margin: 20px 0'>Usuário e/ou senha incorretos</p>";
      header('Refresh: 0; url = /bsing/app/view/pages/signin/');
    }
  } else {
    $business->setEmail($data["email"]);
    $business->setPassword($data["password"]);

    if ($utilsDAO->signin($business, "business")) {
      echo "Usuário logado com sucesso!";
      header("Location: /bsing/app/view/pages/Home/Business/");
    } else {
      echo "Usuário ou senha incorretos!";
    }
  }
}

if (isset($_POST["logout"])) {
  session_start();
  session_destroy();
  header("Location: /bsing/");
  exit;
}
