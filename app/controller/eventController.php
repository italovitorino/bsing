<?php
session_start();

require_once __DIR__ . "/../config/connection.php";
require_once __DIR__ . "/../model/event.php";
require_once __DIR__ . "/../dao/eventDAO.php";

$event = new Event();
$eventDAO = new EventDAO();

$data = filter_input_array(INPUT_POST);

if (isset($data["send_request"]) && $data["send_request"] !== null) {
  $event->setId_User($data["id_user"]);
  $event->setId_Business($data["id_business"]);
  $event->setDate($data["event_date"]);
  $event->setStatus(0);

  if ($eventDAO->checkEventExists($data["id_user"], $data["id_business"])) {
    $_SESSION['msg'] = "<p style='color: red; margin: 20px 0'>Você já fez uma solicitação neste estabelecimento, por favor, aguarde</p>";
    header('Refresh: 0; url = /bsing/app/view/pages/home/user/');
  } else {
    if ($eventDAO->sendRequest($event)) {
      $_SESSION['msg'] = "<p style='color: green; margin: 20px 0'>Solicitação enviada</p>";
      header('Refresh: 0; url = /bsing/app/view/pages/home/user/');
    } else {
      echo "erro";
    }
  }
}

if (isset($data["accept_request"])) {
  if ($eventDAO->checkStatus($data["id_user"], $data["id_business"], 1)) {
    $_SESSION['msg'] = "<p style='color: red; margin: 20px 0'>Você já tem um solicitação aprovada deste artista, finalize o processo para aceitar essa!</p>";
    header('Refresh: 0; url = /bsing/app/view/pages/home/business/');
  } else {
    if (
      $eventDAO->handleRequest(1, $data["id_user"], $data["id_business"], 0)
    ) {
      $_SESSION['msg'] = "<p style='color: green; margin: 20px 0'>Solicitação aprovada com sucesso</p>";
      header('Refresh: 0; url = /bsing/app/view/pages/home/business/');
    } else {
      echo "Não foi possível aprovar essa solicitação";
    }
  }
}

if (isset($data["decline_request"])) {
  if ($eventDAO->handleRequest(2, $data["id_user"], $data["id_business"], 0)) {
    $_SESSION['msg'] = "<p style='color: red; margin: 20px 0'>Solicitação negada</p>";
    header('Refresh: 0; url = /bsing/app/view/pages/home/business/');
  } else {
    echo "Não foi possível negar essa solicitação";
  }
}

if (isset($data["cancel_request_approval"])) {
  if ($eventDAO->handleRequest(0, $data["id_user"], $data["id_business"], 1)) {
    $_SESSION['msg'] = "<p style='color: blue; margin: 20px 0'>Processo desfeito</p>";
    header('Refresh: 0; url = /bsing/app/view/pages/home/business/');
  } else {
    echo "Não foi possível negar essa solicitação";
  }
}

if (isset($data["conclude"])) {
  if ($eventDAO->handleRequest(3, $data["id_user"], $data["id_business"], 1)) {
    $_SESSION['msg'] = "<p style='color: green; margin: 20px 0'>Solicitação marcada como concluída</p>";
    header('Refresh: 0; url = /bsing/app/view/pages/home/business/');
  } else {
    echo "Não foi possível concluir essa solicitação";
  }
}

if (isset($data["cancel_request"])) {
  if ($eventDAO->handleRequest(1, $data["id_user"], $data["id_business"], 3)) {
    $_SESSION['msg'] = "<p style='color: blue; margin: 20px 0'>Processo desfeito</p>";
    header('Refresh: 0; url = /bsing/app/view/pages/home/business/');
  } else {
    echo "Não foi possível desfazer essa operação";
  }
}
