<?php

namespace App\Repositories\Album;

interface AlbumInterface
{

    public function index($request);

    public function store($request);

    public function show($id);

    public function update($request);

    public function destroy($id);

    public function moveBeforeDelete($request);

}
