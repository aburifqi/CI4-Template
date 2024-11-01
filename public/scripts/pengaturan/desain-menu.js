var newCount = 1;
var rulesForm = {
    id: {
        required: true,
    },
    judul: {
        required: true,
    },
};
var messageErrorForm = {
    id: {
        required: "Kode menu belum diisi",
    },
    judul: {
        required: "Judul menu belum diisi",
    },
};
var setting = {
    view: {
        addHoverDom: addHoverDom,
        removeHoverDom: removeHoverDom,
        addDiyDom: addDiyDom,
        selectedMulti: false,
        showIcon: false,//showIconForTree
    },
    check: {
        enable: true
    },
    data: {
        simpleData: {
            enable: true
        }
    },
    edit: {
        enable: true
    }
};

var relatedTarget;
var isChoose;
var curIcon="";

$(function () {
    renderTree();

    $("#btn-pick-warna").spectrum({
        type: "component",
    })
    .on("change", function () {
        $(this).css("background-color", $(this).val());
        $(this).prev('input').val($(this).val());
    });

    $("#frm-data").validate({
        rules: rulesForm,
        messages: messageErrorForm,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('text-danger');
            element.closest('.form-group').addClass('bad');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            $(element).closest('.form-group').addClass('bad');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).closest('.form-group').removeClass('bad');
        },
        submitHandler: function(form) {
            $("#loader").fadeIn();
           
            let dataArr = $(form).serializeArray(); 
            let data =$('#modal-menu').data("data");
            let zTree = $.fn.zTree.getZTreeObj("treeMenu");
            let nodes = zTree.getNodes();

            dataArr.forEach(item => {
                if(item.name == 'id'){
                    data.db.name = item.value;
                }else{
                    data.db[item.name]=item.value;
                }
            });
            data.db.status = $("#status").is(":checked")?'active':'inactive';
            data.db.jenis = $("#jenis").is(":checked")?'Menu':'Action';

            const isNameEksis = $.grep(nodes, (nd)=>{
                return nd.id == data.db.name;
            });
            if(isNameEksis.length){
                $.toast({
                    heading: "Dibatalkan!",
                    text: `Menu ${data.db.name} sudah ada...`,
                    showHideTransition: "slide",
                    position: "bottom-right",
                    hideAfter: 1500,
                    icon: "warning",
                });
                return;
            }
            if(!data.id){
                nodes.push({ id:data.db.name, pId:0, name:data.db.judul, isParent:false,db:data.db, nocheck:true});
            }else{
                data.id = data.db.name;
                data.name = data.db.judul;
            }
            $.fn.zTree.init($("#treeMenu"), setting, nodes);
            $("#modal-menu").modal("toggle");
        }
    });

    initDataTable(
        $("#tbl-icons"),
        baseURL+'get-icons',
        function (data) {
        },
        true,
        {
            columnDefs:[{
                        orderable: false,
                        targets: 0,
                    },
                ],
            order  : [[1, 'desc']],
        
        }
    );
    // Buang ini untuk ngilangin data di footer
    $("#el-footer").html(`
        <button class="btn btn-dark" onclick="batal(this)">Batal</button>
        <button type="button" id="btn-simpan" class="btn btn-primary mr-2" onclick="simpan(this)">Simpan</button>
    `);
    //--------------------------

});

//#region Function
function renderTree(){
    $.ajax({
        url:baseURL+'get-menu',
        type:"POST",
        dataType:"JSON",
        
        success:(res)=>{
            var zNode=[];
            if(res.data.length){
                let id = 1;
                $.each(res.data, (i, menu)=>{
                    zNode.push({ id:menu.name, pId:0, name:menu.judul, isParent:menu.anak.length>0?true:false,db:menu, nocheck:true});
                    if (menu.anak.length){
                        getChildMenu(res.data, menu.anak, menu, zNode, id);
                    }
                    id++;
                });
                $.fn.zTree.init($("#treeMenu"), setting, zNode);
            }
        }
    });
}

