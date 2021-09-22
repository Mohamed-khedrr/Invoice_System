@extends('layouts.master')
@section('title')
    الاقسام
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاقسام</span>
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
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
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

                        {{-- Validation errors --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                {{--end of Validation errors --}}

                                @if(session()->has('edit'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ session()->get('edit') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if(session()->has('insert'))
                                <div class="alert alert-success" role="alert">
                                    {{session()->get('insert')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                @endif

                                @if(session()->has('delete'))
                                    <div class="alert alert-success" role="alert">
                                        {{session()->get('delete')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif


				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <div class="col-sm-6 col-md-4 col-xl-3">
                                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo1">اضافة قسم</a>
                                        </div>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-md-nowrap" id="example1">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">#</th>
                                                <th class="wd-15p border-bottom-0">اسم القسم</th>
                                                <th class="wd-15p border-bottom-0">الوصف</th>
                                                <th class="wd-15p border-bottom-0" >العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0 ; ?>
                                            @foreach ($sections as $section)
                                            <tr>
                                                <td>{{++$i}}</td>
                                                <td>{{$section->section_name}}</td>
                                                <td>{{$section->description}}</td>
                                                <td>

                                                    <a class="modal-effect btn btn btn-info" data-effect="effect-scale"
                                                        data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}"
                                                        data-description="{{ $section->description }}" data-toggle="modal" href="#modaldemo2"
                                                        title="تعديل"><i class="las la-pen"></i>
                                                    </a>

                                                    <a class="modal-effect btn btn-danger" data-effect="effect-scale"
                                                        data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}" data-toggle="modal"
                                                        href="#modaldemo3" title="حذف"><i class="las la-trash"></i>
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
                    <!--/div-->

                    <!--div-->

                            {{-- insert modal  --}}
                    <div class="modal" id="modaldemo1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <h6></h6>
                                    <form action="{{route('sections.store')}}" method="POST" autocomplete="off">
                                        @csrf
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">اسم القسم</label>
                                          <input type="text" name="section_name" class="form-control" id="exampleInputEmail1" placeholder="اسم القسم">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">الوصف</label>
                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                          </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">اضافة</button>
                                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                                        </div>
                                      </form>
                                </div>
                            </div>
                        </div>
                    </div>
                            {{---end of insert modal--}}

                            {{-- edit modal  --}}
                            <div class="modal" id="modaldemo2">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">تعديل قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6></h6>
                                            <form action="sections/update" method="POST" autocomplete="off">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" id="id" >
                                                <div class="form-group">
                                                  <label for="exampleInputEmail1">اسم القسم</label>
                                                  <input type="text" name="section_name" class="form-control" id="section_name" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">الوصف</label>
                                                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                                  </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">تعديل</button>
                                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                                                </div>
                                              </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- end of edit modal --}}

                             {{-- delete modal  --}}
                             <div class="modal" id="modaldemo3">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">حذف قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6></h6>
                                            <form action="sections/destroy" method="POST" autocomplete="off">
                                                @csrf
                                                @method('DELETE')
                                                <h5> هل انت متأكد من حذف هذا القسم </h5>
                                                <input type="hidden" name="id" id="id">
                                                <div class="form-group">
                                                    <input type="text" readonly name="section_name" class="form-control" id="section_name" >
                                                  </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                                                </div>
                                              </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- end of delete modal --}}



                </div>
                <!-- /row -->
            </div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
{{-- pathing data to edit modal --}}
<script>
    $('#modaldemo2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
    })
</script>

{{-- pathing data to delete modal --}}
<script>
    $('#modaldemo3').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
    })
</script>

@endsection
