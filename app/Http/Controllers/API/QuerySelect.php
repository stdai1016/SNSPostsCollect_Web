<?php

namespace App\Http\Controllers\API;

use \Illuminate\Database\Eloquent\Builder;

trait QuerySelect
{
    /** Get the names of the columns for exact match.
     *  Define class constant `EXACT_MATCH_COLUMNS` to enable exact match.
     *  @return string[]
     */
    public static function getExactMatchColumns()
    {
        $c = get_called_class();
        $cols =
            defined("$c::EXACT_MATCH_COLUMNS") ? $c::EXACT_MATCH_COLUMNS : [];
        return is_array($cols) ? $cols : explode(',', $cols);
    }

    /** Get the name of the column for searching.
     *  Define class constant `PATTERN_MATCH_COLUMN` to enable pattern match
     *  @return string|null
     */
    public static function getPatternMatchColumn()
    {
        $c = get_called_class();
        return defined("$c::PATTERN_MATCH_COLUMN")
            ? $c::PATTERN_MATCH_COLUMN : null;
    }

    /** Get reserved keys on URL query.
     *  Define class constant `ADDITIONAL_RESERVED_KEYS` to expand keys
     *  @return string[]
     */
    public static function getReservedKeys() {
        $keys = ['q', 'max_id', 'limit', 'fields', 'expansions'];
        $c = get_called_class();
        $ex = defined("$c::ADDITIONAL_RESERVED_KEYS")
            ? $c::ADDITIONAL_RESERVED_KEYS : [];
        $keys = array_merge($keys, is_array($ex) ? $ex : explode(',' ,$ex));
        return array_unique($keys);
    }

    /** Get a new query builder for the model's table.
     *  @return \Illuminate\Database\Eloquent\Builder
     */
    abstract protected function getQueryBuilder();

    /** Parse request queries
     *  @return array
     */
    public static function parseRequestQuery()
    {
        $req = request();
        $query = [];
        foreach(static::getExactMatchColumns() as $col) {
            $v = $req->query($col);
            if (!$v) $query[$col] = null;
            else if (is_array($v)) $query[$col] = $v;
            else $query[$col] = explode(',', $v);
        }
        foreach (static::getReservedKeys() as $k) $query[$k] = $req->query($k);
        if ($query['fields']) $query['fields'] = explode(',', $query['fields']);
        $expansions = $query['expansions'];
        if ($expansions) $query['expansions'] = explode(',', $expansions);

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
