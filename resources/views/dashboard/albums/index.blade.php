@extends('layouts.master')



@section('css')
    <!---Internal Fileuploads css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal FancyUploder css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    @section('title')
        {{ trans('main.Albums') }}
    @stop
@endsection



@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('main.Dashboard') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main.Albums') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection


@section('content')

            <!-- validationNotify -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- success Notify -->
            @if (session()->has('success'))
                <script id="successNotify">
                    window.onload = function() {
                        notif({
                            msg: "تمت العملية بنجاح",
                            type: "success"
                        })
                    }
                </script>
            @endif

            <!-- error Notify -->
            @if (session()->has('error'))
                <script id="errorNotify">
                    window.onload = function() {
                        notif({
                            msg: "لقد حدث خطأ.. برجاء المحاولة مرة أخرى!",
                            type: "error"
                        })
                    }
                </script>
            @endif

            <!-- canNotDeleted Notify -->
            @if (session()->has('canNotDeleted'))
                <script id="canNotDeleted">
                    window.onload = function() {
                        notif({
                            msg: "لا يمكن الحذف لوجود بيانات أخرى مرتبطة بها..!",
                            type: "error"
                        })
                    }
                </script>
            @endif

            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row row-xs wd-xl-60p">
                                <div class="col-sm-6 col-md-3">
                                    @can('إضافة الألبومات')
                                        <a class="modal-effect btn btn-primary ripple" data-effect="effect-newspaper" data-toggle="modal" href="#addModal">
                                            <i class="mdi mdi-plus"></i>&nbsp;{{ trans('main.Add') }} {{ trans('main.New') }}
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive hoverable-table">
                                <table class="table table-hover" id="example1" style=" text-align: center;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">{{ trans('main.Name') }}</th>
                                            <th class="text-center">{{ trans('main.Image') }}</th>
                                            <th class="text-center">{{ trans('main.Images') }}</th>
                                            <th class="text-center">{{ trans('main.Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($data->count() > 0)
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td class="text-center">{{ $item->name }}</td>
                                                    <td class="text-center">
                                                        @if(@$item->img)
                                                            <img src="{{ $item->img->localUrl }}" alt="{{ $item->img->name }}" height="50" width="50">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($item->images)
                                                            @foreach($item->images as $image)
                                                                @foreach($image as $img=>$val)
                                                                    <img src="{{ $val }}" alt="{{ $val }}" height="50" width="50">
                                                                @endforeach
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">
                                                                <i class="fas fa-caret-down"></i>{{ trans('main.Actions') }}
                                                            </button>
                                                            <div class="dropdown-menu bd-primary rounded-5">
                                                                @can('تعديل الألبومات')
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit{{ $item->id }}" title="{{ trans('main.Edit') }}">
                                                                        <i class="text-info fas fa-pencil-alt"></i>&nbsp;&nbsp;{{ trans('main.Edit') }}
                                                                    </a>
                                                                @endcan
                                                                @can('حذف الألبومات')
                                                                    @if($item->image || $item->images)
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#moveAndDelete{{ $item->id }}" title="{{ trans('main.Move Images To Other Album Then Delete') }}">
                                                                            <i class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;{{ trans('main.Move Images To Other Album Then Delete') }}
                                                                        </a>
                                                                    @endif
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{ $item->id }}" title="{{ trans('main.Delete') }}">
                                                                        <i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;{{ trans('main.Force Delete') }}
                                                                    </a>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('dashboard.albums.editModal')
                                                @include('dashboard.albums.deleteModal')
                                                @include('dashboard.albums.moveAndDeleteModal')
                                            @endforeach
                                            @include('dashboard.albums.addModal')
                                        @else
                                            <tr>
                                                <th class="text-center" colspan="10">
                                                    <div class="col mb-3 d-flex">
                                                        <div class="card flex-fill">
                                                            <div class="card-body p-3 text-center">
                                                                <p class="card-text f-12">{{ trans('main.No Data Founded') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!--/div-->

                <!-- Modal effects -->
                <div class="modal" id="modaldemo8">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">{{ trans('main.Delete') }} {{ trans('main.User') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{ route('users.destroy', 'test') }}" method="post">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <p>{{ trans('main.Are You Sure Of Deleting..??') }}</p><br>
                                    <input type="hidden" name="user_id" id="user_id" value="">
                                    <input class="form-control" name="username" id="username" type="text" readonly>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main.Close') }}</button>
                                    <button type="submit" class="btn btn-danger">{{ trans('main.Confirm') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection



@section('js')
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

    <script>
        $('#modaldemo8').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var user_id = button.data('user_id')
            var username = button.data('username')
            var modal = $(this)
            modal.find('.modal-body #user_id').val(user_id);
            modal.find('.modal-body #username').val(username);
        })
    </script>
@endsection
