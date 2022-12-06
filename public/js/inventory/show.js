// Datatables
const inventoryId = document.getElementById('inventoryId').value;
document.addEventListener('DOMContentLoaded', function () {
  let table = new DataTable('#inventoryDetails', {
    processing: true,
    serverSide: true,
    // ajax: '/inventory/inventoryDetailJson/1',
    ajax: '/inventory/inventoryDetailJson/' + inventoryId,
    columns: [
      {
        data: 'DT_RowIndex',
        name: 'DT_RowIndex'
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
        data: 'quantity',
        name: 'quantity'
      },
    ]
  });
});


