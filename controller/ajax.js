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

  if ($('#txt-filter-court').length) {
    $('#txt-filter-court').keyup(function () {
      const dataSearch = $('#txt-filter-court').val();

      const action = 'filter-court';
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
          $('#table-cancha').html(dataCancha);

          const tabla = document.getElementById('table-cancha');
          const name = document.getElementById('floatingName');
          const observation = document.getElementById('floatingObservation');
          const disciplines = document.getElementById('disciplinas');
          const status = document.getElementById('sw-status');
          const hidden_id = document.getElementById('hidden_id_cancha');

          const action = 'get_court';
          dataCancha;

          for (const row of tabla.children) {
            if (row.children[3]) {
              const update = row.children[3].children[0];
              $(update).click(() =>
                get_data_court(
                  update,
                  action,
                  dataCancha,
                  status,
                  name,
                  observation,
                  disciplines,
                  hidden_id
                )
              );
            }
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
    });
  }

  if ($('#table-cancha').length) {
    const tabla = document.getElementById('table-cancha');
    const name = document.getElementById('floatingName');
    const observation = document.getElementById('floatingObservation');
    const disciplines = document.getElementById('disciplinas');
    const status = document.getElementById('sw-status');
    const hidden_id = document.getElementById('hidden_id_cancha');

    const action = 'get_court';
    let dataCancha;
    for (const row of tabla.children) {
      const update = row.children[3].children[0];
      $(update).click(() =>
        get_data_court(
          update,
          action,
          dataCancha,
          status,
          name,
          observation,
          disciplines,
          hidden_id
        )
      );
    }
  }

  // All offer events
  if (
    $('#add-offer').length ||
    $('#update-offer').length ||
    $('#table-offer').length ||
    $('#txt-filter-offer').length
  ) {
    const addButton = document.getElementById('add-offer');
    const updateButton = document.getElementById('update-offer');
    const tableBody = document.getElementById('table-offer');
    const filterTxt = document.getElementById('txt-filter-offer');

    // Inputs
    const nameTxt = document.getElementById('floatingName');
    const offerTxt = document.getElementById('floatingOffer');
    const finicioTxt = document.getElementById('finicio');
    const ffinTxt = document.getElementById('ffin');
    const idOffer = document.getElementById('id_offer');
    const idDis = document.getElementById('id_dis');

    // Form
    const formOffer = document.getElementById('form-offer');

    // error and success
    const error = document.getElementById('error');
    const success = document.getElementById('success');

    // Response
    let dataOffer;
    table_offer_event();

    $(addButton).click(function () {
      let info = [
        $(nameTxt).val(),
        $(offerTxt).val(),
        $(finicioTxt).val(),
        $(ffinTxt).val(),
        $(idDis).val(),
      ];

      $(error).text('');
      $(success).text('');

      const response = validar_promo(info);
      if (!response.pass) {
        $(error).text(response.message);
      } else {
        info = JSON.stringify(info);
        $.ajax({
          url: '../../controller/ajaxFilter.php',
          type: 'POST',
          async: true,
          data: {
            action: 'add_offer',
            info,
          },
          beforeSend: function () {},
          success: function (response) {
            dataOffer = $.parseJSON(response);
            if (dataOffer === 'err') {
              $(error).text(
                'La fecha de inicio debe ser mayor al ultima promoción registrada'
              );
            } else {
              getDefaultInputOffer();
              $(tableBody).html(dataOffer);
              table_offer_event();
              $(success).text('Se agregó correctamente la promoción.');
            }
          },
          error: function (error) {
            console.log(error);
          },
        });
      }
    });

    $(updateButton).click(function () {
      let info = [
        $(nameTxt).val(),
        $(offerTxt).val(),
        $(finicioTxt).val(),
        $(ffinTxt).val(),
        $(idDis).val(),
        $(idOffer).val(),
      ];

      $(error).text('');
      $(success).text('');

      const response = validar_promo(info);
      if (!response.pass) {
        $(error).text(response.message);
      } else {
        info = JSON.stringify(info);
        $.ajax({
          url: '../../controller/ajaxFilter.php',
          type: 'POST',
          async: true,
          data: {
            action: 'update_offer',
            info,
          },
          beforeSend: function () {},
          success: function (response) {
            dataOffer = $.parseJSON(response);
            if (dataOffer === 'err') {
              $(error).text(
                'Si desea actualizar fechas, debe ser mayor a la ultima promoción registrada'
              );
            } else {
              getDefaultInputOffer();
              $(tableBody).html(dataOffer);
              table_offer_event();
              $(success).text('Se actualizó correctamente la promoción.');
            }
          },
          error: function (error) {
            console.log(error);
          },
        });
      }
    });

    $(filterTxt).keyup(function () {
      const search_data = $(filterTxt).val();
      const id_dis = $(idDis).val();

      $.ajax({
        url: '../../controller/ajaxFilter.php',
        type: 'POST',
        async: true,
        data: {
          action: 'search_filter_offer',
          search_data,
          id_dis,
        },
        beforeSend: function () {},
        success: function (response) {
          dataOffer = $.parseJSON(response);
          getDefaultInputOffer();
          $(tableBody).html(dataOffer);
          table_offer_event();
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

  // Add all event for table offer
  function table_offer_event() {
    const tableBody = document.getElementById('table-offer');

    // Inputs
    const nameTxt = document.getElementById('floatingName');
    const offerTxt = document.getElementById('floatingOffer');
    const finicioTxt = document.getElementById('finicio');
    const ffinTxt = document.getElementById('ffin');
    const idOffer = document.getElementById('id_offer');
    const idDis = document.getElementById('id_dis');

    for (const row of tableBody.children) {
      if (row.children[4]) {
        const update = row.children[4].children[0];
        const eliminate = row.children[4].children[1];

        // console.log($(update).val());
        // console.log(update);
        $(update).click(() => {
          $(idOffer).val($(update).attr('id'));
          // console.log($(update).attr('des'));
          $(offerTxt).val($(update).attr('des'));
          if (
            row.children[2].innerText !== '' &&
            row.children[1].innerText !== ''
          ) {
            $(ffinTxt).val(row.children[2].innerText);
            $(finicioTxt).val(row.children[1].innerText);
          }
          $(nameTxt).val(row.children[0].innerText);
        });
        $(eliminate).click(() => {
          const id_offer = $(eliminate).attr('id');
          const id_dis = $(idDis).val();
          $.ajax({
            url: '../../controller/ajaxFilter.php',
            type: 'POST',
            async: true,
            data: {
              action: 'delete_offer',
              id_offer,
              id_dis,
            },
            beforeSend: function () {},
            success: function (response) {
              dataOffer = $.parseJSON(response);
              if (dataOffer === 'err') {
                $(error).text('Ocurrio un error al eliminar la promoción.');
              } else {
                getDefaultInputOffer();
                $(tableBody).html(dataOffer);
                table_offer_event();
                $(success).text('Se eliminó correctamente la promoción.');
              }
            },
            error: function (error) {
              console.log(error);
            },
          });
        });
      }
    }
  }
});
