<?php

namespace Modules\Core\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

trait DataTable
{
    // DataTable Methods
    public static function drawTable(Request $request, $query)
    {

        $sort['col'] = $request->input('columns.' . $request->input('order.0.column') . '.data');
        $sort['dir'] = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $counter = $query->count();

        $output['recordsTotal'] = $counter;
        $output['recordsFiltered'] = $counter;
        $output['draw'] = intval($request->input('draw'));
//        // Order datatable items by translations key
        $query_model = $query->getModel();
        if (method_exists($query_model, 'isTranslationAttribute') && $query_model->isTranslationAttribute($sort['col'])) {
            $split = explode('\\', get_class($query_model));
            $model_name = end($split);
            $model_table = $query_model->getTable();
            $translations_table = \Str::snake($model_name . '_translations');
            $translations_table_key = \Str::singular($model_table) . '_id';

            $order_by_translation_key = \DB::table($translations_table)
                ->select($sort['col'])
                ->whereRaw("{$translations_table}.{$translations_table_key} = {$model_table}.id")
                ->where('locale', locale())
                ->limit(1);
        }

        // Get Data
        $models = $query
            ->orderBy($order_by_translation_key ?? ($sort['col'] ?? 'id'), ($sort['dir']??'asc'))
            ->skip($request->input('start'))
            ->take($request->input('length', 25))
            ->get();

        $output['data'] = $models;

        return $output;
    }
}
