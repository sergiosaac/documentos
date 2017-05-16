<?php
require 'php/read.php';
require 'layouts/header.php'
?>

<div class="container">
<br>
  <h3>Crear documentacion:</h3>
  <br><br>
  <form method="POST" action="php/editar.php">
    <div class="form-group">
      <label for="nombre">Nombre del servicio:</label>
      <input type="text" class="form-control" id="text" placeholder="Ingresa titulo del servicio" name="nombre" required value="<?= $selecionado->nombre ?>" >
      <input type="hidden" class="form-control" value="<?= $_GET['id'] ?>" name="_id" required >
    </div>
    <div class="contenedorurl" >
      <?php foreach ($selecionado->urls as $url) { ?>

          <div class="jumbotron">
              <div  style="float:right; margin-top:-10px" class="form-group">
                <a href="#!" > <span class="borraUrl glyphicon glyphicon-remove"></span> </a>
              </div>
              <br>
              <br>

              <div class="form-group">
                <label for="pwd">Nombre:</label>
                <input  type="text" class="form-control" id="pwd" placeholder="Nombre" name="nombre_url[]" required value="<?= $url->nombre_url ?>">
              </div>
              <div class="form-group">
                <label for="pwd">Descripcion</label>
                <textarea  placeholder="Descripcion" name="descripcion_url[]" class="form-control" rows="5" id="comment" required > <?= $url->descripcion_url ?> </textarea>
              </div>
              <div class="form-group">
                <label for="pwd">Metodo:</label>
                <input  type="text" class="form-control" id="pwd" placeholder="Metodo" name="method[]" required value="<?= $url->method ?>" >
              </div>
              <div class="form-group">
                <label for="pwd">Entrada</label>
                <input  type="text" class="form-control" id="pwd" placeholder="Entrada" name="entrada[]" required value="<?= $url->entrada ?>">
              </div>
              <div class="form-group">
                <label for="pwd">URL</label>
                <input  type="text" class="form-control" id="pwd" placeholder="URL" name="url[]" required value="<?= $url->url ?>" >
              </div>
              <div class="form-group">
                <label for="pwd">Salida</label>
                <input  type="text" class="form-control" id="pwd" placeholder="Salida" name="salida[]" required value='<?= $url->salida ?>' >
              </div>
            </div>

      <?php } ?>
    </div>

      <hr>

      <div class="form-group">
          <a href="#!" class="agregarUrl" > Agregar URL </a>
      </div>

         <button style="float: right;" type="submit" class="btn btn-default">Actualizar servicio</button>    
         </form>
       <button style="float: right;" type="submit" class="btn btn-warning"> <a href="index.php?id=<?= $_GET['id'] ?>"> Cancelar </a> </button>
    <br><br>
    <br><br>
    <br><br>
  
</div>
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')

  </script>
  <script src="js/bootstrap.min.js"></script>
  <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
  <script src="../../assets/js/vendor/holder.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  <script type="text/javascript">

      $(document).ready(function(){

        $(".agregarUrl").click(function(){
              $('.contenedorurl').append(`
                  <div class="jumbotron">
                      <div  style="float:right; margin-top:-10px" class="form-group">
                        <a href="#!" > <span class="borraUrl glyphicon glyphicon-remove"></span> </a>
                      </div>
                      <br>
                      <br>

                      <div class="form-group">
                        <label for="pwd">Nombre:</label>
                        <input  type="text" class="form-control" id="pwd" placeholder="Nombre" name="nombre_url[]" required >
                      </div>
                      <div class="form-group">
                        <label for="pwd">Descripcion</label>
                        <textarea  placeholder="Descripcion" name="descripcion_url[]" class="form-control" rows="5" id="comment" required ></textarea>
                      </div>
                      <div class="form-group">
                        <label for="pwd">Metodo:</label>
                        <input  type="text" class="form-control" id="pwd" placeholder="Metodo" name="method[]" required >
                      </div>
                      <div class="form-group">
                        <label for="pwd">Entrada</label>
                        <input  type="text" class="form-control" id="pwd" placeholder="Entrada" name="entrada[]" required >
                      </div>
                      <div class="form-group">
                        <label for="pwd">URL</label>
                        <input  type="text" class="form-control" id="pwd" placeholder="URL" name="url[]" required >
                      </div>
                      <div class="form-group">
                        <label for="pwd">Salida</label>
                        <input  type="text" class="form-control" id="pwd" placeholder="Salida" name="salida[]" required >
                      </div>
                    </div>
               `);
              });

        $(document).on('click', '.borraUrl', function(){
            $(this).parent().parent().parent().remove();
        });

    });

  </script>

<?php
require 'layouts/footer.php'
?>
