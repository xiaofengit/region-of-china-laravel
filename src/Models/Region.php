<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    const TYPE_PROVINCE = 'province';
    const TYPE_CITY = 'city';
    const TYPE_DISTRICT = 'district';
    const TYPE_STREET = 'street';
    
    /**
     * 主键
     * 
     * @var string
     */
    protected $primaryKey = 'code';

    /**
     * 主键是否主动递增
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * 是否主动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 父级
     */
    public function parent()
    {
        return $this->belongsTo(Region::class, 'parent_code', 'code');
    }

    /**
     * 子级
     */
    public function childrens()
    {
        return $this->hasMany(Region::class, 'parent_code', 'code');
    }

    /**
     * 获取数据
     */
    public function getRegions($type = null, $parent = null)
    {
        $map = [];
        if ($type) {
            $map['type'] = $type;
        }
        
        if ($parent) {
            $map['parent_code'] = $parent;
        }
        return $this->where($map)->get();
    }
}
