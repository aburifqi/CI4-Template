let currentPage="";
let initPage = true;
// var otoritas = [];
$(function() {
    // const curURL = window.location.href;
    // const paramData = parseURLParams(curURL);

    // if (paramData && paramData.page[0]) {
    //     currentPage = paramData.page[0];
    //     sessionStorage.setItem('current-page', currentPage);
    //     location.href="index.php";
    //     return;
    // }
    // //render side bar menu
    renderSideBar();
    // initPage = true;
    // if(!currentPage){
    //     currentPage = sessionStorage.getItem('current-page');//$.cookie('current-page');
    //     // if(!currentPage)currentPage = 'menu_beranda';
    // }

    // if(currentPage){
    //     // let param = $.cookie('param')?JSON.parse($.cookie('param')):{};
    //     let param = sessionStorage.getItem('param')?JSON.parse(sessionStorage.getItem('param')):{};
    //     openPage(currentPage, param);
    // }
});
//#region Functions
    function setActiveLinkMenu(obj){
        return;
        if(obj){
            $(".navigasi-template-app li, .navigasi-template-app a").removeClass("active");
            $(obj).addClass("active");
            $(obj).parent("li").addClass("active");
        }else{
            let linkObj =$(`.navigasi-template-app a[data-page=${pageCode}]`);
            $(linkObj).addClass("active");
            $(linkObj).parent("li").addClass("active");
            let parentClp = $(linkObj).parents(".collapse");
            if($(parentClp).length){
                $(parentClp).addClass("show");
            }
        }
    }

    function openPage(pageCode='menu_beranda', param={}){
        if(event)event.preventDefault();

        if (currentPage == pageCode && !initPage)return;
        // otoritas = [];
        initPage = false;
        $(".title-text").html("")
        $("#data-display").html("<h1>Please wait...</h1>");
        $("#el-footer").empty();
        currentPage = pageCode;
        sessionStorage.setItem("current-page", currentPage);
        sessionStorage.setItem("param", JSON.stringify(param));
        $.ajax({
            url:"modules/common.php",
            type: "POST",
            dataType:"JSON",
            async:false,
            data:{
                action:"open-page",
                pageCode:pageCode,
                param:param
            },
            success:(data)=>{
                var breadCrumbs = data.breadCrumbs;
                breadCrumbs = breadCrumbs.sort(function(a, b) { 
                    return a.active - b.active
                });
                $("ol.breadcrumb").empty();
                $.each(breadCrumbs, function (i, item){
                    if(item.active !== 1){
                        $("ol.breadcrumb").append(`<li class="breadcrumb-item"><a href="javascript:void(0);">${item.title}</a></li>`);
                    }else{
                        $("ol.breadcrumb").append(`<li class="breadcrumb-item active" aria-current="page">${item.title}</li>`);
                    }
                })
                $(".title-text").html(data.menu.title)
                $("#inject-css").append(data.content[0]);
                $("#data-display").html(data.content[1]);
                $("modals").html(data.content[2]);
                $("#inject-js").html(data.content[3]);
                // otoritas = data.otoritas;
            },
            error:(_xhr, _status, _err)=>{

            }
        });
    }

    function renderSideBar(){
        $(".navigasi-template-app .render-menu").remove();
        fetch(`${baseURL}/menu`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(r =>  r.json().then(res =>{
            console.log(res)
            if(res.hasil == 1){
                const parentMenuFormat =`<li class="nav-item menu-items">
                    <a class="nav-link parent-menu" href="javascript:void(0);">
                        <div style = "display:flex; align-items: center; width: 100%;">
                            <span class="menu-icon">
                                <i></i>
                            </span>
                            <span class="menu-title judul-menu"></span>
                            <i class="menu-arrow"></i>
                        </div>
                    </a>
                </li>`;

                const childMenuContainerFormat =`<div class="collapse" id="">
                    <ul class="nav flex-column sub-menu">
                    </ul>
                </div>`;

                const childMenuFormat =`<li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);">
                        <div>
                            <i class=""></i>&nbsp;<span style="width:auto;left:40px;padding:0;" class="child-menu-label menu-title"></span>
                        </div>
                    </a>
                </li>`;

                let parentMenu = $.grep(res.data,(d, i)=>{
                    return d.parent_code == 0;
                });
                parentMenu = parentMenu.sort((a, b)=>{
                    return a.urut - b.urut;
                });
                if (parentMenu.length){
                    $.each(parentMenu, (i, pm)=>{
                        if (pm.children.length){
                            getChildMenu(pm);
                        }
                        //Render Menu
                        $(".navigasi-template-app").append(renderMenu(pm, parentMenuFormat, childMenuContainerFormat, childMenuFormat));
                    });
                }
                console.log(parentMenu)
            }
            $("#data-display").html(res.tes)
        }));
        // .then((res)=>{
        //     if(res.hasil == 1){

        //     }
        //     console.log(res)
        // });
    
        // $.ajax({
        //     url:"modules/common.php",
        //     type: 'POST',
        //     dataType: 'json',
        //     async:false,
        //     data:{
        //         action:"side-bar-menu",
        //     },
        //     success : (data)=>{
        //         if(data.menu){
        //             const parentMenuFormat =`<li>
        //                 <a class="parent-menu" href="javascript:void(0);">
        //                     <span class="menu-icon">
        //                         <i class="icon-menu"></i>
        //                     </span>
        //                     <span class="judul-menu">Menu</span>
        //                 </a>
        //             </li>`;
    
        //             const childMenuContainerFormat =`<div class="collapse" id="">
        //                 <ul class="nav flex-column sub-menu">
        //                 </ul>
        //             </div>`;
    
        //             const childMenuFormat =`<li class="nav-item">
        //                 <a class="nav-link" href="javascript:void(0);">
        //                     <i class=""></i>&nbsp;
        //                 </a>
        //             </li>`;

        //             let parentMenu = $.grep(data.menu,(d, i)=>{
        //                 return d.parent_code == 0;
        //             });
        //             parentMenu = parentMenu.sort((a, b)=>{
        //                 return a.urut - b.urut;
        //             });
        //             if (parentMenu.length){
        //                 $.each(parentMenu, (i, pm)=>{
        //                     if (pm.children.length){
        //                         getChildMenu(pm);
        //                     }
        //                     //Render Menu
        //                     $(".navigasi-template-app").append(renderMenu(pm, parentMenuFormat, childMenuContainerFormat, childMenuFormat));
        //                 });
        //             }
        //         }
        //     }
        // });

    }
    
    function getChildMenu(menu){
        $.each(menu.children, (n, ch)=>{
            if (ch.otoritas_child.type == "Menu"){
                menu.children[n] = ch.otoritas_child;
                if (ch.otoritas_child.children.length){
                    getChildMenu(ch.otoritas_child);
                }
            }
        });
    }

    function renderMenu(menu, parentMenuFormat, childMenuContainerFormat, childMenuFormat) {
        let menuContainer = $('<div></div>');
        let objMenu = $(parentMenuFormat);
        let objContainerMenu = $(childMenuContainerFormat);

        $(objMenu).appendTo(menuContainer);
        $(objMenu).addClass("render-menu");
        $(objContainerMenu).addClass("render-menu");

        $(objMenu).find('.judul-menu').html(menu.title);
        $(objMenu).find('.menu-icon').addClass(menu.icon);
        if(menu.icon_color){
            $(objMenu).find('.menu-icon').attr("style",`color:${menu.icon_color}`);
        }
        if(menu.code === currentPage){
            $(objMenu).addClass('active');
            $(objMenu).find('>a').addClass('active');
        }
        if(menu.children.length){
            $(objContainerMenu).appendTo(objMenu);
            $.each(menu.children, (i, mn)=>{
                let objChildMenu = $(childMenuFormat);
                if(mn.children.length){
                    let htmlChild = renderMenu(mn, parentMenuFormat, childMenuContainerFormat, childMenuFormat);
                    $(objContainerMenu).append(htmlChild);
                    $(objChildMenu).find('>a>div').attr({
                        "onclick":`setActiveLinkMenu(this);`,
                    });

                }else{

                    $(objChildMenu).appendTo($(objContainerMenu));
                    if(mn.code === currentPage){
                        $(objChildMenu).addClass('active');
                        $(objChildMenu).find('>a').addClass('active');
                    }
                    $(objChildMenu).find('i').addClass(mn.icon);
                    $(objChildMenu).find('.child-menu-title').text(mn.title);
                    if(mn.icon_color){
                        $(objChildMenu).find('i').attr("style",`color:${mn.icon_color}`);
                    }
                    $(objChildMenu).find('>a').attr({
                        "href":`index.php?page=${mn.code}`
                    });
                    $(objChildMenu).find('>a>div').attr({
                        "onclick":`setActiveLinkMenu(this); openPage('${mn.code}');`,
                        "data-page":mn.id
                    });
                }
            });
            $(objMenu).find('>a>div').attr({
                "onclick":`setActiveLinkMenu(this);`,
            });
        }else{
            $(objMenu).find('.menu-arrow').remove();
            $(objMenu).find('>a').attr({
                "href":`index.php?page=${menu.code}`
            });
            $(objMenu).find('>a>div').attr({
                "onclick":`setActiveLinkMenu(this); openPage('${menu.code}');`,
                "data-page":menu.id
            });
        }
        
        return $(menuContainer).html();
    }

    function logOut(location = 0){
        // $.removeCookie('param');
        // $.removeCookie('current-page');
        sessionStorage.clear();
        console.log(otoritas)
        otoritas ={};
        currentPage ="";
        initPage =true;
        $.ajax({
            url:"modules/common.php",
            type: "POST",
            dataType:"JSON",
            data:{
                action:"log-out",
            },
            success:(data)=>{
                // window.location.href=data.reqURI;
                // window.location.href=`index.php?location=${location}`;
                window.location.href=`index.php`;
            },
            error:(_xhr, _status, _err)=>{

            }
        });
    }
//#endregion
//#region Events
//#endregion
