<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UniqueField implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected  $model;
    protected  $field;


    public function __construct($model,$field)
    {
        $this->model = $model;
        $this->field = $field;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //return false;

        $user_id = Auth::user()->id;
        $res = $this->model::where([
          'user_id'=>$user_id,
          $this->field=>$value,
          ])->count();
        return $res>0 ? false:true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ucfirst($this->field).' already exists';
    }
}
