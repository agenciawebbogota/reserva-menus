<div id="actualizarMenu" class="modal modal-fixed-footer" >
    <div class="modal-content">
    <h4 class="center-align">Editar Menú</h4>
      <div class="row">
      <form class="col s12" @submit.prevent="updateMenu(update)" enctype="multipart/form-data">
        <div class="row">
          <div class="input-field col s6">
            <i class="mdi-action-add-shopping-cart small"></i>
            <input id="nobre" type="text" class="validate" data-length="10" v-model="update.nombre">
          </div>
          <div class="input-field col s6">
            <i class="mdi-editor-attach-money small"></i>
            <input id="precio" type="text" class="validate" v-model="update.precio">
          </div>
          <div class="input-field col s12">
              <i class="mdi-maps-restaurant-menu small"></i>
              <textarea id="descripcion" class="materialize-textarea" data-length="120" v-model="update.descripcion"></textarea>
          </div>
          {{-- @if (Auth::user()->estado_empresa != 'GRATIS')
          <div class="row">
            <div class="file-field input-field col s12">
                <div class="btn">
                  <span>Cargar imagen</span>
                  <input type="file" @change="getImagen2" accept="image/png, image/jpeg">
                </div>
              <input type="text" id="file" class="file-path" placeholder="Recomendamos un ancho de 800px y un alto de 248px.">
              <span style="color:#c91e04">@{{ noti.imagen }}</span>
            </div>
          </div>
        @endif --}}
          <div id="input-switches1" class="section">
        		<div class="row section">
        			<div class="col s12 m8 l9">
        				<div class="switch">
        					¿Es Adición? :
        					<label>
        					NO
        					<input type="checkbox" v-model="update.adicional">
        					<span class="lever"></span> SI
        					</label>
        				</div>
        			</div>
        		</div>
        	</div>

          <div class="col s12 m8 l9">
            <div class="switch">
              Disponible :
              <label>
                NO
                <input type="checkbox" v-model="update.estado">
                <span class="lever"></span> SI
              </label>
            </div>
          </div>
        </div>
         <button class="btn waves-effect waves-light grey darken-4" type="submit">Guardar
      </button>
      </form>
    </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Salir</a>
    </div>
  </div>
