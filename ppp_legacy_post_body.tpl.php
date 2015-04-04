<span class="ppp-icon ppp-icon-<?php print $post->icon ?>"></span>
<span class="ppp-postdate">written <?php print format_date($post->post_date, 'custom', 'l, F j Y H:i') ?></span>
<a class="ppp-icon ppp-icon-profile" href="<?php print url('member/' . $user->uid) ?>" title="View Profile"><span class="alt-text">Profile</span></a>
<?php if (valid_url($user->homepage, TRUE)) : ?>
<a class="ppp-icon ppp-icon-homepage" href="<?php print $user->homepage ?>" title="View Homepage"><span class="alt-text">Homepage</span></a>
<?php endif; ?>
<a<?php if ($in_topic) print ' id="' . sprintf('%06d', $post->pid) . '"' ?>>#<?php print $post->pid ?></a>
<hr class="ppp-rule" />
<?php $editline = $post->edit_date ? ('<small>[ ' . format_date($post->edit_date, 'custom', 'l, F d, Y H:i') . ': Message edited by: ' . ($post->edit_name) . ' ]</small>' ) : '' ?>
<?php print str_replace('[edit]', $editline, check_markup($post->body, variable_get('ppp_legacy_post_format', 'xbbcode'))) ?>
<?php if (arg(1) == 1 && (arg(2) == 1484 && $post->pid == 0) || (arg(2) == 888 && $post->pid == 310)) print '<br /><img src="http://stuff.ermarian.net/arancaytar/images/dwcrack.png" />'; ?>
<hr class="ppp-rule" />
<span class="ppp-postcount">Posts: <strong><?php print l($user->posts, 'member/' . $user->uid) ?></strong></span> | 
<span class="ppp-registered">Registered: <strong><?php print format_date($user->joined, 'custom', 'l, F j Y H:i') ?></strong></span>
