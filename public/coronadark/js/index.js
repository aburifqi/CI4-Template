$(function() {
});
//#region Functions
//#endregions
//#region Events
$(".nav-item.menu-items>a.nav-link").on("click", function(e){
    if(e)e.preventDefault();
    const li = $(this).parent('li');
    // $(li).parent("ul").find("li.nav-item.menu-items").each(function(){
    //     if($(this) !== $(li))$(this).removeClass("active");
    // });
    // console.log($(li).hasClass("active"));
    $(li).siblings("li").removeClass("active");
    $(li).find("div.collapse").removeClass("show");
    $(li).parents('.menu-items').each(function(){
        $(this).siblings(".menu-items").removeClass('active');
        $(this).siblings(".menu-items").find('.menu-items').removeClass('active');
    });
    $(li).addClass("active");
})
//#endregion
