@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Elements</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Tabs</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">


        <!-- /div -->

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style3">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        Basic Style3 Tabs
                    </div>
                    <p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p>
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-3">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu ">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs">
                                            <li class=""><a href=" #tab11" class="active" data-toggle="tab"><i
                                                    class="fa fa-laptop"></i> الفاتورة </a></li>
                                            <li><a href="#tab12" data-toggle="tab"><i class="fa fa-cube"></i> تفاصيل
                                                    الفاتورة</a></li>
                                            <li><a href="#tab13" data-toggle="tab"><i class="fa fa-cogs"></i> مرفقات
                                                    الفاتورة</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab11">
                                            <table id="example1" class="table key-buttons text-md-nowrap"
                                                data-page-length='50' style="text-align: center">

                                                <tbody>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">رقم الفاتورة</th>
                                                        <td>{{ $invoices->invoice_number }}</td>
                                                        <th scope="row">تاريخ الاصدار</th>
                                                        <td>{{ $invoices->invoice_date }}</td>
                                                        <th scope="row">تاريخ الاستحقاق</th>
                                                        <td>{{ $invoices->due_date }}</td>
                                                        <th scope="row">القسم</th>
                                                        <td>{{ $invoices->Section->section_name }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">المنتج</th>
                                                        <td>{{ $invoices->product }}</td>
                                                        <th scope="row">مبلغ التحصيل</th>
                                                        <td>{{ $invoices->amount_collection }}</td>
                                                        <th scope="row">مبلغ العمولة</th>
                                                        <td>{{ $invoices->amount_Commission }}</td>
                                                        <th scope="row">الخصم</th>
                                                        <td>{{ $invoices->discount }}</td>
                                                    </tr>


                                                    <tr>
                                                        <th scope="row">نسبة الضريبة</th>
                                                        <td>{{ $invoices->rate_vat }}</td>
                                                        <th scope="row">قيمة الضريبة</th>
                                                        <td>{{ $invoices->value_vat }}</td>
                                                        <th scope="row">الاجمالي مع الضريبة</th>
                                                        <td>{{ $invoices->total }}</td>
                                                        <th scope="row">الحالة الحالية</th>

                                                        @if ($invoices->value_status == 1)
                                                            <td><span
                                                                    class="badge badge-pill badge-success">{{ $invoices->status }}</span>
                                                            </td>
                                                        @elseif($invoices->Value_Status ==2)
                                                            <td><span
                                                                    class="badge badge-pill badge-danger">{{ $invoices->status }}</span>
                                                            </td>
                                                        @else
                                                            <td><span
                                                                    class="badge badge-pill badge-warning">{{ $invoices->status }}</span>
                                                            </td>
                                                        @endif
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">ملاحظات</th>
                                                        <td>{{ $invoices->note }}</td>
                                                    </tr>
                                                </tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="tab12">
                                            <table class="table center-aligned-table mb-0 table-hover"
                                                style="text-align:center">
                                                <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th>رقم الفاتورة</th>
                                                        <th>نوع المنتج</th>
                                                        <th>القسم</th>
                                                        <th>حالة الدفع</th>
                                                        <th>تاريخ الدفع </th>
                                                        <th>ملاحظات</th>
                                                        <th>تاريخ الاضافة </th>
                                                        <th>المستخدم</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; ?>
                                                    @foreach ($details as $x)
                                                        <?php $i++; ?>
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $x->invoice_number }}</td>
                                                            <td>{{ $x->product }}</td>
                                                            <td>{{ $invoices->Section->section_name }}
                                                            </td>
                                                            @if ($x->value_status == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $x->status }}</span>
                                                                </td>
                                                            @elseif($x->value_status ==2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $x->status }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $x->status }}</span>
                                                                </td>
                                                            @endif
                                                            <td>{{ $x->payment_date }}</td>
                                                            <td>{{ $x->note }}</td>
                                                            <td>{{ $x->created_at }}</td>
                                                            <td>{{ $x->user }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>



                                        {{-- attachments tab --}}
                                        <div class="tab-pane" id="tab13">

                                            <form action="{{ route('details.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <h4>اضافة مرفقات</h4>
                                                <input type="hidden" value="{{ $invoices->invoice_number }}"
                                                    name="invoice_number">
                                                <input type="hidden" value="{{ $invoices->id }}" name="invoice_id">

                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="validatedCustomFile"
                                                        name="file">
                                                    <label class="custom-file-label" for="validatedCustomFile"> اختر ملف
                                                    </label>
                                                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                                                </div>

                                                <button class="btn btn-primary" type="submit">تأكيد</button>
                                            </form>
                                            <br>

                                            <table class="table center-aligned-table mb-0 table-hover"
                                                style="text-align:center">
                                                <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th>تاريخ الاضافة</th>
                                                        <th>قام بالاضافة</th>
                                                        <th>العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; ?>
                                                    @foreach ($attachments as $attach)
                                                        <?php $i++; ?>
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $attach->created_at }}</td>
                                                            <td>{{ $attach->creared_by }}</td>
                                                            <td>
                                                                {{-- show icon --}}
                                                                <a class="btn btn-outline-success btn-sm"
                                                                    href="{{ url('view_file') }}/{{ $invoices->invoice_number }}/{{ $attach->file_name }}"
                                                                    role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                    عرض</a>
                                                                {{-- download icon --}}
                                                                <a class="btn btn-outline-info btn-sm"
                                                                    href="{{ url('download_file') }}/{{ $invoices->invoice_number }}/{{ $attach->file_name }}"
                                                                    role="button"><i class="fas fa-download"></i>&nbsp;
                                                                    تحميل</a>
                                                                {{-- delete icon --}}
                                                                {{-- <button class="btn btn-outline-danger btn-sm"
                                                                    data-toggle="modal"
                                                                    data-file_name="{{ $attach->file_name }}"
                                                                    data-invoice_number="{{ $attach->invoice_number }}"
                                                                    data-id="{{ $attach->id }}"
                                                                    data-target="#delete_file">حذف</button> --}}

                                                                <a class="btn btn-outline-danger btn-sm"
                                                                    data-effect="effect-scale"
                                                                    data-id="{{ $attach->id }}"
                                                                    data-file_name="{{ $attach->file_name }}"
                                                                    data-invoice_number="{{ $attach->invoice_number }}"
                                                                    data-toggle="modal" href="#modal" title="حذف"><i
                                                                        class="las la-trash"> حذف</i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!---delete modal-->
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> حذف منتج</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('details.destroy', 'test') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id">
                                                <h5>هل انت متأكد من حذف المنتج</h5>
                                                <label for="invoice_number"> رقم الفاتورة </label>
                                                <input type="text" class="form-control" readonly id="invoice_number"
                                                    name="invoice_number">
                                                <label for="file_name"> اسم الملف </label>
                                                <input type="text" class="form-control" readonly id="file_name"
                                                    name="file_name">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">تاكيد</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">اغلاق</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!---end of delete modal-->
                    </div>
                </div>
            </div>
        </div>
        <!-- /div -->





        <!-- /row -->
    </div>

@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

    <script>
        $('#modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_number = button.data('invoice_number')
            var file_name = button.data('file_name')
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #invoice_number').val(invoice_number);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #id').val(id);
        })
    </script>
@endsection
