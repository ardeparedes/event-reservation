<?php

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $event = new Event;

        return [
            'title' => [
                'required',
                Rule::unique($event->getTable())->where(function ($query) {
                    return $query->where('title', $this->title)
                        ->where('datetime', $this->datetime)
                        ->where('location', $this->location)
                        ->where('created_by', auth()->id());
                })
            ],
            'datetime' => 'required|date|after:'.now(),
            'deadline' => 'required|date|after:'.now().'|before:datetime',
            'location' => 'required',
            'price' => 'required|numeric|min:0',
            'attendee_limit' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'The event must be unique.',
        ];
    }
}
