<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryEloquent;
use Modules\Configuration\Repositories\User\UserRepository;
use Modules\Configuration\Repositories\User\UserRepositoryEloquent;
use Modules\Configuration\Repositories\Role\RoleRepository;
use Modules\Configuration\Repositories\Role\RoleRepositoryEloquent;
use Modules\Configuration\Repositories\Module\ModuleRepository;
use Modules\Configuration\Repositories\Module\ModuleRepositoryEloquent;
use Modules\ContentManagement\Repositories\Notice\NoticeRepository;
use Modules\ContentManagement\Repositories\Notice\NoticeRepositoryEloquent;
use Modules\ContentManagement\Repositories\Banner\BannerRepository;
use Modules\ContentManagement\Repositories\Banner\BannerRepositoryEloquent;
use Modules\ContentManagement\Repositories\Message\MessageRepository;
use Modules\ContentManagement\Repositories\Message\MessageRepositoryEloquent;
use Modules\ContentManagement\Repositories\AboutUs\AboutUsRepository;
use Modules\ContentManagement\Repositories\AboutUs\AboutUsRepositoryEloquent;
use Modules\ContentManagement\Repositories\Download\DownloadRepository;
use Modules\ContentManagement\Repositories\Download\DownloadRepositoryEloquent;
use Modules\Media\Repositories\Album\AlbumRepository;
use Modules\Media\Repositories\Album\AlbumRepositoryEloquent;
use Modules\Media\Repositories\AlbumPhoto\AlbumPhotoRepository;
use Modules\Media\Repositories\AlbumPhoto\AlbumPhotoRepositoryEloquent;
use Modules\NewsAndEvent\Repositories\NewsAndEvent\NewsAndEventRepository;
use Modules\NewsAndEvent\Repositories\NewsAndEvent\NewsAndEventRepositoryEloquent;
use Modules\Testimonial\Repositories\Testimonial\TestimonialRepository;
use Modules\Testimonial\Repositories\Testimonial\TestimonialRepositoryEloquent;
use Modules\Settings\Repositories\Setting\SettingRepository;
use Modules\Settings\Repositories\Setting\SettingRepositoryEloquent;
use Modules\ContentManagement\Repositories\Faculty\FacultyRepository;
use Modules\ContentManagement\Repositories\Faculty\FacultyRepositoryEloquent;
use Modules\Seo\Repositories\Seo\SeoRepository;
use Modules\Seo\Repositories\Seo\SeoRepositoryEloquent;
use Modules\ContentManagement\Repositories\Page\PageRepository;
use Modules\ContentManagement\Repositories\Page\PageRepositoryEloquent;
use Modules\Others\Repositories\Subscriber\SubscriberRepository;
use Modules\Others\Repositories\Subscriber\SubscriberRepositoryEloquent;
use Modules\Others\Repositories\Feedback\FeedbackRepository;
use Modules\Others\Repositories\Feedback\FeedbackRepositoryEloquent;
use Modules\SchoolManagement\Repositories\Alumni\AlumniRepository;
use Modules\SchoolManagement\Repositories\Alumni\AlumniRepositoryEloquent;
use Modules\SchoolManagement\Repositories\Result\ResultRepository;
use Modules\SchoolManagement\Repositories\Result\ResultRepositoryEloquent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultstringlength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            BaseRepository::class,
            BaseRepositoryEloquent::class
        );
        $this->app->singleton(
            UserRepository::class,
            UserRepositoryEloquent::class
        );
        $this->app->singleton(
            RoleRepository::class,
            RoleRepositoryEloquent::class
        );
        $this->app->singleton(
            ModuleRepository::class,
            ModuleRepositoryEloquent::class
        );
        $this->app->singleton(
           NoticeRepository::class,
           NoticeRepositoryEloquent::class
        );
        $this->app->singleton(
            BannerRepository::class,
            BannerRepositoryEloquent::class
         );
         $this->app->singleton(
            MessageRepository::class,
            MessageRepositoryEloquent::class
         );
         $this->app->singleton(
            AboutUsRepository::class,
            AboutUsRepositoryEloquent::class
         );
         $this->app->singleton(
            DownloadRepository::class,
            DownloadRepositoryEloquent::class
         );
         $this->app->singleton(
            AlbumRepository::class,
            AlbumRepositoryEloquent::class
         );
         $this->app->singleton(
            AlbumPhotoRepository::class,
            AlbumPhotoRepositoryEloquent::class
         );
         $this->app->singleton(
            NewsAndEventRepository::class,
            NewsAndEventRepositoryEloquent::class
         );
         $this->app->singleton(
            TestimonialRepository::class,
            TestimonialRepositoryEloquent::class
         );
         $this->app->singleton(
            SettingRepository::class,
            SettingRepositoryEloquent::class
         );
         $this->app->singleton(
            FacultyRepository::class,
            FacultyRepositoryEloquent::class
         );
         $this->app->singleton(
            SeoRepository::class,
            SeoRepositoryEloquent::class
         );
         $this->app->singleton(
           PageRepository::class,
           PageRepositoryEloquent::class  
         );
         $this->app->singleton(
            SubscriberRepository::class,
            SubscriberRepositoryEloquent::class  
          );
        $this->app->singleton(
            FeedbackRepository::class,
            FeedbackRepositoryEloquent::class  
        );
        $this->app->singleton(
            AlumniRepository::class,
            AlumniRepositoryEloquent::class  
        );
        $this->app->singleton(
            ResultRepository::class,
            ResultRepositoryEloquent::class  
        );
    }
}
