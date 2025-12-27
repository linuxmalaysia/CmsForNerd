<?php

declare(strict_types=1);

require __DIR__ . '/includes/common.inc.php';

use CmsForNerd\CmsContext;

$ctx = new CmsContext();

// Example Copilot-friendly prompts (leave as comments for Copilot to act on):
// TODO-COPILOT: "Create a simple about page that includes the contents/about-body.inc
// file and uses the site's header and footer partials. Keep markup semantic."
// TODO-COPILOT: "Add a unit test that asserts the about page includes the phrase
// 'CmsForNerd' and that the contents/about-body.inc file exists."

pageheader($ctx, 'About CmsForNerd');
require __DIR__ . '/contents/about-body.inc';
pagecontent($ctx);
pagetailer($ctx);

// End of about.php
