(function ($) {
    'use strict';

    $.fn.bootstrapTable.locales['es-ES'] = {
        formatLoadingMessage: function () {
            return '<div class="alert alert-dark" role="alert" style="text-align: center;"><img src="../img/company/load1.svg" style="width: 30px;"><br><strong>Espera un momento por favor.</strong> Estamos cargando los datos en la tabla.</div>';
        },
        formatRecordsPerPage: function (pageNumber) {
            return pageNumber + ' registros por página';
        },
        formatShowingRows: function (pageFrom, pageTo, totalRows) {
            return 'Mostrando de ' + pageFrom + ' a ' + pageTo + ' registros de ' + totalRows + ' registros en total';
        },
        formatSearch: function () {
            return 'Buscar';
        },
        formatNoMatches: function () {
            return '<div class="alert alert-primary" role="alert" style="text-align: center;"><img src="../assets/images/error/internal-server.svg" style="width: 250px;"><br><strong>Oopss!</strong> No se han encontrado registros en nuestra base de datos.</div>';
        },
        formatRefresh: function () {
            return 'Actualizar';
        },
        formatToggle: function () {
            return 'Alternar';
        },
        formatPaginationSwitch: function () {
            return 'Ocultar/Mostrar paginación';
        },
        formatAllRows: function () {
            return 'Todo';
        },
        formatColumns: function () {
            return 'Columnas';
        }
    };

    $.extend($.fn.bootstrapTable.defaults, $.fn.bootstrapTable.locales['es-ES']);

})(jQuery);