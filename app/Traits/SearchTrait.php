<?php

namespace App\Traits;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Search Trait
 */
trait SearchTrait {
    public function getWhereField(Request $request, Array $fields) {
        Session::forget('error');
        if (isset($request->searchFieldName) && isset($request->searchField)) {
            $field = $fields[$request->searchFieldName];
            switch ($field['type']) {
                case 'string':
                    $whereRaw = $request->searchFieldName .' like '. '\'%'.$request->searchField.'%\'';
                    break;
                case 'int':
                    if (is_numeric($request->searchField)) {
                        $whereRaw = $request->searchFieldName .' = '. $request->searchField;
                    } else {
                        Session::flash('error', __('messages.value_not_numeric', [
                            'field' => $fields[$request->searchFieldName]['label']
                        ]));
                        $whereRaw = '1 = 1';
                    }
                    break;
                
                default:
                    $whereRaw = $request->searchFieldName .' = '. $request->searchField;
                    break;
            }
        } else {
            $whereRaw = '1 = 1';
        }

        return $whereRaw;
    }
}
