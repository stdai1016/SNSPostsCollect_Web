<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Author;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    use QuerySelect, ResponseHelper;

    const EXACT_MATCH_COLUMNS = ['id', 'userid', 'name'];
    const PATTERN_MATCH_COLUMN = 'name';

    protected function getQueryBuilder() {
        return Author::query();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->selectData();
        return $this->response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        $query = $this->parseRequestQuery();
        if (is_array($query['fields'])) $author->setVisible($query['fields']);
        return $this->response($author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\AuthorRequest $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorRequest $request, Author $author)
    {
        $validated = $request->validated();
        $author->update($validated);
        return $this->response($author);
    }
}
