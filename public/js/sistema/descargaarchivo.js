$(function () {
    var obj = {};
    obj.url = "descargaarchivo";
    obj.col = 1;
    obj.idtabla = "tabladescarga";
//    cargaTabla(obj);
    var res = crud(obj, 'descargaarchivo/loadFile');
    res.success(function (data) {
    })

    table();
})

function descargar(id) {
    var obj = {};
    obj.id = id;
    var ruta = '';
    var res = crud(obj, 'descargaarchivo/obtienelink');
    res.success(function (data) {
        window.open('descargaarchivo/descargar/' + data.ruta, '_blank');
    })
}


function table() {
    return $('#tabladescarga').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "descargaarchivo/CargarTabla",
            method: "POST"
        },
        columns: [
            {data: "id", searchable: false},
            {data: "nombre"},
            {data: "size", searchable: false},
            {data: "fecha", searchable: false},
            {data: "ruta", searchable: false},
        ],
        order: [[1, 'ASC']],
        aoColumnDefs: [
            {
                aTargets: [0, 1, 2, 3],
                mRender: function (data, type, full) {
                    return '<a href="#" onclick="obj.show(' + full.id + ')">' + data + '</a>';
                }
            },
            {
                targets: [4],
                searchable: false,
                mData: null,
                mRender: function (data, type, full) {
                    return '<button class="btn btn-success btn-xs" onclick="descargar(' + full.id + ')"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></button>';
                }
            }
        ],
    });
}