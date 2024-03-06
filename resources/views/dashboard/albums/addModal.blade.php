<!-- start add modal -->
<div class="modal" id="addModal">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('main.Add') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form method="POST" action="{{ route('albums.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- name -->
                        <div class="col-6">
                            <label for="name_ar" class="mr-sm-2">{{ trans('main.Name') }} :</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                        <!-- image -->
                        <div class="col-6">
                            <label for="image" class="mr-sm-2">{{ trans('main.Image') }} :</label>
                            <input type="file" name="image" class="dropify form-control" accept="image/*" data-height="70" required/>
                        </div>
                        <!-- images -->
                        <div class="col-6">
                            <label for="images" class="mr-sm-2">{{ trans('main.Images') }} :</label>
                            <input id="demo" type="file" name="images[]" class="form-control" accept="image/*" data-height="70" multiple required/>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-success ripple">{{ trans('main.Confirm') }}</button>
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">{{ trans('main.Close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end add modal -->