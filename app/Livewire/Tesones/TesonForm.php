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

    protected function rules(): array
    {
        $rules = [
            'nomina_id'       => ['required', 'exists:nominas,id'],
            'tipo_personal'   => ['required', 'integer', 'in:' . implode(',', array_keys(TipoPersonal::selectOptions()))],
            'remision_nomina' => ['required', 'integer', 'in:' . implode(',', array_keys(FormaPago::selectOptions()))],
            'observaciones'   => ['nullable', 'string', 'max:500'],
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
        } else {
            $this->teson = new Teson();
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
    }

    public function save(): void
    {
        $data = $this->validate();

        if ($this->isEdit) {
            $this->teson->update($data);
            session()->flash('flash_message', 'Tesón modificado exitosamente');
            session()->flash('flash_level', 'info');
            $this->redirectRoute('tesones.show', $this->teson->id);
        } else {
            $teson = new Teson($data);
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
        ]);
    }
}
