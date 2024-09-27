var bahasaDT = {
  emptyTable: "Tidak ada data yang tersedia pada tabel ini",
  info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
  infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
  infoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
  lengthMenu: "Tampilkan _MENU_ entri",
  loadingRecords: "Sedang memuat...",
  processing: "Sedang memproses...",
  search: "Cari:",
  zeroRecords: "Tidak ditemukan data yang sesuai",
  thousands: "'",
  paginate: {
    first: '<i class="fa fa-step-backward"></i>',
    last: '<i class="fa fa-step-forward"></i>',
    next: '<i class="fa fa-forward"></i>',
    previous: '<i class="fa fa-backward"></i>',
  },
  aria: {
    sortAscending: ": aktifkan untuk mengurutkan kolom ke atas",
    sortDescending: ": aktifkan untuk mengurutkan kolom menurun",
  },
  autoFill: {
    cancel: "Batalkan",
    fill: "Isi semua sel dengan <i>%d</i>",
    fillHorizontal: "Isi sel secara horizontal",
    fillVertical: "Isi sel secara vertikal",
  },
  buttons: {
    collection:
      "Kumpulan <span class='ui-button-icon-primary ui-icon ui-icon-triangle-1-s'/>",
    colvis: "Visibilitas Kolom",
    colvisRestore: "Kembalikan visibilitas",
    copy: "Salin",
    copySuccess: {
      1: "1 baris disalin ke papan klip",
      _: "%d baris disalin ke papan klip",
    },
    copyTitle: "Salin ke Papan klip",
    csv: "CSV",
    excel: "Excel",
    pageLength: {
      "-1": "Tampilkan semua baris",
      _: "Tampilkan %d baris",
    },
    pdf: "PDF",
    print: "Cetak",
    copyKeys:
      "Tekan ctrl atau u2318 + C untuk menyalin tabel ke papan klip.<br /><br />Untuk membatalkan, klik pesan ini atau tekan esc.",
  },
  searchBuilder: {
    add: "Tambah Kondisi",
    button: {
      0: "Cari Builder",
      _: "Cari Builder (%d)",
    },
    clearAll: "Bersihkan Semua",
    condition: "Kondisi",
    data: "Data",
    deleteTitle: "Hapus filter",
    leftTitle: "Ke Kiri",
    logicAnd: "Dan",
    logicOr: "Atau",
    rightTitle: "Ke Kanan",
    title: {
      0: "Cari Builder",
      _: "Cari Builder (%d)",
    },
    value: "Nilai",
    conditions: {
      date: {
        after: "Setelah",
        before: "Sebelum",
        between: "Diantara",
        empty: "Kosong",
        equals: "Sama dengan",
        not: "Tidak sama",
        notBetween: "Tidak diantara",
        notEmpty: "Tidak kosong",
      },
      number: {
        between: "Diantara",
        empty: "Kosong",
        equals: "Sama dengan",
        gt: "Lebih besar dari",
        gte: "Lebih besar atau sama dengan",
        lt: "Lebih kecil dari",
        lte: "Lebih kecil atau sama dengan",
        not: "Tidak sama",
        notBetween: "Tidak diantara",
        notEmpty: "Tidak kosong",
      },
      string: {
        contains: "Berisi",
        empty: "Kosong",
        endsWith: "Diakhiri dengan",
        equals: "Sama Dengan",
        not: "Tidak sama",
        notEmpty: "Tidak kosong",
        startsWith: "Diawali dengan",
      },
      array: {
        equals: "Sama dengan",
        empty: "Kosong",
        contains: "Berisi",
        not: "Tidak",
        notEmpty: "Tidak kosong",
        without: "Tanpa",
      },
    },
  },
  searchPanes: {
    clearMessage: "Bersihkan Semua",
    count: "{total}",
    countFiltered: "{shown} ({total})",
    title: "Filter Aktif - %d",
    collapse: {
      0: "Panel Pencarian",
      _: "Panel Pencarian (%d)",
    },
    emptyPanes: "Tidak Ada Panel Pencarian",
    loadMessage: "Memuat Panel Pencarian",
  },
  infoThousands: ",",
  select: {
    cells: {
      1: "1 sel terpilih",
      _: "%d sel terpilih",
    },
    columns: {
      1: "1 kolom terpilih",
      _: "%d kolom terpilih",
    },
  },
  datetime: {
    previous: "Sebelumnya",
    next: "Selanjutnya",
    hours: "Jam",
    minutes: "Menit",
    seconds: "Detik",
    unknown: "-",
    amPm: ["am", "pm"],
    weekdays: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
    months: [
      "Januari",
      "Februari",
      "Maret",
      "April",
      "Mei",
      "Juni",
      "Juli",
      "Agustus",
      "September",
      "Oktober",
      "November",
      "Desember",
    ],
  },
  editor: {
    close: "Tutup",
    create: {
      button: "Tambah",
      submit: "Tambah",
      title: "Tambah inputan baru",
    },
    remove: {
      button: "Hapus",
      submit: "Hapus",
      confirm: {
        _: "Apakah Anda yakin untuk menghapus %d baris?",
        1: "Apakah Anda yakin untuk menghapus 1 baris?",
      },
      title: "Hapus inputan",
    },
    multi: {
      title: "Beberapa Nilai",
      info: "Item yang dipilih berisi nilai yang berbeda untuk input ini. Untuk mengedit dan mengatur semua item untuk input ini ke nilai yang sama, klik atau tekan di sini, jika tidak maka akan mempertahankan nilai masing-masing.",
      restore: "Batalkan Perubahan",
      noMulti:
        "Masukan ini dapat diubah satu per satu, tetapi bukan bagian dari grup.",
    },
    edit: {
      title: "Edit inputan",
      submit: "Edit",
      button: "Edit",
    },
    error: {
      system:
        'Terjadi kesalahan pada system. (<a target="\\" rel="\\ nofollow" href="\\">Informasi Selebihnya</a>).',
    },
  },
};

