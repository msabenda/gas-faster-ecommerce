<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['transaction_id', 'amount', 'amount_tzs', 'currency', 'status', 'user_id', 'order_reference'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
?>