<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    //
    public function store(Request $request){
        // elf::where('email', $email)->where('password', $password)->first();
        $checkResult = Result::all();
        // $checkResult = Result::where([
        //         ['lga_id','=',$request->lga_id],
        //         ['ward_id','=', $request->ward_id],
        //         ['pu_id','=', $request->pu_id],
        //         ['party_id','=', $request->party_id]
        //     ])->first();

        // $checkResult = Result::where([
        //     'lga_id'=>$request->lga_id,
        //     'ward_id'=>$request->ward_id,
        //     'pu_id'=>$request->pu_id,
        //     'party_id'=>$request->party_id
        //     ])->first();
        // $filter['email']=$email;
        // $filter['password']=$password;
        // $userRecord = $this->where($filter)->first();
        if ($checkResult != null) {
            $data = $this->validate($request, [
                'user_id' => 'required|numeric',
                'party_id' => 'required|numeric',
                'lga_id' => 'required|numeric',
                'ward_id' => 'required|numeric',
                'pu_id' => 'required|numeric',
                'vote_count' => 'required|numeric',
            ]);
            Result::create($data);
            return redirect()->back()->with('message', [
                'type' => 'success',
                'text' => 'Result was posted successful!'.$checkResult,
            ]);
        }
        else{
            return redirect()->back()->with('message', [
                'type' => 'error',
                'text' => 'Result was posted Already!',
            ]);
        }
        // $data = $this->validate($request, [
        //     'user_id' => 'required|numeric',
        //     'party_id' => 'required|numeric',
        //     'lga_id' => 'required|numeric',
        //     'ward_id' => 'required|numeric',
        //     'pu_id' => 'required|numeric',
        //     'vote_count' => 'required|numeric',
        // ]);
        // Result::create($data);
        // return redirect()->back()->with('message', [
        //     'type' => 'success',
        //     'text' => 'Result was posted successful!',
        // ]);

    }
}
