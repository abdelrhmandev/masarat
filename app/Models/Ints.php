<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ints extends Model
{
    use HasFactory;

    protected $table = 'ints';
    public static function getIntParent($id)
    {
        $ints = \DB::table('int_parent')
            ->select(
                'int_parent.id AS Int_id',
                'int_parent.name_ar AS name',
            )
            ->leftJoin('ints', 'ints.parent', 'int_parent.id')
            ->where('ints.id', $id)
            ->first();

        if (!empty($ints)) {
            return $ints->name;
        }
        return "";
    }
}
