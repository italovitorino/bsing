<?php
session_start();

require_once __DIR__ . "/../config/connection.php";
require_once __DIR__ . "/../model/user.php";
require_once __DIR__ . "/../dao/userDAO.php";
require_once __DIR__ . "/../dao/eventDAO.php";

// Utils
require_once __DIR__ . "/../dao/utils/utilsDAO.php";

$user = new User();
$userDAO = new UserDAO();
$utilsDAO = new UtilsDAO();
$eventDAO = new EventDAO();

$data = filter_input_array(INPUT_POST);

if (isset($_POST["signup"])) {
  $user->setName($data["name"]);
  $user->setAge($data["age"]);
  $user->setMusic_Genre($data["musical_genre"]);
  $user->setHome_State($data["home_state"]);
  // $user->setBiography($data['biography']);
  $user->setTelephone(
    $data["country_code"] . $data["state_code"] . $data["telephone"]
  );
  $user->setEmail($data["email"]);
  $user->setPassword(password_hash($data["password"], PASSWORD_DEFAULT));

  if ($userDAO->signup($user)) {
    header("Location: /bsing/app/view/pages/signin");
  }
}

if (isset($_POST["edit-profile"])) {
  $user->setId_User($_SESSION['user_session']);
  $user->setName($data["input-name"]);
  $user->setAge($data["input-age"]);
  $user->setMusic_Genre($data["musical_genre"]);
  $user->setHome_State($data["input-home-state"]);
  $user->setBiography($data["input-biography"]);
  $user->setTelephone($data["input-phone"]);
  $user->setEmail($data["input-email"]);

  if (isset($_FILES["input-profile-image"])) {
    $profileImage = $_FILES["input-profile-image"];
  } else {
    $profileImage = null;
  }

  if ($userDAO->editProfile($user, $profileImage)) {
    $_SESSION['msg'] = "<p style='color: green; margin: 20px 0'>Dados alterados com sucesso</p>";
    header('Refresh: 0; url = /bsing/app/view/pages/home/user/');
  } else {
    echo "erro";
  }
}

if (isset($_POST['delete-request'])) {
  if($eventDAO->deleteRequestUser($data["id_business"], $_SESSION['user_session'], 0)) {
    $_SESSION['msg'] = "<p style='color: green; margin: 20px 0'>Solicitação excluída</p>";
    header('Refresh: 0; url = /bsing/app/view/pages/home/user/');
  }
}

if (isset($_POST['delete-request-list'])) {
  if($eventDAO->deleteRequestUser($data["id_business"], $_SESSION['user_session'], 2)) {
    $_SESSION['msg'] = "<p style='color: green; margin: 20px 0'>Solicitação excluída</p>";
    header('Refresh: 0; url = /bsing/app/view/pages/home/user/');
  }
}