function initDataTable(
  tabel,
  urlAJAX,
  paramAJAX,
  isFilterCol = true,
  options = {}
) {
  var columnData = [];

  if (isFilterCol)
    $(tabel).find("thead").append($(`<tr class = "red-radial filter-row"></tr>`));
  $(tabel)
    .find("thead>tr:first >th")
    .each(function (colIdx) {
      if (isFilterCol) $(tabel).find(".filter-row").append(`<th class="reswidth"></th>`);
      // const fieldData = $(this).attr("field-data");
      const fieldName = $(this).attr("field-name");
      const filterType = $(this).attr("filter-type");
      const dataFormat = $(this).attr("format-data");
      const customFunction = $(this).attr("format-custom");
      const className = $(this).attr("class-name");
      const customElement = $(this).attr("custom-element");
      const orderable = $(this).attr("no-order")? false:true;

      if (fieldName) {
        columnData.push({
          data: fieldName,
          name: fieldName + (filterType ? "|" + filterType : ""),
          defaultContent: "",
          className: className ? className : "",
          orderable : orderable,
          // autoWidth:true,
          render: function (data, type, row, meta) {
            var html = "";
            if (customElement) {
              html = window[customElement](data, type, row, meta);
            }

            switch (dataFormat) {
              case "row-number":
                return meta.row + meta.settings._iDisplayStart + 1 + "." + html;
                break;
              case "money":
                return (
                  "<span>Rp. </span><span>" +
                  number_format(data) + //(data / 1000).toFixed(3) +
                  "</span>" +
                  html
                );
                break;
              case "number":
                // return $.fn.dataTable.render.number('.', ',', 2, '').display(data) + html;
                return number_format(data); //(data / 1000).toFixed(3);
                break;
              case "date-time":
                if (!data) return "-";
                return moment(data).format("DD MMM YYYY HH:mm:ss") + html;
                break;
              case "date":
                if (!data) return "-";
                return moment(data).format("DD MMMM YYYY") + html;
              case "date-from-integer":
                if (!data) return "-";
                var convDate = new Date(1000 * data);
                return moment(convDate).format("DD MMMM YYYY") + html;
                break;
              case "custom": 
                // console.log(customFunction)               
                var result =
                  window[customFunction](data, type, row, meta) + html;
                return result;
                break;
            }
            return className == "dt-control"?"":data;
          },
        });
      }
    });

  let opsi = {
    language: bahasaDT,
    // stateSave: true,
    // stateSaveCallback: function (settings, data) {
    //   sessionStorage.setItem(
    //     "DataTables_" + settings.sInstance,
    //     JSON.stringify(data)
    //   );
    // },
    // stateLoadCallback: function (settings) {
    //   return JSON.parse(
    //     sessionStorage.getItem("DataTables_" + settings.sInstance)
    //   );
    // },
    width: "100%",
    autoWidth:true,
    paging: true,
    ordering: true,
    info: true,
    // lengthChange: true,
    dom             : 'rtp',
    // dom             : 'Blfrtip',
    // dom: "lrtip",
    searching: true,
    processing: true,
    // pagingType       : "full", //"numbers",//"full_numbers",//"simple",//"first_last_numbers",//"simple_numbers",//
    // tableStyle      : "hover stripe nowrap",
    scrollY         : $(tabel).parents(".modal").length? "30vh":"60vh",
    // // scrollX         : true,
    // responsive      : true,
    // lengthMenu: [
    //   [5, 10, -1],
    //   [5, 10, "All"],
    // ],
    pageLength: 5,//listItemPerPage? listItemPerPage:5,
    // order: [[0, "desc"]],
    orderCellsTop: true,
    serverSide: true,
    columns: columnData,
    columnDefs: [],
    initComplete: async function () {
      var allColumns = this.api().columns();

      await allColumns.every(async function (colIdx) {
        var column = this;
        const headerText = $(column.header()).text();
        const filterType = $(column.header()).attr("filter-type");
        const customFilter = $(column.header()).attr("filter-custom");
        //-- Cell yang ada filternya di header tabel.
        const cellFilter = $(column.header())
          .closest("table")
          .find(".filter-row th")
          .eq(colIdx);

        $(cellFilter).css("display", $(column.header()).css("display"));
        //-- Setup tampilan input filter di header tabel.
        switch (filterType) {
          case "toggle-filter":
            $(
              `<button type="button" class="toggle-filter filter-off btn btn-primary" title="Clear Filter"><i class="fa fa-bolt"></i></button>`
            )
              .appendTo($(cellFilter).empty())
              .on("click", function () {
                allColumns.every(function () {
                  this.search("");
                });
                $(tabel).find(".filter-row input").val("");
                $(tabel).find(".filter-row select").val("");

                $(tabel).DataTable().ajax.reload();
              });
            break;
          case "input": // Input
            var input = $(
              `<input type="text" class="" placeholder="` +
                headerText.trim() +
                `"  autocomplete="off"  readonly onclick="this.removeAttribute('readonly');" style="width:100%;"/>`
            )
              .appendTo($(cellFilter).empty())
              .off("keyup change")
              .on("keyup change", function (e) {
                // if (e.originalEvent.key!="Enter")return;
                e.stopPropagation();

                var cursorPosition = this.selectionStart;
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                if (column.search() !== val) {
                  column.search(val ? val : "", true, false).draw();
                }

                $(this)
                  .focus()[0]
                  .setSelectionRange(cursorPosition, cursorPosition);
              });
            break;
          case "select": // Select
            var optionFunction = $(column.header()).attr("filter-option");
            var select = $(
              '<select class="custom-select box-detail" style="width:100%"><option value=""></option></select>'
            )
              .appendTo(
                $('<div class="select-dropdown full-width"></div>').appendTo(
                  $(cellFilter).empty()
                )
              )
              .on("change", function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                if (column.search() !== val) {
                  column.search(val ? val : "", true, false).draw();
                }
              });
            var options = await window[optionFunction]();
            if (options) {
              options.forEach(function (item) {
                select.append(
                  `<option value = "` +
                    item.val +
                    `">` +
                    item.text +
                    `</option>`
                );
              });
            }
            break;
          case "date-picker": // Date Picker
            var datePicker = $(
              `<input type="text" class="text-center" placeholder="&emsp;" value = ""/>`
            )
              .appendTo($(cellFilter).empty())
              .bootstrapMaterialDatePicker({
                time: false,
                format: "DD/MM/YYYY",
                lang: "id",
                cancelText: "Batal",
              })
              .on("change", function () {
                var val = $(this).val(); //$.fn.dataTable.util.escapeRegex($(this).val());

                if (column.search() !== val) {
                  val = moment(val).format("YYYY-MM-DD");
                  column.search(val ? val : "", true, false).draw();
                }
              });
            break;
          case "date-range-picker": // Date Picker Range
          case "date-range-picker-integer": // Date Picker Range
            // var tglAwal = moment().startOf('month').subtract(1, 'months').format('DD/MM/YYYY');
            // var tglAkhir = moment().endOf('month').format('DD/MM/YYYY');

            // var datePickerRange = $(
            //     `<div style="display:flex;width:100%;flex-direction:column;">
            //     <input readonly class="startdate text-center" value="` + tglAwal + `"/>
            //     <input readonly class="enddate text-center" value="` + tglAkhir + `"/>
            // </div>`
            // )
            // .appendTo(
            //     $(cellFilter).empty()
            // )
            // .daterangepicker({
            //     startDate: moment().startOf('month').subtract(1, 'months'),
            //     endDate: moment().endOf('month'),
            //     locale: {
            //         format: "DD/MM/YYYY",
            //     },
            //     },
            //     function (start, end, label) {
            //     // $(this).find(".startdate").val(start.format('DD/MM/YYYY'));
            //     // $(this).css("background","red");
            //     // console.log(start.format('YYYY-MM-DD'));
            //     // console.log(end.format('YYYY-MM-DD'));
            //     // console.log(label);
            //     }
            // )
            // .on("apply.daterangepicker", function (ev, picker) {
            //     // var val = $.fn.dataTable.util.escapeRegex($(this).val());
            //     $(this)
            //     .find(".startdate")
            //     .val(picker.startDate.format("DD/MM/YYYY"));
            //     $(this)
            //     .find(".enddate")
            //     .val(picker.endDate.format("DD/MM/YYYY"));

            //     var val =
            //     picker.startDate.format("YYYY/MM/DD") +
            //     "-" +
            //     picker.endDate.format("YYYY/MM/DD");
            //     if (column.search() !== val) {
            //     column.search(val ? val : "", true, false).draw();
            //     }
            // });
            // break;
            var datePickerRange = $(
              `<div style="display:flex;flex-direction:column;align-items:center;"></div>`
            )
              .appendTo($(cellFilter).empty())
              .data("data", { tglAwal: "", tglAkhir: "" })
              .on("ubah", function () {
                var data = $(this).data("data");
                if (!data.tglAwal || !data.tglAkhir) return;
                var val =
                  moment(data.tglAwal).format("YYYY/MM/DD") +
                  "-" +
                  moment(data.tglAkhir).format("YYYY/MM/DD");
                if (column.search() !== val)
                  column.search(val ? val : "", true, false).draw();
              });

            var tglAwal = $(
              `<input readonly class="startdate full-width" value="" style="font-family: inherit; font-size: inherit;text-align:center;width:90px; margin-bottom:3px;"/>`
            )
              .datepicker({
                autoclose: true,
                todayHighlight: true,
                format: "dd-mm-yyyy",
              })
              .on("changeDate", function (ev) {
                var data = $(datePickerRange).data("data");
                data.tglAwal = ev.date;
                $(datePickerRange).data("ubah", data);
                $(datePickerRange).trigger("ubah");
              })
              .appendTo(datePickerRange);
            var tglAkhir = $(
              `<input readonly class="enddate full-width" value="" style="font-family: inherit; font-size: inherit;text-align:center;width:90px;"/>`
            )
              .datepicker({
                autoclose: true,
                todayHighlight: true,
                format: "dd-mm-yyyy",
              })
              .on("changeDate", function (ev) {
                var data = $(datePickerRange).data("data");
                data.tglAkhir = ev.date;
                $(datePickerRange).data("data", data);
                $(datePickerRange).trigger("ubah");
              })
              .appendTo(datePickerRange);
            break;

          case "empty-date-range-picker-integer": // Date Picker Range
            var datePickerRange = $(
              `<div style="display:flex;width:100%;flex-direction:column;">
                            <input readonly class="startdate text-center" value=""/>
                            <input readonly class="enddate text-center" value=""/>
                        </div>`
            )
              .appendTo($(cellFilter).empty())
              .daterangepicker(
                {
                  startDate: moment().startOf("month"),
                  endDate: moment().endOf("month"),
                  locale: {
                    format: "DD/MM/YYYY",
                  },
                },
                function (start, end, label) {
                  // $(this).find(".startdate").val(start.format('DD/MM/YYYY'));
                  // $(this).css("background","red");
                  // console.log(start.format('YYYY-MM-DD'));
                  // console.log(end.format('YYYY-MM-DD'));
                  // console.log(label);
                }
              )
              .on("apply.daterangepicker", function (ev, picker) {
                // var val = $.fn.dataTable.util.escapeRegex($(this).val());
                $(this)
                  .find(".startdate")
                  .val(picker.startDate.format("DD/MM/YYYY"));
                $(this)
                  .find(".enddate")
                  .val(picker.endDate.format("DD/MM/YYYY"));

                var val =
                  picker.startDate.format("YYYY/MM/DD") +
                  "-" +
                  picker.endDate.format("YYYY/MM/DD");
                if (column.search() !== val) {
                  column.search(val ? val : "", true, false).draw();
                }
              });
            break;
          case "number-range": // Range Angka
            var rangeNumber = $(
              `<div style="display:flex;width:100%;flex-direction:column;">
                                <input type="number" min="0" value="0" class="from text-right mb-1"/>
                                <input type="number" min="0" value="0" class="to text-right"/>
                            </div>`
            )
              .appendTo($(cellFilter).empty())
              .off("keyup change", "input")
              .on("keyup change", "input", function (e) {
                // if (e.originalEvent.key!="Enter")return;
                e.stopPropagation();
                const divParent = $(this).parent("div");
                if (!$(this).val()) $(this).val(0);
                var val =
                  $(divParent).find(".from").val() +
                  "-" +
                  $(divParent).find(".to").val();
                if (column.search() !== val) {
                  isProcessing = true;
                  column.search(val ? val : "", true, false).draw();
                }

                $(this).focus()[0];
                // .setSelectionRange(cursorPosition, cursorPosition);
              });
            break;
          case "time-range-picker": // Time Range Picker
            var timeRangePicker = $(`
                            <div class="timerangepicker">
                                <a href="javascript:void(0);" class ="btn btn-success btn-sm tmbl-ok"><i class="fas fa-check"></i></a>
                                <div class="knobcontainer"></div>
                                <div class="range-waktu"></div>
                                <div class="durasi"></div>
                                <div class="graph-center"></div>
                            </div>`).appendTo($("#main-wrapper"));

            var rangeTime =
              $(`<div style="display:flex;width:100%;flex-direction:column;">
                            <input type="text" class="text-center" readonly value="06:00-21:00"/>
                            </div>`)
                .appendTo($(cellFilter).empty())
                .on("click", function (e) {
                  if ($(timeRangePicker).hasClass("muncul")) {
                    $(timeRangePicker).find(".tmbl-ok").trigger("click");
                  } else {
                    $(timeRangePicker).addClass("muncul");
                    $(timeRangePicker).position({
                      my: "left+5 top",
                      at: "left bottom",
                      of: $(this),
                      collision: "fit",
                    });
                  }
                });

            $(timeRangePicker)
              .find(".knobcontainer")
              .timerangewheel({
                width: 150,
                height: 150,
                indicatorWidth: 12,
                handleRadius: 15,
                handleStrokeWidth: 1,
                accentColor: "#2C3E50",
                handleIconColor: "#fff",
                handleStrokeColor: "#fff",
                handleFillColorStart: "#374149",
                handleFillColorEnd: "#374149",
                tickColor: "#8a9097",
                indicatorBackgroundColor: "#E74C3C",
                data: {
                  start: "06:00",
                  end: "21:00",
                },
                onChange: function (timeObj) {
                  $(rangeTime)
                    .find("input")
                    .val(timeObj.start + "-" + timeObj.end);
                  $(timeRangePicker)
                    .find(".range-waktu")
                    .html(
                      '<span class="badge badge-pill badge-info">Dari : ' +
                        timeObj.start +
                        '</span><span class="badge badge-pill badge-success">Hingga : ' +
                        timeObj.end +
                        "</span>"
                    );
                  var durasi = timeObj.duration.split(":");
                  $(timeRangePicker)
                    .find(".durasi")
                    .html(
                      '<span class="badge badge-pill badge-warning">Durasi : ' +
                        parseInt(durasi[0]) +
                        " jam " +
                        parseInt(durasi[1]) +
                        " menit</span>"
                    );
                },
              });

            $(document).click(function (event) {
              if (!$(event.target).closest(rangeTime, timeRangePicker).length) {
                if ($(timeRangePicker).hasClass("muncul")) {
                  $(timeRangePicker).find(".tmbl-ok").trigger("click");
                }
              }
            });
            // $(timeRangePicker).position({
            //   my:        "left+5 top+5",
            //   at:        "left bottom",
            //   of:        $(rangeTime),
            //   collision: "fit"
            // });

            $(timeRangePicker)
              .find(".tmbl-ok")
              .on("click", function () {
                $(this).closest(".timerangepicker").removeClass("muncul");
                var val = $(rangeTime).find("input").val();
                if (column.search() !== val) {
                  isProcessing = true;
                  column.search(val ? val : "", true, false).draw();
                }
              });
            break;
          case "custom":
          case "custom-having":
            if (!customFilter) return;
            var result = window[customFilter]();
            if (!result) return;
            $(result)
              .appendTo($(cellFilter).empty())
              .on("filtering", function () {
                var val = result.data("data");
                if (column.search() !== val) {
                  isProcessing = true;
                  column.search(val ? val : "", true, false).draw();
                }
              });
            break;
          case "input-item-old": // Input
            var inputFilter = $(
              `<div style="display:flex;flex-direction:column;align-items:center;"></div>`
            )
              .appendTo($(cellFilter).empty())
              .data("data", { tglAwal: "", tglAkhir: "" })
              .on("ubah", function () {
                var data = $(this).data("data");
                if (!data.tglAwal || !data.tglAkhir) return;
                var val =
                  moment(data.tglAwal).format("YYYY/MM/DD") +
                  "-" +
                  moment(data.tglAkhir).format("YYYY/MM/DD");
                if (column.search() !== val)
                  column.search(val ? val : "", true, false).draw();
              });

            var input_code = $(`
                            <input type="text" class="" placeholder="Kode Item" autocomplete="off" style="width:100%;"/>`)
              .appendTo(inputFilter)
              .off("keyup change")
              .on("keyup change", function (e) {
                // if (e.originalEvent.key!="Enter")return;
                e.stopPropagation();

                var cursorPosition = this.selectionStart;
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                if (column.search() !== val) {
                  column.search(val ? val : "", true, false).draw();
                }

                $(this)
                  .focus()[0]
                  .setSelectionRange(cursorPosition, cursorPosition);
              });

            var input_name = $(`
                            <input type="text" class="" placeholder="Nama Item" autocomplete="off" style="width:100%;"/>`)
              .appendTo(inputFilter)
              .off("keyup change")
              .on("keyup change", function (e) {
                // if (e.originalEvent.key!="Enter")return;
                e.stopPropagation();

                var cursorPosition = this.selectionStart;
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                if (column.search() !== val) {
                  column.search(val ? val : "", true, false).draw();
                }

                $(this)
                  .focus()[0]
                  .setSelectionRange(cursorPosition, cursorPosition);
              });
            break;
          case "input-item": // Input
            var input = $(
              `<input type="text" class="" placeholder="` +
                headerText.trim() +
                `"  autocomplete="off"  readonly onclick="this.removeAttribute('readonly');" style="width:100%;"/>`
            )
              .appendTo($(cellFilter).empty())
              .off("keyup change")
              .on("keyup change", function (e) {
                // if (e.originalEvent.key!="Enter")return;
                e.stopPropagation();

                var cursorPosition = this.selectionStart;
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                if (column.search() !== val) {
                  column.search(val ? val : "", true, false).draw();
                }

                $(this)
                  .focus()[0]
                  .setSelectionRange(cursorPosition, cursorPosition);
              });
            break;
        }
      });
      $(tabel).DataTable().columns.adjust();

      this.trigger("init-end");
    },
    createdRow: (row, data, dataIndex) => {},
  };
  if (options) {
    $.each(options, function (key, value) {
      opsi[key] = value;
    });
  }
  if (opsi.serverSide) {
    opsi.ajax = {
      url: urlAJAX,
      dataType: "json",
      data: paramAJAX,
      type: "POST",
      dataSrc: function (data) {
        // console.log(data);
        return data.data;
      },
      error: function (xhr, status, error) {
        console.log(status);
        console.log(error);
        var errorMessage = xhr.status + ": " + xhr.statusText;
        console.log(errorMessage);
      },
    };
  }
  $(tabel).DataTable(opsi);

  $(tabel).addClass("initialized");

}

