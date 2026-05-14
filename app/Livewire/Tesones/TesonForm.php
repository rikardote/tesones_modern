<?php

namespace App\Livewire\Tesones;

use App\Enums\FormaPago;
use App\Enums\TipoPersonal;
use App\Models\Nomina;
use App\Models\Teson;
use Carbon\Carbon;
use Livewire\Component;

class TesonForm extends Component
{
    public ?Teson $teson = null;
    public bool $isEdit = false;

    public string $nomina_id = '';
    public string $tipo_personal = '';
    public string $remision_nomina = '';
    public string $folio_inicial = '';
    public string $folio_final = '';
    public string $observaciones = '';

    // Workplace fields
    public string $workplace_id = '';
    public string $adscripcion_snapshot = '';
    public string $unidad_snapshot = '';
    public string $lugar_snapshot = '';
    public string $titular_area_snapshot = '';
    public string $pagador_habilitado_snapshot = '';

    protected function rules(): array
    {
        $rules = [
            'nomina_id'       => ['required', 'exists:nominas,id'],
            'tipo_personal'   => ['required', 'integer', 'in:' . implode(',', array_keys(TipoPersonal::selectOptions()))],
            'remision_nomina' => ['required', 'integer', 'in:' . implode(',', array_keys(FormaPago::selectOptions()))],
            'observaciones'   => ['nullable', 'string', 'max:500'],
            'workplace_id'    => ['required', 'exists:workplaces,id'],
            'titular_area_snapshot'      => ['nullable', 'string', 'max:255'],
            'pagador_habilitado_snapshot' => ['nullable', 'string', 'max:255'],
        ];

        $formaPago = (string) $this->remision_nomina;

        // 1 = DÉBITO BBVA, 7 = DÉBITO SPEI
        if (in_array($formaPago, ['1', '7'])) {
            $rules['folio_inicial'] = ['required', 'numeric', 'digits:7'];
            $rules['folio_final']   = ['required', 'numeric', 'digits:7', 'gte:folio_inicial'];
        } 
        // 2 = CHEQUES, 4 = PENSIÓN ALIMENTICIA
        elseif (in_array($formaPago, ['2', '4'])) {
            $rules['folio_inicial'] = ['required', 'integer', 'min:1000'];
            $rules['folio_final']   = ['required', 'integer', 'min:1000', 'gte:folio_inicial'];
        }
        // 3 = VALES, 5 = FONAC DIE, 6 = FONAC DÉBITO (Opcionales)
        else {
            $rules['folio_inicial'] = ['nullable', 'integer', 'min:1', 'required_with:folio_final'];
            $rules['folio_final']   = ['nullable', 'integer', 'min:1', 'required_with:folio_inicial', 'gte:folio_inicial'];
        }

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'nomina_id.required'          => 'Debes seleccionar una nómina.',
            'tipo_personal.required'      => 'Selecciona el tipo de personal.',
            'remision_nomina.required'    => 'Selecciona la forma de pago.',
            'folio_inicial.required'      => 'El folio inicial es obligatorio para esta forma de pago.',
            'folio_inicial.digits'        => 'El folio inicial debe tener exactamente 7 dígitos.',
            'folio_inicial.min'           => 'El folio inicial debe tener al menos 4 dígitos.',
            'folio_inicial.required_with' => 'Si ingresas folio final, el folio inicial es obligatorio.',
            'folio_final.required'        => 'El folio final es obligatorio para esta forma de pago.',
            'folio_final.digits'          => 'El folio final debe tener exactamente 7 dígitos.',
            'folio_final.min'             => 'El folio final debe tener al menos 4 dígitos.',
            'folio_final.required_with'   => 'Si ingresas folio inicial, el folio final es obligatorio.',
            'folio_final.gte'             => 'El folio final no puede ser menor al folio inicial.',
        ];
    }

    public function mount(?int $id = null): void
    {
        if ($id) {
            $this->teson = Teson::findOrFail($id);
            $this->isEdit = true;
            $this->nomina_id       = (string) $this->teson->nomina_id;
            $this->tipo_personal   = (string) $this->teson->tipo_personal;
            $this->remision_nomina = (string) $this->teson->remision_nomina;
            $this->folio_inicial   = (string) ($this->teson->folio_inicial ?? '');
            $this->folio_final     = (string) ($this->teson->folio_final ?? '');
            $this->observaciones   = (string) ($this->teson->observaciones ?? '');
            
            $this->workplace_id                = (string) ($this->teson->workplace_id ?? '');
            $this->adscripcion_snapshot        = (string) ($this->teson->adscripcion_snapshot ?? '');
            $this->unidad_snapshot             = (string) ($this->teson->unidad_snapshot ?? '');
            $this->lugar_snapshot              = (string) ($this->teson->lugar_snapshot ?? '');
            $this->titular_area_snapshot       = (string) ($this->teson->titular_area_snapshot ?? '');
            $this->pagador_habilitado_snapshot = (string) ($this->teson->pagador_habilitado_snapshot ?? '');
        } else {
            $this->teson = new Teson();
            
            // Auto-select if only one workplace
            $assignedWorkplaces = auth()->user()->workplaces;
            if ($assignedWorkplaces->count() === 1) {
                $this->selectWorkplace($assignedWorkplaces->first()->id);
            }
        }
    }

    public function updated($propertyName): void
    {
        // Si cambia la forma de pago, revalidar folios si ya tienen contenido
        if ($propertyName === 'remision_nomina') {
            if ($this->folio_inicial || $this->folio_final) {
                $this->validateOnly('folio_inicial');
                $this->validateOnly('folio_final');
            }
            return;
        }

        // Validar el campo específico que cambió
        $this->validateOnly($propertyName);

        if ($propertyName === 'workplace_id') {
            $this->selectWorkplace($this->workplace_id);
        }
    }

    public function selectWorkplace($id)
    {
        if (!$id) return;
        
        $workplace = \App\Models\Workplace::find($id);
        if ($workplace) {
            $this->workplace_id = (string) $workplace->id;
            $this->adscripcion_snapshot = $workplace->adscripcion;
            $this->unidad_snapshot = $workplace->unidad;
            $this->lugar_snapshot = $workplace->lugar;
            $this->titular_area_snapshot = $workplace->titular_area;
            $this->pagador_habilitado_snapshot = $workplace->pagador_habilitado;
        }
    }

    public function save(): void
    {
        $data = $this->validate();

        if ($this->isEdit) {
            $this->teson->update(array_merge($data, [
                'adscripcion_snapshot' => $this->adscripcion_snapshot,
                'unidad_snapshot' => $this->unidad_snapshot,
                'lugar_snapshot' => $this->lugar_snapshot,
            ]));
            session()->flash('flash_message', 'Tesón modificado exitosamente');
            session()->flash('flash_level', 'info');
            $this->redirectRoute('tesones.show', $this->teson->id);
        } else {
            $teson = new Teson(array_merge($data, [
                'adscripcion_snapshot' => $this->adscripcion_snapshot,
                'unidad_snapshot' => $this->unidad_snapshot,
                'lugar_snapshot' => $this->lugar_snapshot,
            ]));
            $teson->user_id = auth()->id();
            $teson->fecha_elaboracion = Carbon::today();
            $teson->save();

            session()->flash('flash_message', 'Tesón generado exitosamente');
            session()->flash('flash_level', 'info');
            $this->redirectRoute('tesones.show', $teson->id);
        }
    }

    public function render()
    {
        return view('livewire.tesones.teson-form', [
            'nominas'      => Nomina::all()->sortByDesc('fecha_emision')->pluck('Fullnomina', 'id')->toArray(),
            'tiposPersonal'=> TipoPersonal::selectOptions(),
            'formasPago'   => FormaPago::selectOptions(),
            'workplaces'   => auth()->user()->workplaces,
        ]);
    }
}
