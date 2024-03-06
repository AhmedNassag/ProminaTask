<?php

namespace App\Repositories;

use App\Traits\ImageTrait;
use Illuminate\Support\Facades\File;

abstract class BaseRepository
{
    use ImageTrait;

    protected $model;
    protected $view;
    protected $singleCollectionName;
    protected $multiCollectionName;

    public function __construct()
    {
        $this->model                = $this->getModel();
        $this->view                 = $this->getView();
        $this->singleCollectionName = $this->getSingleCollectionName();
        $this->multiCollectionName  = $this->getMultiCollectionName();
    }

    abstract public function getModel();
    abstract public function getView();
    abstract public function getSingleCollectionName();
    abstract public function getMultiCollectionName();





    public function index($request)
    {
        $data = $this->getModel()::paginate(config('myConfig.paginationCount'));
        return view('dashboard.'.$this->view.'.index', compact('data'));
    }



    public function show($id)
    {
        $data = $this->getModel()::findOrFail($id);
        return view('dashboard.'.$this->view.'.show', compact('data'));
    }



    public function store($request)
    {
        try {
            $data = $this->model::create($request->validated());
            if (!$data) {
                session()->flash('error');
                return redirect()->back();
            }
            //store single image
            if ($request->hasFile('image')) {
                $data->clearMediaCollection($this->singleCollectionName); //delete old record from database
                $image = $request->file('image');
                $this->uploadMedia($data, $this->singleCollectionName, $image);
            }
            //store multi images
            if ($request->hasFile('images')) {
                $data->clearMediaCollection($this->multiCollectionName); //delete old record from database
                foreach($request->file('images') as $image)
                {
                    $this->uploadMedia($data, $this->multiCollectionName, $image);
                }
            }
            session()->flash('success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function update($request)
    {
        try {
            $data = $this->model::findOrFail($request->id);
            if (!$data) {
                session()->flash('error');
                return redirect()->back();
            }
            $data->update($request->validated());
            //update single image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $data->clearMediaCollection($this->singleCollectionName); //delete old record from database
                $this->uploadMedia($data, $this->singleCollectionName, $image);
            }
            //update multi images
            if ($request->hasFile('images')) {
                $data->clearMediaCollection($this->multiCollectionName); //delete old record from database
                foreach($request->file('images') as $image)
                {
                    $this->uploadMedia($data, $this->multiCollectionName, $image);
                }
            }
            if (!$data) {
                session()->flash('error');
                return redirect()->back();
            }
            session()->flash('success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy($request)
    {
        try {
            $data = $this->model::findOrFail($request->id);
            if (!$data) {
                session()->flash('error');
                return redirect()->back();
            }
            //delete old media if exist
            $singleMedia = $data->getMedia($this->singleCollectionName)->first();
            $multiMedia  = $data->getMedia($this->multiCollectionName)->all();
            if($singleMedia)
            {
                $data->clearMediaCollection($this->singleCollectionName); //delete old record from database
                $file_name = $singleMedia->file_name;
                $img_id    = $singleMedia->id;
                if($img_id && $file_name)
                {
                    //remove file from project
                    if (File::exists(public_path('storage/'. $img_id .'/'.$file_name)))
                    {
                        unlink(public_path('storage/' . $img_id .'/'.$file_name));
                    }
                }
            }
            if($multiMedia)
            {
                $data->clearMediaCollection($this->multiCollectionName); //delete old record from database
                foreach($multiMedia as $media)
                {
                    $file_name = $media->file_name;
                    $img_id    = $media->id;
                    if($img_id && $file_name)
                    {
                        //remove files from project
                        if (File::exists(public_path('storage/'. $img_id .'/'.$file_name)))
                        {
                            unlink(public_path('storage/' . $img_id .'/'.$file_name));
                        }
                    }
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
