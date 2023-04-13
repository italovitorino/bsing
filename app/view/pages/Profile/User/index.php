<?php
session_start();

require_once __DIR__ . "/../../../../config/connection.php";

require_once __DIR__ . "/../../../../model/user.php";

require_once __DIR__ . "/../../../../dao/userDAO.php";

$user = new User();
$userDAO = new UserDAO();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <title>Perfil do usuário</title>
</head>

<body>
  
  <?php  ?>
  <div class="card-container">
    <div class="card">
      <form enctype="multipart/form-data" action="../../../../controller/userController.php" method="post">
        <label>Nome</label>
        <input type="text" name="input-name" value="<?= $_SESSION["user_name"] ?>">
        <br>
        <label>Idade</label>
        <input type="text" name="input-age" value="<?= $_SESSION["user_age"] ?>">
        <br>
        <label>Gênero Musical </label>
        <select name="musical_genre">
          <option value="">Selecione Um Gênero Musical</option>
          <option value="Rock" <?php if ($_SESSION["user_musical_genre"] == "Rock") {echo "selected";} ?>>Rock</option>
          <option value="Pop" <?php if ($_SESSION["user_musical_genre"] == "Pop") {echo "selected";} ?>>Pop</option>
          <option value="MPB" <?php if ($_SESSION["user_musical_genre"] == "MPB") {echo "selected";} ?>>MPB</option>
          <option value="Sertanejo" <?php if ($_SESSION["user_musical_genre"] == "Sertanejo") {echo "selected";} ?>>Sertanejo</option>
          <option value="Pagode" <?php if ($_SESSION["user_musical_genre"] == "Pagode") {echo "selected";} ?>>Pagode</option>
          <option value="Funk" <?php if ($_SESSION["user_musical_genre"] == "Funk") {echo "selected";} ?>>Funk</option>
          <option value="Axé" <?php if ($_SESSION["user_musical_genre"] == "Axé") {echo "selected";} ?>>Axé</option>
          <option value="Forró" <?php if ($_SESSION["user_musical_genre"] == "Forró") {echo "selected";} ?>>Forró</option>
          <option value="Samba" <?php if ($_SESSION["user_musical_genre"] == "Samba") {echo "selected";} ?>>Samba</option>
        </select>

        <label>UF</label>
        <select required name="input-home-state">
          <option value="">Selecione o Estado</option>
          <option value="AC" <?php if ($_SESSION["user_home_state"] == "AC") echo "selected"; ?>>Acre</option>
          <option value="AL" <?php if ($_SESSION["user_home_state"] == "AL") echo "selected"; ?>>Alagoas</option>
          <option value="AP" <?php if ($_SESSION["user_home_state"] == "AP") echo "selected"; ?>>Amapá</option>
          <option value="AM" <?php if ($_SESSION["user_home_state"] == "AM") echo "selected"; ?>>Amazonas</option>
          <option value="BA" <?php if ($_SESSION["user_home_state"] == "BA") echo "selected"; ?>>Bahia</option>
          <option value="CE" <?php if ($_SESSION["user_home_state"] == "CE") echo "selected"; ?>>Ceará</option>
          <option value="DF" <?php if ($_SESSION["user_home_state"] == "DF") echo "selected"; ?>>Distrito Federal</option>
          <option value="ES" <?php if ($_SESSION["user_home_state"] == "ES") echo "selected"; ?>>Espírito Santo</option>
          <option value="GO" <?php if ($_SESSION["user_home_state"] == "GO") echo "selected"; ?>>Goiás</option>
          <option value="MA" <?php if ($_SESSION["user_home_state"] == "MA") echo "selected"; ?>>Maranhão</option>
          <option value="MT" <?php if ($_SESSION["user_home_state"] == "MT") echo "selected"; ?>>Mato Grosso</option>
          <option value="MS" <?php if ($_SESSION["user_home_state"] == "MS") echo "selected"; ?>>Mato Grosso do Sul</option>
          <option value="MG" <?php if ($_SESSION["user_home_state"] == "MG") echo "selected"; ?>>Minas Gerais</option>
          <option value="PA" <?php if ($_SESSION["user_home_state"] == "PA") echo "selected"; ?>>Pará</option>
          <option value="PB" <?php if ($_SESSION["user_home_state"] == "PB") echo "selected"; ?>>Paraíba</option>
          <option value="PR" <?php if ($_SESSION["user_home_state"] == "PR") echo "selected"; ?>>Paraná</option>
          <option value="PE" <?php if ($_SESSION["user_home_state"] == "PE") echo "selected"; ?>>Pernambuco</option>
          <option value="PI" <?php if ($_SESSION["user_home_state"] == "PI") echo "selected"; ?>>Piauí</option>
          <option value="RJ" <?php if ($_SESSION["user_home_state"] == "RJ") echo "selected"; ?>>Rio de Janeiro</option>
          <option value="RN" <?php if ($_SESSION["user_home_state"] == "RN") echo "selected"; ?>>Rio Grande do Norte</option>
          <option value="RS" <?php if ($_SESSION["user_home_state"] == "RS") echo "selected"; ?>>Rio Grande do Sul</option>
          <option value="RO" <?php if ($_SESSION["user_home_state"] == "RO") echo "selected"; ?>>Rondônia</option>
          <option value="RR" <?php if ($_SESSION["user_home_state"] == "RR") echo "selected"; ?>>Roraima</option>
          <option value="SC" <?php if ($_SESSION["user_home_state"] == "SC") echo "selected"; ?>>Santa Catarina</option>
          <option value="SP" <?php if ($_SESSION["user_home_state"] == "SP") echo "selected"; ?>>São Paulo</option>
          <option value="SE" <?php if ($_SESSION["user_home_state"] == "SE") echo "selected"; ?>>Sergipe</option>
          <option value="TO" <?php if ($_SESSION["user_home_state"] == "TO") echo "selected"; ?>>Tocantins</option>
        </select><br>
        <label>Telefone </label>
        <input type="text" minlength="13" name="input-phone" value="<?= $_SESSION["user_telephone"] ?>">
        <br>
        <label>Email </label>
        <input type="text" name="input-email" value="<?= $_SESSION["user_email"] ?>">
        <br> <br>
      
        <label>Biografia </label>
        <br>
        <textarea name="input-biography" cols="40" rows="5"></textarea>
        <br>
        <label>Imagem de Perfil </label>
        <p>Selecione o Arquivo </p>
        <div class="btns">
          <input type="file" name="input-profile-image" value="<?= $_SESSION["user_profile_image"] ?>">
          <br><br>
          <input type="submit" name="edit-profile" value="Editar">
          <a href="../../Home/user" class="butao"><input type="button" value="Voltar" class="butao"></a>
        </div>
      </form>
    </div>
  </div>
  <!-- <br>  -->
</body>

</html>