<?php
require_once __DIR__ . "/../config/connection.php";

class EventDAO
{
  public function checkEventExists($id_user, $id_business)
  {
    $sql = "SELECT * FROM event WHERE id_user = ? AND id_business = ?";
    $stmt = Conexao::getInstance()->prepare($sql);
    $stmt->bindValue(1, $id_user);
    $stmt->bindValue(2, $id_business);
    $stmt->execute();
    $rset = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rset as $line) {
      if ($line["status"] == 0) {
        return true;
      }
    }

    return false;
  }

  public function sendRequest(Event $event)
  {
    try {
      $sql =
        "INSERT INTO event (id_user, id_business, date, status) VALUES (:id_user, :id_business, :date, :status)";

      $stmt = Conexao::getInstance()->prepare($sql);
      $stmt->bindValue(":id_user", $event->getId_User(), PDO::PARAM_INT);
      $stmt->bindValue(
        ":id_business",
        $event->getId_Business(),
        PDO::PARAM_INT
      );
      $stmt->bindValue(":date", $event->getDate(), PDO::PARAM_STR);
      $stmt->bindValue(":status", $event->getStatus(), PDO::PARAM_INT);

      return $stmt->execute();
    } catch (PDOException $th) {
      echo "Erro: " . $th->getMessage();
    }
  }

  public function getAllRequest($user_session, $status)
  {
    $sql =
      "SELECT user.id_user,user.name, user.age, user.musical_genre, user.home_state, user.biography, user.telephone, user.email, user.profile_image, DATE_FORMAT(event.date, '%d/%m/%Y') as formatted_date FROM event JOIN user ON event.id_user = user.id_user WHERE id_business = ? AND status = ?;";

    $stmt = Conexao::getInstance()->prepare($sql);
    $stmt->bindValue(1, $user_session);
    $stmt->bindValue(2, $status);

    $datas = [];

    if ($stmt->execute()) {
      $rset = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($rset) > 0) {
        foreach ($rset as $line) {
          $data = [
            "id_user" => $line["id_user"],
            "user_name" => $line["name"],
            "user_age" => $line["age"],
            "user_musical_genre" => $line["musical_genre"],
            "user_home_state" => $line["home_state"],
            "user_biography" => nl2br($line["biography"]),
            "user_telephone" => $line["telephone"],
            "user_email" => $line["email"],
            "user_profile_image" => $line['profile_image'],
            "date" => $line["formatted_date"],
          ];
          array_push($datas, $data);
        }
      }
    }
    return $datas;
  }

  public function checkStatus($id_user, $id_business, $status)
  {
    try {
      $sql =
        "SELECT * FROM event WHERE id_user = ? AND id_business = ? AND status = ?";

      $stmt = Conexao::getInstance()->prepare($sql);
      $stmt->bindValue(1, $id_user);
      $stmt->bindValue(2, $id_business);
      $stmt->bindValue(3, $status);
      $stmt->execute();

      $rset = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($rset) > 0) {
        return true;
      }

      return false;
    } catch (\Throwable $th) {
      //throw $th;
    }
  }

  public function handleRequest(
    $status,
    $id_user,
    $id_business,
    $status_previous
  ) {
    try {
      $sql =
        "UPDATE event SET status = ? WHERE id_user = ? AND id_business = ? AND status = ?;";

      $stmt = Conexao::getInstance()->prepare($sql);
      $stmt->bindValue(1, $status);
      $stmt->bindValue(2, $id_user);
      $stmt->bindValue(3, $id_business);
      $stmt->bindValue(4, $status_previous);

      return $stmt->execute();
    } catch (PDOException $th) {
      echo "Erro: " . $th->getMessage();
    }
  }

  public function searchRequestUser($user_session)
  {
    $sql = "SELECT business.id_business, business.corporate_name, business.type_business, business.zip_code, business.address, business.number, business.district, business.city, business.business_state, business.telephone, business.email, DATE_FORMAT(event.date, '%d/%m/%Y') as formatted_date, event.status FROM event JOIN business ON event.id_business = business.id_business WHERE event.id_user = ?;";

    $stmt = Conexao::getInstance()->prepare($sql);
    $stmt->bindValue(1, $user_session);

    $datas = [];

    if ($stmt->execute()) {
      $rset = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($rset) > 0) {
        foreach ($rset as $line) {
          $data = [
            "id_business" => $line['id_business'],
            "corporate_name" => $line['corporate_name'],
            "type_business" => $line['type_business'],
            "zip_code" => $line['zip_code'],
            "address" => $line['address'],
            "number" => $line['number'],
            "district" => $line['district'],
            "city" => $line['city'],
            "business_state" => $line['business_state'],
            "phone" => $line['telephone'],
            "email" => $line['email'],
            "date" => $line["formatted_date"],
            "status" => $line["status"]
          ];
          if ($data["status"] === 0) {
            $data["status"] = "Em análise";
          } else if ($data["status"] === 1) {
            $data["status"] = "Aprovado, aguarde o contato da empresa";
          } else if ($data["status"] === 2) {
            $data["status"] = "Negado";
          } else {
            $data["status"] = "Concluído";
          }

          array_push($datas, $data);
        }
      }
    }
    return $datas;
  }

  public function deleteRequestUser($id_business, $id_user, $status)
  {
    try {
      $sql = "DELETE FROM event WHERE id_business = ? AND id_user = ? AND status = ?";

      $stmt = Conexao::getInstance()->prepare($sql);
      $stmt->bindValue(1, $id_business, PDO::PARAM_INT);
      $stmt->bindValue(2, $id_user, PDO::PARAM_INT);
      $stmt->bindValue(3, $status, PDO::PARAM_INT);

      return $stmt->execute();
    } catch (\Throwable $th) {
      //throw $th;
    }
  }
}
