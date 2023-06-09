
<?php

  require "database.php";

  $error = null;
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"]) || empty($_POST["phone"])) {
      $error = "Por favor llena los campos.";
    } else if (strlen($_POST["phone"]) < 9){
      $error = "El numero de telefono deberia tener al menos 9 digitos.";
    }else {
      $name = $_POST["name"];
      $phone = $_POST["phone"];
  
      $statement = $conn->prepare("INSERT INTO contacts(name, phone_number) VALUES (:name, :phone)");
      $statement->bindParam(":name", $_POST["name"]);
      $statement->bindParam(":phone", $_POST["phone"]);
      $statement->execute();
  
      header("Location: home.php");
    }

  }

?>


<?php require "partials/header.php" ?>

  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Add New Contact</div>
          <div class="card-body">
            <?php if ($error) : ?>
              <p class="text-danger">
                <?= $error ?>
              </p>
            <?php endif ?> 
            <form method="POST" action="add.php">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name">
                <div id="nameHelp" class="form-text">Escribe tu nombre completo</div>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone">
              </div>
              
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
        
<?php require "partials/footer.php" ?>
