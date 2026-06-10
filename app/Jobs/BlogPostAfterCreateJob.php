<?php

namespace App\Jobs;

use App\Models\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlogPostAfterCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Міняємо тип з int на саму Модель BlogPost
     * @var BlogPost
     */
    private $blogPost;

    /**
     * Конструктор тепер приймає цілу модель статті, як і передає контролер
     * @param BlogPost $blogPost
     */
    public function __construct(BlogPost $blogPost)
    {
        $this->blogPost = $blogPost;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Змінюємо текст на "Створено" і беремо ID безпосередньо з моделі
        logs()->info("Створено новий запис в блозі [{$this->blogPost->id}]");
    }
}
