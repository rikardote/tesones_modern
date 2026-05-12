<?php

namespace App\Livewire\Tesones;

use App\Enums\ClaveCancelacion;
use App\Enums\FormaPago;
use App\Models\Teson;
use App\Models\Cancelacion;
use Livewire\Component;

class CancelacionManager extends Component
{
    public Teson $teson;
    
    // Form fields
    public $num_empleado = '';
    public $nombre = '';
    public $numero_cheque = '';
    public $importe = '';
    public $clave = '';
    
    public $editingId = null;
    public $flashMessage = '';

    protected function rules()
    {
        $rules = [
            'num_empleado' => 'required|numeric',
            'nombre' => 'required|string|max:255',
            'importe' => 'required|numeric|min:0.01',
            'clave' => 'required|in:' . implode(',', array_keys(ClaveCancelacion::selectOptions())),
        ];

        // Conditional validation for numero_cheque based on Teson payment type
        $rangeRule = "between:{$this->teson->folio_inicial},{$this->teson->folio_final}";

        if ($this->teson->forma_pago == FormaPago::DEBITO_BBVA->value || $this->teson->forma_pago == FormaPago::DEBITO_SPEI->value) {
            $rules['numero_cheque'] = ['required', 'digits:7', $rangeRule];
        } elseif ($this->teson->forma_pago == FormaPago::CHEQUES->value || $this->teson->forma_pago == FormaPago::PENSION_ALIMENTICIA->value) {
            $rules['numero_cheque'] = ['required', 'numeric', 'min:1000', $rangeRule];
        } else {
            $rules['numero_cheque'] = ['required', 'numeric', $rangeRule];
        }

        return $rules;
    }

    protected function validationAttributes()
    {
        return [
            'numero_cheque' => 'folio / número de cheque',
        ];
    }

    protected function messages()
    {
        return [
            'numero_cheque.between' => 'El folio debe estar dentro del rango capturado para este tesón (:min - :max).',
        ];
    }

    public function mount(Teson $teson)
    {
        $this->teson = $teson;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'num_empleado' => $this->num_empleado,
            'nombre' => mb_strtoupper($this->nombre, 'UTF-8'),
            'numero_cheque' => $this->numero_cheque,
            'importe' => $this->importe,
            'clave' => $this->clave,
        ];

        if ($this->editingId) {
            $cancelacion = Cancelacion::findOrFail($this->editingId);
            $cancelacion->update($data);
            $this->flashMessage = 'Cancelación actualizada correctamente.';
        } else {
            $this->teson->cancelaciones()->create($data);
            $this->flashMessage = 'Cancelación agregada correctamente.';
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $cancelacion = Cancelacion::findOrFail($id);
        $this->editingId = $id;
        $this->num_empleado = $cancelacion->num_empleado;
        $this->nombre = $cancelacion->nombre;
        $this->numero_cheque = $cancelacion->numero_cheque;
        $this->importe = $cancelacion->importe;
        $this->clave = $cancelacion->clave;
        
        $this->flashMessage = '';
    }

    public function delete($id)
    {
        Cancelacion::findOrFail($id)->delete();
        $this->flashMessage = 'Cancelación eliminada.';
        
        if ($this->editingId == $id) {
            $this->resetForm();
        }
    }

    public function resetForm()
    {
        $this->reset(['num_empleado', 'nombre', 'numero_cheque', 'importe', 'clave', 'editingId']);
        $this->resetValidation();
    }

    public function updatedNombre($value)
    {
        $this->nombre = mb_strtoupper($value, 'UTF-8');
    }

    public function render()
    {
        return view('livewire.tesones.cancelacion-manager', [
            'cancelaciones' => $this->teson->cancelaciones()->latest()->get(),
            'claves' => ClaveCancelacion::selectOptions(),
        ]);
    }
}
