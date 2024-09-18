document.addEventListener('DOMContentLoaded', function(){
  iniciarApp();
});

function iniciarApp(){
  buscarPorFecha();
}

function buscarPorFecha(){
  const fechaInput = document.querySelector('#fecha');
  fechaInput.addEventListener('input', function(e) {
    const fechaSeleccionada = e.target.value;
    window.location = `?fecha=${fechaSeleccionada}`;
  });
}

function servicioCreado(e) {
  e.preventDefault(); // Previne el envío del formulario inmediatamente
  Swal.fire({
      icon: 'question',
      title: '¿Desea guardar el servicio?',
      showCancelButton: true,
      confirmButtonText: 'Sí, guardar',
      cancelButtonText: 'No, cancelar'
  }).then((result) => {
      if (result.isConfirmed) {
          // Si el usuario confirma, envía el formulario.
          e.target.form.submit();
      }
  });
}

function servicioActualizado(e) {
  e.preventDefault(); // Previne el envío del formulario inmediatamente
  Swal.fire({
      icon: 'question',
      title: '¿Desea actualizar el servicio?',
      showCancelButton: true,
      confirmButtonText: 'Sí, actualizar',
      cancelButtonText: 'No, cancelar'
  }).then((result) => {
      if (result.isConfirmed) {
          // Si el usuario confirma, envía el formulario.
          e.target.form.submit();
      }
  });
}

function confirmDelete(event, id) {
  const eliminarCita = document.querySelector(id);
  eliminarCita.addEventListener('click', e=>{
    event.preventDefault(); // Previne el envío del formulario inmediatamente
    Swal.fire({
        title: 'Confirmación',
        text: '¿Estás seguro de Eliminar el registro Seleccionado?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector(id).submit();
        }
    });
  })
}

