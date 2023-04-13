<?php
require_once __DIR__ . "/../config/connection.php";

class UserDAO
{
  public function signup(User $user)
  {
    try {
      $sql =
        "INSERT INTO user (name, age, musical_genre, home_state, telephone, email, password) VALUES (:name, :age, :musical_genre, :home_state, :telephone, :email, :password)";

      $stmt = Conexao::getInstance()->prepare($sql);
      $stmt->bindValue(":name", $user->getName(), PDO::PARAM_STR);
      $stmt->bindValue(":age", $user->getAge(), PDO::PARAM_INT);
      $stmt->bindValue(
        ":musical_genre",
        $user->getMusic_Genre(),
        PDO::PARAM_STR
      );
      $stmt->bindValue(":home_state", $user->getHome_State(), PDO::PARAM_STR);
      $stmt->bindValue(":telephone", $user->getTelephone(), PDO::PARAM_STR);
      $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
      $stmt->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);

      return $stmt->execute();
    } catch (PDOException $th) {
      echo "Erro: " . $th->getMessage();
    }
  }

  public function editProfile(User $user, $profileImage)
  {
    try {
      $sql =
        "UPDATE user SET name = ?, age = ?, musical_genre = ?, home_state = ?, biography = ?, telephone = ?, email = ?, profile_image = ? WHERE id_user = ?";

      $stmt = Conexao::getInstance()->prepare($sql);
      $stmt->bindValue(1, $user->getName(), PDO::PARAM_STR);
      $stmt->bindValue(2, $user->getAge(), PDO::PARAM_INT);
      $stmt->bindValue(3, $user->getMusic_Genre(), PDO::PARAM_STR);
      $stmt->bindValue(4, $user->getHome_State(), PDO::PARAM_STR);
      $stmt->bindValue(5, $user->getBiography(), PDO::PARAM_STR);
      $stmt->bindValue(6, $user->getTelephone(), PDO::PARAM_STR);
      $stmt->bindValue(7, $user->getEmail(), PDO::PARAM_STR);

      if ($profileImage && $profileImage['error'] === UPLOAD_ERR_OK) {
        $profileImageDir = '../assets';
        $profileImageName = uniqid() . '_' . $profileImage['name'];
        $profileImagePath = $profileImageDir . '/' . $profileImageName;

        if (!move_uploaded_file($profileImage['tmp_name'], $profileImagePath)) {
          throw new Exception('Não foi possível salvar a imagem de perfil');
        }

        $stmt->bindValue(8, $profileImagePath, PDO::PARAM_STR);
      } else {
        $stmt->bindValue(8, $user->getProfile_Image(), PDO::PARAM_STR);
      }

      $stmt->bindValue(9, $user->getId_User(), PDO::PARAM_INT);

      return $stmt->execute();
    } catch (\Throwable $th) {
      //throw $th;
    }
  }


  public function searchUser($user_session)
  {
    $sql = "SELECT * FROM user WHERE id_user = ?";
    $stmt = Conexao::getInstance()->prepare($sql);
    $stmt->bindValue(1, $user_session);
    $stmt->execute();

    $data = $stmt->fetch();

    if ($data["biography"] === null || $data["profile_image"] === null) {
      return true;
    }

    return false;
  }
}
