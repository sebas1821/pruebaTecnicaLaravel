<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cliente;
use Carbon\Carbon;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Support\Facades\DB;
use App\Exports\ClientesExports;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;

class Clientes extends Component implements FromView
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $fecha_creacion, $nombre, $apellido, $cedula, $departamento, $ciudad, $celular, $correo, $autorizo;
   
	 protected $listeners = ['export','concurso'];

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
		$departamentos = Departamento::all();
		$municipios=Municipio::where('id_departamento',$this->departamento)->get();
        return view('livewire.clientes.view', [
            'clientes' => Cliente::latest()
						->orWhere('fecha_creacion', 'LIKE', $keyWord)
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('apellido', 'LIKE', $keyWord)
						->orWhere('cedula', 'LIKE', $keyWord)
						->orWhere('departamento', 'LIKE', $keyWord)
						->orWhere('ciudad', 'LIKE', $keyWord)
						->orWhere('celular', 'LIKE', $keyWord)
						->orWhere('correo', 'LIKE', $keyWord)
						->orWhere('autorizo', 'LIKE', $keyWord)
						->paginate(10),
        ],compact('departamentos','municipios'));
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->fecha_creacion = null;
		$this->nombre = null;
		$this->apellido = null;
		$this->cedula = null;
		$this->departamento = null;
		$this->ciudad = null;
		$this->celular = null;
		$this->correo = null;
		$this->autorizo = null;
    }

    public function store()
    {
        $this->validate([
		
		'nombre' => 'required',
		'apellido' => 'required',
		'cedula' => 'required',
		'departamento' => 'required',
		'ciudad' => 'required',
		'celular' => 'required',
		'correo' => 'required|string|email',
		'autorizo' => 'required',
        ]);

		$date = Carbon::now();
		try{
        Cliente::create([ 
			'fecha_creacion' => $date->format('Y-m-d H:i:s'),
			'nombre' => $this-> nombre,
			'apellido' => $this-> apellido,
			'cedula' => $this-> cedula,
			'departamento' => $this-> departamento,
			'ciudad' => $this-> ciudad,
			'celular' => $this-> celular,
			'correo' => $this-> correo,
			'autorizo' => $this-> autorizo
        ]);
		$this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Cliente Creado Con Exito.');
	}catch(\Exception $ex){
		
    
        $this->emit('errorCliente');
    }
     
    }

    public function edit($id)
    {
        $record = Cliente::findOrFail($id);
        $this->selected_id = $id; 
		$this->fecha_creacion = $record-> fecha_creacion;
		$this->nombre = $record-> nombre;
		$this->apellido = $record-> apellido;
		$this->cedula = $record-> cedula;
		$this->departamento = $record-> departamento;
		$this->ciudad = $record-> ciudad;
		$this->celular = $record-> celular;
		$this->correo = $record-> correo;
		$this->autorizo = $record-> autorizo;
    }

    public function update()
    {
        $this->validate([
		
		'nombre' => 'required',
		'apellido' => 'required',
		'cedula' => 'required',
		'departamento' => 'required',
		'ciudad' => 'required',
		'celular' => 'required',
		'correo' => 'required',
		'autorizo' => 'required',
        ]);

        if ($this->selected_id) {
			try{
			$record = Cliente::find($this->selected_id);
            $record->update([ 
			'fecha_creacion' => $this-> fecha_creacion,
			'nombre' => $this-> nombre,
			'apellido' => $this-> apellido,
			'cedula' => $this-> cedula,
			'departamento' => $this-> departamento,
			'ciudad' => $this-> ciudad,
			'celular' => $this-> celular,
			'correo' => $this-> correo,
			'autorizo' => $this-> autorizo
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Cliente Editado con exito.');
			}catch(\Exception $ex){
		
    
				$this->emit('errorCliente');
			}
        }
		
    }

    public function destroy($id)
    {
        if ($id) {
            Cliente::where('id', $id)->delete();
        }
    }
	public function export() 
    {
        return Excel::download(new Clientes, 'clientes.xlsx');
    }

	public function view(): View
    {
         
            $sql = 'select clientes.fecha_creacion,clientes.nombre,clientes.apellido,clientes.cedula,clientes.celular,clientes.correo,clientes.autorizo,
			departamentos.departamento, municipios.municipio
				   from clientes  
				 join departamentos on departamentos.id_departamento = clientes.departamento
				 join  municipios on municipios.id_municipio = clientes.ciudad
				;';
            $clientes = DB::select($sql);
                
            return view('livewire.clientes.exportClientes', [
                'clientesE' => $clientes
            ]);
       
    }

	public function concurso() 
    {
		$clienteGanador=Cliente::inRandomOrder()->first();
		return view('livewire.clientes.concurso', [
			'clienteGanador' => $clienteGanador
		]);
    }

}