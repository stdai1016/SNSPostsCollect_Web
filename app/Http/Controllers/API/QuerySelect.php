<?php

namespace App\Http\Controllers\API;

use \Illuminate\Database\Eloquent\Builder;

trait QuerySelect
{
    /** Get the names of the columns for exact match.
     *  Set `EXACT_MATCH_COLUMNS` to enable search
     *  @return string[]
     */
    public function getExactMatchColumns()
    {
        return defined('static::EXACT_MATCH_COLUMNS')
            ? static::EXACT_MATCH_COLUMNS : [];
    }

    /** Get the name of the column for searching.
     *  Set `PATTERN_MATCH_COLUMN` to enable search
     *  @return string|null
     */
    public function getPatternMatchColumn()
    {
        return defined('static::PATTERN_MATCH_COLUMN')
            ? static::PATTERN_MATCH_COLUMN : null;
    }

    /** Get a new query builder for the model's table.
     *  @return \Illuminate\Database\Eloquent\Builder
     */
    abstract protected function getQueryBuilder();

    /** Parse request queries
     *  @return array
     */
    public function parseRequestQuery()
    {
        $query = [];
        foreach($this->getExactMatchColumns() as $col) {
            $v = request()->query($col);
            if (!$v) $query[$col] = null;
            else if (is_array($v)) $query[$col] = $v;
            else $query[$col] = explode(',', $v);
        }
        $query['q'] = request()->query('q');
        $query['max_id'] = request()->query('max_id');
        $query['limit'] = request()->query('limit');
        $query['fields'] = request()->query('fields');
        if ($query['fields']) $query['fields'] = explode(',', $query['fields']);

        return $query;
    }


    /**
     *  @param array    $query
     *  @param \Illuminate\Database\Eloquent\Builder    $builder
     *  @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function selectData (array $query = null, Builder $builder = null)
    {
        $query = $query ?? $this->parseRequestQuery();
        $builder = $builder ?? $this->getQueryBuilder();
        $key = $builder->getModel()->getKeyName();

        foreach ($this->getExactMatchColumns() as $col) {
            if ($query[$col]) $builder->whereIn($col, $query[$col]);
        }

        // q
        $col = $this->getPatternMatchColumn();
        if ($col && !isset($query[$col]) && isset($query['q'])) {
            $word = preg_replace('/([%_\[\]])/', '\\\1', $query['q']);
            $builder->where($col, 'like', '%'.$word.'%');
        }

        // max_id
        $max_id = intval($query['max_id']);
        if ($max_id > 0) $builder->where($key, '<=', $max_id);

        // limit
        $limit = intval($query['limit']);
        if ($limit > 0) $builder->limit($limit);

        $builder->orderBy($key, 'desc');

        // fields
        $data = $builder->get();
        if (is_array($query['fields'])) {
            foreach ($data as $d) $d->setVisible($query['fields']);
            $data->makeVisible($query['fields']);
        }

        return $data;
    }
}
