<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel"> Nuevo Cliente</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    {{-- <div class="form-group">
                        <label for="fecha_creacion"></label>
                        <input wire:model="fecha_creacion" type="text" class="form-control" id="fecha_creacion" placeholder="Fecha Creacion">@error('fecha_creacion') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div> --}}
                    <div class="form-group">
                        <label for="nombre">* Nombre: </label>
                        <input onkeypress= "return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122)||(event.charCode == 32)||(event.charCode == 160)||(event.charCode == 239)) " wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="apellido">* Apellido: </label>
                        <input onkeypress= "return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122)||(event.charCode == 32)||(event.charCode == 160)||(event.charCode == 239)) " wire:model="apellido" type="text" class="form-control" id="apellido" placeholder="Apellido">@error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="cedula">* Cedula: </label>
                        <input onkeypress = "return ((event.charCode >= 48 && event.charCode <= 57))"  wire:model="cedula" type="text" class="form-control" id="cedula" placeholder="Cedula">@error('cedula') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="departamento">* Departamento:</label>
        
                        <select wire:model="departamento" class="form-control" id="departamento">
                            <option value="">Seleccione el departamento</option>
                            @foreach ($departamentos as $row)
                                <option value="{{$row->id_departamento}}">{{$row->departamento}}</option>
                            @endforeach
                        </select>
                        @error('departamento') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ciudad">* Municipio: </label>
                        <select wire:model="ciudad" class="form-control" id="ciudad">
                            <option value="">Seleccione el municipio</option>
                            @foreach ($municipios as $row)
                                <option value="{{$row->id_municipio}}">{{$row->municipio}}</option>
                            @endforeach
                        </select>
                        @error('ciudad') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="celular">* Celular: </label>
                        <input onkeypress = "return ((event.charCode >= 48 && event.charCode <= 57)||(event.charCode == 45))"  wire:model="celular" type="text" class="form-control" id="celular" placeholder="Celular">@error('celular') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="correo">* Correo: </label>
                        <input  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" wire:model="correo" type="text" class="form-control" id="correo" placeholder="Correo">@error('correo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                       
                        <input  wire:model="autorizo" type="checkbox"  id="autorizo" placeholder="Autorizo">@error('autorizo') <span class="error text-danger">{{ $message }}</span> @enderror
                        <label for="autorizo">* Autorizo el tratamiento de mis datos de acuerdo con la
                            finalidad establecida</label>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Editar Cliente</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="nombre">* Nombre: </label>
                        <input onkeypress= "return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122)||(event.charCode == 32)||(event.charCode == 160)||(event.charCode == 239)) " wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="apellido">* Apellido: </label>
                        <input onkeypress= "return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122)||(event.charCode == 32)||(event.charCode == 160)||(event.charCode == 239)) " wire:model="apellido" type="text" class="form-control" id="apellido" placeholder="Apellido">@error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="cedula">* Cedula: </label>
                        <input onkeypress = "return ((event.charCode >= 48 && event.charCode <= 57))"  wire:model="cedula" type="text" class="form-control" id="cedula" placeholder="Cedula">@error('cedula') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="departamento">* Departamento:</label>
        
                        <select wire:model="departamento" class="form-control" id="departamento">
                            <option value="">Seleccione el departamento</option>
                            @foreach ($departamentos as $row)
                                <option value="{{$row->id_departamento}}">{{$row->departamento}}</option>
                            @endforeach
                        </select>
                        @error('departamento') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ciudad">* Municipio: </label>
                        <select wire:model="ciudad" class="form-control" id="ciudad">
                            <option value="">Seleccione el municipio</option>
                            @foreach ($municipios as $row)
                                <option value="{{$row->id_municipio}}">{{$row->municipio}}</option>
                            @endforeach
                        </select>
                        @error('ciudad') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="celular">* Celular: </label>
                        <input onkeypress = "return ((event.charCode >= 48 && event.charCode <= 57)||(event.charCode == 45))"  wire:model="celular" type="text" class="form-control" id="celular" placeholder="Celular">@error('celular') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="correo">* Correo: </label>
                        <input  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" wire:model="correo" type="text" class="form-control" id="correo" placeholder="Correo">@error('correo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="form-group">
                       
                        <input  wire:model="autorizo" type="checkbox"  id="autorizo" placeholder="Autorizo">@error('autorizo') <span class="error text-danger">{{ $message }}</span> @enderror
                        <label for="autorizo">* Autorizo el tratamiento de mis datos de acuerdo con la
                            finalidad establecida</label>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Editar</button>
            </div>
       </div>
    </div>
</div>
