<div align="center">

# 📢 Zhanot — Advanced WordPress Notification Bar

### Create, manage, and display fully responsive, customizable notification bars anywhere on your WordPress site — with unlimited notices, scheduling, and shortcode support.

<p>
  <img src="https://img.shields.io/github/license/morpheusadam/zhanot-wp-plugin?style=for-the-badge&color=4c1" alt="License" />
  <img src="https://img.shields.io/github/stars/morpheusadam/zhanot-wp-plugin?style=for-the-badge&color=ffca28" alt="Stars" />
  <img src="https://img.shields.io/github/forks/morpheusadam/zhanot-wp-plugin?style=for-the-badge&color=42a5f5" alt="Forks" />
  <img src="https://img.shields.io/github/last-commit/morpheusadam/zhanot-wp-plugin?style=for-the-badge&color=8e44ad" alt="Last commit" />
  <img src="https://img.shields.io/github/repo-size/morpheusadam/zhanot-wp-plugin?style=for-the-badge&color=e67e22" alt="Repo size" />
</p>

<p>
  <img src="https://img.shields.io/badge/WordPress-Plugin-21759B?style=for-the-badge&logo=wordpress&logoColor=white" alt="WordPress" />
  <img src="https://img.shields.io/badge/PHP-7%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/Elementor-Widget-92003B?style=for-the-badge&logo=elementor&logoColor=white" alt="Elementor" />
  <img src="https://img.shields.io/badge/WPBakery-Element-0073AA?style=for-the-badge&logo=wordpress&logoColor=white" alt="WPBakery" />
  <img src="https://img.shields.io/badge/JavaScript-jQuery-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
  <img src="https://img.shields.io/badge/i18n-fa__IR-007ACC?style=for-the-badge&logo=translate&logoColor=white" alt="Translation" />
</p>

</div>

---

## 📖 Overview

**Zhanot** is an advanced **WordPress notification bar plugin** that lets you create and manage **responsive, fully customizable notifications** across your website with ease. Build unlimited notices, style them to match your brand, schedule timed announcements, and place them at the top of your site automatically or embed them anywhere via shortcode.

Designed for **marketers, store owners, and WordPress agencies**, Zhanot turns site-wide announcements — sales, deadlines, promotions, alerts — into a managed content type with categories, per-notice settings, and a global settings panel for custom styling. It integrates with **Elementor** and **WPBakery (Visual Composer)** page builders, ships a **dashboard widget**, and includes a built-in **Jalali (Shamsi) date picker** for scheduling, with full Persian (`fa_IR`) translation included.

> 🔎 **Keywords:** WordPress notification bar, announcement bar plugin, notice bar, responsive notification plugin, WordPress promo bar, Elementor notification, WPBakery notification, shortcode notification, scheduled announcement, customizable notification bar.

---

## ✨ Features

- ♾️ **Unlimited notifications** — create as many notices as you need, each as its own manageable entry.
- 📱 **Fully responsive** — notification bars adapt cleanly to every screen size.
- 🎨 **Deep customization** — set background color, content background, and text color; choose a background image; and add a custom call-to-action button.
- ⏱️ **Timer / scheduled notices** — display an end date for timed notifications, surfaced right in the WordPress dashboard.
- 🗂️ **Categories** — group and organize notifications by category for easier management.
- 🔝 **Auto display** — show your chosen notice automatically at the top of the site, in full-width layout.
- 🔌 **Shortcode + PHP snippet** — every created notice exposes a shortcode (and PHP code) shown on the listing and add-notice screens for placing it anywhere.
- 🧩 **Page-builder ready** — bundled **Elementor** widget and **WPBakery / Visual Composer** element.
- 📊 **Dashboard widget** — a recent-posts/notifications widget for the WordPress admin.
- ⚙️ **Global settings panel** — add custom styles and review the in-plugin help/guide on the settings page.
- 🔄 **In-dashboard updates** — quick update support and a check for the latest available version from the Plugins screen.
- 📅 **Jalali (Shamsi) date picker** — built-in Persian calendar for scheduling.
- 🌍 **Translation-ready** — ships with a Persian (`fa_IR`) translation (`.po`/`.mo`).

