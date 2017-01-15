# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.require_version ">= 1.8"
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "ubuntu/xenial64"
  config.hostmanager.enabled = false

  config.vm.provider :virtualbox do |v|
    v.memory = 512
    v.cpus = 1
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    v.customize ["modifyvm", :id, "--ioapic", "on"]
  end

  config.vm.define "db1" do |db1|
    db1.vm.hostname = "db1"
    db1.vm.network :private_network, ip: "192.168.34.80"
    db1.vm.network "forwarded_port", guest: 3306, host: 3307
    db1.vm.synced_folder "mysql", "/vagrant"
    db1.vm.provision "shell", inline: "apt-get -y install python2.7 python-simplejson"

    db1.vm.provision "ansible" do |ansible|
      ansible.playbook = "./ansible/playbook.yml"
      ansible.groups = {
        "db" => ["db1"]
      }
    end
  end

  config.vm.define "web1" do |web1|
    web1.vm.hostname = "web1"
    web1.vm.network :private_network, ip: "192.168.34.90"
    web1.vm.network "forwarded_port", guest: 80, host: 80
    web1.vm.synced_folder ".", "/vagrant", disabled: true
    web1.vm.synced_folder "web-app", "/var/www/web-app", :owner => "www-data", :group => "www-data"
    web1.vm.provision "shell", inline: "apt-get -y install python2.7 python-simplejson"

    web1.vm.provision "ansible" do |ansible|
      ansible.playbook = "./ansible/playbook.yml"
      ansible.groups = {
        "web" => ["web1"]
      }
    end
  end

  config.vm.provision :hostmanager
end

