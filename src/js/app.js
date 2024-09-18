let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;
const cita = {
  id: '',
  nombre: '',
  fecha: '',
  hora: '',
  servicios: []
};
const dias = [0]; //0=Domingo, 1= Lunes, 2=Martes, etc...

document.addEventListener('DOMContentLoaded', function(){
  iniciarApp();
});

function iniciarApp(){
  mostrarSeccion(); //Muestra y Oculta la informacipon de los Tabs
  tabs();  //Cambia la seccion cuando se presione los tabs
  botonesPaginador(); //Agrega o quita los botones del Paginador
  paginaSiguiente();
  paginaAnterior();
  consultarAPI(); //Consulta la API en el Backend de PHP
  idCliente();  //Añade el ID del Cliente al objeto de Cita
  nombreCliente();  //Añade el Nombre del Cliente al objeto de Cita
  seleccionarFecha(); //Añade la Fecha de la Cita en el Objeto
  seleccionarHora(); //Añade la Hora de la Cita en el Objeto
  mostrarResumen(); //Muestra el Resumen de las Citas
}

function mostrarSeccion(){
  //Quitar la seccion que tenga la clase de mostrar
  const seccionAnterior = document.querySelector('.mostrar');
  if(seccionAnterior){
    seccionAnterior.classList.remove('mostrar');
  }
  //Seleccionar la seccion con el paso
  const pasoSelector = `#paso-${paso}`;
  const seccion = document.querySelector(pasoSelector);
  seccion.classList.add('mostrar');
  
  //Quitar la clase de actual al tab anterior
  const tabAnterior = document.querySelector('.actual');
  if(tabAnterior){
    tabAnterior.classList.remove('actual');
  }
  //Resaltar el Tab Actual
  const tab = document.querySelector(`[data-paso="${paso}"]`);
  tab.classList.add('actual');
}

function tabs(){
  const botones = document.querySelectorAll('.tabs button');
  botones.forEach(boton =>{
    boton.addEventListener('click', function(e){
      paso = parseInt(e.target.dataset.paso);
      mostrarSeccion()
      botonesPaginador();
    })
  })
}

function botonesPaginador(){
  const paginaAnterior = document.querySelector('#anterior');
  const paginaSiguiente = document.querySelector('#siguiente');
  
  switch(paso){
    case 1:
      paginaAnterior.classList.add('boton-disabled');
      paginaAnterior.classList.remove('boton');
      paginaSiguiente.classList.remove('boton-disabled');
      paginaSiguiente.classList.add('boton');
      break;
    //case 2:
    case 2:
      paginaAnterior.classList.add('boton');
      paginaSiguiente.classList.add('boton');
      paginaAnterior.classList.remove('boton-disabled');
      paginaSiguiente.classList.remove('boton-disabled');  
      //if(paso===3){
      //  mostrarResumen();
      //}
      break;
    case 3:
      paginaAnterior.classList.remove('boton-disabled');
      paginaAnterior.classList.add('boton');
      paginaSiguiente.classList.add('boton-disabled');
      paginaSiguiente.classList.remove('boton');
      mostrarResumen();
      break;
  }
  /*
  if(paso===1){
    paginaAnterior.classList.add('boton-disabled');
    paginaAnterior.classList.remove('boton');
    paginaSiguiente.classList.remove('boton-disabled');
    paginaSiguiente.classList.add('boton');
  }else if(paso===4){
    paginaAnterior.classList.remove('boton-disabled');
    paginaAnterior.classList.add('boton');
    paginaSiguiente.classList.add('boton-disabled');
    paginaSiguiente.classList.remove('boton');
    mostrarResumen();
  }else{
    paginaAnterior.classList.add('boton');
    paginaSiguiente.classList.add('boton');
    paginaAnterior.classList.remove('boton-disabled');
    paginaSiguiente.classList.remove('boton-disabled');
  }
    */
  mostrarSeccion()
}

