let tableId    = 'listMenu'
let defaultUrl = url('master-data/menu/list-menu')

create_server_tables({ tableId: tableId, url: defaultUrl, columns: [
  {
    data: 'id',
    name: 'rownumber',
    width: '5%',
    render: function(data, type, row, meta) {
      return meta.row + meta.settings._iDisplayStart + 1
    }
  },
  { data: 'name', name: 'name' },
  // { data: 'icon', name: 'icon' },
  {
    data: 'icon',
    name: 'icon',
    render: function(data, type, row, meta) {
      return data ? `${data} <i class="fa fa-fw ${data}"></i>` : '-'
    }
  },
  { data: 'url', name: 'url' },
  {
    data: 'is_active',
    name: 'is_active',
    render: function(data, type, row, meta) {
      return data == 1 ? `<span class="badge badge-success">Active</span>` : `<span class="badge badge-danger">Inactive</span>`
    }
  },
  {
    data: 'id',
    name: 'action',
    width: '10%',
    render: function(data, type, row, meta) {
      return `
        <div class="btn-group">
          <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog"></i>
          </button>

          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#" onclick="return modalEdit(...Array(2), event, '${btoa(data)}')">
              <i class="fa fa-edit"></i> Edit
            </a>
            <a class="dropdown-item" href="#" onclick="return destroy(event, '${btoa(data)}')">
              <i class="fa fa-trash"></i> Delete
            </a>
          </div>
        </div>
      `;
    }
  }
]})

function preview_icon(event)
{
  let icon = $(event.target).val()
  let preview = $(event.target).closest('.input-group').find('#preview-icon')

  if (icon === '') return preview.html(`<i class="fa fa-fw fa-minus"></i>`)
  preview.html(`<i class="fa fa-fw fa-${icon}"></i>`)
}

// * Feature to add menu data (Start)
function modalCreate(trigger = 'show', size = 'modal-md')
{
  let modal = $('#backdropVerticalCentered')

  if (trigger === 'hide') return modal.modal('hide')

  modal.find('.modal-dialog').removeClass('modal-sm modal-xl modal-lg').addClass(size)
  modal.find('.modal-footer').hide()
  modal.find('.modal-title').html('Create Menu')

  let content = modal.find('.modal-body')
  content.html(`
    <form method="POST" action="${url('master-data/menu')}" class="pl-2 px-4">
      <input id="_token" name="_token" type="hidden" value="${config.csrf_token}" />

      <div class="form-group row">
        <label for="name" class="col-sm-2 text-md-right col-form-label">
          Name <span class="text-danger">*</span>
        </label>
        <div class="col-sm">
          <input type="text" class="form-control" id="name" name="name" placeholder="Name" />
          <div class="invalid-feedback name"></div>
        </div>
      </div>
      <!-- form-group -->

      <div class="form-group row">
        <label for="icon" class="col-sm-2 text-md-right col-form-label">Icon</label>
        <div class="col-sm">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">fa-</span>
            </div>        
            <input type="text" class="form-control" id="icon" name="icon" placeholder="minus" onkeyup="return preview_icon(event)" />
            <div class="input-group-append">
              <span class="input-group-text" id="preview-icon">
                <i class="fa fa-fw fa-minus"></i>
              </span>
            </div>
          </div>
          <span class="text-muted small">Please see the list of icons</span> <a href="https://glyphsearch.com/?library=font-awesome&copy=name" class="text-primary small">here</a>
          <!-- input-group -->
          <div class="invalid-feedback icon"></div>
        </div>
      </div>
      <!-- form-group -->

      <div class="form-group row">
        <label for="url" class="col-sm-2 text-md-right col-form-label">Url</label>
        <div class="col-sm">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">/</span>
            </div>
            <input type="text" class="form-control" id="url" name="url" placeholder="somewhere" />
          </div>
          <!-- input-group -->
          <div class="invalid-feedback url"></div>
        </div>
      </div>
      <!-- form-group -->

      <div class="form-group row">
        <label for="status" class="col-sm-2 text-md-right col-form-label">
          Status <span class="text-danger">*</span>
        </label>
        <div class="col-sm">
          <select class="form-control custom-select" id="status" name="status">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
          <div class="invalid-feedback status"></div>
        </div>
      </div>
      <!-- form-group -->

      <div class="row text-right">
        <div class="col-sm offset-sm-2">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
            <i class="fa fa-fw fa-times-circle"></i> Close
          </button>
          <button type="button" class="btn btn-sm btn-primary" onclick="return create(event)">
            <i class="fa fa-fw fa-save"></i> Save changes
          </button>
        </div>
      </div>
    </form>
  `)

  modal.modal('show')
}

function create(event)
{
  let form   = $(event.target).closest('form')
  let data   = new FormData(form[0])
  let url    = form.attr('action')
  let method = form.attr('method') || 'POST'

  $.ajax({
    url: url,
    type: method,
    data: data,
    dataType: 'json',
    processData: false,
    contentType: false,
    beforeSend: function() {
      form.find('.invalid-feedback').html('').fadeOut()
    }, 
    success: function(response) {
      if (response.status === true) {
        modalCreate('hide')

        return sweet_alert('success', response.message, {
          willClose: refresh_table(tableId)
        });
      }
    },
    error: function(xhr) {
      if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors
        Object.keys(errors).forEach(function(key) {
          let error = errors[key]
          form.find(`.invalid-feedback.${key}`).html(error[0]).fadeIn()
        })
      }
    }
  })
}
// * Feature to add menu data (End)


