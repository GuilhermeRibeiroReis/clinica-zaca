@extends('layouts.main')

@section('title', 'Realizar Consulta')

@section('content')

    <h1>Realizar Consulta - {{ $consulta->numero_consulta }}</h1>

    <form action="{{ route('consulta.realizar.post', $consulta) }}" method="POST">

        @csrf

        <!-- Campo de Observações -->
        <div class="form-group">
            <label for="observacoes">Observações</label>
            <textarea id="observacoes" name="observacoes" class="form-control" required>{{ old('observacoes') }}</textarea>
        </div>

        <!-- Seção de Medicamentos -->
        <div id="medicamentos">
            <div class="form-group">
                <label for="farmacos">Farmácios</label>
                <select name="farmacos[]" class="form-control">
                    @foreach ($farmacos as $farmaco)
                        <option value="{{ $farmaco->idFarmaco }}">{{ $farmaco->nomeFarmaco }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" id="addFarmaco">Adicionar Medicamento</button>

        <button type="submit" class="btn btn-primary">Salvar Consulta</button>
    </form>

    <script>
        document.getElementById('addFarmaco').addEventListener('click', function() {
            var medicamentoDiv = document.createElement('div');
                medicamentoDiv.classList.add('form-group');
                medicamentoDiv.innerHTML = `
                <label for="farmacos">Farmácios</label>
                    <select name="farmacos[]" class="form-control">
                        @foreach ($farmacos as $farmaco)
                            <option value="{{ $farmaco->idFarmaco }}">{{ $farmaco->nomeFarmaco }}</option>
                        @endforeach
                    </select>
            `;
            document.getElementById('medicamentos').appendChild(medicamentoDiv);
        });
    </script>
@endsection