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

        
        <link rel="stylesheet" href="./static/css/index.css" />
        <?php $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); ?>
        <?php if ($uri == "/contacts-app/" || $uri == "/contacts-app/index.php"): ?>
                <script defer src="./static/js/welcome.js"></script>
        <?php endif ?>
        <title>Contacts App</title>
</head>
<body>

      <?php require("navbar.php") ?>

      <main>

      <!-- Content here --> 