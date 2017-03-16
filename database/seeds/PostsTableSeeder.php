<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
        	'photo_url' =>	null,
        	'video_url'	=>	'https://www.youtube.com/watch?v=Scxs7L0vhZ4',
        	'location'	=>	[
        		'name'	=>	'Backpack',
        		'lat'	=>	'90.01',
        		'long'	=>	'23.05'
        	],
        	'user'		=>	App\User::first(),
        	'description'=>	"Screen readers will have trouble with your forms if you don't include a label for every input. For these inline forms, you can hide the labels using the .sr-only class. There are further alternative methods of providing a label for assistive technologies, such as the aria-label, aria-labelledby or title attribute. If none of these is present, screen readers may resort to using the placeholder attribute, if present, but note that use of placeholder as a replacement for other labelling methods is not advised.",

        	'tags'		=>	[
        						'backpack',
        						'hackathon',
        						'hack',
        						'fun'
        					],
        	'upvote'	=>	[],
        	'downvote'	=>	[]
        ]);
    }
}
