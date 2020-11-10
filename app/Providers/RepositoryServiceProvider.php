<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Parents\ParentsRepositoryInterface',
            'App\Repositories\Parents\ParentsRepository'
        );

        $this->app->bind(
            'App\Repositories\Teacher\TeacherRepositoryInterface',
            'App\Repositories\Teacher\TeacherRepository'
        );

        $this->app->bind(
            'App\Repositories\Assignment\AssignmentRepositoryInterface',
            'App\Repositories\Assignment\AssignmentRepository'
        );

        $this->app->bind(
            'App\Repositories\Attendance\AttendanceRepositoryInterface',
            'App\Repositories\Attendance\AttendanceRepository'
        );

        $this->app->bind(
            'App\Repositories\Bulletin\BulletinRepositoryInterface',
            'App\Repositories\Bulletin\BulletinRepository'
        );

        $this->app->bind(
            'App\Repositories\Child\ChildRepositoryInterface',
            'App\Repositories\Child\ChildRepository'
        );

        $this->app->bind(
            'App\Repositories\Document\DocumentRepositoryInterface',
            'App\Repositories\Document\DocumentRepository'
        );

        $this->app->bind(
            'App\Repositories\Event\EventRepositoryInterface',
            'App\Repositories\Event\EventRepository'
        );

        $this->app->bind(
            'App\Repositories\Grade\GradeRepositoryInterface',
            'App\Repositories\Grade\GradeRepository'
        );

        $this->app->bind(
            'App\Repositories\Indicator\IndicatorRepositoryInterface',
            'App\Repositories\Indicator\IndicatorRepository'
        );

        $this->app->bind(
            'App\Repositories\Kelas\KelasRepositoryInterface',
            'App\Repositories\Kelas\KelasRepository'
        );

        $this->app->bind(
            'App\Repositories\KelasEvent\KelasEventRepositoryInterface',
            'App\Repositories\KelasEvent\KelasEventRepository'
        );

        $this->app->bind(
            'App\Repositories\Submission\SubmissionRepositoryInterface',
            'App\Repositories\Submission\SubmissionRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
