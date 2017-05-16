

<?php if (isset($documentacion)) { ?>

    <ul class="nav nav-sidebar">    
        <li style="text-align: center;" ><a href="crear.php"><button type="button" class="btn btn-default">Nuevo servicio + </button></a></li>    
        <li> <h5><input type="text" style="color:grey; width: 100%; padding: 10px;" name="" id="buscadorItem" placeholder="Buscar..."></h5> </li>
    </ul>

    <ul class="nav nav-sidebar listadoItems">        
	    <?php foreach ($documentacion as $doc) { ?>
	                       
	        <li <?php if ($selecionadoActivo == $doc->_id) { echo "class='active'"; } ?> style="border-bottom: 1px solid #ddd;" ><a href="index.php?id=<?= $doc->_id ?>"><?= $doc->nombre ?></a></li>

	    <?php } ?>
	</ul>

<?php } else { ?>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">    
        <h2 class="page-header"> No se encontro el servicio... </h2>
        <div class="bs-callout bs-callout-danger" id="callout-glyphicons-dont-mix">
            <p> Seleciona otra opcion.. </p>
        </div>
    </div>

<?php } ?>