function paginaAnterior(){
  const paginaAnterior = document.querySelector('#anterior');
  paginaAnterior.addEventListener('click', function(){
    if(paso<=pasoInicial) return;
    paso--;
    botonesPaginador();
  });
}

function paginaSiguiente(){
  const paginaSiguiente = document.querySelector('#siguiente');
  paginaSiguiente.addEventListener('click', function(){
    if(paso>=pasoFinal) return;
    paso++;
    botonesPaginador();
  });
}

async function consultarAPI(){

  try {
    //const url = `${location.origin}/api/servicios`;
    const url = '/api/servicios'; // Si el proyecto y el backend y los este archivo en el mismo dominio
    const resultado = await fetch(url);
    const servicios = await resultado.json();
    mostrarServicios(servicios);  
  } catch (error) {
    console.log(error);
  }
}

function mostrarServicios(servicios){
  servicios.forEach(servicio=>{
    const {id, nombre, precio} = servicio;
    const nombreServicio = document.createElement('P');
    nombreServicio.classList.add('nombre-servicio');
    nombreServicio.textContent = nombre;
    const precioServicio = document.createElement('P');
    precioServicio.classList.add('precio-servicio');
    precioServicio.textContent = `$ ${precio}`;

    const servicioDiv = document.createElement('DIV');
    servicioDiv.classList.add('servicio');
    servicioDiv.dataset.idServicio = id;
    servicioDiv.onclick = function(){
      seleccionarServicio(servicio);
    }
    servicioDiv.appendChild(nombreServicio);
    servicioDiv.appendChild(precioServicio);

    document.querySelector('#servicios').appendChild(servicioDiv);
  });
}

function seleccionarServicio(servicio){
  const {id} = servicio;
  const {servicios} = cita;
  //Identificar al Elemento que se le da click
  const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
  //comprobar si un servicio ya fue agregado
  if(servicios.some(agregado => agregado.id === id)){
    //Eliminarlo
    cita.servicios = servicios.filter(agregado => agregado.id !== id)
    divServicio.classList.remove('seleccionado');
  }else{
    //Agregarlo
    cita.servicios = [...servicios, servicio];
    divServicio.classList.add('seleccionado');  
  }
}

function idCliente(){
  cita.id = document.querySelector('#id').value;
}

