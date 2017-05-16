
<?php
require 'php/read.php';
require 'layouts/header.php'
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <?php require 'nav.php'; ?>
        </div>

        <?php if (isset($documentacion)) { ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h2 class="page-header"> <?= $selecionado->nombre ?> <br> <a style="font-size:15px;" href="update.php?id=<?= $selecionado->_id ?>"> Editar  </a>
                  <span style="font-size:15px;"> / </span> <a class="borrarDoc" style="font-size:15px;" data-id="<?= $selecionado->_id ?>"> Borrar </a> </h2>
                <?php foreach ($selecionado->urls as $url) { ?>
                    <div class="bs-callout bs-callout-danger" id="callout-glyphicons-dont-mix">
                        <h4> <?= $url->nombre_url ?></h4>
                        <p><?= $url->descripcion_url ?></p>
                        <ul class="list-group">
                            <li class="list-group-item">Method : <code> <?= $url->method ?> </code></li>
                            <li class="entrada list-group-item"><span class="ver" >Entrada</span> <span class="ver glyphicon glyphicon-triangle-right small"></span> <code style="display: none;" > <?= $url->entrada ?> </code></li>
                            <li class="list-group-item">URL : <code><?= $url->url ?> </code></li>
                            <li class="salida list-group-item"><span class="ver" >Salida</span> <span class="ver glyphicon glyphicon-triangle-right small"></span> <code style="display: none;" > <?= $url->salida ?> </code></li>
                        </ul>
                    </div>
                <?php } ?>

            </div>
        <?php } else { ?>

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h2 class="page-header"> No se encontro el servicio... </h2>
                <div class="bs-callout bs-callout-danger" id="callout-glyphicons-dont-mix">
                    <p> Seleciona otra opcion.. </p>
                </div>
            </div>

        <?php } ?>

    </div>
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
        $(".entrada .ver").click(function(){
            $(this).parent().find("code").toggle();
        });

        $(".salida .ver").click(function(){
            $(this).parent().find("code").toggle();
        });

        //$("#buscadorItem").focus();

        $("#buscadorItem").keyup(function(e){

          buscando = $("#buscadorItem").val().toLowerCase();

           $(".listadoItems li").each(function(e){
                if ($(this).text().toLowerCase().indexOf(buscando) != -1){
                    $(this).fadeIn('fast');
                } else {
                    $(this).fadeOut('fast');
                }
            });
        });

        setTimeout(function(){ $('.actualizado').fadeOut('slow'); }, 4000);

        $(".borrarDoc").click(function(){
            if (confirm('Estas seguro que quieres borrar? ')) {
                window.location.replace("php/borrar.php?id="+$(this).data('id'));
            }
        });

    });

</script>

<?php
require 'layouts/footer.php'
?>
