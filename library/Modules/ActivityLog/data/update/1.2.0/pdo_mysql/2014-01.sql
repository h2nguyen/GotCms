SET foreign_key_checks=0;

UPDATE activity_log_template SET template = '<?php $user = $this->event->getParam(''user''); ?><?php $remote = new \\Zend\\Http\\PhpEnvironment\\RemoteAddress; ?><?= $this->escapeHtml($user ? $user->getName() : $remote->getIpAddress()) ?> has saved the user model <a href="<?= $this->url(''config/user/edit'', array(''id'' => $this->event->getTarget()->getId())) ?>"><?= $this->event->getTarget()->getName(); ?></a>' WHERE event_identifier = 'Gc\\User\\Model' and event_name = 'after.save';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has saved the user model <a href="<?= $this->url(''config/user/edit'', array(''id'' => $this->event->getTarget()->getId())) ?>"><?= $this->event->getTarget()->getName(); ?></a>' WHERE event_identifier = 'Gc\\User\\Model' AND event_name = 'after.save';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has saved the datatype model <a href="<?= $this->url(''development/datatype/edit'', array(''id'' => $this->event->getTarget()->getId())) ?>"><?= $this->event->getTarget()->getName(); ?></a>' WHERE event_identifier = 'Gc\\Datatype\\Model' AND event_name = 'after.save';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has deleted the datatype model <strong>"<?= $this->escapeHtml($this->event->getTarget()->getName()); ?>"</strong>' WHERE event_identifier = 'Gc\\User\\Model' AND event_name = 'after.save';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has deleted the document model <strong>""<?= $this->escapeHtml($this->event->getTarget()->getName()); ?>"</strong>' WHERE event_identifier = 'Gc\\Document\\Model' AND event_name = 'after.delete';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has saved the document model <a href="<?= $this->url(''content/document/edit'', array(''id'' => $this->event->getTarget()->getId())) ?>"><?= $this->event->getTarget()->getName(); ?></a>' WHERE event_identifier = 'Gc\\Document\\Model' AND event_name = 'after.save';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has saved the document type model <a href="<?= $this->url(''development/document-type/edit'', array(''id'' => $this->event->getTarget()->getId())) ?>"><?= $this->event->getTarget()->getName(); ?></a>' WHERE event_identifier = 'Gc\\DocumentType\\Model' AND event_name = 'after.save';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has deleted the layout model <strong>"<?= $this->escapeHtml($this->event->getTarget()->getName()); ?>"</strong>' WHERE event_identifier = 'Gc\\Layout\\Model' AND event_name = 'after.delete';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has deleted the document type model <strong>"<?= $this->escapeHtml($this->event->getTarget()->getName()); ?>"</strong>' WHERE event_identifier = 'Gc\\DocumentType\\Model' AND event_name = 'after.delete';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has deleted the view model <strong>"<?= $this->escapeHtml($this->event->getTarget()->getName()); ?>"</strong>' WHERE event_identifier = 'Gc\\View\\Model' AND event_name = 'after.delete';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has deleted the script model <strong>"<?= $this->escapeHtml($this->event->getTarget()->getName()); ?>"</strong>' WHERE event_identifier = 'Gc\\Script\\Model' AND event_name = 'after.delete';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has saved the view model <a href="<?= $this->url(''development/view/edit'', array(''id'' => $this->event->getTarget()->getId())) ?>"><?= $this->event->getTarget()->getName(); ?></a>' WHERE event_identifier = 'Gc\\View\\Model' AND event_name = 'after.save';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has saved the script model <a href="<?= $this->url(''development/script/edit'', array(''id'' => $this->event->getTarget()->getId())) ?>"><?= $this->event->getTarget()->getName(); ?></a>' WHERE event_identifier = 'Gc\\Script\\Model' AND event_name = 'after.save';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has saved the layout model <a href="<?= $this->url(''development/layout/edit'', array(''id'' => $this->event->getTarget()->getId())) ?>"><?= $this->event->getTarget()->getName(); ?></a>' WHERE event_identifier = 'Gc\\Layout\\Model' AND event_name = 'after.save';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> has deleted the user model <strong>"<?= $this->escapeHtml($this->event->getTarget()->getName()); ?>"</strong>' WHERE event_identifier = 'Gc\\User\\Model' AND event_name = 'after.delete';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getTarget()->getName()) ?> is now connected with the ip address: <strong><?php $remote = new \\Zend\\Http\\PhpEnvironment\\RemoteAddress; echo $this->escapeHtml($remote->getIpAddress()); ?></strong>' WHERE event_identifier = 'Gc\\User\\Model' AND event_name = 'after.auth';
UPDATE activity_log_template SET template = '<?= $this->escapeHtml($this->event->getParam(''user'')) ?> tried to connect with <strong>"<?= $this->escapeHtml($this->event->getParam(''login'')); ?>"</strong>' WHERE event_identifier = 'Gc\\User\\Model' AND event_name = 'after.auth.failed';

SET foreign_key_checks=1;
