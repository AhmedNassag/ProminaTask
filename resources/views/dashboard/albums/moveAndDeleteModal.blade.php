<!--start delete modal -->
<div class="modal fade" id="moveAndDelete{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('main.Move Images To Other Album Then Delete') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('albums.moveBeforeDelete') }}" method="post">
                    @csrf
                    <!-- Start -->
                    <div class="col-12">
                        <label for="album_id" class="mr-sm-2">{{ trans('main.Album') }} :</label>
                        <?php $albums = \App\Models\Album::where('id', '!=', $item->id)->get(['id','name']); ?>
                        <select class="form-control" name="album_id">
                            @foreach($albums as $album)
                                <option value="{{$album->id}}">{{$album->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- End -->
                    <!-- id -->
                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
                    
                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-success ripple">{{ trans('main.Confirm') }}</button>
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">{{ trans('main.Close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end delete modal -->