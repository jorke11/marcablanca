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

    this.countData = function (type) {
        var form = {}, html = '', checked = '';
        form = obj.getDataFilter();
        form.type = type;

        $.ajax({
            url: $("#ruta").val() + 'exceltemplatesend/countFilter',
            type: "POST",
            data: form,
            dataType: 'JSON',
            success: function (data) {
                $("#txtquantity").html("Contactos filtados: " + data.quantity);

                if (data.mark.type != "filter1") {
                    if (data.filter.filter1 != undefined) {
                        html = '';
                        $("#list-filter-1").empty();
                        $.each(data.filter.filter1, function (i, j) {
                            if (data.mark.filter1 != undefined) {
                                $.each(data.mark.filter1, function (a, val) {
                                    if (val == j.filtro1) {
                                        checked = 'checked'
                                    }
                                });
                            }
                            html += '<li class="list-group-item"><input type="checkbox" ' + checked + ' class="filter-1" onclick=obj.countData("filter1") value="' + j.filtro1 + '" name="filter1[]">' + j.filtro1 + '</li>';
                            checked = '';
                        })
                        $("#list-filter-1").html(html);
                    }
                }

                if (data.mark.type != "filter2") {
                    if (data.filter.filter2 != undefined) {
                        html = '';
                        $("#list-filter-2").empty();
                        $.each(data.filter.filter2, function (i, j) {
                            if (data.mark.filter2 != undefined) {

                                $.each(data.mark.filter2, function (a, val) {
                                    if (val == j.filtro2) {
                                        checked = 'checked'
                                    }
                                });
                            }
                            html += '<li class="list-group-item"><input type="checkbox" ' + checked + ' class="filter-2" onclick=obj.countData("filter2") value="' + j.filtro2 + '" name="filter2[]">' + j.filtro2 + '</li>';
                            checked = '';
                        })
                        $("#list-filter-2").html(html);
                    }
                }

                if (data.mark.type != "filter3") {
                    if (data.filter.filter3 != undefined) {
                        html = '';
                        $("#list-filter-3").empty();
                        $.each(data.filter.filter3, function (i, j) {

                            if (data.mark.filter3 != undefined) {

                                $.each(data.mark.filter3, function (a, val) {
                                    if (val == j.filtro3) {
                                        checked = 'checked'
                                    }
                                });
                            }

                            html += '<li class="list-group-item"><input type="checkbox" ' + checked + ' class="filter-3" onclick=obj.countData("filter3") value="' + j.filtro3 + '" name="filter3[]">' + j.filtro3 + '</li>';
                            checked = '';
                        })
                        $("#list-filter-3").html(html);
                    }
                }
                if (data.mark.type != "filter4") {
                    if (data.filter.filter4 != undefined) {
                        html = '';
                        $("#list-filter-4").empty();
                        $.each(data.filter.filter4, function (i, j) {

                            if (data.mark.filter4 != undefined) {

                                $.each(data.mark.filter4, function (a, val) {
                                    if (val == j.filtro4) {
                                        checked = 'checked'
                                    }
                                });
                            }

                            html += '<li class="list-group-item"><input type="checkbox" ' + checked + ' class="filter-4" onclick=obj.countData("filter4") value="' + j.filtro4 + '" name="filter4[]">' + j.filtro4 + '</li>';
                            checked = '';
                        })
                        $("#list-filter-4").html(html);
                    }
                }

                if (data.mark.type != "filter5") {
                    if (data.filter.filter5 != undefined) {
                        html = '';
                        $("#list-filter-5").empty();
                        $.each(data.filter.filter5, function (i, j) {

                            if (data.mark.filter5 != undefined) {

                                $.each(data.mark.filter5, function (a, val) {
                                    if (val == j.filtro5) {
                                        checked = 'checked'
                                    }
                                });
                            }

                            html += '<li class="list-group-item"><input type="checkbox" ' + checked + ' class="filter-5" onclick=obj.countData("filter5") value="' + j.filtro5 + '" name="filter5[]">' + j.filtro5 + '</li>';
                            checked = '';
                        })
                        $("#list-filter-5").html(html);
                    }
                }

                if (data.mark.type != "filter6") {
                    if (data.filter.filter6 != undefined) {
                        html = '';
                        $("#list-filter-6").empty();
                        $.each(data.filter.filter6, function (i, j) {

                            if (data.mark.filter6 != undefined) {

                                $.each(data.mark.filter6, function (a, val) {
                                    if (val == j.filtro6) {
                                        checked = 'checked'
                                    }
                                });
                            }

                            html += '<li class="list-group-item"><input type="checkbox" ' + checked + ' class="filter-6" onclick=obj.countData("filter6") value="' + j.filtro6 + '" name="filter6[]">' + j.filtro6 + '</li>';
                            checked = '';
                        })
                        $("#list-filter-6").html(html);
                    }
                }
            }
        });
    }
}

var obj = new exceltempleate();
obj.init();