// Datatables
document.addEventListener('DOMContentLoaded', function () {
  let table = new DataTable('#hardwareItems', {
    processing: true,
    serverSide: true,
    ajax: 'http://127.0.0.1:8000/hardware/json',
    columns: [
    { 
      data: 'DT_RowIndex',
      name: 'DT_RowIndex'
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
    {
      data: 'service_code',
      name: 'service_code'
    },
    {
      data: 'computer_name',
      name: 'computer_name'
    },
  ],
    "sScrollX": "100%",
    "bScrollCollapse": true
  });

  document.querySelector('#hardwareItems tbody').addEventListener('click', function(event) {
    const data = table.row(event.target).data();
    const tbody = document.querySelector('#inventoryDetails tbody');
    
    
    addRow();
    
    function addRow() {
      const tr = tbody.insertRow();
      const tdNo = tr.insertCell();
      const tdHardware = tr.insertCell();
      const tdSerialNumber = tr.insertCell();
      const tdQuantity = tr.insertCell();
      const tdAction = tr.insertCell();

      const inputHardware = document.createElement('input');
      inputHardware.setAttribute('id', 'hardware_id');
      inputHardware.setAttribute('name', 'hardware_id[]');
      inputHardware.setAttribute('hidden', 'text');
      inputHardware.value = data['name'];

      const inputSerialNumber = document.createElement('input');
      inputSerialNumber.setAttribute('type', 'hidden');
      inputSerialNumber.setAttribute('name', 'hardware_id[]');
      inputSerialNumber.setAttribute('id', 'hardware_id');
      inputSerialNumber.value = data['serial_number'];

      const inputQuantity = document.createElement('input');
      inputQuantity.classList.add('form_control')
      inputQuantity.setAttribute('type', 'text');
      inputQuantity.setAttribute('name', 'hardware_id[]');
      inputQuantity.setAttribute('id', 'hardware_id');

      const deleteRowButton = document.createElement('button');
      deleteRowButton.setAttribute('type', 'button');
      deleteRowButton.setAttribute('name', 'deleteRowButton');
      deleteRowButton.setAttribute('id', 'deleteRowButton');
      deleteRowButton.classList.add('btn');
      deleteRowButton.classList.add('btn-danger');
      deleteRowButton.classList.add('btn_del');
      deleteRowButton.classList.add('deleteRowButton');
      deleteRowButton.innerHTML = 'Delete';
      
      tdNo.innerHTML = tr.rowIndex;
      tdHardware.innerText = data['name'];
      tdHardware.appendChild(inputHardware);
      tdSerialNumber.innerText = data['serial_number'];
      tdSerialNumber.appendChild(inputSerialNumber);
      tdQuantity.appendChild(inputQuantity);
      tdAction.appendChild(deleteRowButton);
      tr.appendChild(tdNo);
      tr.appendChild(tdHardware);
      tr.appendChild(tdSerialNumber);
      tr.appendChild(tdQuantity);
      tr.appendChild(tdAction);
    }
    function removeRow(){
      const tbody = document.getElementsByTagName('tbody')[0];
      tbody.deleteRow(-1);
    }	
  });
});

document.addEventListener('click', function(event) {
  if(event.target.classList.contains('deleteRowButton')) {
    event.target.parentElement.parentElement.remove();
  }
})






// const inputHardware
// tableDivision.innerHTML = 'tes';
// tableRow.appendChild(tableDivision);

// const inventoryDetails = document.querySelector('#inventoryDetails tbody');
// inventoryDetails.appendChild(tableRow);