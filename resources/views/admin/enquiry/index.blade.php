@extends('layouts.backend.master')

@section('title')
    Enquiry
@endsection

@push('styles')
    @include('admin.injector.admin-attriutes-injector')
    {{--
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/admin/datatables.min.css') }}">
    --}}
    {{--
    <link rel="stylesheet" href="https://code.jquery.com/jquery-3.5.1.js"> --}}

    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-colvis-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/cr-1.5.2/fc-3.3.1/fh-3.1.7/r-2.2.6/sc-2.0.3/sb-1.0.0/sp-1.2.0/datatables.min.css" /> --}}

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/colreorder/1.5.2/css/colReorder.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css" />
    <style>
        tfoot {
            display: table-header-group;
        }

    </style>

@endpush

@push('scripts')
    
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js">
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', ".modal-trigger", function() {
                $(this).addClass('delete-item-trigger-clicked');
                var options = {
                    'backdrop': 'static'
                };
                $('#delete-modal').modal(options)
                $("#delete-modal-label").text('Delete item?')
            })
            $(document).on('click', "#delete-action-confirm", function() {
                $('.delete-item-trigger-clicked').siblings(".delete-data-form").submit();
            })
            $('#delete-modal').on('hide.bs.modal', function() {
                $('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked')
            })
        });

    </script>
    <script>
        $(document).ready(function() { //to call datatable api using ajax enquiry index page
            $('#posts').DataTable({
                "processing": true,
                "serverSide": true,
                "bFilter": true,
                // "sDom": 'lBrtip',
                dom: 'lBrtip',
                "pagingType": "full_numbers",
                // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "ajax": {
                    "url": "{{ route('admin.enquiry.paginate') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    }
                },
                "buttons": [
                     'csv', 'pdf', 'print','colvis'
                    // {
                    //     "extend": 'excelHtml5',
                    //     "title": 'Enquiry',
                    //     "exportOptions": {
                    //         columns: [0, ':visible']
                    //     }
                    // },
                    // {
                    //     "extend": 'csv',
                    //     "title": 'Enquiry',
                    //     "exportOptions": {
                    //         columns: [0, ':visible']
                    //     }
                    // },
                    // {
                    //     "extend": 'pdfHtml5',
                    //     "title": 'Enquiry',
                    //     "exportOptions": {
                    //         columns: [0, ':visible']
                    //     }
                    // },
                    // {
                    //     "extend": 'print',
                    //     "title": 'Enquiry',
                    //     "exportOptions": {
                    //         columns: [0, ':visible']
                    //     }
                    // },
                    // {
                    //     "extend": 'colvis'
                    // }
                ],
                "columns": [{
                        "data": "iteration"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "mobile"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "comment"
                    },
                    {
                        "data": "type"
                    },
                    {
                        "data": "id",
                        "orderable": false, //hide ordering for action column
                        "render": function(data) {
                            // console.log(data);

                            var editUrl = "{{ route('admin.enquiry.edit', ':itemId') }}";
                            var deleteUrl = "{{ route('admin.enquiry.destroy', ':itemId') }}";

                            var editUrlWithItemId = editUrl.replace(':itemId', data);
                            var deleteUrlWithItemId = deleteUrl.replace(':itemId', data);

                            //action buttons (edit and delete)
                            data = '<a href="' + editUrlWithItemId +'" class="btn btn-small tooltipped teal lighten-1" data-position="left" data-delay="50" data-tooltip="Edit Entry" style="margin-right: 10px;"><i class="fa fa-eye"></i></a>' +
                                '<form method="POST" class="delete-data-form" action="' +deleteUrlWithItemId + '" hidden>' +
                                '{{ csrf_field() }}' +
                                '{{ method_field('DELETE ') }}' +
                                '</form>' +
                                '<a href="#delete-modal" class="btn btn-small tooltipped modal-trigger red lighten-1" data-position="right" data-delay="50" data-tooltip="Delete Entry"><i class="fa fa-check-circle"></i></a>';
                            return data;
                        }
                    }
                ],
                initComplete: function () {
                    var api = this.api();
                    var timer;
                    var delay = 500

                    // Apply the search
                    api.columns().every(function() {
                        var that = this;

                        // console.log($('input', this.footer()))
                        $('input', this.footer()).on('keyup change', function() {
                            if (that.search() !== this.value) {
                                if(timer != null){
                                    clearTimeout(timer);
                                }
                                timer = setTimeout(() => {
                                    console.log("send")
                                    that
                                    .search(this.value)
                                    .draw();
                                }, delay);
                            }
                        });
                    });
                }   

            });
        });

    </script>
    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#posts tfoot th').each(function() {
                var title = $(this).text();
                if (title == '#' || title == 'Action') {
                    $(this).html('<input type="text" hidden/>');
                } else {

                    $(this).html('<input type="text" placeholder="' + title + '" />');
                }
            });

        });

    </script>

@endpush

@section('page-content')
    <div class="main-container container-fluid">
        @include('layouts.backend.messages')
        <!-- heading -->
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="text-primary mr-auto">Enquiry</h1>
                </div>
            </div>
        </div>
        <!-- /heading -->
        <!-- table -->
        <table class="table table-striped table-bordered" id="posts" cellspacing="0" width="100%">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Comment</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Comment</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
        <!-- /table -->
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-label">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    <h4 class="text-center">Are you sure you want to complete this item?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" id="delete-action-confirm" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /Delete Modal -->
@endsection
