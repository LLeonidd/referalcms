<div class="modal fade" id="modal_phone_edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Обновить телефон</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card-body">
            <form id="phone_edit_form">
              <div class="form-group">
                <label for="phone_edit_number">Номер телефона</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="text" class="form-control" data-inputmask='"mask": "+7(999) 999-9999"' data-mask="" id="phone_edit_number">
                </div>
              </div>
              <div class="form_group">
                <label for="phone_edit_message">Сообщение в Whatsapp</label>
                <input type="text" class="form-control" id="phone_edit_message" placeholder="Введите сообщение для whatsapp">
              </div>
            </form>
          </div>
          <!-- /.card-body -->
      </div>

      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" id="delete_phone_btn">Удалить</button>
        <button type="button" class="btn btn-primary " id="edit_phone_btn">Обвновить</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



@push('scripts_after')
<script>
// Input phone mask
$("#phone_edit_number").inputmask();


// Init form_
$('.phone_edit_btn').click(function(){
  $id = $(this).data('id');
  $phone_number = $(this).parents('tr').find('.phone_number_value').html();
  $phone_message = $(this).parents('tr').find('.phone_message_value').html();
  $el_phone_edit_number = $('#phone_edit_number');
  $el_phone_edit_message = $('#phone_edit_message');
  $el_phone_edit_number.val($phone_number);
  $el_phone_edit_message.val($phone_message);
  $el_phone_edit_number.removeClass('is-invalid');
  $el_phone_edit_message.removeClass('is-invalid');
  $('#edit_phone_btn').data('id', $id);
});


$('#delete_phone_btn').click(function(){
  let $button = $(this);
  let $form = $('#phone_edit_form');
  let $modal = $('#modal_phone_edit');
  let $id = $('#edit_phone_btn').data('id');
  let $url = "/index.php/phone-delete";
  $.ajax({
      url: $url,
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        id:$id,
      },
      success:function(response){
        toastr.success(response.success);
        $modal.modal('toggle');
        $form[0].reset();
        $button.removeClass('disabled');
        $('a[data-id*=\"'+$id+'\"]').parents('tr').remove();
      },
      error: function (err) {
        console.log(err.responseJSON);
         $button.removeClass('disabled');
         if (err.status == 422) { // when status code is 422, it's a validation issue
             console.log(err.responseJSON);
             $.each(err.responseJSON.errors, function (i, error) {
                  toastr.error(error[0]);
                  $('#'+i).addClass('is-invalid');
             });
         }
     }
  })
});

// Send  in DB
$('#edit_phone_btn').click(function(){
  let $modal = $('#modal_phone_edit');
  let $form = $('#phone_edit_form');
  let $button = $(this);
  let $el_phone_number = $('#phone_edit_number');
  let $el_phone_message = $('#phone_edit_message');
  let $url = "/index.php/phone-edit";
  let $number = $el_phone_number.val()!='' ? '+'+Inputmask.unmask($el_phone_number.val(), { mask: "9(999) 999-9999" }):'';
  let $message = $el_phone_message.val();
  let $id = $button.data('id');

  if (!$button.hasClass('disabled')){
     $button.addClass('disabled');
     $.ajax({
       url: $url,
       type:"POST",
       data:{
         "_token": "{{ csrf_token() }}",
         id:$id,
         phone_edit_number:$number,
         phone__edit_message:$message,
       },
       success:function(response){
         toastr.success(response.success);
         $modal.modal('toggle');
         $form[0].reset();
         $button.removeClass('disabled');
       },
       error: function (err) {
         console.log(err.responseJSON);
          $button.removeClass('disabled');
          if (err.status == 422) { // when status code is 422, it's a validation issue
              console.log(err.responseJSON);
              $.each(err.responseJSON.errors, function (i, error) {
                   toastr.error(error[0]);
                   $('#'+i).addClass('is-invalid');
              });
          }
      }
   })
  }
})
</script>
@endpush
