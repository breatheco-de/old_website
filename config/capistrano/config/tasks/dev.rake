after :deploy ,'after_deploy' do
    on roles([:app]) do |host|
        application = 'online-4geeksacademy'
       	execute("bash -l -c \"cd #{deploy_to}/current/config/ && sudo ./server_sudo.sh #{deploy_to} online.4geeksacademy.co\"")
end
