default_run_options[:pty] = true

set :application, "nippou"
set :repository,  "git@github.com:luckymancvp/nippou.git"
set :scm, :git
set :git_enable_submodules, 1

set :ssh_options, { :forward_agent => true }
set :use_sudo, false
set :user, "ec2-user"

# If you aren't deploying to /u/apps/#{application} on the target
# servers (which is the default), you can specify the actual location
# via the :deploy_to variable:
# set :deploy_to, "/var/www/#{application}"
set :deploy_to, "/var/www/html/app/#{application}"
set :branch, "master"

# If you aren't using Subversion to manage your source code, specify
# your SCM below:
# set :scm, :subversion

role :app, "54.250.134.71"

after "deploy:create_symlink", "my_namespace:symlink"
 
namespace :my_namespace do
  desc "Create symlink"
  task :symlink do
    run "mkdir -p #{shared_path}/system/assets"
    run "mkdir -p #{shared_path}/log/runtime"
    
    run "ln -nfs #{release_path} /var/www/html/#{application}"
    run "ln -nfs #{shared_path}/system/assets #{release_path}/assets"
    run "ln -nfs #{shared_path}/log/runtime #{release_path}/protected/runtime"

    run "chmod 777 #{shared_path}/system/assets"
  	run "chmod 777 #{shared_path}/log/runtime"
  end
end