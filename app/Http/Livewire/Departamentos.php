<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Departamento;

class Departamentos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $id_departamento, $departamento;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.departamentos.view', [
            'departamentos' => Departamento::latest()
						->orWhere('id_departamento', 'LIKE', $keyWord)
						->orWhere('departamento', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->id_departamento = null;
		$this->departamento = null;
    }

    public function store()
    {
        $this->validate([
		'id_departamento' => 'required',
		'departamento' => 'required',
        ]);

        Departamento::create([ 
			'id_departamento' => $this-> id_departamento,
			'departamento' => $this-> departamento
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Departamento Successfully created.');
    }

    public function edit($id)
    {
        $record = Departamento::findOrFail($id);
        $this->selected_id = $id; 
		$this->id_departamento = $record-> id_departamento;
		$this->departamento = $record-> departamento;
    }

    public function update()
    {
        $this->validate([
		'id_departamento' => 'required',
		'departamento' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Departamento::find($this->selected_id);
            $record->update([ 
			'id_departamento' => $this-> id_departamento,
			'departamento' => $this-> departamento
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Departamento Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Departamento::where('id', $id)->delete();
        }
    }
}