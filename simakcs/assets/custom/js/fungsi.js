$(document).ready(function () {
    $('a[data-confirm]').click(function() {
        var href = $(this).attr('href');
        if (!$('#dataConfirmModal').length) {
            $('body').append(
                '<div class="modal fade" id="dataConfirmModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">' +
                    '<div class="modal-dialog modal-lg">' +
                        '<div class="modal-content">' +
                            '<div class="modal-header">' +
                                '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>' +
                                '<h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>' +
                            '</div>' +

                            '<div class="modal-body"></div>' +

                            '<div class="modal-footer">' +
                                '<button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>' +
                                '<a class="btn btn-primary" id="dataConfirmOK">Ya</a>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );
        }
        $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
        $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show: true});
        return false;
    });
});