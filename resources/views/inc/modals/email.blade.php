<div class="modal fade" id="modal_email">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Добавить Email</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card-body">
            <form id="email_form">
              <div class="form-group">
                <label for="email_address">Email адрес</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                  </div>
                  <input type="text" class="form-control" id="email_address">
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id="add_email_btn">Добавить</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


@push('scripts_after')
<script>
// Add phone in DB
$('#add_email_btn').click(function(){
  let $form = $('#email_form');
  let $button = $(this);
  let $el_email_address = $('#email_address');
  let $modal = $('#modal_email');
  let $url = "/index.php/email-add";

  let $email_address = $el_email_address.val().replaceAll(' ','');

  if (!$button.hasClass('disabled')){
     $button.addClass('disabled');
     $.ajax({
       url: $url,
       type:"POST",
       data:{
         "_token": "{{ csrf_token() }}",
         email_address:$email_address,
       },
       success:function(response){
         toastr.success(response.success);
         $modal.modal('toggle');
         $form[0].reset();
         $button.removeClass('disabled');
       },
       error: function (err) {
          $button.removeClass('disabled');
          console.log(err.responseJSON);
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
