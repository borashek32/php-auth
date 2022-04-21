<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="col-6 mt-4">
      <?php
        if($_SESSION['message']) {
          echo
          '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>' . $_SESSION['message'] . '</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>'; 
        }
        unset($_SESSION['message']);
      ?>

      <form action="vendor/registration.php" method="POST" enctype="multipart/form-data"  class="mt-2">
        <p class="h4">Редактировать личную информацию</p>
        <small id="emailHelp" class="form-text text-muted">Мы никогда не раскрываем личные данные пользователей.</small>
        <div class="form-group">
          <label for="email">Email</label>
          <input name="email" type="email" class="form-control" id="email" 
            placeholder="Введите ваш электронный адрес" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
          <label for="fullname">ФИО</label>
          <input name="fullname" type="text" class="form-control" 
            placeholder="Введите ФИО" id="fullname">
        </div>
        <div class="form-group">
          <label for="login">Логин</label>
          <input name="login" type="text" class="form-control" id="login"
            placeholder="Придумайте логин длиной от 4 до 9 символов">
        </div>
        <div class="form-group">
          <label for="password">Пароль</label>
          <input name="password" type="password" class="form-control" id="password"
            placeholder="Придумайте пароль длиной не менее 8 символов">
        </div>
        <div class="form-group">
          <label for="password_conf">Подтвердите пароль</label>
          <input name="password_conf" type="password" class="form-control" id="password_conf"
            placeholder="Введите ваш пароль повторно">
        </div>
        <?php
          if($_SESSION['message']) {
            echo
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>' . $_SESSION['message'] . '</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>'; 
          }
          unset($_SESSION['message']);
        ?>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
      </form>  

    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>