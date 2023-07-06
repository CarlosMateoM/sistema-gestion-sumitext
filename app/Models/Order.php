<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customers_id',
        'start_date',
        'end_date',
        'delivery_date',
        'order_status',
        'observations'
    ];

    protected $casts = [
        'order_status' => OrderStatus::class,
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('start_date', 'like', '%' . $search . '%')
                ->orWhere('end_date', 'like', '%' . $search . '%')
                ->orWhere('delivery_date', 'like', '%' . $search . '%')
                ->orWhere('observations', 'like', '%' . $search . '%')
                ->orWhereHas('customer', function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%']);
                });
        });
    }

}
