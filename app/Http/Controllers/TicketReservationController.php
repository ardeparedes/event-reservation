<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\TicketReservationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TicketReservationController extends Controller
{
    protected $ticketReservationService;

    public function __construct(TicketReservationService $ticketReservationService)
    {
        $this->ticketReservationService = $ticketReservationService;
    }

    public function store(Request $request, Event $event)
    {
        DB::beginTransaction();

        try {
            $this->ticketReservationService->reserveTicket($request->user(), $event);

            DB::commit();

            return response()->json(['message' => 'Ticket reserved successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
