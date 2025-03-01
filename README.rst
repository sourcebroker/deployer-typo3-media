deployer-typo3-media
====================

      .. image:: http://img.shields.io/packagist/v/sourcebroker/deployer-typo3-media.svg?style=flat
         :target: https://packagist.org/packages/sourcebroker/deployer-typo3-media

      .. image:: https://img.shields.io/badge/license-MIT-blue.svg?style=flat
         :target: https://packagist.org/packages/sourcebroker/deployer-typo3-media

.. contents:: :local:

Notice (!!!)
------------
This is experimental package for now. Do not use it yet.


What does it do?
----------------

This package provides settings to use package `sourcebroker/deployer-extended-media`_  with TYPO3 CMS.
It allows to sync media between instances.

Installation
------------

1) Install package with composer:
   ::

      composer require sourcebroker/deployer-typo3-media


2) Put following lines on the beginning of your deploy.php:
   ::

      require_once(__DIR__ . '/vendor/autoload.php');
      new \SourceBroker\DeployerLoader\Loader([
        ['get' => 'sourcebroker/deployer-typo3-media'],
      ]);


   If you have some conflicts of packages between your root project and deployer.phar you can try
   to use ``/vendor/sourcebroker/deployer-loader/autoload.php`` instead of ``/vendor/autoload.php``.


Synchronizing media
-------------------

The command for synchronizing media from production to local instance (usually your laptop):
::

   dep media:pull production


Command for synchronizing media from production to staging instance is:
::

   dep media:copy production --options=target:staging

Command for synchronizing media from production to staging, creating symlinks to each file in shared folder
if both instances are at the same server. Good to safe space on disk:

::

   dep media:link production --options=target:staging


Example of working configuration
--------------------------------

This is example of working configuration for TYPO3 13.

::

  <?php

  namespace Deployer;

  require_once(__DIR__ . '/vendor/autoload.php');
  new \SourceBroker\DeployerLoader\Loader([
    ['get' => 'sourcebroker/deployer-typo3-media'],
  ]);

  host('production')
      ->setHostname('vm-dev.example.com')
      ->setRemoteUser('deploy')
      ->set('bin/php', '/home/www/t3base13-public/production/.bin/php');
      ->set('deploy_path', '~/t3base13/production');

  host('staging')
      ->setHostname('vm-dev.example.com')
      ->setRemoteUser('deploy')
      ->set('bin/php', '/home/www/t3base13-public/staging/.bin/php');
      ->set('deploy_path', '~/t3base13/staging');

  localhost('local')
      ->set('bin/php', 'php')
      ->set('deploy_path', getcwd());



Changelog
---------

See https://github.com/sourcebroker/deployer-typo3-media/blob/master/CHANGELOG.rst


.. _sourcebroker/deployer-extended-media: https://github.com/sourcebroker/deployer-extended-media
