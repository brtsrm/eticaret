require('./bootstrap');

setTimeout(function() {
    $(".alert").slideUp();
}, 4000);

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".urun_azalt, .urun_arttir").on("click", function() {
    var urunRowId = $(this).attr("data-rowid");
    var urunAdet = $(this).attr("data-adet");
    $.ajax({
        type: "PUT",
        url: '/sepet/guncelle',
        data: {
            urunrowid: urunRowId,
            urunadet: urunAdet
        },
        success: function(e) {

            $(".urunadet").html(e.urun_adet);

            window.location.href = '/sepet';

        }
    })
});