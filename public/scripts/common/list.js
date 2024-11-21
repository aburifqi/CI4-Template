$(document).ready(function(){
    initDataTable(
        $("#simplePos"),
        $("#simplePos").attr("controller"),
        function (data) {
            data.action = "list";
            data.searchmode = "in";
            data.searchCustom = ()=>{
                if(!$("#inp-cari-custom").length)return '';
                return $("#inp-cari-custom").val();
            }
        },
        true,
        {
            columnDefs:[
                {
                    orderable: false,
                    targets: 0,
                },
                {
                    orderable: false,
                    targets: $("#simplePos .filter-row th").length - 1,
                },
            ],
            order  : [[0, 'desc']],
        }
    );
});

function actionColumn(data, type, row, meta) {
    var strRender = `<div class="btn-group">
        <div class="d-flex justify-content-center">
            ${
                otoritas.edit?
                    `<a href="${lnkData + row.id}&judul=${judul}" class="btn btn-edit p-1 mr-1" data-toggle="tooltip" title="Ubah">
                        <i class="fas fa-wrench f-10px"></i>
                    </a>`
                :
                    ''
            }
            ${
                otoritas.view?
                    `<a href="${lnkView + row.id}" class="btn btn-read p-1 mr-1" data-toggle="tooltip" title="Lihat">
                        <i class="far fa-eye f-10px"></i>
                    </a>`
                :
                    ''
            }
            ${
                otoritas.delete?
                    `<a href="javascript:void(0)" class="btn btn-delete p-1" data-toggle="tooltip" title="Hapus" onclick = "hapus(this, '${menu}', ${row.id});">
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