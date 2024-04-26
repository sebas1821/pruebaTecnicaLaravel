@section('title', __('Clientes'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Lista de clientes </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Clientes">
						</div>
						<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Nuevo Cliente
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.clientes.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Fecha Creacion</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Cedula</th>
								<th>Departamento</th>
								<th>Ciudad</th>
								<th>Celular</th>
								<th>Correo</th>
								<th>Autorizo</th>
								<td>Acciones</td>
							</tr>
						</thead>
						<tbody>
							@forelse($clientes as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->fecha_creacion }}</td>
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->apellido }}</td>
								<td>{{ $row->cedula }}</td>
								@php
                                   $nombreDepartamento= DB::table('departamentos')->where('id_departamento',$row->departamento)->pluck('departamento')->first();
								@endphp
								<td>{{  $nombreDepartamento}}</td>
								@php
                                   $nombreMunicipio= DB::table('municipios')->where('id_municipio',$row->ciudad)->pluck('municipio')->first();
								@endphp
								<td>{{ $nombreMunicipio }}</td>
								<td>{{ $row->celular }}</td>
								<td>{{ $row->correo }}</td>
								@if($row->autorizo == 1 )
								<td>Si</td>
								@else
								<td>No</td>
								@endif
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Acciones
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a></li>
											<li><a class="dropdown-item" onclick="confirm('Seguro que desea eliminar a : {{$row->nombre}}? ')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a></li>  
										</ul>
									</div>								
								</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
						</tbody>
					</table>						
					<div class="float-end">{{ $clientes->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
</div>
