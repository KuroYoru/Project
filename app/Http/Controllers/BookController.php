<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Http\Request;

class BookController extends Controller {

    private $repository;

    public function __construct(BookRepositoryInterface $bookRepository) {
        $this->repository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return $this->repository->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return $this->repository->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return $this->repository->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return $this->repository->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        return $this->repository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        return $this->repository->destroy($id);
    }

    public function search(Request $request) {
        return $this->repository->search($request);
    }

    public function bookXML() {
        return $this->repository->bookXML();
    }
    
    public function buy($id){
        return $this->repository->buy($id);
    }
    
    public function  bought(Request $request){
        return $this->repository->bought($request);
    }
}
