<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    
    public function account() {
        return $this->hasOne(Account::class, 'account_id', 'id');
    }
    
    public function fruit() {
        return $this->hasOne(Fruit::class, 'fruit_id', 'id');
    }
}
