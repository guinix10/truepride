document.addEventListener("DOMContentLoaded", function () {
  const isAdmin = localStorage.getItem("isAdmin") === "true";

  const calendarEl = document.getElementById("calendar");
  if (!calendarEl) return;

  let eventos = JSON.parse(localStorage.getItem("eventos")) || [];

  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "pt-br",
    selectable: isAdmin,
    editable: false,
    events: eventos,
    select: function (info) {
      if (isAdmin) {
        const titulo = prompt("Título do evento:");
        const descricao = prompt("Descrição do evento:");
        if (titulo) {
          const novoEvento = {
            title: titulo,
            start: info.startStr,
            description: descricao || ""
          };
          calendar.addEvent(novoEvento);
          eventos.push(novoEvento);
          localStorage.setItem("eventos", JSON.stringify(eventos));
        }
      }
    },
    eventClick: function (info) {
      alert(`Evento: ${info.event.title}\nDescrição: ${info.event.extendedProps.description || 'Sem descrição'}`);
    }
  });

  calendar.render();
});
