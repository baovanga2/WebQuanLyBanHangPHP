<?php
  session_start();
  if (isset($_SESSION['username']))
  {
    echo "<script>window.location='../home/homepage.php';</script>";
  }
  if(isset($_POST['login']))
  {
    $errors = array();
    include_once("users.php");
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    if (loginname_exist($username))
    {
      if (password_true($username, $password))
      {
        $_SESSION["username"]=$username;
        $role=get_role($username);
        $_SESSION['role_id']=$role['r_id'];
        $_SESSION["role_name"]=$role['r_name'];
        echo "<script>window.location='../home/homepage.php';</script>";
      }
      else
      {
        $errors['password'] = "Incorrect password!";
      }
    }
    else
    {
      $errors['username']="User name does not exist!";
    }
    disconnect_db();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <?php
    include_once("../layout/meta_link.php");
  ?>

  <title>PC House - Login</title>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" placeholder="Enter Username">
                      <?php if (!empty($errors['username'])) echo "<span style='color:#FF0000;'>&nbsp&nbsp{$errors['username']}</span>"; ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                      <?php if (!empty($errors['password'])) echo "<span style='color:#FF0000;'>&nbsp&nbsp{$errors['password']}</span>"; ?>
                    </div>

                    <input type="submit" class="btn btn-primary btn-user btn-block" name="login" value="Log in">

                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>

  </div>

  <?php
    include_once("../layout/script.php");
  ?>

</body>

</html>
