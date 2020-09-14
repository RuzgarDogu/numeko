<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Numeko CRM</title>
    <link rel="stylesheet" href="<?php echo URL; ?>node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>views/login/css/login.css" />
    <script type="text/javascript" src="<?php echo URL; ?>node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>node_modules/three/build/three.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>node_modules/vanta/dist/vanta.clouds.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>views/login/js/login.js"></script>
  </head>
  <body id="bodyvanta">

    <div class="login-form" style="position: relative; z-index: 1;">
      <form method="post" action="login/run">
        <img src="public/images/Numeko_logo_PNG_min.png" alt="Numeko" class="mb-3" id="img-loginLogo">
        <!-- <h2 class="text-center">Login</h2> -->
      	  	<div class="form-group">
      		<input type="text" class="form-control" name="login" placeholder="Username">
      	</div>
      	<div class="form-group">
      		<input type="password" class="form-control" name="password" placeholder="Password">
      	</div>
      	<div class="form-group">
      		<button type="submit" class="btn btn-primary btn-block" name="login_user">Login</button>
      	</div>
      </form>
    </div>

  </body>
</html>
