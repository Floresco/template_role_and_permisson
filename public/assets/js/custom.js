function handleBlockUI() {
    $.blockUI({
        message: '<div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status"> ' +
            '<span class="visually-hidden">Loading...</span>' +
            '</div>',
        css: {
            backgroundColor: "transparent",
            border: "0"
        },
        overlayCSS: {
            backgroundColor: "#fff",
            opacity: 0.8
        }
    });
}

function handleUnblockUI() {
    $.unblockUI();
}

function handleBlockModal() {
    $('.modal').block({
        message: '<div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status"> ' +
            '<span class="visually-hidden">Loading...</span>' +
            '</div>',
        css: {
            backgroundColor: "transparent",
            border: "0"
        },
        overlayCSS: {
            backgroundColor: "#fff",
            opacity: 0.8
        }
    });
}

function handleUnblockModal() {
    $('.modal').unblock();
}

$('.is-phone').each(function () {
    $(this).keyup(function () {
        const phoneNumberString = $(this).val();
        $(this).val(phoneNumberString.replace(/\D/g, '')
            .replace(/(\d{1,3})(\d{1,4})?(\d{1,4})?(\d{1,4})?(\d{1,4})?/g, function (txt, f, s, t, u, v) {
                if (v) {
                    return `(${f}) ${s} ${t} ${u} ${v}`
                } else if (u) {
                    return `(${f}) ${s} ${t} ${u}`
                } else if (t) {
                    return `(${f}) ${s} ${t}`
                } else if (s) {
                    return `(${f}) ${s}`
                } else if (f) {
                    return `(${f})`
                }
            }));
    });
});
$('.is-number').each(function () {
    $(this).keyup(function () {
        if (isNaN(this.value)) {
            this.value = this.defaultValue;
        } else {
            this.defaultValue = this.value;
        }
    });
})
$('.is-string').each(function () {
    $(this).keyup(function () {
        const regex = /^[a-zA-Z ]+$/i;
        if (!regex.test(this.value)) {
            this.value = this.value.slice(0, this.value.length - 1)

        } else {
            this.defaultValue = this.value;
        }
    })
})
$('.is-prefix').each(function () {
    $(this).keyup(function () {
        const regex = /^[0-9;]+$/i;
        if (!regex.test(this.value)) {
            this.value = this.value.slice(0, this.value.length - 1)
        } else {
            this.defaultValue = this.value;
        }
    })
})
$('.select2').each(function (){
    $(this).select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
        dropdownParent: $(this).parent(),
        searchInputPlaceholder: $(this).data('search-placeholder'),
    })
    $(this).on('select2:open', function () {
        $('.select2-selection__choice__remove').addClass('select2-remove-right');
    });
})
$('.nobr').keyup(function () {
    let data = this.value
    if ($.trim(data) !== "") {
        this.value = data.replace(/\n/g, ", ")
    } else {
        this.value = ""
    }
})

function initListDataTable() {
    $('.dataTables_scrollBody').css('min-height', '400px');
    $(".is-search-table tfoot th").each(function () {
        const title = $(this).text();
        if (title !== '') {
            $(this).html("<input type=\"text\" class=\"form-control\" placeholder=\" " + title + "\" />");
        }
    });
    const is_search_table = $('.is-search-table').DataTable({
        responsive: false,
        lengthChange: !1,
        destroy: true,
        fixedHeader: true,
        // sDom: '<"row"<"col-lg-4"l><"col-lg-4 text-right"B><"col-lg-4"f>><"table-responsive"t><"row"<i><p>>', // 'Bfrtip'
        buttons: [
            {
                extend: "excel",
                text: "Excel",
                exportOptions: {
                    columns: function (idx, data, node) {
                        return node.innerHTML !== "";
                    }
                }
            },
            {
                extend: "csv",
                text: "CSV",
                exportOptions: {
                    columns: function (idx, data, node) {
                        return node.innerHTML !== "";
                    }
                }
            },
            {
                extend: "pdf",
                text: "PDF",
                exportOptions: {
                    columns: function (idx, data, node) {
                        return node.innerHTML !== "";
                    }
                }
            },
            {
                extend: "copy",
                text: "Copier",
                exportOptions: {
                    columns: function (idx, data, node) {
                        return node.innerHTML !== "";
                    }
                }
            },
            {
                extend: "print",
                text: "Imprimer",
                exportOptions: {
                    columns: function (idx, data, node) {
                        return node.innerHTML !== "";
                    }
                }
            },
        ],
        language: {
            "sEmptyTable": "Aucune donnée disponible dans le tableau",
            "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
            "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Afficher _MENU_ éléments",
            "sLoadingRecords": "Chargement...",
            "sProcessing": "Traitement...",
            "sSearch": "Recherche :",
            "searchPlaceholder": "Rechercher ...",
            "sZeroRecords": "Aucun élément correspondant trouvé",
            "oPaginate": {
                "sFirst": "Premier",
                "sLast": "Dernier",
                "sNext": "Suivant",
                "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            },
            "select": {
                "rows": {
                    "_": "%d lignes sélectionnées",
                    "0": "Aucune ligne sélectionnée",
                    "1": "1 ligne sélectionnée"
                }
            }
        },
        "aaSorting": [],
        "scrollX": true,
        "scrollY": "450px",
        "scrollCollapse": true,
        "searching": true,
        "paging": true,
        "info": true,
        "pageLength": 50
    })
    is_search_table.buttons().container().appendTo(".dataTables_wrapper .col-md-6:eq(0)");
    is_search_table.columns().every(function () {
        const that = this;
        $("input", this.footer()).on("keyup change clear", function () {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
}

initListDataTable();

function toggle_pwd(item) {
    const elm = $(item);
    if ($('input#password').attr('type') === 'password') {
        $('input#password').attr('type', 'text')
        elm.removeClass('fa-eye-slash')
        elm.addClass('fa-eye')
    } else {
        $('input#password').attr('type', 'password')
        elm.removeClass('fa-eye')
        elm.addClass('fa-eye-slash')
    }
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
