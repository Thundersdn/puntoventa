<!DOCTYPE html>
<html>
  <head>
    <title>Inicio de sesion</title>
    <?php include "./class_lib/links.php"; ?>
  </head>
  <body>
    <form action="valida_usr.php" method="post" class="AjaxForms MainLogin" data-type-form="login" autocomplete="off">
        <p class="text-center text-muted lead text-uppercase">login</p>
        <div class="form-group">
          <label class="control-label" for="UserName">Usuario</label>
          <input class="form-control" name="usuario" id="UserName" type="text" required="">
        </div>
        <div class="form-group">
          <label class="control-label" for="Pass">Contraseña</label>
          <input class="form-control" name="pass" id="Pass" type="password" required="">
        </div>
        <p class="text-center">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>        
        </p>
    </form>
    <div class="MsjAjaxForm"></div>
    <?php include "./class_lib/scripts.php"; ?>
  </body>
</html>
