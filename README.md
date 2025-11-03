# MRW Card Block

v0.6.0

Mark Root-Wiley, [MRW Web Design](https://mrwweb.com)

A variation of the Media & Text block that creates a "Card" with stacked media and content. Adds support for the aspect ratio of the image to allow for nice, balanced layouts.

Since it is a block variation rather than a standalone block, uninstalling the plugin will just have the cards fall back to Media & Text blocks, preserving all content.

## Changelog

### 0.6.0 (October 23, 2025)

- Add block link style

### 0.5.0 (August 20, 2025)

- Don't show "Aspect Ratio" setting if "Crop to Fill" is false
- Change "Original" to "Default" is Aspect Ratio setting to reflect that there will always be an aspect ratio applied if the "Crop to Fill" option is set
- Fix media placeholder style error
- Fix missing textdomain

### 0.4.3 (December 16, 2024)

- Load Github updater on `admin_init` hook to prevent "`_load_textdomain_just_in_time` was called incorrectly" error introduced with WordPress 6.7
- Remove duplicate require_once statement loading Github updater

### 0.4.2 (November 21, 2024)

- Add support for new `.is-image-fill-element` class introduced in WordPress 6.7

### 0.4.1 (June 28, 2024)

- Fix support for "Original" aspect ratio
- Fix card block when used in Grid Group block variation

### 0.4.0 (June 24, 2024)

- Add support for aspect ratios using WordPress defaults or whatever is defined in theme.json
- Change default min-height for image to 0px so aspect ratios always work. Can set easily in CSS with `--mrw-card--min-height` custom property
- Remove gulp build process and replace with wp-scripts
- Now requires PHP 7.0 and WordPress 6.6+ (currently in Beta 3)

### 0.3.0 (May 20, 2024)

- Use custom properties for styling for easier overrides
- Use spacing scale (40) for content area padding of the block, if it's set. Fall back to 8% if not.
- Redo build process to fix dependency issues in Widget Editor and Site Editor and use wp-scripts. Drops SASS build process entirely.

### 0.2.1

- Hide image drag handle that won't do anything

### 0.2.0

- Add [Github updater class from @radishconcepts](https://github.com/radishconcepts/WordPress-GitHub-Plugin-Updater)

### 0.1.0

- First version

## License

[GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
