<div class='modal fade' id='verprodProveedor' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
   <div class='modal-dialog modal-lg' role='document'>
      <div class='modal-content bg-white'>
         <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalCenterTitle'><span id="cliente_nombre"></span></h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
         </div>
         <div class='modal-body'>
          <input type='hidden' name='id_proveedor' id='id_proveedor'>
           <div class='row align-items-center'>
              
              <div class='col-12 col-md-12'>
              <table
                data-toggle="table"
                data-toolbar="#toolbarItems"
                data-mobile-responsive="true"
                data-search="true"
                data-show-refresh="true"
                data-show-columns="true"
                data-click-to-select="true"
                data-sort-name="0"
                data-page-list="[5, 10, 20]"
                data-page-size="10"
                data-show-pagination-switch="true"
                data-pagination="true"
                id="tableItemsProv">

                </table>
              </div>
          </div>
         </div>
         <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
         </div>
      </div>
   </div>
</div>
<script>
$('#tableItemsProv').bootstrapTable({
    height: 300,
    idField: '0',
    url: '../ajax/buscarItems1.php',
    columns: [{
        field: '0',
        title: '#',
        sortable: true
    }, {
        field: '1',
        title: 'Foto'
    }, {
        field: '2',
        title: 'C&oacute;digo SUNAT',
        sortable: true
    }, {
        field: '3',
        title: 'Barras',
        sortable: true
    }, {
        field: '4',
        title: 'Nombre',
        sortable: true
    }, {
        field: '5',
        title: 'Stock',
        sortable: true
    }, {
        field: '6',
        title: 'Precio',
        sortable: true
    }, {
        field: '7',
        title: 'IGV',
        sortable: true
    }, {
        field: '8',
        title: 'Acciones'
    }]
});
</script>