function addHoverDom(treeId, treeNode) {
    var sObj = $("#" + treeNode.tId + "_span");
    if (treeNode.editNameFlag || $("#addBtn_"+treeNode.tId).length>0) return;
    var addStr = "<span class='button add' id='addBtn_" + treeNode.tId + "' title='add node' onfocus='this.blur();'></span>";
    sObj.after(addStr);

    var btn = $("#addBtn_"+treeNode.tId);
    if (btn) btn.bind("click", function(){
        // tambahMenu(treeNode, treeNode.id);
        var zTree = $.fn.zTree.getZTreeObj("treeMenu");

        const id = (100 + newCount);
        const name = "new node" + (newCount++);
        zTree.addNodes(treeNode, {
            id: id, 
            pId:treeNode.id, 
            name: name,
            db:{
                id:0,
                auth_permissions_id: 0,
                "name": id,
                "judul": name,
                "icon": "",
                "icon_color": "",
                "jenis": "Menu",
                "parent_name": treeNode.id,
                "urut": 0,
                "url": "",
                "status": "active",
                "level": 0,
                "is_page": "0",
                "status": "active",
                "created_at": null,
                "created_by": null,
                "updated_at": null,
                "updated_by": null,
                "description": "",
            }
        });
        return false;
    });

    var btnRemove = $(`#${treeNode.tId}_remove`);
    var btnDB = $(`<span class="btn btn-xs btn-primary" id="${treeNode.tId}_db" title="Data" style="width:21px; height:21px; border:1px solid gray;"><i class="mdi mdi-settings"></i></span>`).on("click", function(e){
        $("#modal-menu").data("data", treeNode).modal("show");
    }).on("ubah", function(e){
        treeNode = $(this).data("data");
    });
    // .on("click", function(){
    //     $("#modal-menu").modal('show').data("data", treeNode);
    // });
    $(btnRemove).after(btnDB);
};

function removeHoverDom(treeId, treeNode) {
    $("#addBtn_"+treeNode.tId).unbind().remove();
    $(`#${treeNode.tId}_db`).unbind().remove();
};

function addDiyDom(treeId, treeNode) {
    if(!treeNode.db) return;
    if(!treeNode.db.icon)return;
    var aObj = $("#" + treeNode.tId + '_span');

    var btnDB = "<span class='demoIcon' id='diyBtn_" +treeNode.id+ "' title='"+treeNode.name+"' onfocus='this.blur();'><i class='"+treeNode.db.icon+"' style='color:"+treeNode.db.icon_color+";'></i></span>";
    var editStr = $("<span class='icon-menu' title='"+treeNode.name+"' onfocus='this.blur();'><i class='"+treeNode.db.icon+"' style='color:"+treeNode.db.icon_color+";'></i></span>").on("click", function(e){
        // console.log(treeNode)
    });
    aObj.before(editStr);
}

function showIconForTree(treeId, treeNode) {
    return !treeNode.isParent;
};

function getChildMenu(listParent, listSibling, menu, zNode, id){
    var kid = 0;
    $.each(menu.anak, (n, ch)=>{
        kid++;
        var strID = id.toString() + kid.toString();
        const parent = $.grep(listParent, (pr)=>{
            return pr.name == ch.parent_name;
        });

        zNode.push({ id: ch.name, pId:parent[0].name, name:ch.judul, db:ch, nocheck:true});
        if (ch.jenis == "Menu"){
            if (ch.anak.length){
                getChildMenu(listSibling, ch.anak, ch, zNode, parseInt(strID));
            }
        }
        kid++;
    });
}

function tambahMenu( parent_code){
    $("#frm-data").trigger("reset");
    const data = {db:{
        "id": 0,
        "auth_permissions_id": 0,
        "judul": "",
        "icon": "",
        "icon_color": "",
        "jenis": "Menu",
        "parent_name": "",
        "urut": 0,
        "url": "",
        "is_page": "0",
        "status": "active",
        "created_at": null,
        "created_by": null,
        "updated_at": null,
        "updated_by": null,
        "level": 0,
        "name": "0",
        "description": "",
        "anak": [],
    }}

    $("#modal-menu").data("data",data).modal("show");
}

