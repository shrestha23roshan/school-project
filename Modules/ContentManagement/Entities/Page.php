<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{
    use Sluggable;

    protected $fillable = [
        'parent_id',
        'heading',
        'slug',
        'attachment',
        'breadcrumb_attachment',
        'description',
        'order_position',
        'is_active',
        'meta_title',
        'meta_tags',
        'meta_description',
        'created_by',
        'updated_by'
    ];

    protected $hidden = ['created_at','updated_at'];

    /**
     * Return the sluggable configuration array for this model.
     * 
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'heading'
            ]
        ];
    }

    /**
     * Get the parent that owns the page.
     */
    public function parent()
    {
        return $this->belongsTo('Modules\ContentManagement\Entities\Page', 'parent_id');
    }

    /**
     * Get the childrens for the page.
     */
    public function childrens()
    {
        return $this->hasMany('Modules\ContentManagement\Entities\Page', 'parent_id');
    }

    /**
     * Get the active childrens for the page.
     */
    public function activeChildrens()
    {
        return $this->childrens()->where('is_active', 1)->orderBy('order_position', 'asc');
    }

}
