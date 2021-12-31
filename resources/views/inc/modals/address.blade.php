<div class="modal fade" id="modal_address">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Добавить адрес</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card-body">
            <form id="address_form">
              <div class="form-group">
                <label for="address">Адрес</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                  </div>
                  <input type="text" class="form-control" id="address" placeholder="Введите адрес">
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id="add_address_btn">Добавить</button>
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
$('#add_address_btn').click(function(){
  let $modal = $('#modal_address');
  let $form = $('#address_form');
  let $button = $(this);
  let $el_address = $('#address');
  let $url = "/index.php/address-add";

  let $address = $el_address.val();

  if (!$button.hasClass('disabled')){
     $button.addClass('disabled');
     $.ajax({
       url: $url,
       type:"POST",
       data:{
         "_token": "{{ csrf_token() }}",
         address:$address,
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