function simpanMenu(obj) {
    $("#frm-data").submit();
}

function getChildData(data, anak){
    $.each(anak, function(i, item){
        if(!item.db){
            data.push({
                "id": 0,
                "auth_permissions_id": 0,
                "name": item.id,
                "judul": item.name,
                "icon": "",
                "icon_color": "",
                "jenis": "Menu",
                "parent_name": item.pId,
                "urut": item.getIndex(),
                "url": "",
                "status": "active",
                "level": 0,
                "is_page": "0",
                "status": "active",
                "created_at": null,
                "created_by": null,
                "updated_at": null,
                "updated_by": null,
                "description": "",
            });
        }else{
            let db = item.db;
            // db.auth_permissions_id = item.auth_permissions_id;
            db.name = item.id;
            db.judul = item.name;
            db.parent_name = item.pId;
            db.urut = item.getIndex();
            data.push(db);
        }
        if(item.children && item.children.length){
            getChildData(data, item.children);
        }
    })
}

async function simpan(obj) {
    let confirm = await Swal.fire({
        title: "Konfirmasi",
        text: "Apakah Anda yakin ingin menyimpan data menu ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Batal",
        confirmButtonText: "Yakin",
    });

    if (!confirm.isConfirmed) return;

    var zTree = $.fn.zTree.getZTreeObj("treeMenu");
    var nodes =zTree.getNodes();
    
    var data = [];
    $.each(nodes, function (i, item){
        var db = item.db;
        // db.auth_permissions_id = item.auth_permissions_id;
        db.name = item.id;
        db.judul = item.name;
        db.urut = i;
        data.push(db);
        if(item.children && item.children.length){
            getChildData(data, item.children);
        }
    });
    console.log(data)
    $.ajax({
        url: baseURL+'simpan-menu',
        type: "POST",
        dataType: "JSON",
        data: {
            data:data
        },
        success: (data) => {
            if (parseInt(data.hasil)==1) {
                $.toast({
                    heading: "Berhasil",
                    text: data.message,
                    showHideTransition: "slide",
                    position: "bottom-right",
                    hideAfter: 1500,
                    icon: "success",
                });
                $(obj).prop("disabled", false);
            } else {
                $.toast({
                    heading: "Gagal",
                    text: data.message,
                    showHideTransition: "slide",
                    position: "bottom-right",
                    hideAfter: 1500,
                    icon: "error",
                });
                $(obj).prop("disabled", false);
            }
        },
        error: (_xhr, status, err) => {
            console.log(_xhr);
            $(obj).prop("disabled", false);
        },
    });

    return;
    $(obj).prop("disabled", true);

    var row = $(obj).closest("tr");
    var table = $(obj).closest("table");
    var data = $(table).DataTable().row(row).data();

    data.icon = $(row).find(".pick-icon").length ?
        $(row).find(".pick-icon i").attr("class") :
        "";
    data.icon_color = $(row).find(".pick-icon-color").length ?
        $(row).find(".pick-icon-color").css("background-color") :
        "";
    data.title = $(row).find(".title").length ? $(row).find(".title").val() : "";
    data.code = $(row).find(".kode").length ? $(row).find(".kode").val() : "";
    data.jenis = $(row).find(".jenis").length ? $(row).find(".jenis").val() : "";
    data.url = $(row).find(".url").length ? $(row).find(".url").val() : "";
    data.status = $(row).find(".status").length ? $(row).find(".status").val() : "";
    data.crud_state = "saved";

    if (!data.title) {
        $.toast({
            heading: "Dibatalkan",
            text: "Tentukan title desain menu",
            showHideTransition: "slide",
            position: "bottom-right",
            hideAfter: 1500,
            icon: "warning",
        });
        $(row).find(".title").focus();
        $(obj).prop("disabled", false);
        return;
    }

    if (!data.code) {
        $.toast({
            heading: "Dibatalkan",
            text: "Tentukan kode desain menu",
            showHideTransition: "slide",
            position: "bottom-right",
            hideAfter: 1500,
            icon: "warning",
        });
        $(row).find(".kode").focus();
        $(obj).prop("disabled", false);
        return;
    }

    $.ajax({
        url: "app/controller/pengaturan/desain-menu.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action:"save",
            data:data
        },
        success: (data) => {
            if (data.success) {
                $(table).DataTable().ajax.reload();
                // renderSideBar();
                $.toast({
                    heading: "Berhasil",
                    text: data.message,
                    showHideTransition: "slide",
                    position: "bottom-right",
                    hideAfter: 1500,
                    icon: "success",
                });
                $(obj).prop("disabled", false);
            } else {
                $.toast({
                    heading: "Gagal",
                    text: data.message,
                    showHideTransition: "slide",
                    position: "bottom-right",
                    hideAfter: 1500,
                    icon: "error",
                });
                $(obj).prop("disabled", false);
            }
        },
        error: (_xhr, status, err) => {
            console.log(_xhr);
            $(obj).prop("disabled", false);
        },
    });
}

