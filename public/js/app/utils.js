let is_invalid = $('.form-control.is-invalid')
if (is_invalid.length > 0) {
  $('.form-control.is-invalid').on('click focus blur', function () {
    $(this).removeClass('is-invalid')
  })
}

function sweet_alert(type, message, params = {}) {
  Swal.fire({
    type: type,
    text: message,
    timer: params.timer || 3000,
    timerProgressBar: params.timerProgressBar || true,
    showConfirmButton: params.showConfirmButton || false
  })
}

let select2 = $('.select2.auto-init')
if (select2.length) select2.select2()

let summernote = $('.summernote.auto-init')
if (summernote.length) summernote.summernote()