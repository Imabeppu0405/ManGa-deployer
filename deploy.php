<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/Imabeppu0405/ManGa.pro.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('ManGa')
    ->set('hostname', 'ec2-43-206-153-90.ap-northeast-1.compute.amazonaws.com')
    ->set('remote_user', 'ec2-user')
    ->set('deploy_path', '/var/www')
    ->set('identity_file', '~/.ssh/ManGa_key.pem');;

desc('build');
task('build', function() {
    run('cd /var/www/current; npm run build');
});

after('deploy', 'build');
after('rollback', 'build');
// Hooks

after('deploy:failed', 'deploy:unlock');
