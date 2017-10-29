$(function () {
    crearTabla("administrador", 7, 'gestionEmpresa');
    mensaje("alertamensaje", 'hidden');

    mensaje("alertamensaje", 'hidden');
    $("#tabempresas").click(function () {
        crearTabla("administrador", 7, 'gestionEmpresa');
        mensaje("alertamensaje", 'hidden');
        $(".datosempresa").limpiarCampos();
    })


    $("#registrarempresa").click(function () {
        var valido = $(".datosempresa").valida();
        mensaje("alertamensaje", 'hidden');

        var datos = $("#formEmpresas").serialize();

        if (valido == 0) {
            var res = crud(datos, 'empresas/gestion');
            res.success(function (data) {
                if (data.error) {
                    mensaje("alertamensaje", 'error', data.error);
                } else {
                    mensaje("alertamensaje");
                    crearTabla("administrador", 7, 'gestionEmpresa');
                }
            })
        } else {
            mensaje("alertamensaje", 'error');
        }

    });
    $("#nuevoempresa").click(function () {
        $(".datosempresa").limpiarCampos();
        mensaje("alertamensaje", 'hidden');
    });
})

function gestionEmpresa(id) {
    $("#formEmpresas #id").attr("disabled", false);
    var obj = {};
    obj.id = id;
    var res = crud(obj, 'empresas/cargaDatos');
    res.success(function (data) {
        $(".datosempresa").cargarCampos(data, false);
    })
}

function borrarEmpresa(id, clase) {
    $("#" + id).empty();
    var obj = {};
    obj.id = id;
    var res = crud(obj, 'empresas/borrar');
    crearTabla("administrador", 7, 'gestionEmpresa');
    mensaje("alertamensaje");
}


function table() {
    return $('#tablaadministrador').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "administrador/cargaTabla",
            method: "get"
        },
        columns: [
            {data: "id"},
            {data: "nombre"},
            {data: "nit"},
            {data: "direccion"},
            {data: "telefonos"},
            {data: "contacto"},
            {data: "estado"},
        ],
        order: [[1, 'ASC']],
        aoColumnDefs: [
            {
                aTargets: [0, 1, 2, 3, 4, 5, 6],
                mRender: function (data, type, full) {
                    return '<a href="#" onclick="gestionEmpresa(' + full.id + ')">' + data + '</a>';
                }
            },
            {
                targets: [7],
                searchable: false,
                mData: null,
                mRender: function (data, type, full) {
                    return '<button class="btn btn-danger btn-xs" onclick="borrarEmpresa(' + data.id + ')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
                }
            }
        ],
    });
}