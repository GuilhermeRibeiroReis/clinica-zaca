<div>
    <form wire:submit.prevent="submitForm">
        <div>
            <label for="especialidade">Especialidade</label>
            <select wire:model="especialidadeId" id="especialidade" name="idEspecialidade">
                <option value="">Selecione a Especialidade</option>
                @foreach($especialidades as $especialidade)
                    <option value="{{ $especialidade->idEspecialidade }}">{{ $especialidade->descricao }}</option>
                @endforeach
            </select>
        </div>

        @if($especialidadeId)
            <div>
                <label for="medico">Médico</label>
                <select wire:model="medicoId" id="medico" name="idMedico">
                    <option value="">Selecione o Médico</option>
                    @foreach($medicos as $medico)
                        <option value="{{ $medico->idMedico }}">{{ $medico->nomeMedico }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div>
            <label for="numero_consulta">Número da Consulta</label>
            <input type="number" wire:model="numeroConsulta" id="numero_consulta" name="numero_consulta">
        </div>

        <div>
            <label for="data_consulta">Data da Consulta</label>
            <input type="date" wire:model="dataConsulta" id="data_consulta" name="data_consulta">
        </div>

        <button type="submit">Registrar Consulta</button>
    </form>
</div>
