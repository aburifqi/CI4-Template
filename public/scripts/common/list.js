$(document).ready(function(){
    initDataTable(
        $("#tbl-data"),
        baseURL+$("#tbl-data").attr("sumber"),
        function (data) {
            data.action = "list";
            data.searchmode = "in";
        },
        true,
        {
            // columnDefs:[
            //     {
            //         orderable: false,
            //         targets: 0,
            //     },
            // ],
            order  : [[0, 'desc']],
        }
    );
});

function actionColumn(data, type, row, meta) {
    // ${lnkData + row.id}&judul=${judul}
    // ${lnkView + row.id}
    // hapus(this, '${menu}', ${row.id});
    const strRender = `<div class="btn-group">
        <div class="d-flex justify-content-center">
            ${
                izinEdit?
                    `<a href="" class="btn btn-edit p-1 mr-1" data-toggle="tooltip" title="Ubah">
                        <i class="fas fa-edit f-10px"></i>
                    </a>`
                :
                    ''
            }
            ${
                izinLihat?
                    `<a href="" class="btn btn-read p-1 mr-1" data-toggle="tooltip" title="Lihat">
                        <i class="far fa-eye f-10px"></i>
                    </a>`
                :
                    ''
            }
            ${
                izinHapus?
                    `<a href="javascript:void(0)" class="btn btn-delete p-1" data-toggle="tooltip" title="Hapus" onclick = "">
                        <i class="fas fa-trash-alt f-10px"></i>
                    </a>`
                :
                    ''
            }
        </div>
    </div>`;

    return strRender;
}

async function hapus(obj, menu="", id=0){
    let confirm = await Swal.fire({
        title: "Konfirmasi",
        text: "Apakah Anda yakin ingin menghapusnya?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Batal",
        confirmButtonText: "Yakin",
    });

    if (!confirm.isConfirmed) return;

    let curTable = $(obj).closest("table");

    $.ajax({
        url: lnkCtrl,
        type: "POST",
        dataType: "JSON",
        data: {
            action: "delete",
            menu:menu,
            id: id, 
        },
        success: (data) => {
            if (data.hasil) {
                $(curTable).DataTable().ajax.reload();
                $.toast({
                    heading: "Berhasil",
                    text: data.message,
                    showHideTransition: "slide",
                    position: "bottom-right",
                    hideAfter: 1500,
                    icon: "success",
                });
            } else {
                $.toast({
                    heading: "Gagal",
                    text: data.message,
                    showHideTransition: "slide",
                    position: "bottom-right",
                    hideAfter: 1500,
                    icon: "error",
                });
            }
        },
        error: (_xhr, status, err) => {
            console.log(_xhr);
        },
    });
}

$("#simplePos").on("draw.dt", function(){
    // const tombolPage = $(".dt-paging.paging_full_numbers");
    const tombolPage = $(".dt-paging");

    // var events = $("#the_link").data('events');
    // var $other_link = $("#other_link");
    // if ( events ) {
    //     for ( var eventType in events ) {
    //         for ( var idx in events[eventType] ) {
    //             // this will essentially do $other_link.click( fn ) for each bound event
    //             $other_link[ eventType ]( events[eventType][idx].handler );
    //         }
    //     }
    // }
    // $(tombolPage).hide();
    $(".blok-tombol").append(tombolPage);
});