function kolomItem(data, type, row, meta) {
  return row.item;
}

//#region custom column
function kolomStatusPR(data, type, row, meta) {
  let strRender = "";
  switch (data) {
    case "pending":
      strRender = `<span class = "badge badge-pill badge-secondary">Pending</span>`;
    break;
    case "approved":
      strRender = `
        <button type = "button" class = "btn btn-success">
          <span>Approved by<br/><b>${row.approved_name}</b></span>
          <span class = "badge badge-light"><small>${moment(row.approved_at).format("DD MMM YYYY")}</small></span>
        </button>
      `;
    break;
    case "processed":
      strRender = `
        <button type = "button" class = "btn btn-warning" data-toggle = "tooltip" data-placement="bottom" title = "
          Approved by: <b>${row.approved_name}</b><br/><small>${moment(row.approved_at).format("DD MMM YYYY")}</small>
        ">
          <span>Processed by<br/><b>${row.processed_name}</b></span>
          <span class = "badge badge-light"><small>${moment(row.processed_at).format("DD MMM YYYY")}</small></span>
        </button>
      `;
    break;
    case "completed":
      strRender = `
        <button type = "button" class = "btn btn-primary" data-toggle = "tooltip" data-placement="bottom" title = "
          Approved by: <b>${row.approved_name}</b><br/><small>${moment(row.approved_at).format("DD MMM YYYY")}</small><br/>
          Processed by: <b>${row.processed_name}</b><br/><small>${moment(row.processed_at).format("DD MMM YYYY")}</small>
        ">
          <span>Completed by<br/><b>${row.completed_name}</b></span>
          <span class = "badge badge-light"><small>${moment(row.completed_at).format("DD MMM YYYY")}</small></span>
        </button>
      `;
    break;
    case "cancelled":
      strRender = `
        <button type = "button" class = "btn btn-danger">
          <span>Cancelled by<br/><b>${row.cancelled_name}</b></span>
          <span class = "badge badge-light"><small>${moment(row.cancelled_at).format("DD MMM YYYY")}</small></span>
        </button>
      `;
    break;
  }
  return strRender;
}

