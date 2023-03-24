
<?php

  require "database.php";

  $error = null;
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
      $error = "Por favor llena los campos";
    } else if (!str_contains($_POST["email"], "@")) {
      $error = "El formato del email  es incorrecto.";
    }else {
      $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
      $statement->bindParam(":email", $_POST["email"]);
      $statement->execute();

      if($statement->rowCount() > 0) {
        $error = "El email ya esta registrado";
      } else {
        $conn
          ->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)")
          ->execute([
            ":name" => $_POST["name"],
            ":email" => $_POST["email"],
            ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
          ]);

          header("Location: home.php");
      }
    }
  }

?>


<?php require "partials/header.php" ?>

  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Registro</div>
          <div class="card-body">
            <?php if ($error) : ?>
              <p class="text-danger">
                <?= $error ?>
              </p>
            <?php endif ?> 
            <form method="POST" action="register.php">
              <div class="mb-3">
                <label for="name" class="form-label">Nombre: </label>
                <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name">
                <div id="nameHelp" class="form-text">Escribe tu nombre completo</div>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Correo electronico: </label>
                <input type="email" class="form-control" id="email" name="email">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Contraseña:  </label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
        
<?php require "partials/footer.php" ?>
