<style>
	img#cimg{
		height: 17vh;
		width: 25vw;
		object-fit: scale-down;
	}
</style>
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar nueva cita</h4>
        </div>
            <form method="POST" action="{{ route('cliente.citas.new') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="schedule" class="control-label">Fecha y hora</label>
                            <input type="datetime-local" name="schedule" id="schedule" class="form-control form-control-border" placeholder="Ingresa el horario de la cita" value ="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="test_ids" class="control-label">Pruebas</label>
                            <select id="tags" name="test_ids[]" multiple="multiple"></select>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="prescription" class="control-label">Prescripción <small><em>(Si hay alguna)</em></small></label>
                            <input type="file" name="prescription" accept="application/msword, .doc, .docx, .txt, application/pdf" id="prescription" class="form-control form-control-border" >
                        </div>
                    </div>      
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
      </div>
    </div>
</div>
@section('scripts')

<script src="{{ asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $("#tags").select2({
            placeholder:'Buscar Prueba',
            allowClear:true,
            theme: "classic",
            ajax:{
                url:"{{ route('search.pruebas') }}",
                type: "post",
                $delay:250,
                dataType:'json',
                data: function(params) {
                    return{
                        name:params.term,
                        "_token":"{{ csrf_token() }}",
                    };
                },
                processResults:function(data){
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id,
                                text:item.name
                            }
                        })
                    };
                },
            },
        });
    });
</script>
@endsection