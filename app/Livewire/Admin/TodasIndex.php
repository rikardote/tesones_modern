<?php

namespace App\Livewire\Admin;

use App\Models\Teson;
use Livewire\Component;
use Livewire\WithPagination;

class TodasIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterTipo = '';
    public string $filterPago = '';

    // Delete confirm
    public ?int $deleteId = null;

    protected $queryString = [
        'search'     => ['except' => ''],
        'filterTipo' => ['except' => ''],
        'filterPago' => ['except' => ''],
    ];

    public function updatingSearch(): void  { $this->resetPage(); }
    public function updatingFilterTipo(): void { $this->resetPage(); }
    public function updatingFilterPago(): void { $this->resetPage(); }

    public function confirmDelete(int $id): void
    {
        $this->deleteId = $id;
    }

    public function cancelDelete(): void
    {
        $this->deleteId = null;
    }

    public function delete(): void
    {
        if (! $this->deleteId) return;

        $teson = Teson::findOrFail($this->deleteId);
        $teson->cancelaciones()->delete();
        $teson->delete();

        session()->flash('flash_message', 'Tesón eliminado');
        session()->flash('flash_level', 'danger');
        $this->deleteId = null;
    }

    public function render()
    {
        $tesones = Teson::with(['nomina', 'user'])
            ->withCount('cancelaciones')
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->whereHas('nomina', fn($n) => $n->where('nomina', 'like', '%' . $this->search . '%'))
                        ->orWhereHas('user', fn($u) => $u->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('adscripcion', 'like', '%' . $this->search . '%'));
                });
            })
            ->when($this->filterTipo, fn($q) => $q->where('tipo_personal', $this->filterTipo))
            ->when($this->filterPago, fn($q) => $q->where('remision_nomina', $this->filterPago))
            ->orderByDesc('fecha_elaboracion')
            ->orderByDesc('id')
            ->paginate(20);

        return view('livewire.admin.todas-index', [
            'tesones' => $tesones,
        ]);
    }
}
