<?php

session_start();

require_once __DIR__ . "/../../../config/connection.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login de usuário</title>

  <link rel="stylesheet" href="style.css">

</head>

<body>
  <?php
  if (isset($_SESSION['erro_login'])) {
    echo $_SESSION['erro_login'];
    unset($_SESSION['erro_login']);
  }
  ?>
  <h1>LOGIN USUÁRIO</h1>
  <form action="../../../controller/utils/utilsController.php" method="post">
    <select name="type_user">
      <option value="">Selecio o tipo de usuário</option>
      <option value="user">Conta artista</option>
      <option value="business">Conta estabelecimento</option>
    </select>
    <input required type="email" name="email" placeholder="Email">
    <input required type="password" name="password" placeholder="Senha">
    <button name="signin" type="submit">Entrar</button>
  </form>
  <p>Não possui conta? <a href="../Signup/User/">Cadastre-se</a></p>
  <p>É dono de estabelecimento? <a href="../Signup/Business/">Cadastra-se aqui</a></p>
</body>

</html>