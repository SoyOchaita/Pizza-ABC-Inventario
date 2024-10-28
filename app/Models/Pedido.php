<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedido extends Model
{
    protected $fillable = [
        'user_id',
        'carrito_id',
        'estado',
        'metodo_pago',
        'tipo_entrega',
        'direccion_id',
        'sucursal_id',
    ];

    // Relación con el usuario que realizó el pedido
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con el carrito
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'carrito_id');
    }

    // Relación con la dirección seleccionada (si aplica)
    public function direccion(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'direccion_id');
    }

    // Relación con la sucursal seleccionada (si aplica)
    public function sucursal(): BelongsTo
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
}
