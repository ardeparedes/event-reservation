<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;

class TicketReservationService
{
    public function reserveTicket(User $user, Event $event)
    {
        $this->validateReservation($event);
        $this->validateUser($user, $event);
        $this->reserveTicketForUser($user, $event);
    }

    private function validateReservation(Event $event)
    {
        if ($event->reservations()->count() >= $event->attendee_limit) {
            throw new \Exception('Attendee limit reached for this event');
        }

        if ($event->deadline < now()) {
            throw new \Exception('Reservation deadline has passed');
        }
    }

    private function validateUser(User $user, Event $event)
    {
        if ($event->created_by === $user->id) {
            throw new \Exception('You cannot reserve tickets for your own event');
        }

        if ($user->reservedEvents()->where('event_id', $event->id)->exists()) {
            throw new \Exception('You have already made a reservation for this event');
        }
    }

    private function reserveTicketForUser(User $user, Event $event)
    {
        $user->reservedEvents()->attach($event);
    }
}
