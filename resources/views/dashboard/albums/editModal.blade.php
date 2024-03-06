<!-- start edit modal -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('main.Edit') }} {{ trans('main.Album') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form action="{{ route('albums.update', 'test') }}" method="post" enctype="multipart/form-data">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="row">

                        <!-- name -->
                        <div class="col-6">
                            <label for="name" class="mr-sm-2">{{ trans('main.Name') }} :</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                        </div>

                        <!-- image -->
                        <div class="col-6">
                            <label for="image" class="mr-sm-2">{{ trans('main.Image') }} :</label>
                            <input type="file" name="image" class="dropify" accept="image/*" data-height="70" required/>
                            @if(@$item->img)
                                <img src="{{ $item->img->localUrl }}" alt="{{ $item->img->name }}" height="50" width="50">
                            @endif
                        </div>

                        <!-- images -->
                        <div class="col-6">
                            <label for="images" class="mr-sm-2">{{ trans('main.Images') }} :</label>
                            <input type="file" name="images[]" class="dropify" accept="image/*" data-height="70" multiple required/>
                            @if($item->images)
                                @foreach($item->images as $image)
                                    @foreach($image as $img=>$val)
                                        <img src="{{ $val }}" alt="{{ $val }}" height="50" width="50">
                                    @endforeach
                                @endforeach
                            @endif
                        </div>

                        <!-- id -->
                        <div class="col-6">
                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
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
<!-- end edit modal -->
