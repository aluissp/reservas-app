$(document).ready(function () {
  if ($('#txt-filter').length) {
    $('#txt-filter').keyup(function () {
      const dataSearch = $('#txt-filter').val();

      const action = 'filter-discipline';
      let dataCancha;

      $.ajax({
        url: '../../controller/ajaxFilter.php',
        type: 'POST',
        async: true,
        data: {
          action,
          dataSearch,
        },
        beforeSend: function () {},
        success: function (response) {
          dataCancha = $.parseJSON(response);
          $('#body-skill').html(dataCancha);
        },
        error: function (error) {
          console.log(error);
        },
      });
    });
  }

  // PDF RESERVAS
  if ($('#printReserva').length) {
    $('#printReserva').click(function () {
      const dataSearch = $('#txtSearchReservaKey').val();
      const dtInicio = $('#id-finicio').val();
      const dtFin = $('#id-ffin').val();
      const action = 'printReserva';
      let dataContact;

      $.ajax({
        url: '../Controlador/ajaxData.php',
        type: 'POST',
        async: true,
        data: {
          action,
          dataSearch,
          dtInicio,
          dtFin,
        },
        beforeSend: function () {},
        success: function (response) {
          console.log('Se imprimio correctamente');
        },
        error: function (error) {
          console.log(error);
        },
      });
    });
  }
});
