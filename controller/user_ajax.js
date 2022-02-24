
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

  // PDF RESERVAS

  // Add event for all courts
  function get_data_court(
    update,
    action,
    dataCancha,
    status,
    name,
    observation,
    disciplines,
    hidden_id
  ) {
    const id_court = update.id;
    $.ajax({
      url: '../../controller/ajaxFilter.php',
      type: 'POST',
      async: true,
      data: {
        action,
        id_court,
      },
      beforeSend: function () {},
      success: function (response) {
        status.removeAttribute('checked');

        dataCancha = $.parseJSON(response);

        $(name).val(dataCancha.nombre_cancha);
        $(observation).val(dataCancha.obs_cancha);
        if (dataCancha.estado_cancha != 0) {
          status.setAttribute('checked', '');
        }

        for (const option of disciplines.children) {
          option.removeAttribute('selected');
          if (option.value == dataCancha.Disciplina_cod_disciplina) {
            option.setAttribute('selected', '');
          }
        }

        hidden_id.value = id_court;
      },
      error: function (error) {
        console.log(error);
      },
    });
  }

  function getDefaultInputOffer() {
    // Inputs
    const nameTxt = document.getElementById('floatingName');
    const offerTxt = document.getElementById('floatingOffer');
    const finicioTxt = document.getElementById('finicio');
    const ffinTxt = document.getElementById('ffin');
    const idOffer = document.getElementById('id_offer');

    $(nameTxt).val('');
    $(offerTxt).val('');
    $(finicioTxt).val('');
    $(ffinTxt).val('');
    $(idOffer).val('');
  }

  // Validar Promo
  function validar_promo(info) {
    let response = {};
    if (info[0] === '' || info[1] === '' || info[2] === '' || info[3] === '') {
      response.pass = false;
      response.message = 'Por favor complete todos los campos.';
      return response;
    }
    const now = new Date();
    const finicio = new Date(info[2]);
    const ffin = new Date(info[3]);

    if (finicio.valueOf() < now.valueOf() || ffin.valueOf() < now.valueOf()) {
      response.pass = false;
      response.message =
        'Fecha de inicio o fin debe ser mayor o igual a la fecha actual.';
      return response;
    }

    if (finicio.valueOf() > ffin.valueOf()) {
      response.pass = false;
      response.message = 'Fecha de inicio debe ser menor a la fecha final.';
      return response;
    }
    response.pass = true;
    return response;
  }

});
