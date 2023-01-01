$(document).ready( function () {
  $('#users').DataTable();

  $('#employee_id').select2({
    placeholder: 'Select Employee'
  });
});