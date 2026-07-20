<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\CemaraPaket;
use App\Models\CemaraAdopsi;
use App\Models\CemaraPohon;

class MyCemaraTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_view_adopsi_landing_page(): void
    {
        $response = $this->get('/adopsi');

        $response->assertStatus(200);
        $response->assertSee('My Cemara');
    }

    public function test_member_can_register_without_security_code(): void
    {
        $response = $this->post('/daftar', [
            'name' => 'Member Test',
            'email' => 'member@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('member.adopsi.dashboard'));
        $this->assertDatabaseHas('users', [
            'email' => 'member@example.com',
            'role' => 'member',
        ]);
    }

    public function test_member_cannot_access_admin_panel(): void
    {
        $member = User::factory()->create(['role' => 'member']);

        $response = $this->actingAs($member)->get('/admin/adopsi');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_panel(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/adopsi');

        $response->assertStatus(200);
    }
}
