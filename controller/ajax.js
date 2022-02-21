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
          console.log(tabla);
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
});