function kolomStatusPO(data, type, row, meta) {
  let strRender = "";
  switch (data) {
    case "pending":
      strRender = `<span class = "badge badge-pill badge-secondary">Pending</span>`;
    break;
    case "approved":
      strRender = `
        <button type = "button" class = "btn btn-success">
          <span>Approved by<br/><b>${row.approved_name}</b></span>
          <span class = "badge badge-light"><small>${moment(row.approved_at).format("DD MMM YYYY")}</small></span>
        </button>
      `;
    break;
    case "partially_received":
      strRender = `
        <button type = "button" class = "btn btn-warning" data-toggle = "tooltip" data-placement="bottom" title = "
          Approved by: <b>${row.approved_name}</b><br/><small>${moment(row.approved_at).format("DD MMM YYYY")}</small>
        ">
          <span>Partially Received by<br/><b>${row.partially_received_name}</b></span>
          <span class = "badge badge-light"><small>${moment(row.partially_received_at).format("DD MMM YYYY")}</small></span>
        </button>
      `;
    break;
    case "received":
      strRender = `
        <button type = "button" class = "btn btn-primary" data-toggle = "tooltip" data-placement="bottom" title = "
          Approved by: <b>${row.approved_name}</b><br/><small>${moment(row.approved_at).format("DD MMM YYYY")}</small><br/>
          Partially Redeived by: <b>${row.partially_received_name}</b><br/><small>${moment(row.partially_received_at).format("DD MMM YYYY")}</small>
        ">
          <span>Received by<br/><b>${row.received_name}</b></span>
          <span class = "badge badge-light"><small>${moment(row.received_at).format("DD MMM YYYY")}</small></span>
        </button>
      `;
    break;
    case "cancelled":
      strRender = `
        <button type = "button" class = "btn btn-danger">
          <span>Cancelled by<br/><b>${row.cancelled_name}</b></span>
          <span class = "badge badge-light"><small>${moment(row.cancelled_at).format("DD MMM YYYY")}</small></span>
        </button>
      `;
    break;
  }
  return strRender;
}

