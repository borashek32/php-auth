<?php
  session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Registration</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row mt-4">
      <div class="offset-md-1 col-md-4">
        
        <?php
          if($_SESSION['success']) {
            echo
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>' . $_SESSION['success'] . '</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>'; 
          }
          unset($_SESSION['success']);
        ?>

        <form action="vendor/login.php" method="POST">
          <p class="h4">Войти в личный кабинет</p>
          <div class="form-group">
            <label for="login">Логин</label>
            <input name="login" type="text" class="form-control" id="login"
              placeholder="Введите ваш логин, указанный при регистрации">
          </div>
          <div class="form-group">
            <label for="password">Пароль</label>
            <input name="password" type="password" class="form-control" id="password"
              placeholder="Введите ваш пароль, указанный при регистрации">
          </div>
          <button type="submit" class="btn btn-primary">Войти</button>
        </form>
      </div>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>

<?php
  // $email = $fullname = $login = $password = $password_conf = '';
  // $email_error = $fullname_error = $login_error = $password_error = $password_conf_error = '';

  // if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //   $email          = prev_input($_POST['email']);
  //   $fullname       = prev_input($_POST['fullname']);
  //   $login          = prev_input($_POST['login']);
  //   $password       = prev_input($_POST['password']);
  //   $password_conf  = prev_input($_POST['password_conf']);

  //   function prev_input($data) {
  //     $data = trim($data);
  //     $data = stripslashes($data);
  //     $data = htmlspecialchars($data);

  //     return $data;
  //   }
  // }
?>