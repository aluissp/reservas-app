document.addEventListener('DOMContentLoaded', function () {
  // Canchas
  const btnAdd = document.getElementById('add-court');
  const btnUpdate = document.getElementById('update-court');

  const formCourt = document.getElementById('form-court');

  if (formCourt) {
    btnAdd.onclick = () => {
      formCourt.setAttribute('action', 'court.php?add=1');
    };
    btnUpdate.onclick = () => {
      formCourt.setAttribute('action', 'court.php?update=1');
    };
  }

  // Promociones
  /*const btnAddOffer = document.getElementById('add-offer');
  const btnUpdateOffer = document.getElementById('update-offer');

  const formOffer = document.getElementById('form-offer');

  if (formOffer) {
    btnAddOffer.onclick = () => {w
      formOffer.setAttribute('action', 'offer.php?add=1');
    };
    btnUpdateOffer.onclick = () => {
      formOffer.setAttribute('action', 'offer.php?update=1');
    };
  }*/
});
