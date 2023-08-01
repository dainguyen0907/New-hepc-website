
var deleteModal = document.getElementById('deleteModal')
deleteModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var id = button.getAttribute('data-id')
  var modalID = deleteModal.querySelector('#id')
  var idMessage=deleteModal.querySelector('#id-delete-message')
  modalID.value=id
  idMessage.textContent=id
  
})


