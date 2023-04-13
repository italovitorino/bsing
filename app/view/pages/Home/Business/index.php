<?php
session_start();

if (!isset($_SESSION['business_session'])) {
  header("Location: /bsing/app/view/pages/signin");
  exit;
}

// Conexão
require_once __DIR__ . '/../../../../config/connection.php';

// Models
require_once __DIR__ . '/../../../../model/user.php';
require_once __DIR__ . '/../../../../model/business.php';

// DAOs
require_once __DIR__ . '/../../../../dao/businessDAO.php';
require_once __DIR__ . '/../../../../dao/userDAO.php';
require_once __DIR__ . '/../../../../dao/eventDAO.php';

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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-<HASH>" crossorigin="anonymous" />

  <link rel="stylesheet" href="style.css">

  <title>Document</title>

  <!-- Importação API -->
  <script defer src="../../../../services/WhatsApp/api.js"></script>
</head>

<body>
  <div class="header">
    <h1>Seja bem-vindo(a) ao seu painel administrativo</h1>
    <form action="../../../../controller/utils/utilsController.php" method="post">
      <button name="logout" type="submit">Sair da conta</button>
    </form>
  </div>

  <h3>Confira abaixo alguns artistas que enviaram solicitação para o seu estabelecimento:</h3>
  <?php
  if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  }
  ?>
  <div class="card-container">
    <?php
    $rset = $eventDAO->getAllRequest($_SESSION['business_session'], 0);

    if (empty($rset)) {
      echo "<p>Nenhuma solicitação encontrada</p>";
    }
    ?>
    <?php foreach ($eventDAO->getAllRequest($_SESSION['business_session'], 0) as $datas) : ?>
      <div class="card">
        <img src="/bsing/app<?php echo $datas['user_profile_image'] ?>" alt="" height="150">
        <p>Nome do artista: <?= $datas['user_name'] ?></p>
        <p>Idade: <?= $datas['user_age'] ?></p>
        <p>Gênero Musical: <?= $datas['user_musical_genre'] ?></p>
        <p>UF: <?= $datas['user_home_state'] ?></p>
        <p>Biografia: <?= $datas['user_biography'] ?></p>
        <p>Telefone para contato: <?= $datas['user_telephone'] ?></p>
        <p>E-mail para contato: <?= $datas['user_email'] ?></p>
        <p>Data: <?= $datas['date'] ?></p>
        <form action="../../../../controller/eventController.php" method="post">
          <input type="hidden" name="id_business" value="<?= $_SESSION['business_session'] ?>">
          <input type="hidden" name="id_user" value="<?= $datas['id_user'] ?>">
          <button name="accept_request" type="submit">Aprovar artista</button>
          <button name="decline_request" type="submit">Negar artista</button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>

  <hr>

  <h3>Confira abaixo os artistas aceitos por você: </h3>
  <div class="card-container">
    <?php
    $rset = $eventDAO->getAllRequest($_SESSION['business_session'], 1);

    if (empty($rset)) {
      echo "<p>Nenhum artista aceito até o momento</p>";
    }
    ?>
    <?php foreach ($eventDAO->getAllRequest($_SESSION['business_session'], 1) as $datas) : ?>
      <div class="card">
        <img src="/bsing/app<?php echo $datas['user_profile_image'] ?>" alt="" height="150">
        <p>Nome do artista: <?= $datas['user_name'] ?></p>
        <p>Idade: <?= $datas['user_age'] ?></p>
        <p>Gênero Musical: <?= $datas['user_musical_genre'] ?></p>
        <p>UF: <?= $datas['user_home_state'] ?></p>
        <p>Biografia: <prev><?= $datas['user_biography'] ?></prev>
        </p>
        <p>Telefone para contato: <?= $datas['user_telephone'] ?></p>
        <p>E-mail para contato: <?= $datas['user_email'] ?></p>
        <p>Data: <?= $datas['date'] ?></p>
        <form action="../../../../controller/eventController.php" method="post">
          <input type="hidden" name="id_business" value="<?= $_SESSION['business_session'] ?>">
          <input class="user_id" type="hidden" name="id_user" value="<?= $datas['id_user'] ?>">
          <button name="cancel_request_approval" type="submit"><i class="fas fa-times"></i> Desfazer</button>
          <button class="btn-conclude" name="conclude" type="submit">Concluir</button>
        </form>
        <input type="hidden" class="business_name" value="<?= $_SESSION['business_name'] ?>">
        <input type="hidden" class="user_name" value="<?= $datas['user_name'] ?>">
        <input type="hidden" class="user_phone" value="<?= $datas['user_telephone'] ?>">
        <button class="btn_contact" data-name="<?= $datas['user_name'] ?>" data-phone="<?= $datas['user_telephone'] ?>" data-business_name="<?= $_SESSION['business_name'] ?>">
          <i class="fab fa-whatsapp"></i> Entrar em contato
        </button>
      </div>
    <?php endforeach; ?>
  </div>

  <hr>

  <h3>Confira abaixo suas solicitações marcadas como concluídas: </h3>
  <div class="card-container">
    <?php
    $rset = $eventDAO->getAllRequest($_SESSION['business_session'], 3);

    if (empty($rset)) {
      echo "<p>Nenhuma solicitação marcada como concluída encontrada</p>";
    }
    ?>
    <?php foreach ($eventDAO->getAllRequest($_SESSION['business_session'], 3) as $datas) : ?>
      <div class="card">
        <img src="/bsing/app<?php echo $datas['user_profile_image'] ?>" alt="" height="150">
        <p>Nome do artista: <?= $datas['user_name'] ?></p>
        <p>Idade: <?= $datas['user_age'] ?></p>
        <p>Gênero Musical: <?= $datas['user_musical_genre'] ?></p>
        <p>UF: <?= $datas['user_home_state'] ?></p>
        <p>Biografia: <?= $datas['user_biography'] ?></p>
        <p>Telefone para contato: <?= $datas['user_telephone'] ?></p>
        <p>E-mail para contato: <?= $datas['user_email'] ?></p>
        <p>Data: <?= $datas['date'] ?></p>
        <form action="../../../../controller/eventController.php" method="post">
          <input type="hidden" name="id_business" value="<?= $_SESSION['business_session'] ?>">
          <input type="hidden" name="id_user" value="<?= $datas['id_user'] ?>">
          <button name="cancel_request" type="submit"><i class="fas fa-times"></i> Desfazer</button>
        </form>
        <input type="hidden" class="business_name" value="<?= $_SESSION['business_name'] ?>">
        <input type="hidden" class="user_name" value="<?= $datas['user_name'] ?>">
        <input type="hidden" class="user_phone" value="<?= $datas['user_telephone'] ?>">
        <button class="btn_contact" data-name="<?= $datas['user_name'] ?>" data-phone="<?= $datas['user_telephone'] ?>" data-business_name="<?= $_SESSION['business_name'] ?>">
          <i class="fab fa-whatsapp"></i> Entrar em contato
        </button>
      </div>
    <?php endforeach; ?>
  </div>
</body>

</html>