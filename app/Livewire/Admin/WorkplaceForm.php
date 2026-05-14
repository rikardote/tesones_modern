<?php

namespace App\Livewire\Admin;

use App\Models\Workplace;
use Livewire\Component;

class WorkplaceForm extends Component
{
    public ?Workplace $workplace = null;
    
    public $adscripcion;
    public $unidad;
    public $lugar;
    public $titular_area;
    public $pagador_habilitado;

    protected $rules = [
        'adscripcion' => 'required|string|max:255',
        'unidad' => 'required|string|max:255',
        'lugar' => 'required|string|max:255',
        'titular_area' => 'nullable|string|max:255',
        'pagador_habilitado' => 'nullable|string|max:255',
    ];

    public function mount(?Workplace $workplace = null)
    {
        if ($workplace && $workplace->exists) {
            $this->workplace = $workplace;
            $this->adscripcion = $workplace->adscripcion;
            $this->unidad = $workplace->unidad;
            $this->lugar = $workplace->lugar;
            $this->titular_area = $workplace->titular_area;
            $this->pagador_habilitado = $workplace->pagador_habilitado;
        }
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->workplace) {
            $this->workplace->update($data);
            $message = 'Centro de trabajo actualizado.';
        } else {
            Workplace::create($data);
            $message = 'Centro de trabajo creado.';
        }

        session()->flash('flash_message', $message);
        return redirect()->route('admin.workplaces.index');
    }

    public function render()
    {
        return view('livewire.admin.workplace-form');
    }
}
