<span class="ppp-icon ppp-icon-<?php print $post->icon ?>"></span>
<span class="ppp-postdate">written <?php print format_date($post->post_date, 'custom', 'l, F j Y H:i') ?></span>
<a class="ppp-icon ppp-icon-profile" href="<?php print url('member/' . $user->uid) ?>" alt="Profile" title="View Profile"></a>
<a class="ppp-icon ppp-icon-homepage" href="<?php print $user->homepage ?>" alt="Homepage" title="View Homepage"></a>
<a name="<?php print sprintf('%06d', $post->pid) ?>" id="<?php print $post->pid; ?>">#<?php print $post->pid ?></a>
<hr size="1" class="ppp-rule" />
<?php $editline = $post->edit_date ? ('<small>[ ' . format_date($post->edit_date, 'custom', 'l, F d, Y H:i') . ': Message edited by: ' . ($post->edit_name) . ' ]</small>' ) : '' ?>
<?php print str_replace('[edit]', $editline, check_markup($post->body, variable_get('ppp_legacy_post_format', 'xbbcode'))) ?>
<hr size="1" class="ppp-rule" />
<span class="ppp-postcount">Posts: <strong><?php print l($user->posts, 'member/' . $user->uid) ?></strong></span> | 
<span class="ppp-registered">Registered: <strong><?php print format_date($user->joined, 'custom', 'l, F j Y H:i') ?></strong></span>