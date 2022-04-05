<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use DB;

interface BookRepositoryInterface {

    public function index();

    public function create();

    public function store(Request $request);

    public function show($id);

    public function edit($id);

    public function update(Request $request, $id);

    public function destroy($id);

    public function search(Request $request);

    public function bookXML();
}