function nombreCliente(){
  cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha(){
  const inputFecha = document.querySelector('#fecha');
  inputFecha.addEventListener('input', function(e){
    const dia = new Date(e.target.value).getUTCDay();
    if(dias.includes(dia)){
      e.target.value = '';
      mostrarAlerta('Domingo no Abrimos', 'error', '#paso-1 p');
    }else{
      cita.fecha = e.target.value;
    }
  });
}

function seleccionarHora(){
  const inputHora = document.querySelector('#hora');
  inputHora.addEventListener('input', function(e){
    const horaCita = e.target.value;
    const hora = horaCita.split(":")[0];  //Selecciona solo la hora
    if(hora<10 || hora>20){
      e.target.value = '';
      mostrarAlerta('Hora No Válida', 'error', '#paso-1 p');
    }else{
      cita.hora = e.target.value;
    }
  });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece=true){
  //Previene que se genere mas de 1 alerta
  const alertaPrevia = document.querySelector('.alerta');
  if(alertaPrevia){
    alertaPrevia.remove();
  }
  //Scripting para crear la alerta
  const alerta = document.createElement('DIV');
  alerta.textContent = mensaje;
  alerta.classList.add('alerta');
  alerta.classList.add(tipo);
  const referencia = document.querySelector(elemento);
  referencia.appendChild(alerta);
  if(desaparece){
    //Eliminar la alerta
    setTimeout(()=>{
      alerta.remove();
      alertaPrevia.remove();
    }, 3000);
  }
}

function mostrarResumen(){
  const resumen = document.querySelector('.contenido-resumen');
  resumen.innerHTML = '';
  //Limpiar el contenido de Resumen
  while(resumen.firstChild){
    resumen.removeChild(resumen.firstChild);
  }
  if(Object.values(cita).includes('') || cita.servicios.length===0){
    mostrarAlerta('Faltan Datos de Servicios, Fecha u Hora', 'error', '.contenido-resumen', false);
    return;
  }
  //Formatear el Div de Resumen
  const {nombre, fecha, hora, servicios} = cita;

  //Heading para Resumen de Datos del Cliente
  const headingCita = document.createElement('H3');
  headingCita.textContent = 'Resumen de Cita';
  resumen.appendChild(headingCita);

  const nombreCliente = document.createElement('P');
  nombreCliente.innerHTML = `<span>Nombre: </span> ${nombre}`;

  const fechaCita = document.createElement('P');
  fechaCita.innerHTML = `<span>Fecha: </span> ${obtenerFechaFormateada(fecha)}`;

  const horaCita = document.createElement('P');
  horaCita.innerHTML = `<span>Hora: </span> ${hora} Horas`;

  const append = document.createElement('HR');
  
  resumen.appendChild(nombreCliente);
  resumen.appendChild(fechaCita);
  resumen.appendChild(horaCita);
  resumen.appendChild(append);
  
  //Heading para Servicios en Resumen
  const headingServicios = document.createElement('H3');
  headingServicios.textContent = 'Resumen de Servicios';
  resumen.appendChild(headingServicios);

  const verificarServicios = document.createElement('P');
  verificarServicios.classList.add('text-center')
  verificarServicios.textContent = 'Verifica que la Información sea Correcta';
  resumen.appendChild(verificarServicios);

  //Iterar y mostrar los servicios
  servicios.forEach(servicio=>{
    const { id, precio, nombre} = servicio;
    const contenedorServicio = document.createElement('DIV');
    contenedorServicio.classList.add('contenedor-servicio');
    
    const textoServicio = document.createElement('P');
    textoServicio.textContent = nombre;

    const precioServicio = document.createElement('P');
    precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

    contenedorServicio.appendChild(textoServicio);
    contenedorServicio.appendChild(precioServicio);
    
    resumen.appendChild(contenedorServicio);
  })

  // Boton para Crear una cita
  const botonReservar = document.createElement('BUTTON');
  botonReservar.classList.add('boton');
  botonReservar.textContent = 'Reservar Cita';
  botonReservar.onclick = reservarCita;
  resumen.appendChild(botonReservar);
}

function obtenerFechaFormateada(fecha){
  const fechaObj = new Date(fecha);
  const mes = fechaObj.getMonth();
  const dia = fechaObj.getDate() + 2;
  const year = fechaObj.getFullYear();

  const fechaUTC = new Date(Date.UTC(year, mes, dia));
  const opciones = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
  //const fechaFormateada = fechaUTC.toLocaleDateString('es-MX', opciones);
  const fechaFormateada = fechaUTC.toLocaleDateString(undefined, opciones);
  return fechaFormateada;
}

async function reservarCita(){
  const { nombre, fecha, hora, servicios, id } = cita;
  const idServicios = servicios.map(servicio => servicio.id);
  //Ordenar el Arreglo por ID asc
  idServicios.sort();
  const datos = new FormData();
  //Agregar Datos
  datos.append('fecha', fecha);
  datos.append('hora', hora);
  datos.append('usuarioId', id);
  datos.append('servicios', idServicios);
  //console.log([...datos]);
  //Petición hacia la API
  try {
    //const url = 'http://localhost:3000/api/citas';
    const url = '/api/citas';
    const respuesta = await fetch(url, {
      method: 'POST',
      body: datos
    })
    const resultado = await respuesta.json();
    if(resultado.resultado){
      Swal.fire({
        icon: "success",
        title: "Cita Creada",
        text: "Tu Cita Fue Creada Satisfactoriamente!"
      }).then(()=>{
        setTimeout(()=>{
          window.location.reload();
        }, 200);
      })
    }  
  }catch (error) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Hubo un Error al Guardar la Cita"
    });
  }
  //console.log([...datos]);
}
