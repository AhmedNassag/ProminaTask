<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Album\StoreRequest;
use App\Http\Requests\Album\UpdateRequest;
use App\Repositories\Album\AlbumInterface;

class AlbumController extends Controller
{
    protected $album;

    public function __construct(AlbumInterface $album)
    {
        $this->album = $album;
        $this->middleware('permission:عرض الألبومات', ['only' => ['index']]);
        $this->middleware('permission:إضافة الألبومات', ['only' => ['store']]);
        $this->middleware('permission:تعديل الألبومات', ['only' => ['update']]);
        $this->middleware('permission:حذف الألبومات', ['only' => ['destroy','moveBeforeDelete']]);
    }



    public function index(Request $request)
    {
        return $this->album->index($request);
    }



    public function store(StoreRequest $request)
    {
        return $this->album->store($request);
    }



    public function update(UpdateRequest $request)
    {
        return $this->album->update($request);
    }



    public function destroy(Request $request)
    {
        return $this->album->destroy($request);
    }



    public function moveBeforeDelete(Request $request)
    {
        return $this->album->moveBeforeDelete($request);
    }
}
