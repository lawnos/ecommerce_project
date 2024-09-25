<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ContactUsModel extends Model
{
    use HasFactory;

    protected $table = 'contact';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        $return =  self::select('contact.*');

        $filters = [
            'id' => '=',
            'name' => 'like',
            'email' => 'like',
            'phone' => 'like',
            'subject' => 'like',
        ];

        foreach ($filters as $field => $item) {
            if (!empty(Request::get($field))) {
                $value = Request::get($field);
                $return = $return->where($field, $item, $item === 'like' ? '%' . $value . '%' : $value);
            }
        }

        $return = $return->orderBy('contact.id', 'desc')
            ->paginate(12);

        return $return;
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
