// Datatables
document.addEventListener('DOMContentLoaded', function () {
  let table = new DataTable('#hardwares', {
    processing: true,
    serverSide: true,
    ajax: 'http://127.0.0.1:8000/hardware/json',
    // columnDefs: [
    //   {
    //     targets: -1,
    //             data: null,
    //             defaultContent: '<button>Click!</button>',
    //   }
    // ],
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
      name: 'status'
    },
    {
      data: 'hardware_type.name',
      name: 'hardware_type.name'
    },
    {
      data: 'hardware_model.name',
      name: 'hardware_model.name'
    },
    {
      data: 'processor.model_no',
      name: 'processor.model_no'
    },
    {
      data: 'memory.capacity',
      name: 'memory.capacity'
    },
    {
      data: 'graphic_card.capacity',
      name: 'graphic_card.capacity'
    },
    {
      data: 'storage.capacity',
      name: 'storage.capacity'
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




