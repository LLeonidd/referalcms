<div class="modal fade" id="modal_address">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Добавить адресс</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card-body">
            <form id="address_form">
              <div class="form-group">
                <label for="address">Аддресс</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                  </div>
                  <input type="text" class="form-control" id="address">
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default _button_modal" data-dismiss="modal" id="_address_action_btn" data-action="close">Закрыть</button>
        <!-- <button type="button" class="btn btn-danger" id="delete_address_btn">Удалить</button> -->
        <button type="button" class="btn btn-primary _btn_modal_action _button_modal" id="_address_add_btn" data-action="add">Добавить</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



@push('scripts_after')
<script>
function send_data($url, $data, $form, $modal, $button){
  $.ajax({
    url: $url,
    type:"POST",
    data:$data,
    success:function(response){
      toastr.success(response.success);
      $modal.modal('toggle');
      $form[0].reset();
      $button.removeClass('disabled');
    },
    error: function (err) {
       $button.removeClass('disabled');
       if (err.status == 422) { // when status code is 422, it's a validation issue
           console.log(err.responseJSON);
           $.each(err.responseJSON.errors, function (i, error) {
                toastr.error(error[0]);
                $('#'+i).addClass('is-invalid');
           });
       } else {
         console.log(err.responseJSON);
       }
   }
  })
}

$('#modal_address').on('show.bs.modal', function (event) {
  var $button = $(event.relatedTarget)
  var $action = $button.data('action')
  var $modal = $(this)
  var $input_address = $modal.find('#address');
  if ($action == 'add'){
    $modal.find('.modal-title').text('Добавить адрес')
    $modal.find('#_address_add_btn').text('Добавить')
    $modal.find('#_address_action_btn').text('Закрыть')
    $modal.find('#_address_action_btn').removeClass('btn-danger');
    $modal.find('#_address_action_btn').addClass('btn-default');
    $modal.find('#_address_action_btn').data('action', 'close');
    $modal.find('#_address_add_btn').data('action', $action);
  } else if ($action == 'edit'){
    $modal.find('.modal-title').text('Обновить адрес')
    $modal.find('#_address_add_btn').text('Обновить')
    $modal.find('#_address_action_btn').text('Удалить')
    $modal.find('#_address_action_btn').removeClass('btn-default');
    $modal.find('#_address_action_btn').addClass('btn-danger');
    $modal.find('#_address_action_btn').data('action', 'delete');
    $modal.find('#_address_add_btn').data('action', $action);
    $modal.data('id', $button.data('id'));
    $address = $button.parents('tr').find('.address_value').html();
    $input_address.val($address);
    $input_address.removeClass('is-invalid');

  }
})


// Add address in DB
$('#modal_address ._button_modal').click(function(){
  let $button = $(this);
  let $action = $button.data('action')
  let $modal = $('#modal_address');
  let $form = $('#address_form');
  let $input_address = $('#address');

  let $address = $input_address.val();
  let $url = "/index.php/address-"+$action;
  let $id = $modal.data('id')
  let $data = {
    "_token": "{{ csrf_token() }}",
    address:$address,
    id:$id,
  }
  if (!$button.hasClass('disabled')){
     $button.addClass('disabled');
     send_data($url, $data, $form, $modal, $button)
  }
})
</script>
@endpush
