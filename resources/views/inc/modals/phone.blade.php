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
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary _btn_modal_action" id="add_phone_btn" data-type="">Добавить</button>
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
$("#phone_number").inputmask();


// Add phone in DB
$('#add_phone_btn').click(function(){
  let $form = $('#phone_form');
  let $button = $(this);
  let $el_phone_number = $('#phone_number');
  let $el_phone_message = $('#phone_message');
  let $modal = $('#modal_phone');

  let $url = "/index.php/phone-add";

  let $number = $el_phone_number.val()!='' ? '+'+Inputmask.unmask($el_phone_number.val(), { mask: "9(999) 999-9999" }):'';
  let $message = $el_phone_message.val();

  if (!$button.hasClass('disabled')){
     $button.addClass('disabled');
     $.ajax({
       url: $url,
       type:"POST",
       data:{
         "_token": "{{ csrf_token() }}",
         phone_number:$number,
         phone_message:$message,
       },
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
})
</script>
@endpush
