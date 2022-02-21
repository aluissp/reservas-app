document.addEventListener('DOMContentLoaded', function () {
  const btnAdd = document.getElementById('add-court');
  const btnUpdate = document.getElementById('update-court');

  const form = document.getElementById('form-court');

  btnAdd.onclick = () => {
    form.setAttribute('action', 'court.php?add=1');
  }
  btnUpdate.onclick = () => {
    form.setAttribute('action', 'court.php?update=1');
  }
});
