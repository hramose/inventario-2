@extends ('admin/layout')

@section ('title') Admin | Sistema Inventario @stop

@section ('content')


    <div class="welcome">
        <h1>Ventas</h1>

        <form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Registro Compra</legend>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="id_producto">Producto</label>
  <div class="controls">
    <select id="id_producto" name="id_producto" class="input-xlarge">
      <option>Producto Uno</option>
      <option>Producto Dos</option>
      <option>Producto Tres</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="proveedor_id">Proveedor</label>
  <div class="controls">
    <select id="proveedor_id" name="proveedor_id" class="input-xlarge">
      <option>Proveedor Uno</option>
      <option>Proveedor Dos</option>
      <option>Proveedor Tres</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="costo_unitario">Costo Unitario</label>
  <div class="controls">
    <input id="costo_unitario" name="costo_unitario" type="text" placeholder="Costo Unitario" class="input-xlarge" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="costo_unitario_iva">Costo Unitario con IVA</label>
  <div class="controls">
    <input id="costo_unitario_iva" name="costo_unitario_iva" type="text" placeholder="Costo unitario con IVA" class="input-xlarge">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="costo_total">Costo Total</label>
  <div class="controls">
    <input id="costo_total" name="costo_total" type="text" placeholder="Costo Total" class="input-xlarge">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="costo_total_iva">Costo Total con IVA</label>
  <div class="controls">
    <input id="costo_total_iva" name="costo_total_iva" type="text" placeholder="Costo Total con IVA" class="input-xlarge">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="fecha_compra">Fecha Compra</label>
  <div class="controls">
    <input id="fecha_compra" name="fecha_compra" type="text" placeholder="Fecha Compra" class="input-xlarge">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="fecha_vencimiento">Fecha Vencimiento</label>
  <div class="controls">
    <input id="fecha_vencimiento" name="fecha_vencimiento" type="text" placeholder="Fecha Vencimiento" class="input-xlarge">
    <p class="help-block">vencimiento del producto</p>
  </div>
</div>

</fieldset>
</form>


        
    </div>

@stop