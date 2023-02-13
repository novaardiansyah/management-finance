$(document).ready(function () {
  setTimeout(() => {
    loading(false)  
  }, 750);
})

let is_invalid = $('.form-control.is-invalid')
if (is_invalid.length > 0) {
  $('.form-control.is-invalid').on('click focus blur', function () {
    $(this).removeClass('is-invalid')
  })
}

function loading(type = true)
{
  type === false ? $('#loader-screen').removeClass('d-flex').hide() : $('#loader-screen').addClass('d-flex').show() 
}

function stripHtml(html)
{
  let tmp = document.createElement("DIV")
  tmp.innerHTML = html
  return tmp.textContent || tmp.innerText || ""
}

function sweet_alert(type, message, params = {}) {
  Swal.fire({
    type: type,
    html: `<small>${stripHtml(message)}</small>`,
    timer: params.timer || 3000,
    showConfirmButton: params.showConfirmButton || false
  })
}

let select2 = $('.select2.auto-init')
if (select2.length) select2.select2()

let summernote = $('.summernote.auto-init')
if (summernote.length) summernote.summernote()

function create_server_tables(params = {})
{
  let tableId = params.tableId || 'table'
  let url     = params.url || ''

  let ajax = {
    url: url,
    type: 'POST',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }

  $(`#${tableId}`).DataTable({
    processing: true,
    serverSide: true,
    ajax: ajax,
    columns: params.columns || [
      {
        data: 'id',
        name: 'id',
        width: '5%',
        render: function(data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1
        }
      }
    ],
    order: [[0, 'asc']],
    columnDefs: [{}],
    responsive: true,
    autoWidth: false,
    pageLength: 10,
    language: {
      processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
      lengthMenu: 'Show _MENU_ entries',
      zeroRecords: 'No matching records found',
      info: 'Showing _START_ to _END_ of _TOTAL_ entries',
      infoEmpty: 'Showing 0 to 0 of 0 entries',
      infoFiltered: '(filtered from _MAX_ total entries)',
      search: 'Search:',
      paginate: {
        first: 'First',
        last: 'Last',
        next: 'Next',
        previous: 'Previous'
      }
    }
  })
}

function refresh_table(tableId = 'table')
{
  $(`#${tableId}`).DataTable().ajax.reload()
}