<?php

namespace Modules\Configuration\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
   /**
     * Database table used by the model.
     */
    protected $table = 'roles';

    /**
     * Attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'role',
        'is_active'
    ];

    /**
     * Attributes excluded from the model's JSON form.
     * 
     * @var array
     */
    protected $hidden = [];

    /**
     * Get all users that belong to the role.
     */
    public function users()
    {
        return $this->hasMany('Modules\Configuration\Entities\User', 'role_id');
    }

    /**
     * Get all modules that belong to the role.
     */
    public function modules()
    {
        return $this->belongsToMany('Modules\Configuration\Entities\Module', 'role_modules', 'role_id', 'module_id');
    }
}
