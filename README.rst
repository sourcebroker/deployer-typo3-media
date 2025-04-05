deployer-typo3-media
====================

      .. image:: http://img.shields.io/packagist/v/sourcebroker/deployer-typo3-media.svg?style=flat
         :target: https://packagist.org/packages/sourcebroker/deployer-typo3-media

      .. image:: https://img.shields.io/badge/license-MIT-blue.svg?style=flat
         :target: https://packagist.org/packages/sourcebroker/deployer-typo3-media

.. contents:: :local:


What does it do?
----------------

This package allows to sync media between instances using host data stored in `deployer`_ configuration.

It allows to copy files to your local instance, copy files between instances, but also symlink files
instead of copy to save disk space (if the staging instance is at the same server as production).

This package only extends `sourcebroker/deployer-extended-media`_  with settings specific for TYPO3 CMS.


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


3) Create ``.env`` file (or ``.env.local``) in your project root. The ``.env`` (or ``.env.local``) file should be out of git
   because you need to store there information about instance name in var ``INSTANCE``. The ``INSTANCE`` value must correspond to
   ``host()`` name.

   For following real, example configuration:

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
          ->set('bin/php', '/usr/bin/php8.4')
          ->set('deploy_path', '~/t3base13/production');

      host('staging')
          ->setHostname('vm-dev.example.com')
          ->setRemoteUser('deploy')
          ->set('bin/php', '/usr/bin/php8.4')
          ->set('deploy_path', '~/t3base13/staging');



   you would need to create file ``.env`` (or ``.env.local``) with following content:

   a. ``INSTANCE=production`` at host defined by ``host('production')``
   b. ``INSTANCE=staging`` at host defined by ``host('staging')``
   c. ``INSTANCE=local`` at your local env (laptop)

   As an alternative you can also not create any env file but make sure that
   the env variable INSTANCE exists in system at hosts defined in deplyer
   (and also at your local host).


Synchronizing media
-------------------

The commands for synchronizing media for the example above configuration would be:

* For syncing media from production to local instance (usually your laptop):

  ::

   dep media:pull production


* For syncing media from production to staging instance is:

  ::

   dep media:copy production --options=target:staging

* For syncing media from production to staging, creating symlinks to each file in shared folder
  if both instances are at the same server. Good to safe space on disk:

  ::

   dep media:link production --options=target:staging

* For syncing media from local to staging: (use with care - generally not recommended)

  ::

   dep media:push staging

* For syncing media from local to production: (use with care! - generally strongly not recommended)

  ::

   dep media:push production


Changelog
---------

See https://github.com/sourcebroker/deployer-typo3-media/blob/master/CHANGELOG.rst

.. _sourcebroker/deployer-extended-media: https://github.com/sourcebroker/deployer-extended-media
.. _deployer: https://deployer.org