function kolomStatusEmailPO(data, type, row, meta) {
  let strRender = "";
  switch (data) {
    case "0":
      strRender = `<span class = "span-email badge badge-pill badge-secondary" data-toggle = "tooltip" data-placement="top" title = "Belum di E-Mail"><i class = "fa fa-minus-circle fa-2x"></span>`;
    break;
    case "1":
      let strTitle = "<b>Sudah di E-Mail</b>";
      if(row.details.transaksi_purchase_order_email_history.length){
        $.each(row.details.transaksi_purchase_order_email_history, (i, eh)=>{
          strTitle += `<br/>oleh: <b>${eh.username}</b> <small>${moment(eh.emailed_at).format("DD MMM YYYY")}</small>`;
        });
      }
      strRender = `<span class = "span-email badge badge-pill badge-primary" data-toggle = "tooltip" data-placement="top" title = "${strTitle}"><i class = "fa fa-check-circle fa-2x"></span>`;
    break;
  }
  return strRender;
}

function kolomKategoriSupplier(data, type, row, meta) {
  let strRender = "";
  $.each(row.details.kategori, (i, item)=>{
    strRender += (strRender? "<br>":"")+ `<span class = "badge badge-pill badge-secondary m-1">${item.kode_kategori}-${item.nama_kategori}</span>`
  });
  return strRender;
}

