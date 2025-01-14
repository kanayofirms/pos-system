<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class PurchaseModel extends Model
{
    use HasFactory;

    protected $table = 'purchase';

    static public function getRecord()
    {
        $return = self::select('purchase.*', 'supplier.supplier_name')
            ->join('supplier', 'purchase.supplier_id', '=', 'supplier.id')
            ->orderBy('id', 'desc');

        // Search start
        if (!empty(Request::get('id'))) {
            $return = $return->where('purchase.id', '=', Request::get('id'));
        }

        if (!empty(Request::get('supplier_id'))) {
            $return = $return->where('supplier.supplier_name', 'like', '%' . Request::get('supplier_id'));
        }

        if (!empty(Request::get('total_item'))) {
            $return = $return->where('purchase.total_item', 'like', '%' . Request::get('total_item'));
        }

        if (!empty(Request::get('total_price'))) {
            $return = $return->where('purchase.total_price', 'like', '%' . Request::get('total_price'));
        }

        if (!empty(Request::get('discount'))) {
            $return = $return->where('purchase.discount', 'like', '%' . Request::get('discount'));
        }
        // Search end

        $return = $return->paginate(20);
        return $return;
    }
}
