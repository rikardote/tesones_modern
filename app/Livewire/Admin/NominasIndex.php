<?php

namespace App\Livewire\Admin;

use App\Models\Nomina;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class NominasIndex extends Component
{
    use WithPagination;

    protected \$paginationTheme = 'tailwind';
    // Modal state
    public bool $showModal = false;
    public bool $isEditing = false;
    public ?int $editId = null;

    // Form fields
    public string $nominaNombre = '';
    public string $fechaEmision = '';

    // Delete confirm
    public ?int $deleteId = null;

    // Flash inline
    public string $flashMessage = '';
    public string $flashLevel = '';

    protected function rules(): array
    {
        return [
            'nominaNombre' => ['required', 'string', 'max:255'],
            'fechaEmision' => ['required', 'date'],
        ];
    }

    protected function messages(): array
    {
        return [
            'nominaNombre.required' => 'El nombre de la nómina es obligatorio.',
            'fechaEmision.required' => 'La fecha de emisión es obligatoria.',
            'fechaEmision.date'     => 'La fecha no es válida.',
        ];
    }

    public function openCreate(): void
    {
        $this->resetErrorBag();
        $this->nominaNombre = '';
        $this->fechaEmision = '';
        $this->editId       = null;
        $this->isEditing    = false;
        $this->showModal    = true;
    }

    public function openEdit(int $id): void
    {
        $this->resetErrorBag();
        $nomina = Nomina::findOrFail($id);
        $this->editId        = $id;
        $this->nominaNombre  = $nomina->nomina;
        $this->fechaEmision  = $nomina->fecha_emision?->format('Y-m-d') ?? '';
        $this->isEditing     = true;
        $this->showModal     = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetErrorBag();
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'nomina'        => $this->nominaNombre,
            'fecha_emision' => $this->fechaEmision,
        ];

        if ($this->isEditing && $this->editId) {
            Nomina::findOrFail($this->editId)->update($data);
            $this->flash('Nómina actualizada exitosamente', 'info');
        } else {
            Nomina::create($data);
            $this->flash('Nómina creada exitosamente', 'info');
        }

        $this->showModal    = false;
        $this->nominaNombre = '';
        $this->fechaEmision = '';
        $this->editId       = null;
        $this->isEditing    = false;
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

        try {
            $nomina = Nomina::findOrFail($this->deleteId);
            $nombre = $nomina->nomina;
            $nomina->delete();
            $this->flash("Nómina \"{$nombre}\" eliminada", 'danger');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                $this->flash('No se puede eliminar: tiene Tesones asociados.', 'warning');
            } else {
                $this->flash('Error al eliminar la nómina.', 'warning');
            }
        }

        $this->deleteId = null;
    }

    private function flash(string $message, string $level = 'info'): void
    {
        $this->flashMessage = $message;
        $this->flashLevel   = $level;
    }

    public function render()
    {
        return view('livewire.admin.nominas-index', [
            'nominas' => Nomina::orderByDesc('fecha_emision')->paginate(15),
        ]);
    }
}
