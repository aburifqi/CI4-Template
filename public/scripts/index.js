$(function() {
    if(directOpenPage){
        openPage(directOpenPage);
    }
});

//#region Fungsi-fungsi
    function openPage(page){
        if(event)event.preventDefault();

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
//#endregion

//#region Events

//#endregion
