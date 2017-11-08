function Master() {
    var tableMaster;
    this.init = function () {
        $("#btnSave").click(this.save);
        $("#btnNew").click(this.new);
        tableMaster = obj.table();

    }


    this.save = function () {
        $("#archivo_id").val("");
        var formData = new FormData($("#frm")[0]);
        if (parseInt($("#frm #cupototal").val()) >= parseInt($("#frm #maximo_servicio").val())) {
            $.ajax({
                url: "master/store",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (data) {
                    toastr.success("Operacion realizada");
                    $(".input-master").cargarCampos(data.data, false);
                    $("#frm #preview").attr("src", data.data.url);
                    tableMaster.ajax.reload();

                }
            });
        } else {
            toastr.error("Maximo servicio no puede ser mayor al cupo asignado!");
        }
    }

    this.tableExcel = function (detail) {
        var html = "";
        $("#tblResult tbody").empty();
        $.each(detail, function (i, val) {
            html += "<tr><td>" + val.numero + "</td>";
            html += '<td><button class="btn btn-warning btn-xs" type="button" onclick=obj.deleteItem(' + val.id + ',' + val.archivo_id + ')> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td></tr>';
        })
        $("#tblResult tbody").html(html);
    }

    this.table = function () {

        return $('#tableMarca').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "master/ListMarcas",
            },
            columns: [
                {data: "id"},
                {data: "nombre"},
                {data: "nit"},
                {data: "contacto"},
                {data: "celular1"},
                {data: "mensaje"},
            ],
            order: [[1, 'ASC']],
            aoColumnDefs: [
                {
                    aTargets: [0, 1, 2, 3, 4, 5],
                    mRender: function (data, type, full) {
                        return '<a href="#" onclick="obj.show(' + full.id + ')">' + data + '</a>';
                    }
                },
//                {
//                    targets: [4],
//                    searchable: false,
//                    mData: null,
//                    mRender: function (data, type, full) {
//                        return '<button class="btn btn-danger btn-xs" onclick="obj.delete(' + data.id + ')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
//                    }
//                }
            ],
        });
    }

    this.new = function (id) {
        $(".input-master").limpiarCampos();
        $("#preview").attr("src", "")
    }

    this.show = function (id) {
        $.ajax({
            url: "master/getMarca/" + id,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                $(".input-master").cargarCampos(data.datos, false);

                $.each(data.preferencia, function (i, val) {
                    $(".preferencias").each(function () {
                        if (($(this).attr("id")).trim() == i.trim()) {
                            $(this).val(val);
                        }
                    })
                })

                $("#preview").attr("src", data.url)
            }
        })
    }

}

var obj = new Master();
obj.init();