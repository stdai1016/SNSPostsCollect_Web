<?php
/**
 * The route resolves the implicit route bindings by
 * snake case of name of parameter of function, and gives a null Model
 * to function if parameter does not exist in route.
 * Set apiResource with `tag_types`and parameter name with `$tagType`
 * (or tagtypes/$tagtype).
 * See `\Illuminate\Routing\ImplicitRouteBinding::resolveForRoute` and
 * `\Illuminate\Routing\ControllerDispatcher::dispatch` for detail.
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\TagType;
use App\Http\Requests\TagTypeRequest;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class TagTypeController extends Controller
{
    use QuerySelect, ResponseHelper;

    const EXACT_MATCH_COLUMNS = ['name'];
    const PATTERN_MATCH_COLUMN = 'name';

    protected function getQueryBuilder()
    {
        return TagType::query();
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
     * @param  \App\TagType  $tagType
     * @return \Illuminate\Http\Response
     */
    public function show(TagType $tagType)
    {
        $query = $this->parseRequestQuery();
        if (is_array($query['fields'])) $tagType->setVisible($query['fields']);
        return $this->response($tagType);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TagTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagTypeRequest $request)
    {
        $validated = $request->validated();
        $tagType = TagType::create($validated);
        if (!$tagType) $this->abort('');
        return $this->response($tagType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\TagTypeRequest  $request
     * @param  \App\TagType  $tagType
     * @return \Illuminate\Http\Response
     */
    public function update(TagTypeRequest $request, TagType $tagType)
    {
        $validated = $request->validated();
        $tagType->update($validated);
        return $this->response($tagType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TagType  $tagType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TagType $tagType)
    {
        $tagType->delete();
        return response()->json(['msg'=>'OK']);
    }
}
