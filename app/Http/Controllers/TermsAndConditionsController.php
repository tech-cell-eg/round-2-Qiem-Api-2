<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Models\TermsAndCondition;

class TermsAndConditionsController extends Controller
{
    use ApiResponseTrait;
    public function show(){
        $termsAndConditions=TermsAndCondition::latest()->first();
        if(!$termsAndConditions){
            return $this->errorResponse('Terms and Conditions not found',404);
        }
        $data = [
            'title' => $termsAndConditions->title,
            'body' => $termsAndConditions->body,
        ];
        //return data (json)
        return $this->successResponse($data, 'Terms and Conditions retrieved successfully');
    }
}
