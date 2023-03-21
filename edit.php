
<?php

  require "database.php";

  $id = $_GET["id"];

  $statement = $conn->prepare("SELECT * FROM contacts WHERE id = :id LIMIT 1");
  $statement->execute([":id" => $id]);

  if ($statement->rowCount() == 0) {
    http_response_code(404);
    echo("HTTP 404 NOT FOUND");
    return; 
  }

  $contact = $statement->fetch(PDO::FETCH_ASSOC);

  $error = null;
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"]) || empty($_POST["phone"])) {
      $error = "Por favor llena los campos.";
    } else if (strlen($_POST["phone"]) < 9){
      $error = "El numero de telefono deberia tener al menos 9 digitos.";
    }else {
      $name = $_POST["name"];
      $phone = $_POST["phone"];
  
      $statement = $conn->prepare("UPDATE contacts SET name = :name, phone_number = :phone WHERE id = :id");
      $statement->execute([
        ":id" => $id,
        ":name" => $_POST["name"],
        ":phone" => $_POST["phone"]
      ]);
  
      header("Location: home.php");
    }

  }

?>


<?php require "partials/header.php" ?>

  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Edit Contact</div>
          <div class="card-body">
            <?php if ($error) : ?>
              <p class="text-danger">
                <?= $error ?>
              </p>
            <?php endif ?> 
            <form method="POST" action="edit.php?id=<?= $contact["id"] ?>">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input value="<?= $contact["name"] ?>" type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name">
                <div id="nameHelp" class="form-text">Escribe tu nombre completo</div>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input value="<?= $contact["phone_number"] ?>" type="tel" class="form-control" id="phone" name="phone">
              </div>
              
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
        
<?php require "partials/footer.php" ?>
