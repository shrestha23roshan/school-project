<?php
namespace Modules\Testimonial\Repositories\Testimonial;

use App\Repositories\BaseRepositoryEloquent;
use Modules\Testimonial\Entities\Testimonial;

class TestimonialRepositoryEloquent extends BaseRepositoryEloquent implements TestimonialRepository
{
    protected $model;

    public function __construct(Testimonial $model)
    {
        $this->model = $model;
    }
}