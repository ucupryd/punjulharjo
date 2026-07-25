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

    public function test_admin_can_upload_custom_hero_with_backup_and_restore(): void
    {
        \Illuminate\Support\Facades\Storage::fake('public_direct');
        $admin = User::factory()->create(['role' => 'admin']);

        // Upload 1 (File A)
        $fileA = \Illuminate\Http\UploadedFile::fake()->image('heroA.jpg');
        $response = $this->actingAs($admin)->post('/admin/hero/update-custom', [
            'hero_key' => 'hero_testimoni',
            'hero_image' => $fileA,
        ]);
        $response->assertRedirect();
        
        $pathA = \App\Models\SiteSetting::getValue('hero_testimoni');
        $this->assertNotNull($pathA);
        $this->assertNull(\App\Models\SiteSetting::getValue('hero_testimoni_backup'));

        // Upload 2 (File B)
        $fileB = \Illuminate\Http\UploadedFile::fake()->image('heroB.jpg');
        $response = $this->actingAs($admin)->post('/admin/hero/update-custom', [
            'hero_key' => 'hero_testimoni',
            'hero_image' => $fileB,
        ]);
        $response->assertRedirect();

        $pathB = \App\Models\SiteSetting::getValue('hero_testimoni');
        $pathBackupB = \App\Models\SiteSetting::getValue('hero_testimoni_backup');
        $this->assertEquals($pathA, $pathBackupB);

        // Upload 3 (File C)
        $fileC = \Illuminate\Http\UploadedFile::fake()->image('heroC.jpg');
        $response = $this->actingAs($admin)->post('/admin/hero/update-custom', [
            'hero_key' => 'hero_testimoni',
            'hero_image' => $fileC,
        ]);
        $response->assertRedirect();

        $pathC = \App\Models\SiteSetting::getValue('hero_testimoni');
        $pathBackupC = \App\Models\SiteSetting::getValue('hero_testimoni_backup');
        $this->assertEquals($pathB, $pathBackupC);

        // Restore / Undo test
        $response = $this->actingAs($admin)->post('/admin/hero/restore', [
            'hero_key' => 'hero_testimoni',
        ]);
        $response->assertRedirect();

        $this->assertEquals($pathB, \App\Models\SiteSetting::getValue('hero_testimoni'));
        $this->assertEquals($pathC, \App\Models\SiteSetting::getValue('hero_testimoni_backup'));
    }
}
