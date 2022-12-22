// Datatables
document.addEventListener('DOMContentLoaded', function () {
  let table = new DataTable('#itemStocks', {
    processing: true,
    serverSide: true,
    ajax: 'http://127.0.0.1:8000/itemStock/json',
    columns: [
      {
        data: 'DT_RowIndex',
        name: 'DT_RowIndex'
      },
      {
        data: 'hardware.code',
        name: 'hardware.code'    
      },
      {
        data: 'hardware.name',
        name: 'hardware.name'
      },
      {
        data: 'hardware.serial_number',
        name: 'hardware.serial_number'
      },
      {
        data: 'hardware.hardware_type.name',
        name: 'hardware.hardware_type.name'
      },
      {
        data: 'hardware.hardware_model.name',
        name: 'hardware.hardware_model.name'
      },
      {
        data: 'hardware.processor.model_no',
        name: 'hardware.processor.model_no'
      },
      {
        data: 'hardware.memory.type',
        name: 'hardware.memory.type'
      },
      {
        data: 'hardware.storage.size',
        name: 'hardware.storage.size'
      },
      {
        data: 'stock',
        name: 'stock'
      },
    ]
  });
});

