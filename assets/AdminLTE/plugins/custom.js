
function cari_supplier() {
    $('#modal-lg').modal('show'); // show bootstrap modal
    $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
}

$(document).on('click', '.pilih_suppliers', function(e) {
    document.getElementById("id_supplier").value = $(this).attr('data-kode');

    document.getElementById("supplier_name").value = $(this).attr('data-nama');

    $('#modal-lg').modal('hide');
});


function toastsDefaultSuccess() {
  $(document).Toasts("create", {
    class: "bg-success",
    title: "Toast Title",
    subtitle: "Subtitle",
    body: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
  });
}