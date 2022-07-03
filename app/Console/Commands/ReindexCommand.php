<?php

namespace App\Console\Commands;

use App\Models\Post;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all posts to Elasticsearch';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        private Client $elasticsearch,
        private Post $post
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Indexing all articles. This might take a while...');
        try {
            $this->elasticsearch->indices()->delete(['index' => $this->post->getSearchIndex()]);
        } catch (\Exception $e) {
        };
        foreach (Post::cursor() as $post) {
            $this->elasticsearch->index([
                'index' => $post->getSearchIndex(),
                'type' => $post->getSearchType(),
                'id' => $post->getKey(),
                'body' => $post->toSearchArray(),
            ]);
            $this->output->write('.');
        }
        $this->info('Done!');
    }

}