---

## 🛠️ Tech Stack

| Layer | Technology |
| --- | --- |
| Platform | WordPress (plugin) |
| Language | PHP 7+ |
| Front-end | JavaScript / jQuery, Select2, custom icon font |
| Builders | Elementor, WPBakery (Visual Composer) |
| i18n | gettext (`fa_IR` translation bundled) |

<p align="center">
  <img src="https://skillicons.dev/icons?i=wordpress,php,js" alt="Tech stack" />
</p>

---

## 🚀 Getting Started

### Prerequisites

- A working **WordPress** installation
- **PHP 7+**

### Installation

1. Download the plugin (clone or grab a ZIP of this repository).
2. In your WordPress dashboard, go to **Plugins → Add New → Upload Plugin**.
3. Upload the plugin archive and click **Install Now**.
4. **Activate** the plugin from the Plugins menu.

```bash
git clone https://github.com/morpheusadam/zhanot-wp-plugin.git
```

---

## 📦 Usage

1. After activation, open the **Notifications** section from the WordPress dashboard.
2. Create a new notification and configure its colors, background, button, category, and (optionally) an end date for timed notices.
3. Let Zhanot display it automatically at the top of your site, or copy the generated **shortcode** to place it anywhere — including inside **Elementor** or **WPBakery** layouts.
4. Use the **Settings** page to add global custom styles and read the built-in help guide.

---

## 🗂️ Project Structure

```text
zhanot-wp-plugin/
├── zhanot.php            # main plugin bootstrap + constants
├── core.php              # core loader
├── admin/               # admin menu, AJAX, hooks, license, functions
├── includes/
│   ├── classes/         # notification loop, functions, flash messages
│   │   ├── elementor/   # Elementor integration
│   │   ├── VC/          # WPBakery / Visual Composer integration
│   │   ├── view/        # template creator
│   │   └── widgets/     # dashboard + show-posts widgets
│   ├── metas/           # meta boxes (panel, save)
│   ├── settings/        # general · display · help settings tabs
│   ├── lib/jalali.php   # Jalali (Shamsi) date support
│   └── TMCE/            # TinyMCE shortcode selector
├── assets/              # css · js · fonts · images
├── languages/          # fa_IR translation (.po / .mo)
└── uninstall.php
```

---

## 🤝 Contributing

Contributions are welcome! Open an [issue](https://github.com/morpheusadam/zhanot-wp-plugin/issues) or submit a pull request with new features, builder integrations, translations, or fixes.

## 📜 License

Distributed under the **GPL-3.0** License. See [`LICENSE`](LICENSE) for details.

---

<div align="center">

### 👤 Author — Morpheus Adam

Web developer & cheerful hacker · PHP · Laravel · Go

<p>
  <a href="https://github.com/morpheusadam"><img src="https://img.shields.io/badge/GitHub-morpheusadam-181717?style=for-the-badge&logo=github&logoColor=white" alt="GitHub" /></a>
  <a href="https://sam.zeonic.me"><img src="https://img.shields.io/badge/Website-sam.zeonic.me-4c1?style=for-the-badge&logo=googlechrome&logoColor=white" alt="Website" /></a>
  <a href="mailto:morpheusadam95@gmail.com"><img src="https://img.shields.io/badge/Email-Contact-D14836?style=for-the-badge&logo=gmail&logoColor=white" alt="Email" /></a>
</p>

⭐ **If Zhanot helped you ship better announcements, consider giving it a star!** ⭐

</div>


---

## ⭐ Star History

<a href="https://star-history.com/#morpheusadam/zhanot-wp-plugin&Date">
  <img src="https://api.star-history.com/svg?repos=morpheusadam/zhanot-wp-plugin&type=Date" alt="zhanot-wp-plugin — Star History Chart" width="70%" />
</a>

<div align="center">

### If this project helps you, please give it a ⭐

A star helps other developers discover **zhanot-wp-plugin** and supports continued development.

</div>
