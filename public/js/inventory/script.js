// $(document).ready( function () {
//   $('#inventories').DataTable();
// });
// Datatables
document.addEventListener('DOMContentLoaded', function () {
  let table = new DataTable('#inventories', {
    processing: true,
    serverSide: true,
    ajax: '/inventory/json',
    columns: [
      {
        data: 'DT_RowIndex',
        name: 'DT_RowIndex'
      },
      {
        data: 'action',
        name: 'action'
      },
      {
        data: 'inventory_date',
        name: 'inventory_date'    
      },
      {
        data: 'do_date',
        name: 'do_date'
      },
      {
        data: 'do_no',
        name: 'do_no'
      },
      {
        data: 'supplier.name',
        name: 'supplier.name'
      },
    ]
  });
});

// document.addEventListener('DOMContentLoaded', function () {
//   let table = new DataTable('#inventories');
// });

