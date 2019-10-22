# phpWebAppFramework
Light PHP MVC Framework to develop lightweight PHP application

Inspired and forked from https://github.com/bpesquet/Framework-MVC

Create db.sql

SQL file for the creation of the DB
An admin user must be created in order to be able to log in as administrator in the webApp (here Admin/Azerty123):

INSERT INTO `application`.`user` (`id`, `username`, `password`, `activated`, `is_admin`, `create_time`) VALUES (NULL, 'Admin', '$2y$10$x4SjfxKogs88VHhIARK1veSaeE4xXOp22Ly2x/f7hUlq0.g/Qe0dW', '1', '1', '2019-02-11 14:07:29')
