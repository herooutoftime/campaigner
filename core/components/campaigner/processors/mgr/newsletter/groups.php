<?php

// validate properties
if (empty($_POST['id'])) {
    return $modx->error->failure($modx->lexicon('campaigner.newsletter.error.notfound'));
}

// get the object
$newsletter = $modx->getObject('Newsletter', array('id' => $_POST['id']));
if(!$newsletter) return $modx->error->failure($modx->lexicon('campaigner.newsletter.error.notfound'));

$groups = $modx->getCollection('NewsletterGroup', array('newsletter' => $newsletter->get('id')));
$done = array();

$newGroups = $_POST['groups'];
foreach($groups as $group) {
    if(!in_array($group->group, $newGroups)) {
        $delete = $modx->getObject('NewsletterGroup', array('group' => $group->group, 'newsletter' => $newsletter->get('id')));
        $delete->remove();
    } else {
        $done[] = $group->group;
    }
}
    
foreach($newGroups as $groupid) {
    if(!in_array($groupid, $done)) {
        $group = $modx->newObject('NewsletterGroup');
        $group->fromArray(array('group' => $groupid, 'newsletter' => $newsletter->get('id')));
        $group->save();
    }
}

/**
 * Feed the manager log
 */
$user = $modx->getAuthenticatedUser('mgr');
$l = $modx->newObject('modManagerLog');
$data = array(
    'user'      => $user->get('id'),
    'occurred'  => date('Y-m-d H:i:s'),
    'action'    => 'change_groups_newsletter',
    'classKey'  => 'Newsletter',
    'item'      => $newsletter->get('id')
);

$l->fromArray($data);
$l->save();

return $modx->error->success('',$newsletter);