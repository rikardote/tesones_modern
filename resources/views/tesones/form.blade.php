<div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="folioValidator">
    {{-- Nómina --}}
    <div class="md:col-span-2">
        <label for="nomina_id" class="form-label">Nómina</label>
        <select name="nomina_id" id="nomina_id" class="form-select" size="6" required>
            <option value="">Selecciona una nómina...</option>
            @foreach($nominas as $id => $nomina)
                <option value="{{ $id }}" {{ old('nomina_id', $teson->nomina_id ?? '') == $id ? 'selected' : '' }}>
                    {{ $nomina }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Tipo de personal --}}
    <div>
        <label for="tipo_personal" class="form-label">Tipo de personal</label>
        <select name="tipo_personal" id="tipo_personal" class="form-select" required>
            <option value="">Selecciona tipo de personal...</option>
            @foreach($tiposPersonal as $value => $label)
                <option value="{{ $value }}" {{ old('tipo_personal', $teson->tipo_personal ?? '') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Forma de pago --}}
    <div>
        <label for="remision_nomina" class="form-label">Forma de pago</label>
        <select name="remision_nomina" id="remision_nomina" class="form-select"
                x-model="tipoPago" required>
            <option value="">Selecciona...</option>
            @foreach($formasPago as $value => $label)
                <option value="{{ $value }}" {{ old('remision_nomina', $teson->remision_nomina ?? '') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Folio Inicial --}}
    <div>
        <label for="folio_inicial" class="form-label">Folio Inicial</label>
        <input type="number" name="folio_inicial" id="folio_inicial"
               class="form-input" min="1" placeholder="0"
               x-model.number="folio1"
               value="{{ old('folio_inicial', $teson->folio_inicial ?? '') }}" required>
    </div>

    {{-- Folio Final --}}
    <div>
        <label for="folio_final" class="form-label">Folio Final</label>
        <input type="number" name="folio_final" id="folio_final"
               class="form-input" min="1" placeholder="0"
               x-model.number="folio2"
               value="{{ old('folio_final', $teson->folio_final ?? '') }}" required>
    </div>

    {{-- Mensaje de validación --}}
    <div class="md:col-span-2">
        <span x-show="mensaje" x-text="mensaje"
              :class="mensaje.includes('✅') ? 'badge badge-success px-3 py-1.5 text-sm' : 'badge badge-danger px-3 py-1.5 text-sm'">
        </span>
    </div>

    {{-- Observaciones --}}
    <div class="md:col-span-2">
        <label for="observaciones" class="form-label">Observaciones</label>
        <input type="text" name="observaciones" id="observaciones"
               class="form-input" placeholder="Observaciones (opcional)"
               value="{{ old('observaciones', $teson->observaciones ?? '') }}">
    </div>

    {{-- Botón --}}
    <div class="md:col-span-2">
        <button type="submit" id="boton" class="btn btn-success w-full"
                x-bind:disabled="!valido">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
            {{ isset($teson) && $teson->id ? 'Guardar Cambios' : 'Generar Tesón' }}
        </button>
    </div>
</div>

@push('js')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('folioValidator', () => ({
        tipoPago: '{{ old("remision_nomina", $teson->remision_nomina ?? "") }}',
        folio1: {{ old('folio_inicial', $teson->folio_inicial ?? 0) }},
        folio2: {{ old('folio_final', $teson->folio_final ?? 0) }},
        get valido() {
            if (!this.tipoPago) return false;
            if (this.folio2 && this.folio1 && this.folio2 < this.folio1) return false;
            if (['1','7'].includes(this.tipoPago)) {
                return String(this.folio1).length === 7 && String(this.folio2).length === 7;
            }
            if (['2','4'].includes(this.tipoPago)) {
                return String(this.folio1).length === 6 && String(this.folio2).length === 6;
            }
            return true;
        },
        get mensaje() {
            if (!this.tipoPago) return '';
            if (this.folio2 && this.folio1 && this.folio2 < this.folio1)
                return '⚠️ EL FOLIO FINAL NO PUEDE SER MENOR AL FOLIO INICIAL';
            if (['1','7'].includes(this.tipoPago) && (String(this.folio1).length !== 7 || String(this.folio2).length !== 7))
                return 'DÉBITO BBVA / SPEI deben tener 7 dígitos';
            if (['2','4'].includes(this.tipoPago) && (String(this.folio1).length !== 6 || String(this.folio2).length !== 6))
                return 'CHEQUES / PENSIÓN deben tener 6 dígitos';
            return '✅ Folios válidos';
        }
    }));
});
</script>
@endpush
