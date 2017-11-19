var valida, path = "", intervalo;
$(function () {
    var smslong = 0, cupo = 0, concatena = 0, next = 0;
    $("#message").cuentaPalabras("#contentMessage");
    $("#btnClean").click(function () {
        $("#destination,#message,#note").val("");
        $("#contentMessage").html("");
        $("#txtcodigo").html("");
        $(".progress-bar").css("width", "0%");
        $("#txtprocess").html("0%");
    })

    $("#btnConsolidate").click(function () {
        var msg = '';

        $("#btnSendMsg").attr("disabled", false);


        if ($("#message").val() != '') {
            $.ajax({
                url: 'exceltemplatesend/getCupo',
                type: "POST",
                dataType: 'JSON',
                async: false,
                success: (function (data) {
                    concatena = data.concatena;
                    next = data.next;
                    cupo = data.cupo.disponible;
                })
            })

            if (concatena != "1" && ($("#message").val()).length > 160) {
                toastr.error("No tiene permitido enviar mas de 160 caracteres, favor contactarse con el área de soporte de CONTACTOSMS");
                return false;
            }


            msg = $("#message").val();

            processData();


        } else {
            $("#message,#note").addClass("error");
            toastr.error("El Mensaje");
        }

    })
});

function countData() {

}


function processData() {
    var form = {};

    var form = obj.getDataFilter();
    form.client_id = $("#client_id").val();
    form.message = $("#message").val();

    $.ajax({
        url: 'exceltemplatesend/cargaExcel',
        type: "POST",
        async: true,
        data: form,
        dataType: 'JSON',
        success: function (data) {
            if (data.status == true) {
                toastr.success("proceso Realizado!");
                $("#txtcodigo").empty().html("Codigo Verificación: <b>" + data.idbase + "</b>");
                $("#btnConsolidate,#btnClean").attr("disabled", false);
                $("#close").attr("disabled", false);
                $("#loading").addClass("hidden");
            }

        }
    });
}




function exceltempleate() {
    this.init = function () {

    }

    this.getDataFilter = function () {
        var form = {};

        var filter1 = [], filter2 = [], filter3 = [], filter4 = [], filter5 = [], filter6 = [];

        $(".filter-1").each(function () {
            if ($(this).is(":checked")) {
                filter1.push($(this).val());
            }
        })
        $(".filter-2").each(function () {
            if ($(this).is(":checked")) {
                filter2.push($(this).val());
            }
        })
        $(".filter-3").each(function () {
            if ($(this).is(":checked")) {
                filter3.push($(this).val());
            }
        })
        $(".filter-4").each(function () {
            if ($(this).is(":checked")) {
                filter4.push($(this).val());
            }
        })
        $(".filter-5").each(function () {
            if ($(this).is(":checked")) {
                filter5.push($(this).val());
            }
        })
        $(".filter-6").each(function () {
            if ($(this).is(":checked")) {
                filter6.push($(this).val());
            }
        })

        form.filter1 = filter1;
        form.filter2 = filter2;
        form.filter3 = filter3;
        form.filter4 = filter4;
        form.filter5 = filter5;
        form.filter6 = filter6;
        return form;
    }

    this.countData = function () {
        var form = {};
        form = obj.getDataFilter();

        $.ajax({
            url: $("#ruta").val() + 'exceltemplatesend/countFilter',
            type: "POST",
            data: form,
            dataType: 'JSON',
            success: function (data) {

                $("#txtquantity").html("Contactos filtados: " + data.quantity)
            }
        });
    }
}

var obj = new exceltempleate();
obj.init();