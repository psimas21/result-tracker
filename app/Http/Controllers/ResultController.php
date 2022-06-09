<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Result;

class ResultController extends Controller
{
    public function store(PostRequest $request)
    {
        $checkResult = Result::where('user_id', auth()->user()->id)
            ->where('party_id', $request->party_id)
            ->where('lga_id', $request->lga_id)
            ->where('lga_id', $request->lga_id)
            ->where('ward_id', $request->ward_id)
            ->where('pu_id', $request->pu_id)
            ->get()
            ->toArray();

        if (count($checkResult) !== 0) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'error',
                    'text' =>
                        'Result was posted already! ' .
                        $checkResult[0]['vote_count'] .
                        ' were posted',
                ]);
        }

        $data = [
            'user_id' => auth()->user()->id,
            'party_id' => $request->party_id,
            'lga_id' => $request->lga_id,
            'ward_id' => $request->ward_id,
            'pu_id' => $request->pu_id,
            'vote_count' => $request->vote_count,
        ];

        try {
            if ($request->validated()) {
                Result::create($data);
                return redirect()
                    ->back()
                    ->with('message', [
                        'type' => 'success',
                        'text' =>
                            'Result was posted successful! ' .
                            $request->vote_count .
                            ' were posted',
                    ]);
            }
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'error',
                    'text' => 'Something went wrong.',
                ]);
        }
    }
}
