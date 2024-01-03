<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreDogRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:1|max:200',
            'age' => 'required_without:born_date|integer|min:0|max:15',
            'born_date' => 'required_without:age|date|date_format:Y-m-d|before:today',
        ];
    }

    protected function passedValidation() {
        if ($this->age) {
            $this->replace([
                'name' => $this->name,
                'age' => $this->age,
                'born_date' => Carbon::now()->subYears($this->age)->toDateTimeString()
            ]);
        } else {
            $age = Carbon::parse($this->born_date)->diffInYears(Carbon::now());
            $this->replace([
                'name' => $this->name,
                'age' => $age,
                'born_date' => $this->born_date
            ]);
        }
    }

}
