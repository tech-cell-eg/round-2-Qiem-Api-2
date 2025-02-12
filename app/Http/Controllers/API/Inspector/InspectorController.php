<?php

namespace App\Http\Controllers\API\Inspector;

use App\Http\Controllers\Controller;
use App\Models\Inspector;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class InspectorController extends Controller
{
    use ApiResponseTrait;
    //Show inspector's balance and outstanding balance.
    public function show($id){
        $inspector=Inspector::find($id);
        if(!$inspector){
            return $this->errorResponse('Inspector not found',404);
        }
        $data=[
            'account_balance' => $inspector->balance . ' ريال',
            'outstanding_balance' => $inspector->outstanding_balance . ' ريال',
        ];
        return $this->successResponse($data,'Inspector balance details retrieved successfully');
    }
}
