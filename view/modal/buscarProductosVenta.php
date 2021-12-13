<div class="modal fade" id="buscar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content bg-white">
        <div class="modal-header">
           <h5 class="modal-title" id="exampleModalCenterTitle">Buscar Items</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
				<div class="form-group row">

					<div class="col-md-12">
						<div class="input-group">
							<input type="text" autocomplete="off" class="form-control" id="q" placeholder="Buscar por C&oacute;digo, nombre o descripci&oacute;n" onkeyup="load(1)">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary waves-effect waves-light" onclick="load(1)"><span class="la la-search"></span></button>
							</span>
						</div>
					</div>
					<div class="col-md-4">
						<div id="loader"></div><!-- Carga gif animado -->
					</div>
				</div>
			<div class="outer_div" ></div><!-- Datos ajax Final -->
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">De acuerdo</button>
        </div>
     </div>
  </div>
</div>