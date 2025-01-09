<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;


class SupplierModel extends Model
{
    use HasFactory;

    protected $table = 'supplier';


    static public function getRecord()
    {
        // return self::get();
        $return = self::select('supplier.*');
        // Search start
        if (!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }

        if (!empty(Request::get('supplier_name'))) {
            $return = $return->where('supplier_name', 'like', '%' . Request::get('supplier_name') . '%');
        }

        if (!empty(Request::get('supplier_telephone'))) {
            $return = $return->where('supplier_telephone', 'like', '%' . Request::get('supplier_telephone') . '%');
        }

        if (!empty(Request::get('supplier_address'))) {
            $return = $return->where('supplier_address', 'like', '%' . Request::get('supplier_address') . '%');
        }

        if (!empty(Request::get('created_at'))) {
            $return = $return->where('created_at', 'like', '%' . Request::get('created_at') . '%');
        }

        if (!empty(Request::get('updated_at'))) {
            $return = $return->where('updated_at', 'like', '%' . Request::get('updated_at') . '%');
        }
        // Search end

        $return = $return->orderBy('id', 'desc')->paginate(20);

        return $return;
    }

    static public function getSingle($id)
    {
        return self::find($id);

    }


    static public function recordInsert($request)
    {
        try {
            $save = new self();
            $save->supplier_name = trim($request->supplier_name);
            $save->supplier_telephone = trim($request->supplier_telephone);
            $save->supplier_address = trim($request->supplier_address);
            $save->save();

        } catch (Exception $e) {
            \Log::error("Error saving record: " . $e->getMessage());
            throw $e;

        }
    }

    static public function recordUpdate($id, $request)
    {
        try {
            // Get the supplier record by ID
            $save = self::getSingle($id);

            // Check if the record exists
            if (!$save) {
                throw new \Exception("Supplier with ID {$id} not found.");
            }

            // Validate and trim the input fields
            $supplierName = trim($request->supplier_name);
            $supplierTelephone = trim($request->supplier_telephone);
            $supplierAddress = trim($request->supplier_address);

            // Check if the trimmed fields are not empty or null
            if (empty($supplierName) || empty($supplierTelephone) || empty($supplierAddress)) {
                throw new \Exception("Supplier fields cannot be empty.");
            }

            // Update the supplier's fields
            $save->supplier_name = $supplierName;
            $save->supplier_telephone = $supplierTelephone;
            $save->supplier_address = $supplierAddress;

            // Save the updated record
            $save->save();
        } catch (\Exception $e) {
            // Log the error
            \Log::error("Error updating record (ID: {$id}): " . $e->getMessage());
            throw $e;
        }
    }

}
