<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;

class StatisticController extends Controller
{
    public function index(Request $req) : JsonResponse {
        if($req->user()->hasRole('Client'))
            return $this->ClientIndex($req);

        return $this->G_UnauthorizedResponse('unauthorized to Statistic[index]');
    }
        private function ClientIndex($req) : JsonResponse{
            if(Transaction::where('client_id', $req->user()->id)->count() > 0) {
                $start = Carbon::parse(
                    Transaction::where('client_id', $req->user()->id)
                        ->orderBy('created_at', 'ASC')
                        ->first()
                        ->created_at
                )->startOfYear()->format('Ym');

                $summaryTransaction = [];
                $count = 0;
                while(Carbon::now()->subMonths($count)->format('Ym') >= $start) {
                    $summaryTransaction [Carbon::now()->subMonths($count)->format('Y')] [] = [
                        Carbon::now()->subMonths($count)->startOfMonth(),
                        Transaction::where('client_id', $req->user()->id)
                            ->where('created_at', '>=', Carbon::now()->subMonths($count)->startOfMonth())
                            ->where('created_at', '<=', Carbon::now()->subMonths($count)->endOfMonth())
                            // ->orderBy('created_at', 'DESC')
                            ->sum('amount'),
                    ];
                    // $summaryTransaction [Carbon::now()->subMonths($count)->format('Y')]
                    $count++;
                }

                return response()->json([...$this->G_ReturnDefault($req), 'data' => $summaryTransaction]);
            }
            else {
                return response()->json([...$this->G_ReturnDefault($req), 'data' => null]);
            }
        }
}
