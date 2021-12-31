<div class="modal fade" id="modal_user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Изменить данные пользователя</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card-body">
            <form id="user_form">
              <div class="form-group">
                <label for="name_user">Имя</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" id="name_user">
                </div>
              </div>
              <div class="form-group">
                <label for="email_user">Логин (email)</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                  </div>
                  <input type="text" class="form-control" id="email_user">
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id="edit_user_btn">Обновить</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


@push('scripts_after')
<script>

$('.update_user_btn').click(function(){
  $('#name_user').val('{{ $account -> name }}');
  $('#email_user').val('{{ $account -> login }}');
});

// Update_user
$('#edit_user_btn').click(function(){
  let $form = $('#user_form');
  let $button = $(this);
  let $el_name_user = $('#name_user');
  let $el_email_user = $('#email_user');
  let $modal = $('#modal_user');
  let $url = "/index.php/user-edit";
  let $id = '{{ $account->id }}'

  let $name_user = $el_name_user.val()
  let $email_user = $el_email_user.val().replaceAll(' ','');

  if (!$button.hasClass('disabled')){
     $button.addClass('disabled');
     $.ajax({
       url: $url,
       type: "POST",
       data: {
         "_token": "{{ csrf_token() }}",
         id: $id,
         name_user: $name_user,
         email_user: $email_user,
       },
       success:function(response){
         toastr.success(response.success);
         $modal.modal('toggle');
         $form[0].reset();
         $button.removeClass('disabled');
         $('#box_user_name').html($name_user);
         $('#box_user_email').html($email_user);
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
