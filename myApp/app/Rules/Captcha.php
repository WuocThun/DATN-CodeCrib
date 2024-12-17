<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Recaptcha\ReCaptcha;
class Captcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        $recaptcha = new ReCaptcha(env('CAPTCHA_SECRET'));
        $response = $recaptcha->verify($value, $_SERVER['REMOTE_ADDR']);
        return $response->isSuccess();
    }
    public function message()
    {
        return 'Vui lòng nhập Capcha để xác thực.';	//trả về thông báo khi lỗi không xác nhận captcha
    }


    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}
