<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    use QuerySelect, JsonResponse;

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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        if (strcmp($request->method(), 'PATCH') != 0) {
            return response()->json(['msg'=>'Method Not Allowed'], 405);
        }
        $contentType = $request->header('content-type');        
        if (!str_starts_with($contentType, 'application/json')) {
            return response()->json(['msg'=>'Bad Content-Type'], 400);
        }
        $blocked = $request->json('blocked');
        $author->blocked = boolval($blocked); 
        $author->save();
        return $this->response($author);
    }
}
