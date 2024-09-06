$(function() {
    if(directOpenPage){
        openPage(directOpenPage);
    }
});

//#region Fungsi-fungsi
    function openPage(page){
        if(event)event.preventDefault();
        console.log(page)
        $.ajax({
            url :`${baseURL}/page`,
            type: 'POST',
            dataType :'JSON',
            data : {
                page:page
            },
            success :(res)=>{
                console.log(res)
                $("#page-element").html(res.view);
            },
            error : (_xhr, _status, _err)=>{
                console.log(_xhr);
            }
        })
    }
//#endregion

//#region Events

//#endregion
