<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => ['date','required'],
            'friends' => ['array'],
            'friends.*' => ['required','min:2','integer'],
            'winner_id' => ['required','integer','in_array:friends.*'],
            'balls_left' => ['required','integer'],
            'no_show' => ['bool'],
            'tournament_id' => ['required','integer'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'friends.*.min' => 'At least two friends are required to play a game',
            'winner_id.in_array' => 'Winner is missing, its not possible to tie a pool game :)',
            'balls_left.required' => 'Please provide how many balls the loser friend left on table',
        ];
    } 
}
