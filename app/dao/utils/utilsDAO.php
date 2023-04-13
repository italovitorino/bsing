<?php
require_once __DIR__ . "/../../config/connection.php";

class UtilsDAO
{
  public function signin($user, $userType)
  {
    try {
      $table = $userType == "user" ? "user" : "business";

      $sql = "SELECT * FROM {$table} WHERE email = :email";

      $stmt = Conexao::getInstance()->prepare($sql);
      $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
      $stmt->execute();

      $userData = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($stmt->rowCount() === 1) {
        if (password_verify($user->getPassword(), $userData["password"])) {
          session_start();
          $_SESSION[$userType . "_session"] = $userData["id_" . $userType];

          if ($userType === "user") {
            $_SESSION[$userType . "_name"] = $userData["name"];
            $_SESSION[$userType . "_age"] = $userData["age"];
            $_SESSION[$userType . "_musical_genre"] = $userData["musical_genre"];
            $_SESSION[$userType . "_home_state"] = $userData["home_state"];
            $_SESSION[$userType . "_biography"] = $userData["biography"];
            $_SESSION[$userType . "_telephone"] = $userData["telephone"];
            $_SESSION[$userType . "_email"] = $userData["email"];
            $_SESSION[$userType . "_profile_image"] = $userData["profile_image"];
          } else {
            $_SESSION[$userType . "_name"] = $userData["corporate_name"];
          }

          return true;
        }
        return false;
      }
    } catch (PDOException $th) {
      echo "Erro: " . $th->getMessage();
    }
  }
}