function kolomKategoriSupplierTender(data, type, row, meta) {
  let strRender = "";
  $.each(row.kategori, (i, item)=>{
    strRender += (strRender? "<br>":"")+ `<span class = "badge badge-pill badge-secondary m-1">${item.kode_kategori}-${item.nama_kategori}</span>`
  });
  return strRender;
}

function kolomCompany(data, type, row, meta) {
  let strRender = "";
  $.each(row.details.user_company_group, (i, item)=>{
    strRender += (strRender? "<br>":"")+ `<span class = "badge badge-pill badge-secondary m-1">${item.name}</span>`
  });
  return strRender;
}

function kolomGudang(data, type, row, meta) {
  return row.nama_gudang;
}

function kolomCompanyName(data, type, row, meta) {
  return row.company_name?row.company_name:'';
}

function kolomJenisTransaksi(data, type, row, meta) {
	return `<span class="badge badge-pills badge-${row.jenis_transaksi == 'Terima Barang'?'success':'danger'}">${data}</span>`;
}

function kolomKodeTransaksi(data, type, row, meta) {
    let strKlik = '';
    switch (row.jenis_transaksi){
        case "Terima Barang":
            strKlik = `addTab('penerimaanbarang', 'Penerimaan Barang', 'template/transaksi/penerimaan-barang-view.php?id=${row.id_header}')`
        break;
        case 'Pemakaian Barang':
            strKlik = `addTab('pemakaianbarang', 'Pemakaian Barang', 'template/transaksi/pemakaian-barang-view.php?id=${row.id_header}')`
        break;
    }
	return `<a href="javascript:void(0);" onclick="${strKlik}">${data}</a>`;
}

