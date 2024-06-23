<?php

namespace Deployer;

require 'recipe/laravel.php';

set('repository', 'https://github.com/swordfish-studio-s/laravel-backend.git');

set('branch', 'main');
set('default_stage', 'production');

set('git_tty', true);
set('git_cache', true);
set('ssh_multiplexing', false);
set('keep_releases', 5);

// Shared files/dirs between deploys
add('shared_files', ['.env']);
add('shared_dirs', ['/storage']);

// Writable dirs by web server
add('writable_dirs', []);

// Hosts

host('100.84.82.70')
    ->set('remote_user','swordfish')
    ->set('deploy_path', '/home/swordfish/htdocs/swordfish.luciousdev.nl')
    ->set('branch', 'main');

// Tasks

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate');
