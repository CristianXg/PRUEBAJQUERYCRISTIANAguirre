$(document).ready(function() {
  let edit = false;


  console.log('jquery is working!');
  fetchTasks();
  $('#task-result').hide();



  $('#search').keyup(function() {
    if($('#search').val()) {
      let search = $('#search').val();
      $.ajax({
        url: 'task-search.php',
        data: {search},
        type: 'POST',
        success: function (response) {
      
            let tasks = JSON.parse(response);
            let template = '';
            tasks.forEach(task => {
              template += `
                     <li><a href="#" class="task-item">${task.nombres}</a></li>
                    ` 
            });
            $('#task-result').show();
            $('#container').html(template);
          
        } 
      })
    }
  });

  $('#task-form').submit(e => {
    e.preventDefault();
    const postData = {
      nombres: $('#nombres').val(),
      telefono: $('#telefono').val(),
      direccion: $('#direccion').val(),
      codigo: $('#codigo').val()
    };
    const url = edit === false ? 'task-add.php' : 'task-edit.php';
    console.log(postData, url);
    $.post(url, postData, (response) => {
      console.log(response);
      $('#task-form').trigger('reset');
      fetchTasks();
    });
  });


  function fetchTasks() {
    $.ajax({
      url: 'tasks-list.php',
      type: 'GET',
      success: function(response) {
        const tasks = JSON.parse(response);
        let template = '';
        tasks.forEach(task => {
          template += `
                  <tr codigo="${task.codigo}">
                  <td>${task.codigo}</td>
                  <td>
                  <a href="#" class="task-item">
                    ${task.nombres} 
                  </a>
                  </td>
                  <td>${task.telefono}</td>
                  
                  <td>${task.direccion}</td>
                  <td>
                    <button class="task-delete btn btn-danger">
                     Eliminar
                    </button>
                  </td>
                  </tr>
                `
        });
        $('#tasks').html(template);
      }
    });
  }


  $(document).on('click', '.task-item', (e) => {
    const element = $(this)[0].activeElement.parentElement.parentElement;
    const codigo = $(element).attr('codigo');
    $.post('task-single.php', {codigo}, (response) => {
      const task = JSON.parse(response);
      $('#nombres').val(task.nombres);
      $('#telefono').val(task.telefono);
      $('#direccion').val(task.direccion);
      $('#codigo').val(task.codigo);
      edit = true;
    });
    e.preventDefault();
  });


  $(document).on('click', '.task-delete', (e) => {
    if(confirm('Are you sure you want to delete it?')) {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const codigo = $(element).attr('codigo');
      $.post('task-delete.php', {codigo}, (response) => {
        fetchTasks();
      });
    }
  });
});
