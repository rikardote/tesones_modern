<?php

namespace App\Livewire\Tesones;

use App\Enums\ClaveCancelacion;
use App\Models\Cancelacion;
use App\Models\Teson;
use Livewire\Component;
use Livewire\Attributes\On;

class TesonShow extends Component
{
    public Teson $teson;

    // Cancelacion form
    public string $num_empleado = '';
    public string $nombre = '';
    public string $numero_cheque = '';
    public string $importe = '';
    public string $clave = '';

    // Edit cancelacion modal
    public bool $showEditModal = false;
    public ?int $editingId = null;
    public string $edit_num_empleado = '';
    public string $edit_nombre = '';
    public string $edit_numero_cheque = '';
    public string $edit_importe = '';
    public string $edit_clave = '';

    // Delete confirm
    public ?int $deleteId = null;
    public string $deleteTarget = ''; // 'teson' or 'cancelacion'

    protected function rules(): array
    {
        return [
            'num_empleado'  => ['required', 'integer'],
            'nombre'        => ['required', 'string', 'max:255'],
            'numero_cheque' => ['required', 'integer', 'min:1000'],
            'importe'       => ['required', 'numeric', 'min:0'],
            'clave'         => ['required', 'integer', 'in:50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,80,81'],
        ];
    }

    protected function editRules(): array
    {
        return [
            'edit_num_empleado'  => ['required', 'integer'],
            'edit_nombre'        => ['required', 'string', 'max:255'],
            'edit_numero_cheque' => ['required', 'integer', 'min:1000'],
            'edit_importe'       => ['required', 'numeric', 'min:0'],
            'edit_clave'         => ['required', 'integer', 'in:50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,80,81'],
        ];
    }

    public function mount(int $id): void
    {
        $this->teson = Teson::with(['nomina', 'user', 'cancelaciones'])->findOrFail($id);
    }

    public function addCancelacion(): void
    {
        $this->validate($this->rules());

        $cancelacion = new Cancelacion([
            'num_empleado'  => $this->num_empleado,
            'nombre'        => $this->nombre,
            'numero_cheque' => $this->numero_cheque,
            'importe'       => $this->importe,
            'clave'         => $this->clave,
        ]);
        $cancelacion->teson_id = $this->teson->id;
        $cancelacion->save();

        $this->reset(['num_empleado', 'nombre', 'numero_cheque', 'importe', 'clave']);
        $this->teson->load('cancelaciones');

        session()->flash('flash_message', 'Cancelación agregada exitosamente');
        session()->flash('flash_level', 'info');
    }

    public function openEditCancelacion(int $id): void
    {
        $cancelacion = Cancelacion::findOrFail($id);
        $this->editingId = $id;
        $this->edit_num_empleado  = $cancelacion->num_empleado;
        $this->edit_nombre        = $cancelacion->nombre;
        $this->edit_numero_cheque = $cancelacion->numero_cheque;
        $this->edit_importe       = $cancelacion->importe;
        $this->edit_clave         = $cancelacion->clave;
        $this->showEditModal = true;
    }

    public function updateCancelacion(): void
    {
        $this->validate($this->editRules());

        $cancelacion = Cancelacion::findOrFail($this->editingId);
        $cancelacion->update([
            'num_empleado'  => $this->edit_num_empleado,
            'nombre'        => $this->edit_nombre,
            'numero_cheque' => $this->edit_numero_cheque,
            'importe'       => $this->edit_importe,
            'clave'         => $this->edit_clave,
        ]);

        $this->showEditModal = false;
        $this->editingId = null;
        $this->teson->load('cancelaciones');

        session()->flash('flash_message', 'Cancelación actualizada exitosamente');
        session()->flash('flash_level', 'info');
    }

    public function closeEditModal(): void
    {
        $this->showEditModal = false;
        $this->editingId = null;
    }

    public function confirmDeleteCancelacion(int $id): void
    {
        $this->deleteId = $id;
        $this->deleteTarget = 'cancelacion';
    }

    public function confirmDeleteTeson(): void
    {
        $this->deleteTarget = 'teson';
        $this->deleteId = $this->teson->id;
    }

    public function cancelDelete(): void
    {
        $this->deleteId = null;
        $this->deleteTarget = '';
    }

    public function deleteConfirmed()
    {
        if ($this->deleteTarget === 'cancelacion' && $this->deleteId) {
            $cancelacion = Cancelacion::findOrFail($this->deleteId);
            $cancelacion->delete();
            $this->teson->load('cancelaciones');
            session()->flash('flash_message', 'Cancelación eliminada');
            session()->flash('flash_level', 'danger');
        }

        if ($this->deleteTarget === 'teson' && $this->deleteId) {
            $this->teson->cancelaciones()->delete();
            $this->teson->delete();
            session()->flash('flash_message', 'Tesón eliminado exitosamente');
            session()->flash('flash_level', 'danger');
            $this->redirectRoute('tesones.index');
            return;
        }

        $this->deleteId = null;
        $this->deleteTarget = '';
    }

    public function render()
    {
        $this->teson->loadMissing(['nomina', 'user', 'cancelaciones']);

        return view('livewire.tesones.teson-show', [
            'cancelaciones' => $this->teson->cancelaciones,
            'claves'        => ClaveCancelacion::selectOptions(),
        ]);
    }
}
