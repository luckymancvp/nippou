set :application, "nippou"
set :repository,  "git@github.com:luckymancvp/nippou.git"
set :scm, :git

set :ssh_options, { :forward_agent => true }
set :use_sudo, false
set :user, "ec2-user"

# If you aren't deploying to /u/apps/#{application} on the target
# servers (which is the default), you can specify the actual location
# via the :deploy_to variable:
# set :deploy_to, "/var/www/#{application}"
set :deploy_to, "/home/ec2-user/#{application}"
set :branch, "master"

# If you aren't using Subversion to manage your source code, specify
# your SCM below:
# set :scm, :subversion

role :app, "54.250.134.71"