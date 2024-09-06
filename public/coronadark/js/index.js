$(function() {
});
//#region Functions
//#endregions
//#region Events
$(".nav-item.menu-items>a.nav-link").on("click", function(e){
    if(e)e.preventDefault();
    const li = $(this).parent('li');
    $(li).parent("ul").find("li.nav-item.menu-items").removeClass("active");
    $(li).toggleClass("active");
    $(li).find("div.collapse").removeClass("show");
})
//#endregion
