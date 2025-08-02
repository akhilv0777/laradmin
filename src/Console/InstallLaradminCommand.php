<?php

namespace Akhilesh\Laradmin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;
use App\Models\User;

class InstallLaradminCommand extends Command
{
    protected $signature = 'laradmin:install {--roles=}';
    protected $description = 'Setup Laradmin (spatie roles, assets, views, super admin)';

    public function handle(): int
    {
        // 1. Publish all package resources
        $this->info('🔧 Publishing config, views, and assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'laradmin-config']);
        $this->callSilent('vendor:publish', ['--tag' => 'laradmin-views']);
        $this->callSilent('vendor:publish', ['--tag' => 'laradmin-assets']);
        $this->callSilent('vendor:publish', ['--provider' => 'Spatie\\Permission\\PermissionServiceProvider']);

        // 2. Run migrations
        $this->info('📦 Running migrations...');
        $this->call('migrate');

        // 3. Create roles
        $this->info('🔐 Seeding roles...');
        $rolesInput = $this->option('roles') ?: $this->ask('Comma-separated roles (blank = defaults)', '');
        $roles = array_filter(array_map('trim', $rolesInput ? explode(',', $rolesInput) : config('laradmin.default_roles', [])));
        if (empty($roles)) $roles = ['user'];

        foreach ($roles as $r) Role::findOrCreate($r);
        Role::findOrCreate('super_admin');

        // 4. Create super admin
        $email = config('laradmin.super_admin.email');
        $password = config('laradmin.super_admin.password');
        $user = User::firstOrCreate(['email' => $email], [
            'name' => config('laradmin.super_admin.name'),
            'password' => Hash::make($password),
        ]);

        $user->assignRole('super_admin');

        if (config('laradmin.super_admin.force_password_change')) {
            $user->forceFill(['must_change_password' => true])->save();
        }

        $this->info("✅ Super admin created: {$email} / {$password}");
        $this->info('Roles: '.implode(', ', $roles));

        // 5. Check if User model has HasRoles trait
        $this->checkUserModelForHasRoles();

        $this->info('🎉 Laradmin installation complete!');
        return self::SUCCESS;
    }

    protected function checkUserModelForHasRoles(): void
    {
        $userModel = app_path('Models/User.php');
        if (!File::exists($userModel)) {
            $this->warn('⚠️ User model not found at expected path: app/Models/User.php');
            return;
        }

        $content = File::get($userModel);
        if (!str_contains($content, 'HasRoles')) {
            $this->warn("⚠️ Please add 'use HasRoles;' in your User model.");
            $this->line("Eg:");
            $this->line("use Spatie\Permission\Traits\HasRoles;");
            $this->line("class User extends Authenticatable { use HasRoles; }");
        }
    }
}
