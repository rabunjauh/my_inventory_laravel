// Datatables
document.addEventListener('DOMContentLoaded', function () {
  let table = new DataTable('#inventoryDetails');
});

document.addEventListener('DOMContentLoaded', function () {
  let table = new DataTable('#items', {
    "sScrollX": "100%",
    "bScrollCollapse": true
  });
});

document.addEventListener('click', function(event) {
  if(event.target.parentElement.className === 'odd' || event.target.parentElement.className === 'even') {
    console.log(event);
  }
});

const tableRow = document.createElement('tr');
const tableDivision = document.createElement('td');
// const inputHardware
// tableDivision.innerHTML = 'tes';
// tableRow.appendChild(tableDivision);

const inventoryDetails = document.querySelector('#inventoryDetails tbody');
inventoryDetails.appendChild(tableRow);