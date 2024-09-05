$(function() {
});
//#region Functions
//#endregions
//#region Events
$(".nav-item.menu-items>a.nav-link").on("click", function(){
    const li = $(this).parent('li');
    $(li).find("~.nav-item.menu-items").removeClass("active");
    $(li).toggleClass("active");
    $(li).find("div.collapse").removeClass("show");
    // $(this).find(">div.collapse").addClass("show");
    // console.log($(this).find("div.collapse").length)
    // console.log($(this).find(">div.collapse").length)
})
//#endregion
