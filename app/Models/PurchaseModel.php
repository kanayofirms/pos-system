<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseModel extends Model
{
    use HasFactory;

    protected $table = 'purchase';

    static public function getRecord()
    {
        $return = self::select('purchase.*', 'supplier.supplier_name')
            ->join('supplier', 'purchase.supplier_id', '=', 'supplier.id')
            ->orderBy('id', 'desc');

        $return = $return->paginate(20);
        return $return;
    }
}
