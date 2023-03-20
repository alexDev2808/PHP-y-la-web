
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
  
      header("Location: index.php");
    }

  }

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" 
            href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.3/darkly/bootstrap.min.css" 
            integrity="sha512-YRcmztDXzJQCCBk2YUiEAY+r74gu/c9UULMPTeLsAp/Tw5eXiGkYMPC4tc4Kp1jx/V9xjEOCVpBe4r6Lx6n5dA==" 
            crossorigin="anonymous" 
            referrerpolicy="no-referrer" />
    <script 
            defer
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
            crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="./static/css/index.css">
    <title>Contacts App</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><ion-icon name="library-outline"></ion-icon> Contacts App</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./add.php">Add Contact <ion-icon name="add-outline"></ion-icon></a>
              </li>
            </ul>   
          </div>
        </div>
      </nav>

      <main>
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
        
      </main>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>