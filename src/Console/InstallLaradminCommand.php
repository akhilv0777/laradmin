<?php

namespace Akhilesh\Laradmin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class InstallLaradminCommand extends Command
{
    protected $signature = 'laradmin:install {--roles=}';
    protected $description = 'Setup Spatie roles and seed Super Admin + migrations';

    public function handle(): int
    {
        $this->call('vendor:publish', [
            '--provider' => 'Spatie\\Permission\\PermissionServiceProvider',
            '--force' => false
        ]);

        $this->call('migrate');

        $rolesInput = $this->option('roles') ?: $this->ask('Comma-separated roles (blank = defaults)', '');
        $roles = array_filter(array_map('trim', $rolesInput ? explode(',', $rolesInput) : config('laradmin.default_roles', [])));
        if (empty($roles)) $roles = ['user'];

        foreach ($roles as $r) Role::findOrCreate($r);
        Role::findOrCreate('super_admin');

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

        $this->info("Super admin: {$email} / {$password}");
        $this->info('Roles: '.implode(', ', $roles));
        $this->info('Laradmin installed ✅');
        return self::SUCCESS;
    }
}
