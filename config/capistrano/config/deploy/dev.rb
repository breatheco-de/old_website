role :app, %w{deploy@4geeks.co:5388}

set :stage, :deploy
server '4geeks.co', user: 'deploy', roles: %w{app}, port: 5388

set :branch, 'master'

set :deploy_to, '/home/deploy/4geeksacademy.co/themes3'
set :application, 'online-4geeksacademy'
