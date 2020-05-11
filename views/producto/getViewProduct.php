
<div id="imgProdModal" align="left">
  <img src="<?php echo constant('URL'); ?>img/productos/<?php echo $this->productoSelected->foto; ?>" class="img-responsive" width="200"  title="<?php echo $this->productoSelected->descripcionProd;?>">
  <h5 class="text-left"><?php echo $this->productoSelected->descripcionProd;?></h5>
</div>

<div id="datosProdModal">

  <div class="row col-md-12" align="left">              
    <div class="col-md-4"><span class="label-card">Departamento:</span></div>
    <div class="col-md-8"><?php echo $this->productoSelected->nombreDepa; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Tipo de Tela: </span></div>
    <div class="col-md-8"><?php echo $this->productoSelected->tipo_tela; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Categoría: </span></div>
    <div class="col-md-8"><?php echo $this->productoSelected->nombreCate; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Talla(s): </span></div>
    <div class="col-md-8"><?php echo $this->productoSelected->nombreTalla; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Cantidad: </span></div>
    <div class="col-md-8"><?php echo $this->productoSelected->cantidad; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Precio: (Mayoreo) </span></div>
    <div class="col-md-8">$<?php echo $this->productoSelected->mayoreo; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Precio: (Menudeo) </span></div>
    <div class="col-md-8">$<?php echo $this->productoSelected->general; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Estado: </span></div>
    <?php
    $prod = $this->productoSelected->estadoProd;
    $prodEstado = "";

    if($prod == 1){
      $prodEstado = "Activo";
    }else{
      $prodEstado = "Inactivo";
    }

    ?>
    <div class="col-md-8"><?php echo $prodEstado; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Descuento: </span></div>
    <div class="col-md-8">%<?php echo $this->productoSelected->descuento; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Promoción: </span></div>
    <div class="col-md-8"><?php echo $this->productoSelected->nombrePromo; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Dato promoción: </span></div>
    <div class="col-md-8"><?php echo $this->productoSelected->descripcionPromo; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Proveedor: </span></div>
    <div class="col-md-8"><?php echo $this->productoSelected->proveedor; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Registro: </span></div>
    <div class="col-md-8"><?php $fechaReg = $this->productoSelected->fecha_reg; $date = date("d/m/Y", strtotime($fechaReg)); echo " ".$date; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Registró: </span></div>
    <div class="col-md-8"><?php echo $this->productoSelected->nombrePers . " " . $this->productoSelected->apellido; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Codigo Intertno: </span></div>
    <div class="col-md-8"><?php echo $this->productoSelected->codigo_interno; ?></div>
  </div>

  <div class="row col-md-12" align="left">
    <div class="col-md-4"><span class="label-card">Codigo Externo: </span></div>
    <div class="col-md-8"><?php echo $this->productoSelected->codigo_externo; ?></div>
  </div>

</div>