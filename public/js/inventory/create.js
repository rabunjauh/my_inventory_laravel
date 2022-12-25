// Datatable for table hardware inside modal using vanilla javascript
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
            return 'Active';
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
    // Configure datatable scrollable
    "sScrollX": "100%",
    "bScrollCollapse": true
  });
  
  // Create array itemList
  const itemList = [];
  // get table invetoryDetails tbody
  const tbody = document.querySelector('#inventoryDetails tbody');

  // prevent duplicate data showing in item list
  function clearItems() {
    while(tbody.firstChild) {
      tbody.removeChild(tbody.firstChild);
    }
  }

  // remove item from list
  function removeItems(index) {
    itemList.splice(index, 1);
    displayItems();
  }

  // create element for item list
  function addItems(inventory, index) {
    // const tbody = document.querySelector('#inventoryDetails tbody');
      const tr = tbody.insertRow();
      tr.classList.add('trItemDetail');
      const tdNo = tr.insertCell();
      const tdHardwareName = tr.insertCell();
      const tdSerialNumber = tr.insertCell();
      const tdQuantity = tr.insertCell();
      const tdAction = tr.insertCell();

      const inputHardware = document.createElement('input');
      inputHardware.setAttribute('id', 'hardware_id');
      inputHardware.setAttribute('name', 'hardware_id[]');
      inputHardware.setAttribute('type', 'hidden');
      inputHardware.classList.add('hardware_id');
      inputHardware.value = inventory.id;

      const inputQuantity = document.createElement('input');
      inputQuantity.classList.add('form_control')
      inputQuantity.setAttribute('type', 'number');
      inputQuantity.setAttribute('name', 'quantity[]');
      inputQuantity.setAttribute('id', 'quantity');
      inputQuantity.maxLength = 11;
      inputQuantity.required = true;
      inputQuantity.value = inventory.quantity;
      if(inventory.category == 'Workstation') {
        inputQuantity.readOnly = true;
      }

      const deleteRowButton = document.createElement('button');
      deleteRowButton.setAttribute('type', 'button');
      deleteRowButton.setAttribute('name', 'deleteRowButton');
      deleteRowButton.setAttribute('id', 'deleteRowButton');
      deleteRowButton.classList.add('btn');
      deleteRowButton.classList.add('btn-danger');
      deleteRowButton.classList.add('btn_del');
      deleteRowButton.classList.add('deleteRowButton');
      deleteRowButton.innerHTML = 'Delete';
      // Create event for delete button
      deleteRowButton.addEventListener('click', function() {
        removeItems(index);
      });
      
      tdNo.innerHTML = tr.rowIndex;
      tdHardwareName.innerText = inventory.name;
      tdHardwareName.appendChild(inputHardware);
      tdSerialNumber.innerText = inventory.serialNumber;
      tdQuantity.appendChild(inputQuantity);
      tdAction.appendChild(deleteRowButton);
      tr.appendChild(tdNo);
      tr.appendChild(tdHardwareName);
      tr.appendChild(tdSerialNumber);
      tr.appendChild(tdQuantity);
      tr.appendChild(tdAction);
  }

  // display element
  function displayItems() {
    clearItems();
    itemList.forEach((inventory, index) => {
      addItems(inventory, index);
    });
    
    //Toggle save button enable / disable depend of the inventoryDetail existance
    const submitButton = document.querySelector('#submit');
    if(itemList.length > 0) {
      submitButton.disabled = false;
    } else {
      submitButton.disabled = true;
    }
  }

  // Create row in inventoryDetails table when items in hardware table clicked
  document
    .querySelector('#hardwares tbody')
    .addEventListener('click', async function(event) {
      const hardwareId = table.row(event.target).data().id;
      const inventoryDetailByHardwareId = await getInventoryDetailByHardwareId(hardwareId);
      function getInventoryDetailByHardwareId(hardwareId) {
        return fetch('http://127.0.0.1:8000/inventory/inventoryDetailJsonByHardwareId/' + hardwareId)
                .then(response => response.json())
                .then(response => response.data);
      }

      // Check if clicked item is already exist in the inventory detail
      if(inventoryDetailByHardwareId.length > 0) {
        alert('Selected item is already exist in inventory detail');
      } else {
        const data = {
        id: table.row(event.target).data().id,
        category: table.row(event.target).data().hardware_category.name,
        name: table.row(event.target).data().name,
        serialNumber: table.row(event.target).data().serial_number,
        quantity: 1
      }

      // add item validation for prevent duplicate hardware added to item list
      if(!itemList.find(({id}) => id === data.id)) {
        itemList.push(data);
      } else {
        alert('Selected item is already in the list!');
      }
        displayItems();
      }
    });
});

// Select2 drop down supplier
$(document).ready(function() {
  // Get Element drop down supplier by id
  $('#supplier_id').select2({
    placeholder: 'Select Supplier'
  });
});
  
