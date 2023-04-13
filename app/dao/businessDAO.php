<?php
require_once __DIR__ . "/../config/connection.php";

class BusinessDAO
{
  public function signup_business(Business $business)
  {
    try {
      $sql =
        "INSERT INTO business (corporate_name, type_business, zip_code, address, number, district, city, business_state, telephone, email, password) VALUES (:corporate_name, :type_business, :zip_code, :address, :number, :district, :city, :business_state, :telephone, :email, :password)";

      $stmt = Conexao::getInstance()->prepare($sql);
      $stmt->bindValue(
        ":corporate_name",
        $business->getCorporate_Name(),
        PDO::PARAM_STR
      );
      $stmt->bindValue(
        ":type_business",
        $business->getType_Business(),
        PDO::PARAM_STR
      );
      $stmt->bindValue(":zip_code", $business->getZip_Code(), PDO::PARAM_STR);
      $stmt->bindValue(":address", $business->getAddress(), PDO::PARAM_STR);
      $stmt->bindValue(":number", $business->getNumber(), PDO::PARAM_INT);
      $stmt->bindValue(":district", $business->getDistrict(), PDO::PARAM_STR);
      $stmt->bindValue(":city", $business->getCity(), PDO::PARAM_STR);
      $stmt->bindValue(
        ":business_state",
        $business->getBusiness_State(),
        PDO::PARAM_STR
      );
      $stmt->bindValue(":telephone", $business->getTelephone(), PDO::PARAM_STR);
      $stmt->bindValue(":email", $business->getEmail(), PDO::PARAM_STR);
      $stmt->bindValue(":password", $business->getPassword(), PDO::PARAM_STR);

      return $stmt->execute();
    } catch (PDOException $th) {
      echo "Erro: " . $th->getMessage();
    }
  }

  public function getAll()
  {
    $sql = "SELECT * FROM business";
    $stmt = Conexao::getInstance()->prepare($sql);
    $datas = [];

    if ($stmt->execute()) {
      $rset = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($rset) > 0) {
        foreach ($rset as $line) {
          $data = [
            "id" => $line["id_business"],
            "corporate_name" => $line["corporate_name"],
            "type_business" => $line["type_business"],
            "zip_code" => $line["zip_code"],
            "address" => $line["address"],
            "number" => $line["number"],
            "district" => $line["district"],
            "city" => $line["city"],
            "business_state" => $line["business_state"],
            "telephone" => $line["telephone"],
            "email" => $line["email"],
          ];
          array_push($datas, $data);
        }
      }
    }
    return $datas;
  }
}