// * Feature to edit menu data (Start)
function modalEdit(trigger = 'show', size = 'modal-md', event = false, id = '')
{
  let modal = $('#backdropVerticalCentered')
  
  if (event !== false) event.preventDefault()
  if (trigger === 'hide') return modal.modal('hide')

  modal.find('.modal-dialog').removeClass('modal-sm modal-xl modal-lg').addClass(size)
  modal.find('.modal-footer').hide()
  modal.find('.modal-title').html('Update Menu')

  $.ajax({
    url: url(`master-data/menu/${atob(id)}/edit`),
    type: 'GET',
    dataType: 'json',
    beforeSend: function() {},
    success: function(response) {
      if (response.status === false) return sweet_alert('error', response.message, { timer: 4000 })
      let data = response.data

      data.icon = data.icon.replace('fa-', '')
      data.url  = data.url.replace('/', '')

      let content = modal.find('.modal-body')
      content.html(`
        <form method="POST" action="${url('master-data/menu/' + data.id)}" class="pl-2 px-4">
          <input id="_token" name="_token" type="hidden" value="${config.csrf_token}" />
          <input id="_method" name="_method" type="hidden" value="PUT" />
          
          <div class="form-group row">
            <label for="name" class="col-sm-2 text-md-right col-form-label">
              Name <span class="text-danger">*</span>
            </label>
            <div class="col-sm">
              <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="${data.name}" />
              <div class="invalid-feedback name"></div>
            </div>
          </div>
          <!-- form-group -->

          <div class="form-group row">
            <label for="icon" class="col-sm-2 text-md-right col-form-label">Icon</label>
            <div class="col-sm">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">fa-</span>
                </div>        
                <input type="text" class="form-control" id="icon" name="icon" placeholder="minus" onkeyup="return preview_icon(event)" value="${data.icon}" />
                <div class="input-group-append">
                  <span class="input-group-text" id="preview-icon">
                    <i class="fa fa-fw fa-${data.icon}"></i>
                  </span>
                </div>
              </div>
              <span class="text-muted small">Please see the list of icons</span> <a href="https://glyphsearch.com/?library=font-awesome&copy=name" class="text-primary small">here</a>
              <!-- input-group -->
              <div class="invalid-feedback icon"></div>
            </div>
          </div>
          <!-- form-group -->

          <div class="form-group row">
            <label for="url" class="col-sm-2 text-md-right col-form-label">Url</label>
            <div class="col-sm">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">/</span>
                </div>
                <input type="text" class="form-control" id="url" name="url" placeholder="somewhere" value="${data.url}" />
              </div>
              <!-- input-group -->
              <div class="invalid-feedback url"></div>
            </div>
          </div>
          <!-- form-group -->

          <div class="form-group row">
            <label for="status" class="col-sm-2 text-md-right col-form-label">
              Status <span class="text-danger">*</span>
            </label>
            <div class="col-sm">
              <select class="form-control custom-select" id="status" name="status">
                <option value="1" ${parseInt(data.is_active) === 1 ? 'selected' : ''}>Active</option>
                <option value="0" ${parseInt(data.is_active) === 0 ? 'selected' : ''}>Inactive</option>
              </select>
              <div class="invalid-feedback status"></div>
            </div>
          </div>
          <!-- form-group -->

          <div class="row text-right">
            <div class="col-sm offset-sm-2">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                <i class="fa fa-fw fa-times-circle"></i> Close
              </button>
              <button type="button" class="btn btn-sm btn-primary" onclick="return update(event)">
                <i class="fa fa-fw fa-save"></i> Save changes
              </button>
            </div>
          </div>
        </form>
      `)

      modal.modal('show')
    }
  })
}

function update(event)
{
  let form   = $(event.target).closest('form')
  let data   = new FormData(form[0])
  let url    = form.attr('action')

  $.ajax({
    url: url,
    type: 'POST',
    data: data,
    dataType: 'json',
    processData: false,
    contentType: false,
    beforeSend: function() {
      form.find('.invalid-feedback').html('').fadeOut()
    }, 
    success: function(response) {
      if (response.status === true) {
        modalEdit('hide')

        return sweet_alert('success', response.message, {
          willClose: refresh_table(tableId)
        });
      }
    },
    error: function(xhr) {
      if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors
        Object.keys(errors).forEach(function(key) {
          let error = errors[key]
          form.find(`.invalid-feedback.${key}`).html(error[0]).fadeIn()
        })
      }
    }
  })
}
// * Feature to edit menu data (End)


function destroy(event = false, id)
{
  if (event) event.preventDefault()

  Swal.fire({
    text: `Are you sure? You won't be able to revert this!`,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
    reverseButtons: true,
    buttonsStyling: false,
    customClass: {
      confirmButton: 'btn btn-sm btn-danger ml-1',
      cancelButton: 'btn btn-sm btn-secondary'
    }
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: url(`master-data/menu/${atob(id)}`),
        type: 'DELETE',
        data: {
          _token: config.csrf_token,
        },
        success: function(response) {
          if (response.status === true) {
            return sweet_alert('success', response.message, {
              willClose: refresh_table(tableId)
            });
          }
        }
      })
    }
  })
}