=== MRW Card Block ===
Contributors: mrwweb
Tags: Block, Blocks, Media & Text, Card, Block Editor
Requires at least: 6.6
Tested up to: 6.7
Requires PHP: 7.0
Stable tag: 0.4.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A variation of the Media & Text block that creates a "Card" with stacked media and content.

== Description ==

A variation of the Media & Text block that creates a "Card" with stacked media and content. This plugin adds support for the aspect ratio of the image. Since it is a block variation, uninstalling the plugin will just have the cards fall back to Media & Text blocks, preserving all content.

== Changelog ==

= 0.4.2 (November 21, 2024) =

- Add support for new `.is-image-fill-element` class introduced in WordPress 6.7

= 0.4.1 (June 28, 2024) =

- Fix support for "Original" aspect ratio
- Fix card block when used in Grid Group block variation

= 0.4.0 (June 24, 2024) =

- Add support for aspect ratios using WordPress defaults or whatever is defined in theme.json
- Change default min-height for image to 0px so aspect ratios always work. Can set easily in CSS with `--mrw-card--min-height` custom property
- Remove gulp build process and replace with wp-scripts
- Now requires PHP 7.0 and WordPress 6.6+ (currently in Beta 3)

= 0.3.0 (May 20, 2024) =

- Use custom properties for styling for easier overrides
- Use spacing scale (40) for content area padding of the block, if it's set. Fall back to 8% if not.
- Redo build process to fix dependency issues in Widget Editor and Site Editor and use wp-scripts. Drops SASS build process entirely.

= 0.2.1 =

- Hide image drag handle that won't do anything

= 0.2.0 =

- Add [Github updater class from @radishconcepts](https://github.com/radishconcepts/WordPress-GitHub-Plugin-Updater)

= 0.1.0 =

- First version

== Upgrade Notice ==

= 0.4.1 =
Requires WordPress 6.6! Adds aspect ratio support!

= 0.2.0 =
Hide image drag handle
