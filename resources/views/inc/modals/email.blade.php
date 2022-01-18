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
                <label for="email_number">Email</label>
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
        <button type="button" class="btn btn-default _button_modal" data-dismiss="modal" id="_email_action_btn" data-action="close">Закрыть</button>
        <!-- <button type="button" class="btn btn-danger" id="delete_email_btn">Удалить</button> -->
        <button type="button" class="btn btn-primary _btn_modal_action _button_modal" id="_email_add_btn" data-action="add">Добавить</button>
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

$('#modal_email').on('show.bs.modal', function (event) {
  var $button = $(event.relatedTarget)
  var $action = $button.data('action')
  var $modal = $(this)
  var $input_email = $modal.find('#email_address');
  if ($action == 'add'){
    $modal.find('.modal-title').text('Добавить Email')
    $modal.find('#_email_add_btn').text('Добавить')
    $modal.find('#_email_action_btn').text('Закрыть')
    $modal.find('#_email_action_btn').removeClass('btn-danger');
    $modal.find('#_email_action_btn').addClass('btn-default');
    $modal.find('#_email_action_btn').data('action', 'close');
    $modal.find('#_email_add_btn').data('action', $action);
  } else if ($action == 'edit'){
    $modal.find('.modal-title').text('Обновить Email')
    $modal.find('#_email_add_btn').text('Обновить')
    $modal.find('#_email_action_btn').text('Удалить')
    $modal.find('#_email_action_btn').removeClass('btn-default');
    $modal.find('#_email_action_btn').addClass('btn-danger');
    $modal.find('#_email_action_btn').data('action', 'delete');
    $modal.find('#_email_add_btn').data('action', $action);
    $modal.data('id', $button.data('id'));
    $email = $button.parents('tr').find('.email_value').html();
    $input_email.val($email);
    $input_email.removeClass('is-invalid');

  }
})


// Add email in DB
$('#modal_email ._button_modal').click(function(){
  let $button = $(this);
  let $action = $button.data('action')
  let $modal = $('#modal_email');
  let $form = $('#email_form');
  let $input_email = $('#email_address');

  let $email = $input_email.val();
  let $url = "/index.php/email-"+$action;
  let $id = $modal.data('id')
  let $data = {
    "_token": "{{ csrf_token() }}",
    email_address:$email,
    id:$id,
  }

  if (!$button.hasClass('disabled')){
     $button.addClass('disabled');

     send_data($url, $data, $form, $modal, $button)

  }
})
</script>
@endpush