function kolomJumlahTersedia(data, type, row, meta) {
  let strRender = `
    <div class="input-group">
      <input type = "text" class = "form-control box-detail box-crud text-right" name = "jumlah_tersedia" value = "${number_format(parseFloat(data))}"> 
      <div class="input-group-append box-detail-group">
        <span class="input-group-text">${row.nama_satuan}</span>
      </div>
    </div>
  `;

  return strRender;
}

function kolomViewJumlah(data, type, row, meta) {
  let strRender = `${number_format(parseFloat(data))} ${row.nama_satuan}`;

  return strRender;
}

// Peneriman Barang
function kolomPilihItem(data, type, row, meta) {
	let strRender = `<select name = "id_item" class="custom-select box-crud select2 box-detail"><option></option>`;
	if (opsiItem.length) {
		$.each(opsiItem, (idx, item) => {
			strRender += `<option value ="${item.id}" ${item.id == data ? "selected" : ""} data-part_number = "${item.part_number}" data-kategori = "${item.kategori}" data-merek = "${item.merek}" data-id_master_satuan = "${item.id_master_satuan}" data-nama_satuan = "${item.nama_satuan}" data-nilai_konversi = "${item.nilai_konversi}">
				${item.kode_item} - ${item.nama_item}
			</option>`;
		});
	}
	strRender += `</select>`;
	return strRender;
}

function kolomStatusPNB(data, type, row, meta) {
  let strRender = "";
  switch (data) {
    case "pending":
      strRender = "Pending";
    break;
    case "approved":
      strRender = "Approved";
    break;    
  }
  return strRender;
}

function kolomAksiDetail(data, type, row, meta) {
	const strRender = `
        <a href="javascript:void(0)" class="btn btn-delete p-1 mr-1" onclick = "hapusDetail(this);">
			<i class="fas fa-times f-10px"></i>
		</a>
    `;

	return strRender;
}

function kolomFileView(data, type, row, meta) {
	let path = '../../style/img/no-image.png';
	let pathFile = "javascript:void(0);";
	if (row.file !== '') {
		pathFile = "../../uploads/" + row.file;
		path = pathFile;
		if(Object.prototype.toString.call(row.file) == '[object String]' ){
			if(row.file.split(".")[1] === "pdf"){
				path = '../../style/img/logo-pdf.png';
			}
		}
	}
	let strRender = `
		<div class = "kotak-file">
			<a href="${pathFile}" target="_blank">
				<img name="preview-file" src="${path}" class = "gambar" />
			</a>
		</div>
	`;
	return strRender;
}

function kolomNoPR(data, type, row, meta) {
	const strRender = `<a href = "javascript:void(0);" onclick = "addTab('purchaserequest', 'Purchase Request', 'template/transaksi/purchase-request-view.php?id=${row.id_transaksi_purchase_request}');">${data}</a>`;
	return strRender;
}

function kolomNoTender(data, type, row, meta) {
	const strRender = `<a href = "javascript:void(0);" onclick = "addTab('tender', 'Tender', 'template/transaksi/tender-view.php?id=${row.id_transaksi_tender}');">${data}</a>`;
	return strRender;
}

function kolomSupplier(data, type, row, meta) {
	const strRender = `<a href = "javascript:void(0);" onclick = "addTab('supplier', 'Supplier', 'template/master/supplier-view.php?id=${row.id_master_supplier}');"><b>${row.kode_supplier}</b>-${row.nama_supplier}</a>`;
	return strRender;
}

