$(function() {
    if(directOpenPage){
        // Ini untuk klik kanan menu trus ke tab halaman lain di browser
        // openPage(directOpenPage);
        // sessionStorage.clear();
        // sessionStorage.setItem('current-page', directOpenPage);
        const curLink = $(`.menu-items a[onclick="openPage(${directOpenPage});"]`);
        $(curLink).trigger("click");
        $(curLink).parents(`.menu-items`).addClass('active');
        return;
    }
    currentPage = sessionStorage.getItem('current-page');
    if(!parseInt(currentPage))return;
    const curLink = $(`.menu-items a[onclick="openPage(${currentPage});"]`);
    $(curLink).trigger("click");
    $(curLink).parents(`.menu-items`).addClass('active');
});

//#region Fungsi-fungsi
    function openPage(page){
        if(event)event.preventDefault();
        $("#page-element").html(
            `
            <h1>Sedang memuat halaman...</h1>
            `
        );
        sessionStorage.setItem('current-page', page);
        $.ajax({
            url :`${baseURL}/page`,
            type: 'POST',
            dataType :'JSON',
            data : {
                page:page
            },
            success :(res)=>{
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
