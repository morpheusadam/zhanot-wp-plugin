# Zhanot Bar

Zhanot Bar is a WordPress plugin for creating and managing responsive notification bars, aimed at marketers, store owners, and agencies who need site-wide announcements they can schedule and style.

## Overview

The plugin turns announcements — sales, deadlines, promotions, alerts — into a managed content type with categories, per-notice settings, and a global settings panel for custom styling. A notice can be shown automatically at the top of the site or embedded anywhere through a shortcode.

It integrates with the Elementor and WPBakery (Visual Composer) page builders, ships a dashboard widget, and includes a Jalali (Shamsi) date picker for scheduling. A Persian (`fa_IR`) translation is bundled.

## Features

- Unlimited notifications, each managed as its own entry.
- Responsive bars that adapt to any screen size.
- Customisation of background colour, content background, text colour, background image, and a call-to-action button.
- Timed notices with an end date, surfaced in the WordPress dashboard.
- Categories for grouping notifications.
- Automatic display of a chosen notice at the top of the site, in full-width layout.
- A shortcode and a PHP snippet for each notice, shown on the listing and add-notice screens.
- Bundled Elementor widget and WPBakery / Visual Composer element.
- A recent-posts / notifications widget for the WordPress admin.
- Global settings panel with custom styles and an in-plugin help guide.
- Update support from the Plugins screen, including a check for the latest version.
- Jalali (Shamsi) date picker for scheduling.
- Persian (`fa_IR`) translation as `.po` and `.mo` files.

## Requirements

- A working WordPress installation.
- PHP 7 or later.

## Installation

1. Download the plugin, either by cloning this repository or downloading a ZIP of it.
2. In the WordPress dashboard go to Plugins > Add New > Upload Plugin.
3. Upload the plugin archive and click Install Now.
4. Activate the plugin from the Plugins menu.

```bash
git clone https://github.com/morpheusadam/ZhanotBar.git
```

## Usage

1. After activation, open the Notifications section in the WordPress dashboard.
2. Create a notification and set its colours, background, button, category, and optionally an end date for a timed notice.
3. Let Zhanot display it automatically at the top of the site, or copy the generated shortcode to place it anywhere, including inside Elementor or WPBakery layouts.
4. Use the Settings page to add global custom styles and read the built-in help guide.

## Tech stack

| Layer | Technology |
| --- | --- |
| Platform | WordPress plugin |
| Language | PHP 7+ |
| Front end | JavaScript / jQuery, Select2, custom icon font |
| Builders | Elementor, WPBakery (Visual Composer) |
| i18n | gettext, with an `fa_IR` translation bundled |

## Project structure

```text
ZhanotBar/
├── zhanot.php            # main plugin bootstrap and constants
├── core.php              # core loader
├── admin/                # admin menu, AJAX, hooks, licence, functions
├── includes/
│   ├── classes/          # notification loop, functions, flash messages
│   │   ├── elementor/    # Elementor integration
│   │   ├── VC/           # WPBakery / Visual Composer integration
│   │   ├── view/         # template creator
│   │   └── widgets/      # dashboard and show-posts widgets
│   ├── metas/            # meta boxes (panel, save)
│   ├── settings/         # general, display and help settings tabs
│   ├── lib/jalali.php    # Jalali (Shamsi) date support
│   └── TMCE/             # TinyMCE shortcode selector
├── assets/               # css, js, fonts, images
├── languages/            # fa_IR translation (.po / .mo)
└── uninstall.php
```

## Contributing

Open an [issue](https://github.com/morpheusadam/ZhanotBar/issues) or submit a pull request with features, builder integrations, translations, or fixes.

## Licence

GPL-3.0. See [`LICENSE`](LICENSE) for details.

## Author

Morpheus Adam — web developer, PHP / Laravel / Go.

- GitHub: [morpheusadam](https://github.com/morpheusadam)
- Website: [sam.zeonic.me](https://sam.zeonic.me)
- Email: morpheusadam95@gmail.com
