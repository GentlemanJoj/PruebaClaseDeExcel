let calendario=new FullCalendar.Calendar(document.getElementById("calendario"),{events:"/api/events",locale:"es",headerToolbar:{left:"prev,next today",center:"title",right:"dayGridMonth,timeGridWeek,timeGridDay"}});calendario.render();