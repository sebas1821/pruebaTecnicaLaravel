<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Municipio;

class Municipios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $id_municipio, $municipio, $estado, $id_departamento;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.municipios.view', [
            'municipios' => Municipio::latest()
						->orWhere('id_municipio', 'LIKE', $keyWord)
						->orWhere('municipio', 'LIKE', $keyWord)
						->orWhere('estado', 'LIKE', $keyWord)
						->orWhere('id_departamento', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->id_municipio = null;
		$this->municipio = null;
		$this->estado = null;
		$this->id_departamento = null;
    }

    public function store()
    {
        $this->validate([
		'id_municipio' => 'required',
		'municipio' => 'required',
		'estado' => 'required',
		'id_departamento' => 'required',
        ]);

        Municipio::create([ 
			'id_municipio' => $this-> id_municipio,
			'municipio' => $this-> municipio,
			'estado' => $this-> estado,
			'id_departamento' => $this-> id_departamento
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Municipio Successfully created.');
    }

    public function edit($id)
    {
        $record = Municipio::findOrFail($id);
        $this->selected_id = $id; 
		$this->id_municipio = $record-> id_municipio;
		$this->municipio = $record-> municipio;
		$this->estado = $record-> estado;
		$this->id_departamento = $record-> id_departamento;
    }

    public function update()
    {
        $this->validate([
		'id_municipio' => 'required',
		'municipio' => 'required',
		'estado' => 'required',
		'id_departamento' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Municipio::find($this->selected_id);
            $record->update([ 
			'id_municipio' => $this-> id_municipio,
			'municipio' => $this-> municipio,
			'estado' => $this-> estado,
			'id_departamento' => $this-> id_departamento
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Municipio Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Municipio::where('id', $id)->delete();
        }
    }
}