<!DOCTYPE HTML>  
<html>
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Registration</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>  

<?php
  session_start();

  $email = $_POST['email'];
  $fullname = $_POST['fullname'];
  $login = $_POST['login'];
  $password = $_POST['password'];

  $email_error = $fullname_error = $lobin_error = $password_error = $password_conf_error = "";
  $email = $fullname = $login = $password = $password_conf = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["email"])) {
      $_SESSION['email_error'] = 'Поле "Электронная почта" обязательно для заполнения';

    } else if (!empty($_POST["email"])){
      $email = prev_input($_POST["email"]);
      
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email_error'] = 'Поле "Электронная почта" заполнено неверно';

      } else if (empty($_POST['fullname'])) {
        $_SESSION['fullname_error'] = 'Поле "ФИО" обязательно для заполнения';

      } else if (!empty($_POST['fullname'])) {
        $fullname = prev_input($_POST["fullname"]);

        if (mb_strlen($fullname) < 6 || mb_strlen($fullname) > 61) { 
          $_SESSION['fullname_error'] = 'Длина поля "ФИО" должна быть не менее 5 символов и не более 60';
        
        } else if (empty($_POST['login'])) {
          $_SESSION['login_error'] = 'Поле "Логин"" обязательно для заполнения';

        } else if (!empty($_POST['login'])){
          $login = prev_input($_POST["login"]);

          if (mb_strlen($login) < 4 || mb_strlen($login) > 11) { 
            $_SESSION['login_error'] = 'Длина поля "Логин" должна быть не менее 4 символов и не более 10';
          
          } else if (empty($_POST['password'])) {
            $_SESSION['password_error'] = 'Поле "Пароль" обязательно для заполнения';

          } else if (mb_strlen($password) < 7) {
            $password = prev_input($_POST["password"]);

            $_SESSION['password_error'] = '"Пароль" должен содержать не менее 6 символов';

            if (mb_strlen($password) > 6) {
              $mysql = new mysqli('localhost', 'root', 'root', 'php-auth');
              if (!$mysql) {
                echo' Ошибка подключения к БД: '.mysqli_connect_error().' Код ошибки:'.mysqli_connect_errno();
                exit;
              }

              $result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
              $users = $result->fetch_assoc();
              if(!empty($users)) {
                echo "Такой логин уже используется!";
                exit();
              }

              // $password = md5($password, 'cafgscxgfas3r5re65234r');
              $q = mysqli_query($mysql, "INSERT INTO `users` (`id`, `login`, `password`, `fullname`, `email`) VALUES (NULL, '$login', '$password', '$fullname', '$email')");
              if (!$q) {
                echo'Ошибка запроса: ' . mysqli_error($q);
                exit;
              }

              $mysql->close();
              $_SESSION['success'] = 'Регистрация прошла успешно';
              header('Location: ./login.php');
            }
          }
        }
      }
    }
  }

  function prev_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>


<div class="container">
    <div class="row mt-4">
    <div class="col-md-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" 
          enctype="multipart/form-data">

          <p class="h4">Зарегистрироваться</p>

          <div class="form-group">
            <label for="email">Email</label>
            <input name="email" class="form-control" value="<?php echo $email;?>"
              placeholder="Введите ваш электронный адрес" autofocus>
            
            <?php
              if($_SESSION['email_error']) {
                echo 
                  '<div class="mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>' . $_SESSION['email_error'] . '</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>'; 
              }
              unset($_SESSION['email_error']);
            ?>  
          </div>
          

          <div class="form-group">
            <label for="fullname">ФИО</label>
            <input name="fullname" type="text" class="form-control" 
              placeholder="Введите ФИО" value="<?php echo $fullname; ?>">

            <?php
              if($_SESSION['fullname_error']) {
                echo 
                  '<div class="mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>' . $_SESSION['fullname_error'] . '</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>'; 
              }
              unset($_SESSION['fullname_error']);
            ?>    
          </div>

          <div class="form-group">
            <label for="login">Логин</label>
            <input name="login" type="text" class="form-control"
              placeholder="Придумайте логин длиной от 4 до 9 символов" value="<?php echo $login ?>">

            <?php
              if($_SESSION['login_error']) {
                echo 
                  '<div class="mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>' . $_SESSION['login_error'] . '</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>'; 
              }
              unset($_SESSION['login_error']);
            ?>    
          </div>

          <div class="form-group">
            <label for="password">Пароль</label>
            <input name="password"  class="form-control" 
              placeholder="Придумайте пароль длиной не менее 8 символов" value="<?php echo $password ?>">

            <?php
              if($_SESSION['password_error']) {
                echo 
                  '<div class="mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>' . $_SESSION['password_error'] . '</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>'; 
              }
              unset($_SESSION['password_error']);
            ?>    
          </div>

          <input type="submit" class="btn btn-primary" value="Зарегистрироваться">
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>


