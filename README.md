A Vagrant profile that installs a LEMP stack split into two Ubuntu 16.04 (Xenial) virtual machines using VirtualBox for virtualization and Ansible for provisioning.

* Machine 1 (`db1`): MySQL 5.7
* Machine 2 (`web1`): Nginx, PHP 7.1 and PHP FPM

## Installation

Requirements:

* [VirtualBox](https://www.virtualbox.org/)
* [VirtualBox Guest Additions](https://docs.oracle.com/cd/E36500_01/E36502/html/qs-guest-additions.html)
* [Vagrant](https://www.vagrantup.com/) >= 1.8
* [Vagrand Host Manager](https://github.com/devopsgroup-io/vagrant-hostmanager)\*
* [Ansible](http://docs.ansible.com/ansible/intro_installation.html) >= 1.6

\* The Vagrand Host Manager plugin is used to ease communication between the hosts defined in the `Vagrantfile`.

To install the necessary Ansible roles, change directory into the folder containing the `Vagrantfile` and issue the following command:

```SHELL
$ ansible-galaxy install -r ansible-requirements.yml
```

## Usage

### Start Vagrant and log into the VMs (virtual machines)

Start all Vagrant VMs with the following command:

```SHELL
$ vagrant up
```

To SSH into a VM, `web1` for example, use this command:

```SHELL
$ vagrant ssh web1
```

### Access the web application from your browser

You can modify your host machine's hosts file (typically `/etc/hosts` on Mac and Linux) by appending the following line to it:

```
192.168.34.90   web-app.local
```

(`web-app.local` is the hostname configured by default in the `Vagrantfile`.)

That will allow you to visit `http://web-app.local/index.php` in a browser and see the web application in action (the web application, in this case, is a single PHP file, `index.php`).

### Update the VMs

To re-provision the machines after updates to the Ansible files, you can use the `provision` command. For example, to re-provision the `web1` machine you can use:

```SHELL
$ vagrant web1 provision --provision-with ansible
```

## Databases

### Credentials

The credentials for the `web-app` database (inside the `db1` VM) are:

* username: `web-app`
* password: `web-app`

The `index.php` file (inside the `web-app` directory) contains a simple example of how to access that database from the PHP application.

### Environment variables

The database credentials are exposed as environment variables in the web VM (`web1`), so your PHP application can make use of them instead of relying on hard-coded values; frameworks like Symfony allow you to use those variables from inside their configuration files.

