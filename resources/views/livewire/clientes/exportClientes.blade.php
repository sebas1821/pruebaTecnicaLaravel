<div>
   
<table class="table table-bordered table-sm">
    <thead class="thead">
        <tr>

            
             
                <th>Fecha Creacion</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cedula</th>
                <th>Departamento</th>
                <th>Ciudad</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Autorizo</th>
              
           
        </tr>
    </thead>
    <tbody>
@php
     
@endphp
@foreach ($clientesE as $row)
      
            <tr>


          
                <td>{{ $row->fecha_creacion }}</td>
                <td>{{ $row->nombre }}</td>
                <td>{{ $row->apellido }}</td>
                <td>{{ $row->cedula }}</td>
                <td>{{ $row->departamento }}</td>
                <td>{{ $row->municipio }}</td>
                <td>{{ $row->celular }}</td>
                <td>{{ $row->correo }}</td>
                <td>{{ $row->autorizo }}</td>
        @endforeach
    </tbody>
</table>
</div>