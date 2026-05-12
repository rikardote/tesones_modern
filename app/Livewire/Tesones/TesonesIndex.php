<?php

namespace App\Livewire\Tesones;

use App\Models\Teson;
use Livewire\Component;
use Livewire\WithPagination;

class TesonesIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortField = 'fecha_elaboracion';
    public string $sortDir = 'desc';

    // Confirm delete
    public ?int $deleteId = null;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

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

        $teson = Teson::where('user_id', auth()->id())->findOrFail($this->deleteId);
        $teson->cancelaciones()->delete();
        $teson->delete();

        session()->flash('flash_message', 'El tesón se ha eliminado exitosamente');
        session()->flash('flash_level', 'danger');

        $this->deleteId = null;
    }

    public function render()
    {
        $user = auth()->user();

        $tesones = Teson::where('user_id', $user->id)
            ->with('nomina')
            ->withCount('cancelaciones')
            ->when($this->search, function ($q) {
                $q->whereHas('nomina', fn($n) => $n->where('nomina', 'like', '%' . $this->search . '%'));
            })
            ->orderBy($this->sortField, $this->sortDir)
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('livewire.tesones.tesones-index', [
            'tesones' => $tesones,
            'user' => $user,
        ]);
    }
}
