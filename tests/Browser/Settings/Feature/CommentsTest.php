<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CommentsTest extends DuskTestCase
{

    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_user_posts_a_native_comment()
    {
        $super = Role::find(1);
        $user = factory(User::class)->create([
            'activated' => true
        ]);
        $user->attachRole($super);

        $this->browse(function (Browser $browser) use ($user) {
            $postName = $this->faker->lexify('??????');
            $browser->loginAs($user)
                    ->visit('/admin/content/posts')
                    ->pause(2000)
                    ->assertPathIs('/admin/content/posts')
                    ->press('Create')
                    ->pause(2000)
                    ->assertPathIs('/admin/content/posts/create')
                    ->type('title', $postName)
                    ->press('Save')
                    ->pause(1000);

            $browser->visit('/admin/settings/comments')
                    ->pause(2000)
                    ->assertPathIs('/admin/settings/comments')
                    ->select('type', 'native')
                    ->press('Save')
                    ->pause(2000)
                    ->visit('/admin/settings/comments')
                    ->pause(2000)
                    ->assertSelected('type', 'native');

            $browser->visit('/posts/' . $postName)
                    ->pause(1000)
                    ->assertSee($postName)
                    ->click('#app > div > div.content.content-single.content-left > div.load-comments-wrapper > div.btn-primary')
                    ->pause(2000)
                    ->type('#app > div > div.content.content-single.content-left > div.comments > div > div > div > div.comment-body > textarea', 'A test comment goes here.')
                    ->press('Comment')
                    ->pause(3000)
                    ->visit('/posts/' . $postName)
                    ->pause(1000)
                    ->click('#app > div > div.content.content-single.content-left > div.load-comments-wrapper > div.btn-primary')
                    ->pause(2000)
                    ->assertSee('A test comment goes here.');
        });

    }

    public function test_user_turns_off_comments()
    {
        $super = Role::find(1);
        $user = factory(User::class)->create([
            'activated' => true
        ]);
        $user->attachRole($super);

        $this->browse(function (Browser $browser) use ($user) {
            $postName = $this->faker->lexify('??????');
            $browser->loginAs($user)
                    ->visit('/admin/content/posts')
                    ->pause(2000)
                    ->assertPathIs('/admin/content/posts')
                    ->press('Create')
                    ->pause(2000)
                    ->assertPathIs('/admin/content/posts/create')
                    ->type('title', $postName)
                    ->press('Save')
                    ->pause(1000);

            $browser->visit('/admin/settings/comments')
                    ->pause(2000)
                    ->assertPathIs('/admin/settings/comments')
                    ->select('type', 'off')
                    ->press('Save')
                    ->pause(2000)
                    ->visit('/admin/settings/comments')
                    ->pause(2000)
                    ->assertSelected('type', 'off');

            $browser->visit('/posts/' . $postName)
                    ->pause(1000)
                    ->assertSee($postName)
                    ->assertDontSee('Load Comments');
        });

    }
}
