@extends('admin.layouts.app')

@section('content')
    <div class="w3-card-1">
        <div class="w3-container w3-blue">
            <h2>Importação de Arquivos</h2>
        </div>
        <div class="w3-container">
            <p>
                <label class="w3-text-blue" for="dataSet1">Importar arquivo .CSV</label>
                <input type="file" class="w3-input w3-border" accept=".csv" id="dataSet1" required>
                <span hidden id="error_dataSet1">Campo de preenchimento obrigatório.</span>
            </p>
            <p>
                <label class="w3-text-blue" for="dataSet2">Importar arquivo .CSV</label>
                <input type="file" class="w3-input w3-border" accept=".csv" id="dataSet2" required>
                <span hidden id="error_dataSet2">Campo de preenchimento obrigatório.</span>
            </p>
            <p>
                <button class="w3-btn w3-blue-grey" onclick="submit();">Enviar</button>
            </p>
        </div>
    </div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function submit() {
        if(document.getElementById('dataSet1').value == ''){
            document.getElementById("error_dataSet1").style.color = "red";
            document.getElementById("error_dataSet1").removeAttribute("hidden");
        }
        else{
            document.getElementById("error_dataSet1").hidden = true;
        }
        if(document.getElementById('dataSet2').value == ''){
            document.getElementById("error_dataSet2").style.color = "red";
            document.getElementById("error_dataSet2").removeAttribute("hidden");
        }
        else{
            document.getElementById("error_dataSet2").hidden = true;
        }

        if(document.getElementById('dataSet1').value && document.getElementById('dataSet2').value){
            axios.post('/api/import', {
                dataSet1: document.getElementById('dataSet1').files[0],
                dataSet2: document.getElementById('dataSet2').files[0]
            })
            .then(function (res) {
                console.log(res);
            })
        }
    }
</script>
@stop
