<?php
namespace Deployer;

require 'recipe/common.php';

use function Deployer\{host, task, run, set, get, add, before, after, upload, writeln};

// Project name
set('application', 'skyfort');

// Project repository
set('repository', 'git@github.com:Phenomenon-Studio/skyfort.io.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

set('writable_mode', 'chmod');

set('http_group', 'www-data');

set('http_user', 'deployer');

host('production')
	->hostname('157.230.94.214')
	->port(22)
	->user('deployer')
	->identityFile('~/.ssh/id_rsa')
	->forwardAgent(true)
   	->multiplexing(true)
	->set('deploy_path', '/var/www/html')
	->set('keep_releases', 5);

host('production2')
	->hostname('198.211.100.246')
	->port(22)
	->user('deployer')
	->identityFile('~/.ssh/id_rsa')
	->forwardAgent(true)
   	->multiplexing(true)
	->set('deploy_path', '/var/www/html')
	->set('keep_releases', 5);


host('dev')
	->hostname('161.35.127.204')
	->port(22)
	->user('deployer')
	->identityFile('~/.ssh/id_rsa')
	->forwardAgent(true)
   	->multiplexing(true)
	->set('deploy_path', '/var/www/html')
	->set('keep_releases', 5);

// Shared files/dirs between deploys
set('shared_files', [
	'wp-config.php',
	'.htaccess'
]);
set('shared_dirs', [
	'wp-content/uploads',
	'wp-content/cache',
	'.well-known'
]);

// Writable dirs by web server
set('writable_dirs', [
    'wp-content'
]);

set('composer_action', 'install');

set('composer_options', '{{composer_action}} --no-dev --verbose --prefer-dist --optimize-autoloader --no-progress --no-interaction --no-scripts');

// Remove unnecessary stuff
set('clear_paths', [
	'.git',
	'.github',
	'.gitignore',
	'deploy.php',
	'vendor',
	'composer.json',
	'composer.lock',
	'wp-cli.yml',
	'wp-content/plugins/akismet',
	'wp-content/plugins/hello.php',
	'wp-content/themes/twentynineteen',
	'wp-content/themes/twentytwenty',
	'wp-content/themes/twentytwentyone'
]);

// Tasks
desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// Install WordPress.
desc('Install WordPress');
task('deploy:wp', '
	wp core download;
');

after('deploy:writable', 'deploy:wp');

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
