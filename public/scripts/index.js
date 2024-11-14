$(function() {
    if(directOpenPage){
        openPage(directOpenPage);
    }
});

//#region Fungsi-fungsi
    function openPage(page){
        if(event)event.preventDefault();
        $("#page-element").html(
            `
            <h1>Sedang memuat halaman...</h1>
            `
        );
        $.ajax({
            url :`${baseURL}/page`,
            type: 'POST',
            dataType :'JSON',
            data : {
                page:page
            },
            success :(res)=>{
                console.log(res)
                const elemen = $('<div></div>');
                $(elemen).html(res.view);
                const injectStyle = $(elemen).find("injectstyle");
                const injectPage = $(elemen).find("injectpage");
                const injectScript = $(elemen).find("injectscript");
                $("#page-element").html($(injectPage).html());
                $("injectstyle").html($(injectStyle).html());
                $("injectscript").html($(injectScript).html());
            },
            error : (_xhr, _status, _err)=>{
                console.log(_xhr);
            }
        })
    }

    function tos(judul = '', pesan = '', jenis = '', durasi = 1500){
        $.toast({
            heading: judul,
            text: pesan,
            showHideTransition: "slide",
            position: "bottom-right",
            hideAfter: durasi,
            icon: jenis,
        });
    }
//#endregion

//#region Events

//#endregion
