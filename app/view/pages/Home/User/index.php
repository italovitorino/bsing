<?php
session_start();

if (!isset($_SESSION['user_session'])) {
  header("Location: /bsing/app/view/pages/signin");
  exit;
}

// Conexão
require_once __DIR__ . "/../../../../config/connection.php";

// Models
require_once __DIR__ . "/../../../../model/user.php";
require_once __DIR__ . "/../../../../model/business.php";

// DAOs
require_once __DIR__ . "/../../../../dao/businessDAO.php";
require_once __DIR__ . "/../../../../dao/userDAO.php";
require_once __DIR__ . "/../../../../dao/eventDAO.php";

$businessDAO = new BusinessDAO();
$userDAO = new UserDAO();
$eventDAO = new EventDAO();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="style.css">

</head>

<body>
  <div class="header">
    <h1>Seja bem-vindo(a), <?php echo $_SESSION["user_name"] ?></h1>
    <form action="../../../../controller/utils/utilsController.php" method="post">
      <button name="logout" type="submit">Sair da conta</button>
    </form>
  </div>

  <br>

  <div class="alert-message">
    <?php
    $user = $userDAO->searchUser($_SESSION["user_session"]);

    if (!empty($user)) { ?>
      <span class="message-text">Verificamos que sua biografia e/ou foto de perfil não estão preenchidas. Deixar estes campos vazios dificultarão em sua aprovação.</span>
      <a href="../../Profile/User/" class="edit-button">Editar perfil</a>
    <?php } else { ?>
      <a href="../../Profile/User/" class="edit-button">Editar perfil</a>
    <?php }
    ?>
  </div>

  <h3>Confira abaixo alguns dos estabelecimentos em que você pode se candidatar:</h3>
  <?php
  if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  }
  ?>

  <div class="card-grid">
    <?php
    $rset = $businessDAO->getAll();

    if (empty($rset)) {
      echo "<p class='response'>Nenhum empresa registrada</p>";
    }
    ?>
    <?php foreach ($businessDAO->getAll() as $datas) : ?>
      <div class="card">
        <h2>Nome da empresa: <?= $datas["corporate_name"] ?></h2>
        <p>Tipo de negócio: <?= $datas["type_business"] ?></p>
        <p>Endereço: <?= $datas["address"] ?>, <?= $datas["number"] ?></p>
        <p>Bairro: <?= $datas["district"] ?></p>
        <p>Localidade: <?= $datas["city"] ?> - <?= $datas["business_state"] ?></p>
        <p>CEP: <?= $datas["zip_code"] ?></p>
        <p>Telefone: <?= $datas["telephone"] ?></p>
        <p>Email: <?= $datas["email"] ?></p>
        <form action="../../../../controller/eventController.php" method="post">
          <input type="hidden" name="id_business" value="<?= $datas["id"] ?>">
          <input type="hidden" name="id_user" value="<?= $_SESSION["user_session"] ?>">
          <input required type="date" name="event_date">
          <button name="send_request" type="submit">Enviar solicitação</button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>
  <hr>

  <h1 style="margin-top: 1em;">Confira abaixo os estabelecimentos em que você se cadastrou: </h1>
  <?php
  $rset = $eventDAO->searchRequestUser($_SESSION['user_session']);

  if (empty($rset)) {
    echo "<p class='response'>Você ainda não solicitou nenhuma participação</p>";
  }
  ?>
  <section class="card-grid">
    <?php foreach ($eventDAO->searchRequestUser($_SESSION['user_session']) as $datas) : ?>
      <div class="card">
        <h2>Nome da empresa: <?= $datas["corporate_name"] ?></h2>
        <p>Data pretendida: <?= $datas["date"] ?></p>
        <p>Status: <?= $datas["status"] ?></p>
        <p>Tipo de negócio: <?= $datas["type_business"] ?></p>
        <p>Endereço: <?= $datas["address"] ?>, <?= $datas["number"] ?></p>
        <p>Bairro: <?= $datas["district"] ?></p>
        <p>Localidade: <?= $datas["city"] ?> - <?= $datas["business_state"] ?></p>
        <p>CEP: <?= $datas["zip_code"] ?></p>
        <p>Telefone: <?= $datas["phone"] ?></p>
        <p>Email: <?= $datas["email"] ?></p>
        <form action="../../../../controller/userController.php" method="post">
          <input type="hidden" name="id_business" value="<?= $datas["id_business"] ?>">
          <?php if ($datas["status"] === "Em análise") {
            echo '<input type="submit" name="delete-request" value="Excluir solicitação">';
          } else if ($datas["status"] === "Negado") {
            echo '<input type="submit" name="delete-request-list" value="EXCLUIR DA LISTA">';
          } ?>
        </form>
      </div>
    <?php endforeach; ?>
  </section>


</body>

</html>