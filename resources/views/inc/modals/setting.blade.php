<div class="modal fade" id="modal_setting">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Создать реферальную программу</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card-body">
            <form id="setting_form">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="setting_enabled" checked="" >
                  <label class="custom-control-label" for="setting_enabled">Активировать реферальную программу</label>
                </div>
              </div>
              <div class="form-group">
                <label for="name_setting">Название</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="name_setting">
                </div>
              </div>
              <div class="form-group">
                <label>Сайт</label>
                <select class="custom-select" id="site_id">
                  @foreach ($sites as $site)
                  <option data-id="{{ $site->id }}">{{ $site->url }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Телефон</label>
                <select class="custom-select" id="phone_id">
                  @foreach ($phones as $phone)
                  <option data-id="{{ $phone->id }}">{{ $phone->number }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Email</label>
                <select class="custom-select" id="email_id">
                  @foreach ($emails as $email)
                  <option data-id="{{ $email->id }}">{{ $email->email }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Адрес</label>
                <select class="custom-select" id="address_id">
                  @foreach ($addresses as $address)
                  <option data-id="{{ $address->id }}">{{ $address->address }}</option>
                  @endforeach
                </select>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id="add_setting_btn">Создать</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


@push('scripts_after')
<script>


$('#add_setting_btn').click(function(){
  let $modal = $('#modal_setting');
  let $form = $('#setting_form');
  let $button = $(this);
  let $setting_enabled = Number($('#setting_enabled').prop('checked'));
  let $name_setting = $('#name_setting').val();
  let $site_id = $('#site_id option:selected').data('id');
  let $phone_id = $('#phone_id option:selected').data('id');
  let $email_id = $('#email_id option:selected').data('id');
  let $address_id = $('#address_id option:selected').data('id');
  let $url = "/index.php/setting-add";
  let $user_id = "{{ Auth::user()->id }}";

  if (!$button.hasClass('disabled')){
     $button.addClass('disabled');
     $.ajax({
       url: $url,
       type: "POST",
       data: {
         "_token": "{{ csrf_token() }}",
         user_id: $user_id,
         enabled: $setting_enabled,
         name_setting: $name_setting,
         site_id: $site_id,
         phone_id: $phone_id,
         email_id: $email_id,
         address_id: $address_id,
       },
       success:function(response){
         toastr.success(response.success);
         $modal.modal('toggle');
         $form[0].reset();
         $button.removeClass('disabled');

       },
       error: function (err) {
          $button.removeClass('disabled');
          toastr.error('Произошла ошибка. Обратитесь к разработчику.');
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
