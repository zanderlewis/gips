<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    protected $table = 'assignments';
    protected $fillable = ['completed', 'exponent', 'user_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function isPrime($num) {
        if ($num <= 1) return false;
        if ($num <= 3) return true;
        if ($num % 2 == 0 || $num % 3 == 0) return false;
        for ($i = 5; $i * $i <= $num; $i += 6) {
            if ($num % $i == 0 || $num % ($i + 2) == 0) return false;
        }
        return true;
    }
    
    public static function nextPrime($num) {
        $prime = $num;
        $found = false;
        while (!$found) {
            $prime++;
            if (self::isPrime($prime)) {
                $found = true;
            }
        }
        return $prime;
    }
}
