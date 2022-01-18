<div class="modal fade" id="modal_phone">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Добавить телефон</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card-body">
            <form id="phone_form">
              <div class="form-group">
                <label for="phone_number">Номер телефона</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="text" class="form-control" data-inputmask='"mask": "+7(999) 999-9999"' data-mask="" id="phone_number">
                </div>
              </div>
              <div class="form_group">
                <label for="phone_message">Сообщение в Whatsapp</label>
                <input type="text" class="form-control" id="phone_message" placeholder="Введите сообщение для whatsapp">
              </div>
            </form>
          </div>
          <!-- /.card-body -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default _button_modal" data-dismiss="modal" id="_phone_action_btn" data-action="close">Закрыть</button>
        <!-- <button type="button" class="btn btn-danger" id="delete_phone_btn">Удалить</button> -->
        <button type="button" class="btn btn-primary _btn_modal_action _button_modal" id="_phone_add_btn" data-action="add" data-type="">Добавить</button>
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


// Input phone mask
$("#phone_number").inputmask();

$('#modal_phone').on('show.bs.modal', function (event) {
  var $button = $(event.relatedTarget)
  var $action = $button.data('action')
  var $modal = $(this)
  var $input_phone_number = $modal.find('#phone_number');
  var $input_phone_message = $modal.find('#phone_message');
  if ($action == 'add'){
    $modal.find('.modal-title').text('Добавить телефон')
    $modal.find('#_phone_add_btn').text('Добавить')
    $modal.find('#_phone_action_btn').text('Закрыть')
    $modal.find('#_phone_action_btn').removeClass('btn-danger');
    $modal.find('#_phone_action_btn').addClass('btn-default');
    $modal.find('#_phone_action_btn').data('action', 'close');
    $modal.find('#_phone_add_btn').data('action', $action);
  } else if ($action == 'edit'){
    $modal.find('.modal-title').text('Обновить телефон')
    $modal.find('#_phone_add_btn').text('Обновить')
    $modal.find('#_phone_action_btn').text('Удалить')
    $modal.find('#_phone_action_btn').removeClass('btn-default');
    $modal.find('#_phone_action_btn').addClass('btn-danger');
    $modal.find('#_phone_action_btn').data('action', 'delete');
    $modal.find('#_phone_add_btn').data('action', $action);
    $modal.data('id', $button.data('id'));
    $phone_number = $button.parents('tr').find('.phone_number_value').html();
    $phone_message = $button.parents('tr').find('.phone_message_value').html();
    $input_phone_number.val($phone_number);
    $input_phone_message.val($phone_message);
    $input_phone_number.removeClass('is-invalid');
    $input_phone_number.removeClass('is-invalid');
  }
})


// Add phone in DB
$('#modal_phone ._button_modal').click(function(){
  let $button = $(this);
  let $action = $button.data('action')
  let $modal = $('#modal_phone');
  let $form = $('#phone_form');
  let $input_phone_number = $('#phone_number');
  let $input_phone_message = $('#phone_message');

  let $number = $input_phone_number.val()!='' ? '+'+Inputmask.unmask($input_phone_number.val(), { mask: "9(999) 999-9999" }):'';
  let $message = $input_phone_message.val();
  let $url = "/index.php/phone-"+$action;
  let $id = $modal.data('id')
  let $data = {
    "_token": "{{ csrf_token() }}",
    phone_number:$number,
    phone_message:$message,
    id:$id,
  }

  if (!$button.hasClass('disabled')){
     $button.addClass('disabled');
     send_data($url, $data, $form, $modal, $button)

  }
})
</script>
@endpush
