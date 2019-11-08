<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxInformation extends Model
{
    protected $table = 'tax_information';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'user_id'
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function usersTaxInfos($id)
    {
        return TaxInformation::join('users','users.id','=','tax_information.user_id')
                            ->where('user_id',$id)
                            ->select('user_id','users.name','users.email','tax_information.name as taxname','tax_information.address','tax_information.id as tax_id')
                            ->first();
    }
}