async function batal(obj) {
    let confirm = await Swal.fire({
        title: "Konfirmasi",
        text: "Apakah Anda yakin ingin membatalkannya?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Batal",
        confirmButtonText: "Yakin",
    });

    if (!confirm.isConfirmed) return;

    renderTree();
}

async function hapus(obj,id) {
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
        url: "app/controller/pengaturan/desain-menu.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "delete",
            id: id, 
        },
        success: (data) => {
            if (data.success) {
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

async function edit(obj) {
    var row = $(obj).closest("tr");
    var table = $(obj).closest("table");
    var data = $(table).DataTable().row(row).data();

    data.crud_state = "edit";
    $.ajax({
        url: "app/controller/pengaturan/desain-menu.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "save",
            data: data
        },
        success: (data) => {
            if (data.success) {
                $(table).DataTable().ajax.reload();
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

// async function newData(obj,parentCode) {
//     var row = $(obj).closest("tr");
//     var table = $(row).closest("table");
//     var data = $(table).DataTable().row(row).data();

//    if(!data) data ={code:'0'};

//     $.ajax({
//         url: "app/controller/pengaturan/desain-menu.php",
//         type: "POST",
//         dataType: "JSON",
//         data: {
//             action: "save",
//             data: {
//                 id: 0,
//                 code: data.code,
//                 title: "",
//                 icon: "",
//                 icon_color: "",
//                 jenis: "Menu",
//                 urut: 0,
//                 url: "",
//             },
//         },
//         success: (res) => {
//             if (res.success) {
//                 if (!data.id){
//                     $(table).DataTable().ajax.reload();
//                     return;
//                 }
//                 // $(table).DataTable().ajax.reload();
//                 if ($(row).hasClass("shown")) {
//                     $(row).next(".row-child").find("table").DataTable().ajax.reload();
//                 }else{
//                     let curTombolExpand = $(row).find(".tombol-expand");
//                     if ($(curTombolExpand).length){
//                         $(curTombolExpand).trigger("click");
//                     }else{
//                         $(row).find(".kolom-expand").append('<div class="tombol-expand"></div>');
//                         $(row).find(".kolom-expand .tombol-expand").trigger("click");
//                     }
//                 }
//             } else {
//                 $.toast({
//                     heading: "Gagal",
//                     text: data.message,
//                     showHideTransition: "slide",
//                     position: "bottom-right",
//                     hideAfter: 1500,
//                     icon: "error",
//                 });
//             }
//         },
//         error: (_xhr, status, err) => {
//             console.log(_xhr);
//         },
//     });
// }

//PICK icon
function cariMDI(){
    $("#mdi .icon-box").hide();
    $("#mdi .icon-box").each(function(){
        let iconName = $(this).find("i").attr("class").toLowerCase();
        let searchIcon = $("#txt-cari-mdi").val().toLowerCase()
        if(iconName.indexOf(searchIcon)>=0){
            $(this).show();
        }
    });
}
//#endregion

//#region Events
// $("#tbl-data>tbody").on("click", "div.tombol-expand", function (e) {
//     e.stopPropagation();
//     var tr = $(this).closest("tr");
//     var curTabel = $(tr).closest("table");
//     var row = $(curTabel).DataTable().row(tr);
//     var level = parseInt($(curTabel).attr("level")) + 1;

//     if (row.child.isShown()) {
//         row.child.hide();
//         tr.removeClass("shown");
//     } else {
//         row.child(formatDetail(row.data(), level)).show();
//         tr.next("tr").addClass("row-child");
//         tr.addClass("shown");
//     }
// });

$('#modal-menu').on('show.bs.modal', function (event) {
    // var btnDB = $(event.relatedTarget);
    var data = $(this).data("data");
    if(!data){
        $("#frm-data").trigger("reset");
        return;
    }
    if(!data.db){
       data.db={
        "id": 0,
        "name":data.id,
        "judul": data.judul,
        "icon": "",
        "icon_color": "",
        "parent_name": data.pId,
       }
    }
    $.each(data.db, function(key, item){
        $(`#frm-data input[name=${key}]`).val(item);
    });
    $(this).find("input[name=status]").val('active').prop("checked",data.db.status=='active'?true:false).trigger("change");
    $(this).find("input[name=jenis]").val('Menu').prop("checked",data.db.jenis=='Menu'?true:false).trigger("change");
    $("#btn-pick-icon i").attr("class", data.db.icon);
    $("#btn-pick-warna").css("background-color", data.db.icon_color);
});

$("#btn-pick-icon").on("ubah", function(e){
    $('#modal-menu').find("input[name=icon]").val($(this).find("i").attr("class"));
});
//PICK Icon
$("#tbl-icons").on("click", ">tbody>tr", function(e){
    $("#tbl-icons>tbody>tr").removeClass("selected");
    $(this).addClass("selected");
});

$("#tbl-icons").on("draw.dt", function(e){
    if(!curIcon)return;

    $(this).find(">tbody>tr").removeClass("selected");

    $(this).find(">tbody>tr").each(function(){
        var data = $("#tbl-icons").DataTable().row(this).data();
        if(!data)return;
        if(data.kode == curIcon)$(this).addClass("selected");
    })
});

$('#modal-pick-icon').on('show.bs.modal', function (event) {
    $(".icon-box").removeClass("active");
    isChoose=false;
    relatedTarget = $(event.relatedTarget);
    if(!relatedTarget)return;
    curIcon = $(relatedTarget).find("i").attr("class");
    console.log(curIcon)
    $("#tbl-icons .filter-row th:eq(3) input").val(curIcon).trigger("change");

    let icon =$(this).find(`i[class="${$(relatedTarget).find("i").attr("class")}"]`);
    $(icon).parent(".icon-box").addClass("active");
    // $(icon).parents(".container-icon").animate({
    //     scrollTop: $(icon).parent(".icon-box").offsetTop
    // }, 100);
});

$('#btn-modal-pilih-icon').on('click', function (e) {
    isChoose=true;
    $('#modal-pick-icon').modal("toggle");
});

$('#modal-pick-icon').on('hidden.bs.modal', function (e) {
    if(!relatedTarget || !isChoose)return;
    if(!$("#tbl-icons>tbody>tr.selected").length)return;
    var data = $("#tbl-icons").DataTable().row($("#tbl-icons>tbody>tr.selected")).data();
    if(!data)return;
    let icon = data.kode;
    $(relatedTarget).find("i").attr("class",icon);
    $(relatedTarget).trigger('ubah');
});

//#endregion