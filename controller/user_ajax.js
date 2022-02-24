$(document).ready(function () {
  if ($('#txt-filter1').length) {
    $('#txt-filter1').keyup(function () {
      const dataSearch = $('#txt-filter1').val();
      const action = 'filter-search-1';
      let dataCancha;

      $.ajax({
        url: '../controller/user_ajaxFilter.php',
        type: 'POST',
        async: true,
        data: {
          action,
          dataSearch,
        },
        beforeSend: function () {},
        success: function (response) {
          dataCancha = $.parseJSON(response);
          $('#body-filter1').html(dataCancha);
        },
        error: function (error) {
          console.log(error);
        },
      });
    });
  }

  if ($('#txt-filter2').length) {
    $('#txt-filter2').keyup(function () {
      const dataSearch = $('#txt-filter2').val();
      const action = 'filter-search-2';
      let dataCancha;

      $.ajax({
        url: '../controller/user_ajaxFilter.php',
        type: 'POST',
        async: true,
        data: {
          action,
          dataSearch,
        },
        beforeSend: function () {},
        success: function (response) {
          dataCancha = $.parseJSON(response);
          $('#body-filter2').html(dataCancha);
        },
        error: function (error) {
          console.log(error);
        },
      });
    });
  }

  if ($('#txt-filter').length) {
    $('#txt-filter').keyup(function () {
      const dataSearch = $('#txt-filter').val();
      const action = 'filter-my-reserve';
      const miId = $('#mi-id').val();
      let dataCancha;

      $.ajax({
        url: '../controller/user_ajaxFilter.php',
        type: 'POST',
        async: true,
        data: {
          action,
          dataSearch,
          miId,
        },
        beforeSend: function () {},
        success: function (response) {
          dataCancha = $.parseJSON(response);
          $('#table-reserva').html(dataCancha);
        },
        error: function (error) {
          console.log(error);
        },
      });
    });
  }

  // PDF RESERVAS
});
