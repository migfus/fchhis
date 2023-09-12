<?php
namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class EventPublicController extends Controller
{
    public function index(Request $req) : JsonResponse {
        if($req->count) {
            return $this->getCount($req);
        }

        return $this->get($req);
    }

        private function get($req) : JsonResponse {
            $data = [];
            if($req->currentDate) {
                // BUG fix for unwanted inputs
                // NOTE Output Events for 3 months prior, to compensate the loading.
                $data = Event::where('start', '>=', Carbon::createFromFormat('Y-m-d', $req->currentDate)->startOfMonth()->subMonth(6)) // -6 month for allowance evnt
                    ->where('start', '<=', Carbon::createFromFormat('Y-m-d', $req->currentDate)->endOfMonth()->addMonth(6)) // +6 month for allowance event
                    ->with('EventCategory')
                    ->get();
            }
            else {
                $data = Event::where('start', '>=', Carbon::now()->startOfMonth()->subMonth(6))
                    ->where('start', '<=', Carbon::now()->endOfMonth()->addMonth(6))
                    ->with('EventCategory')
                    ->get();
            }

            return response()->json([
                ...$this->G_ReturnDefault(),
                'data' => $data,
            ]);
        }

        private function getCount($req) : JsonResponse {
            $dateCount = Event::where('start', '>=', Carbon::now()->startOfMonth())
                ->where('start', '<=', Carbon::now()->endOfMonth())
                ->with('EventCategory')
                ->count();

            return response()->json([
                ...$this->G_ReturnDefault(),
                'count' => $dateCount,
            ]);
        }
}
