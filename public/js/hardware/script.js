// Datatables
document.addEventListener('DOMContentLoaded', function () {
  let table = new DataTable('#hardwares', {
    processing: true,
    serverSide: true,
    ajax: 'http://127.0.0.1:8000/hardware/json',
    columns: [
    { 
      data: 'DT_RowIndex',
      name: 'DT_RowIndex'
    },
    {
      data: 'action',
      name: 'action',
    },
    {
      data: 'code',
      name: 'code'
    },
    {
      data: 'hardware_category.name',
      name: 'hardware_category.name'
    },
    {
      data: 'name',
      name: 'name'
    },
    {
      data: 'manufacturer.name',
      name: 'manufacturer.name'
    },
    {
      data: 'serial_number',
      name: 'serial_number'
    },
    {
      data: 'status',
      name: 'status',
      render: function(data, type, full, meta) {
        if(data === 1) {
          return 'Aktive';
        } else {
          return 'Not Active';
        }
      }
    },
    {
      data: 'hardware_type.name',
      name: 'hardware_type.name',
      render: function(data, type, full, meta) {
        if(data) {
          return data;
        } else {
          return ''
        }
      }
    },
    {
      data: 'hardware_model.name',
      name: 'hardware_model.name',
      render: function(data, type, full, meta) {
        if(data) {
          return data;
        } else {
          return ''
        }
      }
    },
    {
      data: 'processor.model_no',
      name: 'processor.model_no',
      render: function(data, type, full, meta) {
        if(data) {
          return data;
        } else {
          return ''
        }
      }
    },
    {
      data: 'memory.capacity',
      name: 'memory.capacity',
      render: function(data, type, full, meta) {
        if(data) {
          return data;
        } else {
          return ''
        }
      }
    },
    {
      data: 'graphic_card.capacity',
      name: 'graphic_card.capacity',
      render: function(data, type, full, meta) {
        if(data) {
          return data;
        } else {
          return ''
        }
      }
    },
    {
      data: 'storage.capacity',
      name: 'storage.capacity',
      render: function(data, type, full, meta) {
        if(data) {
          return data;
        } else {
          return ''
        }
      }
    },
    // {
    //   data: 'warranty_start',
    //   name: 'warranty_start'
    // },
    // {
    //   data: 'warranty_end',
    //   name: 'warranty_end'
    // },
    // {
    //   data: 'description',
    //   name: 'description'
    // },
    // {
    //   data: 'remark',
    //   name: 'remark'
    // },
    {
      data: 'service_code',
      name: 'service_code'
    },
    {
      data: 'computer_name',
      name: 'computer_name'
    },
    // {
    //   data: 'image',
    //   name: 'image'
    // },
    // {
    //   defaultContent: '<button>tes</button>'
    // }
    
  ],
    "sScrollX": "100%",
    "bScrollCollapse": true
  });
});

// Air Datepicker
// $('#serial_number').datepicker([options])
// Access instance of plugin
// $('#serial_number').data('datepicker')




