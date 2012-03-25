<div class="ppp-icon-<?php print $post->icon ?>"></div>
<span class="ppp-postdate">written <?php print format_date($post->post_date, 'custom', 'l, F j Y H:i') ?></span>
<a class="ppp-icon-profile" href="<?php print url('member/' . $user->uid) ?>" alt="Profile" title="View Profile"></a>
<a class="ppp-icon-homepage" href="<?php print $user->homepage ?>" alt="Homepage" title="View Homepage"></a>
<span id="<?php print str_pad($post->pid, 6, 0) ?>">#<?php print $post->pid ?></span>
<hr class="ppp-rule" />
<?php $editline = '<small>[ ' . date('l, F d, Y H:i', $post->edit_date) . ': Message edited by: ' . ($post->edit_name) . ' ]</small>' ?>
<?php print str_replace('[edit]', $editline, check_markup($post->body, variable_get('ppp_legacy_post_format', 'xbbcode'))) ?>
<hr class="ppp-rule" />
<span class="ppp-postcount">Posts: <strong><?php print l($user->posts, 'member/' . $user->uid . '/posts') ?></strong></span> | 
<span class="ppp-registered">Registered: <strong><?php print format_date($user->joined, 'custom', 'l, F j Y H:i') ?></strong>
