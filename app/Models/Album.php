<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Album extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table   = 'albums';
    protected $guarded = [];




    ///////////////////////// start image /////////////////////////
    public function getImgAttribute()
    {
        $file = $this->getMedia('album')->last();
        if ($file)
        {
            $file->id = $this->getMedia('album')->last()->id;
            $file->url = $file->getUrl();
            $file->localUrl = app('url')->asset('storage/' . $file->id . '/' . $file->file_name);
        }
        return $file;
    }



    public function getImagesAttribute()
    {
        $files = $this->getMedia('album_images');
        return $this->filesData($files);
    }



    public function filesData($data)
    {
        $urls = [];
        foreach ($data as $key => $file)
        {
            // $urls[$key]['id'] = $file->id;
            // $urls[$key]['url'] = $file->getFullUrl();
            $urls[$key]['url'] = app('url')->asset('storage/' . $file->id . '/' . $file->file_name);
            $file->localUrl = app('url')->asset('storage/' . $file->id . '/' . $file->file_name);

        }
        return ($urls);
    }
    ///////////////////////// end image /////////////////////////
}
