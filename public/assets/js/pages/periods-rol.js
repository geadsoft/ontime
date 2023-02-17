function fechaMes() {
    
    var mes   = document.getElementById("cmbmes").value;
    var tipo  = document.getElementById("cmbtipo").value;
    var fecha = new Date();
    var anio  = fecha.getFullYear();

    switch (mes){
        case 1 :
            mes = 0
        case 2: 
            mes = 1
        case 3: 
            mes = 2
        case 4: 
            mes = 3
        case 5: 
            mes = 4
        case 6: 
            mes = 5
        case 7: 
            mes = 6
        case 8: 
            mes = 7
        case 9: 
            mes = 8
        case 10: 
            mes = 9
        case 11: 
            mes = 10
        case 12: 
            mes = 11
    }
    
    fecha = anio.toString()+'-'+mes.toString()+'-01';

    var fechaini = new Date(fecha);
    var fechafin = new Date(fechaini.getFullYear(),fechaini.getMonth()+1,0);

    if (tipo=="Q"){
        fechafin.setDate(fechaini.getDate()+14);
    }

    document.getElementById("dfechaini").value = formatDateIni(fechaini);
    document.getElementById("dfechafin").value = formatDateFin(fechafin);

    

    
}

function formatDateIni(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

function formatDateFin(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}