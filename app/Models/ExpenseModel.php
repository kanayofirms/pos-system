<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ExpenseModel extends Model
{
    use HasFactory;

    protected $table = 'expense';
}