function kolomNoPO(data, type, row, meta) {
	const strRender = `<a href = "javascript:void(0);" onclick = "addTab('purchaseorder', 'Purchase Order', 'template/transaksi/purchase-order-view.php?id=${row.id_transaksi_purchase_order}');">${data}</a>`;
	return strRender;
}

function kolomJumlah(data, type, row, meta) {
	let strRender = `
		<span>${number_format(data)} ${row.nama_satuan}</span>
	`;
	return strRender;
}

function kolomStok(data, type, row, meta) {
  let strOption = "";
  $.each(row.list_satuan, (i, item)=>{
    strOption += `
      <a class="dropdown-item" href="javascript:void(0);" data-nilai_konversi = "${item.nilai_konversi}">${item.nama_satuan}</a>
    `;
  });

	let strRender = `
		<div class="input-group">
      <span class="form-control text-right box-detail">${number_format(data)}</span>
      <div class="input-group-append box-detail-group">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">${row.nama_satuan}</button>
        <div class="dropdown-menu">
          ${strOption}
        </div>
      </div>
    </div>
	`;
	return strRender;
}


//#endregion

//#region custom option
function optionKategoriItem() {
  let opsi = [];
  $.ajax({
    url: baseURL+"incl/opsi.php",
    type: "POST",
    dataType: "JSON",
    async: false,
    data: {
      action: "opsi-kategori-item",
    },
    success: (data) => {
      if (data.data.length) {
        $.each(data.data, function (i, item) {
          opsi.push({
            val: item.id,
            text: `${item.kode_kategori} - ${item.nama_kategori}`,
          });
        });
      }
    },
  });
  return opsi;
}

function optionMerekItem() {
  let opsi = [];
  $.ajax({
    url: baseURL+"incl/opsi.php",
    type: "POST",
    dataType: "JSON",
    async: false,
    data: {
      action: "opsi-merek-item",
    },
    success: (data) => {
      if (data.data.length) {
        $.each(data.data, function (i, item) {
          opsi.push({
            val: item.id,
            text: `${item.kode_merek} - ${item.nama_merek}`,
          });
        });
      }
    },
  });
  return opsi;
}

function optionGudang() {
  let opsi = [];
  $.ajax({
    url: baseURL+"incl/opsi.php",
    type: "POST",
    dataType: "JSON",
    async: false,
    data: {
      action: "opsi-gudang",
    },
    success: (data) => {
      if (data.data.length) {
        $.each(data.data, function (i, item) {
          opsi.push({
            val: item.id,
            text: `${item.kode_gudang} - ${item.nama_gudang}`,
          });
        });
      }
    },
  });
  return opsi;
}

function optionGudangUser() {
  let opsi = [];
  $.ajax({
    url: baseURL+"incl/opsi.php",
    type: "POST",
    dataType: "JSON",
    async: false,
    data: {
      action: "opsi-gudang-user",
    },
    success: (data) => {
      if (data.data.length) {
        $.each(data.data, function (i, item) {
          opsi.push({
            val: item.id,
            text: `${item.kode_gudang} - ${item.nama_gudang}`,
          });
        });
      }
    },
  });
  return opsi;
}

function optionCompany() {
  let opsi = [];
  $.ajax({
    url: baseURL+"incl/opsi.php",
    type: "POST",
    dataType: "JSON",
    async: false,
    data: {
      action: "opsi-company",
    },
    success: (data) => {
      if (data.data.length) {
        $.each(data.data, function (i, item) {
          opsi.push({
            val: item.id,
            text: `${item.name}`,
          });
        });
      }
    },
  });
  return opsi;
}

function optionCompanyUser() {
  let opsi = [];
  $.ajax({
    url: baseURL+"incl/opsi.php",
    type: "POST",
    dataType: "JSON",
    async: false,
    data: {
      action: "opsi-company-user",
    },
    success: (data) => {
      if (data.data.length) {
        $.each(data.data, function (i, item) {
          opsi.push({
            val: item.id,
            text: `${item.name}`,
          });
        });
      }
    },
  });
  return opsi;
}

function optionStatusPR() {
  return [
    {
      val: "pending",
      text: "Pending",
    },
    {
      val: "approved",
      text: "Approved",
    },
    {
      val: "processed",
      text: "Processed",
    },
    {
      val: "completed",
      text: "Completed",
    },
    {
      val: "cancelled",
      text: "Cancelled",
    },
  ];
}

function optionStatusPO() {
  return [
    {
      val: "pending",
      text: "Pending",
    },
    {
      val: "approved",
      text: "Approved",
    },
    {
      val: "partially_received",
      text: "Partially Received",
    },
    {
      val: "received",
      text: "Received",
    },
    {
      val: "cancelled",
      text: "Cancelled",
    },
  ];
}

function optionStatusEmailPO() {
  return [
    {
      val: "0",
      text: "Belum di E-Mail",
    },
    {
      val: "1",
      text: "Sudah di E-Mail",
    },
  ];
}

function optionStatusPNB() {
  return [
    {
      val: "pending",
      text: "Pending",
    },
    {
      val: "approved",
      text: "Approved",
    },    
  ];
}

//#endregion

//#region custom filter
//#endregion
