$(document).ready(function(){
        
    var inivName = $('#name').val();
    var inivSname = $('#sname').val();
    var inicorreo = $('#email').val();
    var inifecnac = $('#bdate').val();
    var initel = $('#phone').val();
    var initelcont = $('#cphone').val();

    var inisemEmp = $('#semEmp').val();
    var inimat = $('#matricula').val();
    console.log(inivName + ' - ' + inivSname + ' - '+inicorreo);


    $('#btnEnviar').click(function(){  
        var vName = $('#name').val();
        var vSname = $('#sname').val();
        var correo = $('#email').val();
        var fecnac = $('#bdate').val();
        var tel = $('#phone').val();
        var telcont = $('#cphone').val();

        var semEmp = $('#semEmp').val();
        var mat = $('#matricula').val();
        var idusr = $('#iduser').val();
        var idsesn = $('#idsesion').val();
        var idrl = $('#idrol').val();

        //Valida si hay cambios en los campos del formulario
        if (inivName == vName && inivSname==vSname && inicorreo==correo && inifecnac==fecnac && initel==tel && initelcont==telcont && inisemEmp==semEmp && inimat==mat){
            $.alert('No hay cambios que guardar')
        } else {
        
            $.ajax({
                url: 'includes/profile.inc.php',
                type: 'POST',
                data: {name: vName, sname: vSname, email: correo, bdate: fecnac, phone: tel, cphone: telcont, semEmp: semEmp, matricula: mat, iduser: idusr, idsesion: idsesn, idrol: idrl},
            })
            .done(function(res){
                $('#respuesta').html(res)
            })
            .fail(function(){
                console.log("Fallo");
            })
            .always(function(){
                console.log("Complete");
            });
        }
    });
    
    //Validar sólo números en el campo de teléfono
    $("#phone").on('input', function (evt) {
        // Permite sólo números
        this.value = (this.value + '').replace(/[^0-9]/g, '');
    });

    //Validar sólo letras en el campo de nombre
    $("#name").on('input', function (evt) {
        // Permite sólo letras
        this.value = (this.value + '').replace(/[^a-zA-Z ]/g, '');
    });

    //Validar sólo letras en el campo de Apellidos
    $("#sname").on('input', function (evt) {
        // Permite sólo letras
        this.value = (this.value + '').replace(/[^a-zA-Z ]/g, '');
    });

     //Validar sólo números en el campo de teléfono
     $("#matricula").on('input', function (evt) {
        // Permite dos letras mayúsculas y 10 números
        //this.value = (this.value + '').replace(/[A-Z]{3}|[0-9]{11}/g, '');
        this.value = (this.value + '').replace(/[^A-Z0-9]/g, '');
    });
});