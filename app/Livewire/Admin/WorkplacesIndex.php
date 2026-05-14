<?php

namespace App\Livewire\Admin;

use App\Models\Workplace;
use Livewire\Component;
use Livewire\WithPagination;

class WorkplacesIndex extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = ['workplaceSaved' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Workplace $workplace)
    {
        $workplace->delete();
        $this->dispatch('toast', message: 'Centro de trabajo eliminado correctamente.', type: 'success');
    }

    public function render()
    {
        $workplaces = Workplace::where('adscripcion', 'like', '%' . $this->search . '%')
            ->orWhere('unidad', 'like', '%' . $this->search . '%')
            ->orWhere('lugar', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.workplaces-index', [
            'workplaces' => $workplaces
        ]);
    }
}
