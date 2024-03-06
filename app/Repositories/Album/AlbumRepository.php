<?php

namespace App\Repositories\Album;

use App\Traits\API;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\File;
use App\Repositories\BaseRepository;
use App\Models\Album;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Repositories\Album\AlbumInterface;


class AlbumRepository extends BaseRepository implements AlbumInterface
{
    use ImageTrait;

    //model
    public function getModel()
    {
        return new Album();
    }

    //view
    public function getView()
    {
        return 'albums';
    }

    //single_collection_name
    public function getSingleCollectionName()
    {
        return 'album';
    }

    //multi_collection_name
    public function getMultiCollectionName()
    {
        return 'album_images';
    }



    public function moveBeforeDelete($request)
    {
        try {
            $data = $this->model::findOrFail($request->id);
            if (!$data) {
                session()->flash('error');
                return redirect()->back();
            }
            $singleMedia = $data->getMedia($this->singleCollectionName)->first();
            $multiMedia  = $data->getMedia($this->multiCollectionName)->all();
            if($singleMedia)
            {
                $singleMedia->update(['model_id' => $request->album_id]);
            }
            if($multiMedia)
            {
                foreach($multiMedia as $media)
                {
                    $media->update(['model_id' => $request->album_id]);
                }
            }
            $data->delete();
            session()->flash('success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
